function pixflow_iconboxTopShortcode() {
    "use strict";

    var circleSvg, circle, icon, title, description, button, iconAnimate1, iconAnimate2, titleAnimate, descriptionAnimate, buttonAnimate, circleAnimate1, circleAnimate2,
        TM = TweenMax;

    $('.iconbox-top .hover-holder').hover(function () {

            circleSvg = $(this).find('.svg-circle'),
                circle = circleSvg.find('circle'),
                icon = $(this).find('.icon'),
                title = $(this).find('.title'),
                description = $(this).find('.description'),
                button = $(this).find('.shortcode-btn');

            iconAnimate1 = TM.to(icon, 0.3, {scale: 0.9});
            circleAnimate1 = TM.to(circleSvg, 0.4, {opacity: 1});
            circleAnimate2 = TM.to(circle, 1, {'stroke-dashoffset': '1px', ease: Quint.easeOut});
        },
        function () {
            iconAnimate1.pause();
            circleAnimate1.pause();
            circleAnimate2.pause();
            TM.to(icon, 0.3, {scale: 1});
            TM.to(circleSvg, 0.4, {opacity: '0.3'});
            TM.to(circle, 0.6, {'stroke-dashoffset': '360px'});
        })
}

window_load_functions.pixflow_iconboxTopShortcode = [];