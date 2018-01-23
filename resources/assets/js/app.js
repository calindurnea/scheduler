/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Popper = require('popper.js').default;

require('./bootstrap');

require('bootstrap-table/dist/bootstrap-table');

require('sweetalert2/dist/sweetalert2.all.min');

require('jquery-color/jquery.color');

require('bootstrap-colorpicker');

window.Vue = require('vue');

var moment = require('moment');
moment().format();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));

const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();
        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });
    },

    methods: {
        fetchMessages() {
            axios.get('/chat/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/chat/messages', message).then(response => {
                console.log(response.data);
            });
        }
    }
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


//change color input field background color on select
$('#create_user_color_select').change(function () {
    var selectInput = $('#create_user_color_select');
    var selectedColor = selectInput.find(":selected").attr('data-hex');
    selectInput.css('background', selectedColor);
});

//add table-sm class to tables on small devices
$(document).ready(function ($) {
    var addClass = function () {
        var ww = document.body.clientWidth;
        if (ww < 631) {
            $('.table').addClass('table-sm');
        } else if (ww >= 631) {
            $('.table').removeClass('table-sm');
        }
    };
    $(window).resize(function () {
        addClass();
    });
    //Fire it when the page first loads:
    addClass();
});