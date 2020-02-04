<script type="text/x-template" id="post-box">
  <div v-show="!deleted" class="box">
    <h3 @click="setFocus('title')" v-show="!isFocused('title')">@{{ upperTitle }}</h3>
    <input v-show="isFocused('title')" v-model="postTitle" type="text">
    <p @click="setFocus('body')" v-show="!isFocused('body')">@{{ shortBody }}</p>
    <textarea v-show="isFocused('body')" v-model.trim="postBody" />
    <br>
    <button @click="updatePost" v-show="!isFocused('')">SAVE</button>
    <div class="tags">
      <p v-for="tag in postTags" v-text="tag.name">
    </div>
    <button @click="destroy()">DESTROY ME</button>
  </div>
</script>
<script type="text/javascript">

  Vue.component('post-box', {

    template: "#post-box",
    data: function() {
      return {

        deleted: false,

        postTitle: this.title,
        postBody: this.body,
        postTags: this.tags,

        editField: ''
      };
    },
    props: {
      id: Number,
      title: String,
      body: String,
      tags: Array
    },
    computed: {

      upperTitle() {

        return this.postTitle.toUpperCase();
      },
      shortBody() {

        const maxLng = 30;
        var sb = this.postBody.substring(0, maxLng).trim();
        return sb + (this.postBody.length > 30 ? "..." : "");
      }
    },
    methods: {

      setFocus(element) { this.editField = element; },
      isFocused(element) { return this.editField == element; },
      updatePost() {

        console.log('update post [' + this.id + ']');

        var post = {
          _token: token,
          title: this.title,
          body: this.postBody
        };

        axios.post('/post/' + this.id + '/update/axios', post)
              .then(function(res) { console.log('res', res); })
              .catch(function(error) { console.log('error', error); })

        this.setFocus('');
      },
      destroy() {

        console.log('destroying post');

        const _this = this;
        axios.get("/post/" + this.id + "/delete/axios")
              .then(function(res) {

                  console.log('res', res);
                  _this.deleted = true;
              })
              .catch(function(err) { console.log('err', err); });
      }
    }
  });
</script>
