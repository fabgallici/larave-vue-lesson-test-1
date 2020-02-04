
require('./bootstrap');

window.Vue = require('vue');

function init() {

  token = $('meta[name="csrf-token"]').attr('content');
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

  new Vue({
    el: "#app"
  });

  // $.ajax({
  //
  //   url: "http://localhost:3000/api/post/all",
  //   method: 'POST',
  //   data: {
  //     api_token: 'OMiLMjj6JJ1SFVi2bxSniWCJ9uI1HUHxuYYiNkLtWhc5WgbjaAKexvCb4yqsfgNUCE1VJrHORG7Ysnfn'
  //   },
  //   success: function(data) {
  //
  //     console.log('data', data);
  //   }, error: function (err) {
  //
  //     console.log('err', err);
  //   }
  // });
}

$(document).ready(init);
