
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Dropzone = require('dropzone/dist/min/dropzone.min');
/* Plupload Library */
// try{
//     require('plupload/js/plupload.full.min');
//     require('plupload/js/jquery.ui.plupload/jquery.ui.plupload.min');
// }catch(e){
//     console.log(e);
// }
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.use(VueRouter);
Vue.component('entries', require('./components/Entries.vue'));
Vue.component('media', require('./components/media/Media.vue'));
Vue.component('media-list', require('./components/media/List.vue'));
Vue.component('media-square', require('./components/media/Square.vue'));

const app = new Vue({
    el: '#app'
});

// Dropzone.options.filedrop = {
//     init: function () {
//     this.on("queuecomplete", function (file) {
//         // if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
//         //     window.location.reload();
//         // }
//         window.location.reload();
//     });
//     },
// };

// jQuery( document ).ready(function($){
//     $("button [target='elegirImagen']").on("click", function(){
//         console.log('Hice algo');
//         $('#elegirImagen').modal(
//             focus = true
//         );
//     });
// });