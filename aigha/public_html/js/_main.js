/*! viewportSize | Author: Tyson Matanich, 2013 | License: MIT */
(function (n) {
    n.viewportSize = {}, n.viewportSize.getHeight = function () {
        return t("Height")
    }, n.viewportSize.getWidth = function () {
        return t("Width")
    };
    var t = function (t) {
        var f, o = t.toLowerCase(), e = n.document, i = e.documentElement, r, u;
        return n["inner" + t] === undefined ? f = i["client" + t] : n["inner" + t] != i["client" + t] ? (r = e.createElement("body"), r.id = "vpw-test-b", r.style.cssText = "overflow:scroll", u = e.createElement("div"), u.id = "vpw-test-d", u.style.cssText = "position:absolute;top:-1000px", u.innerHTML = "<style>@media(" + o + ":" + i["client" + t] + "px){body#vpw-test-b div#vpw-test-d{" + o + ":7px!important}}<\/style>", r.appendChild(u), i.insertBefore(r, e.head), f = u["offset" + t] == 7 ? i["client" + t] : n["inner" + t], i.removeChild(r)) : f = n["inner" + t], f
    }
})(this);

(function ($) {

    var maxBreakpoint = 980; // maximum breakpoint
    var targetID = 'primary-nav'; // target ID (must be present in DOM)
    var triggerID = 'toggle-nav'; // trigger/button ID (will be created into targetID)

    // targeting navigation
    var n = document.getElementById(targetID);

    // nav initially closed is JS enabled
    n.classList.add('is-closed');

    // global navigation function
    function navi() {
        // when small screen, create a switch button, and toggle navigation class
        if (window.matchMedia("(max-width:" + maxBreakpoint + "px)").matches && document.getElementById(triggerID) == undefined) {
            n.insertAdjacentHTML('afterBegin', '<button id=' + triggerID + ' title="open/close navigation"></button>');
            t = document.getElementById(triggerID);
            t.onclick = function () {
                n.classList.toggle('is-closed');
            }
        }
        // when big screen, delete switch button, and toggle navigation class
        var minBreakpoint = maxBreakpoint + 1;
        if (window.matchMedia("(min-width: " + minBreakpoint + "px)").matches && document.getElementById(triggerID)) {
            document.getElementById(triggerID).outerHTML = "";
        }
    }
    navi();

    // when resize or orientation change, reload function
    window.addEventListener('resize', navi);

    jQuery(document).ready(function () {
                jQuery('.menu-item').click(function (evt) {
                    n.classList.toggle('is-closed');
                    var page = jQuery(this).children().attr('href');
                    var speed = 750; // Durée de l'animation (en ms)
                    jQuery('html, body').animate({scrollTop: jQuery(page).offset().top-100}, speed);
                    evt.preventDefault();
                    return false;
                });
    });


    var delays = [1000, 3000, 5000, 7000, 9000];
    $('.menu-item').addClass('animated-menu');

    $("#contact_form").submit(function (event) {
        var nom = $("#nom").val();
        var sujet = $("#sujet").val();
        var email = $("#email").val();
        var message = $("#message").val();
        var msg_alert = 'Merci de remplir ce champs';
        $('#msg_all').html('');
        $('.inp').removeClass('contact-error');
        $('.msg').removeClass('contact-error');
        
        if (nom == '')
        {
            $('#nom').addClass('contact-error');
            $('#msg_all').html(msg_alert);
        }
        else if (email == '')
        {
            $('#email').addClass('contact-error');
            $('#msg_all').html(msg_alert);
        }
        else if (sujet == '')
        {
            $('#sujet').addClass('contact-error');
            $('#msg_all').html(msg_alert);
        }
        else if (message == '')
        {
            $('#message').addClass('contact-error');
            $('#msg_all').html(msg_alert);
        }                
        else
        {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    $('#msg_all').html(response);
                },
                error: function (response) {
                    $('#msg_all').html(response);
                }
            });
        }
        return false;
    });

    // Setup variables
    $window = $(window);
    $slide = $('.homeSlide');
    $slideTall = $('.homeSlideTall');
    $slideTall2 = $('.homeSlideTall2');
    $body = $('body');

    //FadeIn all sections   
    $body.imagesLoaded(function () {
        setTimeout(function () {

            // Resize sections
            adjustWindow();

            // Fade in sections
            $body.removeClass('loading').addClass('loaded');

        }, 800);
    });

    function adjustWindow() {

        // Init Skrollr
        var s = skrollr.init({
            render: function (data) {

                //Debugging - Log the current scroll position.
                //console.log(data.curTop);
            }
        });

        // Get window size
        winH = $window.height();

        // Keep minimum height 550
        if (winH <= 550) {
            winH = 550;
        }

        // Resize our slides
        $slide.height(winH);
        $slideTall.height(winH * 2);
        $slideTall2.height(winH * 3);

        // Refresh Skrollr after resizing our sections
        s.refresh($('.homeSlide'));

    }

})(jQuery);