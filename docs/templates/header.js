$(function () {

    $('.menu_commands .close-menu, .menu_commands .open-menu').on('click', function () {

        let box = $('.menu_box');

        box.animate({width: 'toggle'}, 350);
        $('.menu_commands .close-menu').toggleClass('d-none');

    });
});