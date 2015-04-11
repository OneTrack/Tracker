/* ========================================================================= */
/*	Preloader
/* ========================================================================= */

jQuery(window).load(function(){

	$("#preloader").fadeOut("slow");

});

var wow = new WOW ({
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       120,          // distance to the element when triggering the animation (default is 0)
    mobile:       false,       // trigger animations on mobile devices (default is true)
    live:         true        // act on asynchronously loaded content (default is true)
}
);
wow.init();
$(document).ready(function(){

	/* ========================================================================= */
	/*	Menu item highlighting
	/* ========================================================================= */

	jQuery('#nav').singlePageNav({
		offset: jQuery('#nav').outerHeight(),
		filter: ':not(.external)',
		speed: 1200,
		currentClass: 'current',
		easing: 'easeInOutExpo',
		updateHash: true,
		beforeStart: function() {
			console.log('begin scrolling');
		},
		onComplete: function() {
			console.log('done scrolling');
		}
	});
	
    $(window).scroll(function () {
        if ($(window).scrollTop() > 400) {
            $("#navigation").css("background-color","#0EB493");
        } else {
            $("#navigation").css("background-color","rgba(16, 22, 54, 0.2)");
        }
    });
	
	/* ========================================================================= */
	/*	Fix Slider Height
	/* ========================================================================= */	

	var slideHeight = $(window).height();
	
	$('#slider, .carousel.slide, .carousel-inner, .carousel-inner .item').css('height',slideHeight);

	$(window).resize(function(){'use strict',
		$('#slider, .carousel.slide, .carousel-inner, .carousel-inner .item').css('height',slideHeight);
	});
	
	
	/* ========================================================================= */
	/*	Portfolio Filtering
	/* ========================================================================= */	
	
	
    // portfolio filtering

    $(".project-wrapper").mixItUp();
	
	
	$(".fancybox").fancybox({
		padding: 0,

		openEffect : 'elastic',
		openSpeed  : 650,

		closeEffect : 'elastic',
		closeSpeed  : 550,

		closeClick : true,
	});
	
	/* ========================================================================= */
	/*	Parallax
	/* ========================================================================= */	
	
	$('#facts').parallax("50%", 0.3);
	
	/* ========================================================================= */
	/*	Timer count
	/* ========================================================================= */

	"use strict";
    $(".number-counters").appear(function () {
        $(".number-counters [data-to]").each(function () {
            var e = $(this).attr("data-to");
            $(this).delay(6e3).countTo({
                from: 50,
                to: e,
                speed: 3e3,
                refreshInterval: 50
            })
        })
    });
	
	/* ========================================================================= */
	/*	Back to Top
	/* ========================================================================= */
	
	
    $(window).scroll(function () {
        if ($(window).scrollTop() > 400) {
            $("#back-top").fadeIn(200)
        } else {
            $("#back-top").fadeOut(200)
        }
    });
    $("#back-top").click(function () {
        $("html, body").stop().animate({
            scrollTop: 0
        }, 1500, "easeInOutExpo")
    });
    
    // Expand Panel
    $("#open").click(function(){
            $("#panel").slideDown("slow");

    });	

    // Collapse Panel
    $("#close").click(function(){
            $("#panel").slideUp("slow");	
    });

$(window).scroll(function() {
 if ($(this).scrollTop() > 1){  
     $('header').addClass("sticky");
   }
   else{
     $('header').removeClass("sticky");
   }
});
// Switch buttons from "Log In | Register" to "Close Panel" on click
$("#toggle a").click(function () {
    $("#toggle a").toggle();
});
	
});

$(function(){
	$('#register').validate({
        rules: {
                name: {
                        required: true,
                        minlength: 2
                },
                email: {
                        required: true,
                        email: true
                },
                password: {
                        required: true,
                        minlength: 4
                },
                confirm_password:{
                	equalTo: "#password"
                }
        },
        messages: {
            name: {
                    required: "come on, you have a name don't you?",
                    minlength: "your name must consist of at least 2 characters"
            },
            email: {
                    required: "no email, no registration !"
            },
            password: {
                    required: "Oops you just missed to give password",
                    minlength: "thats all? really?"
            },
            confirm_password: {
            		equalTo: "Oh no! your confirm password and passowrd didnt match :(",
        }
    }
  
});
	$('#login').validate({
        rules: {
                email: {
                        required: true,
                        email: true
                },
                password: {
                        required: true,
                        minlength: 4
                }
        },
        messages: {
            email: {
                    required: "no email, no login"
            },
            password: {
                required: "Oops you just missed to give password",
                minlength: "thats all? really?"
        }
    }
  
});
	
});

$(function(){
        /* ========================================================================= */
        /*	Contact Form
        /* ========================================================================= */

        $('#contact-form').validate({
                rules: {
                        name: {
                                required: true,
                                minlength: 2
                        },
                        email: {
                                required: true,
                                email: true
                        },
                        message: {
                                required: true
                        }
                },
                messages: {
                        name: {
                                required: "come on, you have a name don't you?",
                                minlength: "your name must consist of at least 2 characters"
                        },
                        email: {
                                required: "no email, no message"
                        },
                        message: {
                                required: "um..yea, you have to write something to send this form.",
                                minlength: "thats all? really?"
                        }
                },
                submitHandler: function(form) {
                        $(form).ajaxSubmit({
                                type:"POST",
                                data: $(form).serialize(),
                                url:"process.php",
                                success: function() {
                                        $('#contact-form :input').attr('disabled', 'disabled');
                                        $('#contact-form').fadeTo( "slow", 0.15, function() {
                                                $(this).find(':input').attr('disabled', 'disabled');
                                                $(this).find('label').css('cursor','default');
                                                $('#success').fadeIn();
                                        });
                                },
                                error: function() {
                                        $('#contact-form').fadeTo( "slow", 0.15, function() {
                                                $('#error').fadeIn();
                                        });
                                }
                        });
                }
        });
});

$('#left-panel-link').panelslider();
$('#right-panel-link').panelslider({side: 'right', clickClose: false, duration: 200 });
$('#close-panel-bt').click(function() {
  $.panelslider.close();
});

// ==========  START GOOGLE MAP ==========//
/*function initialize() {
    var myLatLng = new google.maps.LatLng(12.951020, 77.716782);

    var mapOptions = {
        zoom: 14,
        center: myLatLng,
        disableDefaultUI: true,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'roadatlas']
        }
    };

    var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);


    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: '/assets/images/location-icon.png',
        title: '',
    });
}
<<<<<<< Updated upstream
google.maps.event.addDomListener(window, "load", initialize);*/
// ========== END GOOGLE MAP ========== //


function login_facebook(){
    var left = (window.screen.width / 2) - ((600 / 2) + 10);
    var top = (window.screen.height / 2) - ((500 / 2) + 50);
    window.open('/user/facebook_login','_blank',
    "status=no,height=500,width=600,resizable=yes,left="
    + left + ",top=" + top + ",screenX=" + left + ",screenY="
    + top + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
}