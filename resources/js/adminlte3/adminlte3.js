require('./bootstrap');
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

const lang = document.documentElement.lang.substr(0, 2);

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-Accept-Language'] = lang;

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'X-Accept-Language': lang
    }
});

require('@ahmed-aliraqi/check-all');

CheckAll.onChange(function (el) {
    if (el.checked) {
        el.closest('tr').classList.add("tw-bg-gray-400");
    } else {
        el.closest('tr').classList.remove("tw-bg-gray-400");
    }
});
(function ($) {

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('#flash-overlay-modal').modal();

    $('.nav-sidebar .nav-treeview .nav-item .active').each((index, el) => {
        $(el).closest('.has-treeview').addClass('menu-open');
    });

})(jQuery);

$(function () {
    var Inputmask = require('inputmask').default;
    // $('.price').mask('9999.999');
    // $(".price").inputmask({ alias : "currency", prefix: '₱ ' });
    Inputmask().mask(document.querySelectorAll("input"));
});
