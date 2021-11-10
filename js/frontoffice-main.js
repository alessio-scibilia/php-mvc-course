var before_prenota = 0;
var see_all_eventi = 0;


function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function checkViews() {
    var params = getUrlVars();
    if (params['tab'] == 'info') {
        $(".link-cat-item-container").hide();
        $(".bg-white").removeClass("bg-white");
        $(".fc-black").removeClass("fc-black");
        $(".menu-in-one>span").addClass("fc-black");
        $(".menu-in-one").addClass("bg-white");
        $(".content-one-container").hide();
        $(".content-three-container").hide();
        $(".content-one-container").fadeIn();
        $(".two").removeClass("two-hover");
        $(".three").removeClass("three-hover");
        $(".one").addClass("one-hover");

        $(".menu-content-container").fadeIn();
        $(".container-cat-expand").removeClass("container-cat-expand-active");
    } else if (params['tab'] == 'sugg') {
        $(".link-cat-item-container").hide();
        $(".bg-white").removeClass("bg-white");
        $(".fc-black").removeClass("fc-black");
        $(".menu-in-three>span").addClass("fc-black");
        $(".menu-in-three").addClass("bg-white");
        $(".content-three-container").hide();
        $(".content-one-container").hide();
        $(".content-two-container").fadeIn();
        $(".two").removeClass("two-hover");
        $(".one").removeClass("one-hover");
        $(".three").addClass("three-hover");

        $(".menu-content-container").fadeIn();
        $(".container-cat-expand").removeClass("container-cat-expand-active");

        var w = window.innerWidth;
        if (w <= 991) {
            $(".menu-content-container").show();
            $(".content-three-container").hide();
        }
    } else if (params['tab'] == 'item' && params['section'] == 'booking') {
        $.post("process/cat_item",
            {
                id: params['id'],
                nome_cat: '',
                cat: params['cat']
            },
            function (data, status) {
                $(".open-cat-item-container").html("");
                $(".open-cat-item-container").html(data);
                $(".link-cat-item-container").removeClass("dnmob");
                var elements = document.getElementsByClassName('link-cat-item-container');
                var requiredElement = elements[0];
                requiredElement.classList.remove("dnmob");
                $(".open-cat-item-container").css("opacity", "1");


                $('.owl-item-cat-small').owlCarousel({
                    loop: true,
                    margin: 10,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            dots: true
                        },
                        640: {
                            items: 1,
                            center: true,
                            dots: true
                        },
                        1000: {
                            items: 2,
                            dots: true
                        },
                        1200: {
                            items: 2,
                            dots: true
                        },
                        1400: {
                            items: 3,
                            dots: true,
                            loop: false
                        }
                    }
                });


                $('.owl-item-cat').owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    responsiveClass: false,
                    navText: ['<svg xmlns="http://www.w3.org/2000/svg" class="arrow-back bk2 bk3" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M26.8,0A26.8,26.8,0,1,1,0,26.8,26.8,26.8,0,0,1,26.8,0ZM14.266,31.558H26.8v7.663a1.3,1.3,0,0,0,2.216.919L41.371,27.721a1.285,1.285,0,0,0,0-1.826L29.018,13.466a1.3,1.3,0,0,0-2.216.919v7.663H14.266a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.266,31.558Z" transform="translate(53.606 53.606) rotate(180)" fill="#5ae9d1"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" class="bk2 bk3" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M27.365.563a26.8,26.8,0,1,1-26.8,26.8A26.8,26.8,0,0,1,27.365.563ZM14.829,32.121H27.365v7.663a1.3,1.3,0,0,0,2.216.919L41.934,28.284a1.285,1.285,0,0,0,0-1.826L29.581,14.029a1.3,1.3,0,0,0-2.216.919V22.61H14.829a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.829,32.121Z" transform="translate(-0.563 -0.563)" fill="#5ae9d1"/></svg>'],
                    responsive: {
                        0: {
                            items: 1,
                            dots: false,
                            nav: true
                        },
                        640: {
                            items: 1,
                            center: true,
                            dots: false,
                            nav: true
                        },
                        1000: {
                            items: 1,
                            dots: false,
                            nav: true
                        },
                        1200: {
                            items: 1,
                            dots: false,
                            nav: true
                        },
                        1400: {
                            items: 1,
                            dots: false,
                            nav: true,
                            loop: true,
                        }
                    }
                });


                $(".open-cat-item-container").addClass("open-cat-item-container-active");
                $(".container-cat-expand").removeClass("container-cat-expand-active");
                $(".image_cat_item").show();
                $(".image_cat_item").addClass("image_cat_item_active");
                before_prenota = 1;

            });
    } else if (params['tab'] == 'cat') {

        $.post("process/get_categoria",
            {
                id: params['id']
            },
            function (data, status) {
                $(".container-cat-expand").html("");
                $(".container-cat-expand").html(data);
                $('.slide-cat-container').owlCarousel({
                    loop: false,
                    margin: 60,
                    dots: false,
                    responsiveClass: true,
                    navText: ['<svg xmlns="http://www.w3.org/2000/svg" class="arrow-back3 bk2" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M26.8,0A26.8,26.8,0,1,1,0,26.8,26.8,26.8,0,0,1,26.8,0ZM14.266,31.558H26.8v7.663a1.3,1.3,0,0,0,2.216.919L41.371,27.721a1.285,1.285,0,0,0,0-1.826L29.018,13.466a1.3,1.3,0,0,0-2.216.919v7.663H14.266a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.266,31.558Z" transform="translate(53.606 53.606) rotate(180)" fill="#5ae9d1"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" class="bk2" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M27.365.563a26.8,26.8,0,1,1-26.8,26.8A26.8,26.8,0,0,1,27.365.563ZM14.829,32.121H27.365v7.663a1.3,1.3,0,0,0,2.216.919L41.934,28.284a1.285,1.285,0,0,0,0-1.826L29.581,14.029a1.3,1.3,0,0,0-2.216.919V22.61H14.829a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.829,32.121Z" transform="translate(-0.563 -0.563)" fill="#5ae9d1"/></svg>'],
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        640: {
                            items: 2,
                            center: false,
                            nav: true
                        },
                        1200: {
                            items: 2,
                            nav: true
                        },
                        1400: {
                            items: 3,
                            nav: true,
                            loop: false
                        }
                    }
                });


                $('.owl-cat').owlCarousel({
                    loop: true,
                    margin: 10,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            dots: true
                        },
                        640: {
                            items: 1,
                            center: true,
                            dots: true
                        },
                        1000: {
                            items: 2,
                            dots: true
                        },
                        1200: {
                            items: 2,
                            dots: true
                        },
                        1400: {
                            items: 3,
                            dots: true,
                            loop: false
                        }
                    }
                });
                $(".link-cat-item-container").hide();
                $(".container-cat-expand").css("display", "flex");
                $(".container-cat-expand").css("opacity", "1");
                $(".container-cat-expand").addClass("container-cat-expand-active");
                $(".content-two-container").hide();
                $(".menu-content-container").hide();
                $(".img-cat-item-in").css("opacity", "1");
                $(".slide-cat-container").css("opacity", "1");
                $(".open-cat-item-container").removeClass("open-cat-item-container-active");
                $(".image_cat_item").removeClass("image_cat_item_active");
            });
    } else if (params['tab'] == 'prop') {
        $(".link-cat-item-container").hide();
        $(".bg-white").removeClass("bg-white");
        $(".fc-black").removeClass("fc-black");
        $(".content-two-container").hide();
        $(".content-one-container").hide();
        $(".content-three-container").fadeIn();
        $(".three").removeClass("three-hover");
        $(".one").removeClass("one-hover");
        $(".two").addClass("two-hover");
        $(".menu-in-two>span").addClass("fc-black");
        $(".menu-in-two").addClass("bg-white");
    }
}

$(document).ready(function () {
    checkViews();

    $(window).on('popstate', function () {
        checkViews();
    });


    $(".login-container").toggleClass("login-container-hidden");
    $(".welcome-container").toggleClass("welcome-container-hidden");
});

$("#open-menu").click(function () {
    $(".container-menu-expand").toggleClass("db");
    $(".container-menu-expand").toggleClass("out-side-now");
    $(".container-menu-expand").toggleClass("colored");
    if ($(".menu-content-container").is(":visible")) {
        $(".box-flex").removeClass("bg-white");
        $(".fc-black").removeClass("fc-black");
    }


});

$("#open-menu-mob").click(function () {
    $(".container-menu-expand").toggleClass("db");
    $(".container-menu-expand").toggleClass("out-side-now");
    $(".container-menu-expand").toggleClass("colored");
    $(".spanm1").toggleClass("span-active1");
});

$("#open-menu-mob-index").click(function () {
    $(".container-menu-expand").toggleClass("db");
    $(".container-menu-expand").toggleClass("out-side-now");
    $(".container-menu-expand").toggleClass("colored");
    $(".spanm1").toggleClass("span-active1");
});

$("#open-menu-glass").click(function () {
    $(".container-menu-expand.real-out").toggleClass("db");
    $(".container-menu-expand.real-out").toggleClass("out-side-now");

});

$("#open-menu-mob-glass").click(function () {
    $(".container-menu-expand").toggleClass("db");
    $(".container-menu-expand").toggleClass("out-side-now");
});

$(".box-flex").hover(function () {
    if (!$(".menu-content-container").is(":visible")) {
        if ($(this).attr("data-id") == 1)
            $(".border-menu-in:first-of-type").removeClass("border-show");
        else if ($(this).attr("data-id") == 3)
            $(".border-menu-in:last-of-type").removeClass("border-show");
        else
            $(".border-menu-in").removeClass("border-show");
    }
});

$(".box-flex").click(function () {

    if ($(this).attr("data-id") == 1) {
        $(".bflex-middle").removeClass("bg-white");
        $(".bflex-middle").children(":first").next().removeClass("fc-black");
        $(".bflex-last").removeClass("bg-white");
        $(".bflex-last").children(":first").next().removeClass("fc-black");
        $(this).next().next().removeClass("bg-white");
        $(this).parent().removeClass("border-show");
        $(this).parent().addClass("border-show");
    } else if ($(this).attr("data-id") == 3) {
        $(".bflex-middle").removeClass("bg-white");
        $(".bflex-middle").children(":first").next().removeClass("fc-black");
        $(".bflex-first").removeClass("bg-white");
        $(".bflex-first").children(":first").next().removeClass("fc-black");
        $(this).parent().removeClass("border-show");
        $(this).parent().addClass("border-show");
        $(".carousel-eventi").trigger("to.owl.carousel", [0, 1]);

    } else {
        $(".bflex-first").removeClass("bg-white");
        $(".bflex-first").children(":first").next().removeClass("fc-black");
        $(".bflex-last").removeClass("bg-white");
        $(".bflex-last").children(":first").next().removeClass("fc-black");
        $(this).parent().removeClass("border-show");
        $(this).parent().addClass("border-show");
        $(".carousel-eventi").trigger("to.owl.carousel", [0, 1]);
    }

    $(this).addClass("bg-white");
    $(this).children(":first").next().addClass("fc-black");

});

$(".one").click(function () {
    $(".three").removeClass("three-hover");
    $(".two").removeClass("two-hover");
    $(this).addClass("one-hover");
});

$(".two").click(function () {
    $(".one").removeClass("one-hover");
    $(".three").removeClass("three-hover");
    $(this).addClass("two-hover");
});

$(".three").click(function () {
    $(".two").removeClass("two-hover");
    $(".one").removeClass("one-hover");
    $(this).addClass("three-hover");
});

$(".blue-menu-item").click(function () {

    $(".container-cat-expand").removeClass("container-cat-expand-active");
    $(".container-cat-expand").hide("container-cat-expand-active");
    $(".image_cat_item").removeClass("image_cat_item_active");
    $(".event-container").removeClass("event-container-active");
    $(".event-container").hide("event-container-active");
    $(".eventItem-container").removeClass("eventItem-container-active");
    $(".eventItem-container").hide("eventItem-container-active");
    $(".image_cat_item_evento").removeClass("image_cat_item_evento_active");
    $(".image_cat_item_evento").hide("image_cat_item_evento_active");

    if ($(".menu-content-container").is(":visible")) {
        $(".fc-black").removeClass("fc-black");
    }

    var section = $(this).attr("data-section");

    $(".bg-white").removeClass("bg-white");
    $(".fc-black").removeClass("fc-black");
    $(".prenota-container").removeClass("prenota-container-active");
    $(".open-cat-item-container").removeClass("open-cat-item-container-active");
    $(".container-cat-expand").removeClass("container-cat-expand-active");
    $(".one-hover").removeClass("one-hover");
    $(".two-hover").removeClass("two-hover");
    $(".three-hover").removeClass("three-hover");
    if (section == 1) {
        $(".content-two-container").css("display", "none");
        $(".content-three-container").css("display", "none");
        $(".content-one-container").fadeIn();
        $(".menu-content-container").fadeIn();
        $(".blue-menu").addClass("out-side-now");
        $(".menu-in-one").addClass("bg-white");
        $(".menu-in-one>span").addClass("fc-black");
        $(".one").addClass("one-hover");
        window.history.pushState({}, '', '?tab=info');

    } else if (section == 2) {
        $(".content-two-container").css("display", "none");
        $(".content-one-container").css("display", "none");
        $(".content-three-container").fadeIn();
        $(".menu-content-container").fadeIn();
        $(".blue-menu").addClass("out-side-now");
        $(".menu-in-two").addClass("bg-white");
        $(".menu-in-two>span").addClass("fc-black");
        $(".two").addClass("two-hover");
        window.history.pushState({}, '', '?tab=prop');

    } else if (section == 3) {
        $(".content-three-container").css("display", "none");
        $(".content-one-container").css("display", "none");
        $(".content-two-container").fadeIn();
        $(".menu-content-container").fadeIn();
        $(".blue-menu").addClass("out-side-now");
        $(".menu-in-three").addClass("bg-white");
        $(".menu-in-three>span").addClass("fc-black");
        $(".three").addClass("three-hover");
        window.history.pushState({}, '', '?tab=sugg');

    }

})

$(".menu-in-one").click(function () {
    $(".content-two-container").css("display", "none");
    $(".content-three-container").css("display", "none");
    var w = window.innerWidth;
    window.history.pushState({}, '', '?tab=info');


    if ($(".content-one-container").is(":visible") && w >= 992) {
        $(".menu-content-container").fadeOut();
        $(".content-one-container").fadeOut();
        $(".menu-in-one").removeClass("bg-white");
        $(".fc-black").removeClass("fc-black");
    } else {
        $(".content-one-container").fadeIn();
        $(".menu-content-container").fadeIn();
        $(".blue-menu").addClass("out-side-now");
    }

});

$(".menu-in-two").click(function () {
    $(".content-two-container").css("display", "none");
    $(".content-one-container").css("display", "none");
    var w = window.innerWidth;
    window.history.pushState({}, '', '?tab=prop');


    if ($(".content-three-container").is(":visible") && w >= 992) {
        $(".menu-content-container").fadeOut();
        $(".content-three-container").fadeOut();
        $(".menu-in-two").removeClass("bg-white");
        $(".fc-black").removeClass("fc-black");
    } else {
        $(".content-three-container").fadeIn();
        $(".menu-content-container").fadeIn();
        $(".blue-menu").addClass("out-side-now");
    }
});


$(".menu-in-three").click(function () {
    $(".content-three-container").css("display", "none");
    $(".content-one-container").css("display", "none");
    var w = window.innerWidth;
    window.history.pushState({}, '', '?tab=sugg');


    if ($(".content-two-container").is(":visible") && w >= 992) {
        $(".menu-content-container").fadeOut();
        $(".content-two-container").fadeOut();
        $(".menu-in-three").removeClass("bg-white");
        $(".fc-black").removeClass("fc-black");
    } else {
        $(".content-two-container").fadeIn();
        $(".menu-content-container").fadeIn();
        $(".blue-menu").addClass("out-side-now");
    }
});


function open_cat(id) {

    $.post("process/get_categoria",
        {
            id: id
        },
        function (data, status) {
            $(".container-cat-expand").html("");
            $(".container-cat-expand").html(data);
            $('.slide-cat-container').owlCarousel({
                loop: false,
                margin: 60,
                dots: false,
                responsiveClass: true,
                navText: ['<svg xmlns="http://www.w3.org/2000/svg" class="arrow-back3 bk2" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M26.8,0A26.8,26.8,0,1,1,0,26.8,26.8,26.8,0,0,1,26.8,0ZM14.266,31.558H26.8v7.663a1.3,1.3,0,0,0,2.216.919L41.371,27.721a1.285,1.285,0,0,0,0-1.826L29.018,13.466a1.3,1.3,0,0,0-2.216.919v7.663H14.266a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.266,31.558Z" transform="translate(53.606 53.606) rotate(180)" fill="#5ae9d1"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" class="bk2" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M27.365.563a26.8,26.8,0,1,1-26.8,26.8A26.8,26.8,0,0,1,27.365.563ZM14.829,32.121H27.365v7.663a1.3,1.3,0,0,0,2.216.919L41.934,28.284a1.285,1.285,0,0,0,0-1.826L29.581,14.029a1.3,1.3,0,0,0-2.216.919V22.61H14.829a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.829,32.121Z" transform="translate(-0.563 -0.563)" fill="#5ae9d1"/></svg>'],
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    640: {
                        items: 2,
                        center: false,
                        nav: true
                    },
                    1200: {
                        items: 2,
                        nav: true
                    },
                    1400: {
                        items: 3,
                        nav: true,
                        loop: false
                    }
                }
            });


            $('.owl-cat').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        dots: true
                    },
                    640: {
                        items: 1,
                        center: true,
                        dots: true
                    },
                    1000: {
                        items: 2,
                        dots: true
                    },
                    1200: {
                        items: 2,
                        dots: true
                    },
                    1400: {
                        items: 3,
                        dots: true,
                        loop: false
                    }
                }
            });
            $(".container-cat-expand").css("display", "flex");
            $(".container-cat-expand").css("opacity", "1");
            $(".container-cat-expand").addClass("container-cat-expand-active");
            $(".content-two-container").hide();
            $(".menu-content-container").hide();
            $(".img-cat-item-in").css("opacity", "1");
            $(".slide-cat-container").css("opacity", "1");
            window.history.pushState({}, '', '?tab=cat&id=' + id);

        });


}

$(document).on("click", ".arrow-back", function () {
    window.history.pushState({}, '', '?tab=sugg');
    $(".content-two-container").fadeIn();
    $(".menu-content-container").fadeIn();
    $(".container-cat-expand").removeClass("container-cat-expand-active");

    var w = window.innerWidth;
    if (w <= 991) {
        $(".menu-content-container").show();
        $(".content-three-container").hide();
    }
});


$(document).on("click", ".arrow-back-eventi", function () {
    $(".content-three-container").fadeIn();
    $(".menu-content-container").fadeIn();
    $(".event-container").removeClass("event-container-active");
    $(".event-container").hide();

    var w = window.innerWidth;
    if (w <= 991) {
        $(".menu-content-container").show();
        $(".content-three-container").show();
    }
});


$(document).on("click", ".arrow-back-item-evento", function () {
    if (see_all_eventi == 0) {
        $(".content-three-container").fadeIn();
        $(".menu-content-container").fadeIn();
    } else {
        $(".event-container").show();
        $(".event-container").addClass("event-container-active");
    }

    window.history.pushState({}, '', '?tab=prop');

    $(".eventItem-container").removeClass("eventItem-container-active");
    $(".image_cat_item_evento").removeClass("image_cat_item_evento_active");

    var w = window.innerWidth;
    if (w <= 991) {
        $(".menu-content-container").fadeIn();
        $(".content-three-container").fadeIn();

    }
});

$(document).on("click", ".arrow-back-item-proposte", function () {
    $(".content-three-container").fadeIn();
    $(".menu-content-container").fadeIn();
    $(".proposte-item-container").removeClass("proposte-item-container-active");
    $(".image_cat_item_proposte").removeClass("image_cat_item_proposte_active");
});

$(document).on("click", ".arrow-back-struttura", function () {
    $(".open-struttura-container").removeClass("open-struttura-container-active");
    $(".open-struttura-container").hide();
    $(".image_struttura").removeClass("image_struttura_active");
    $(".image_struttura").hide();
    $(".eventItem-container").show();
    $(".eventItem-container").addClass("eventItem-container-active");
    $(".image_cat_item_evento").show();
    $(".image_cat_item_evento").addClass("image_cat_item_evento_active");
});

$(document).on("click", ".arrow-back-cat", function () {

    var id = $(this).attr("data-id-cat");
    window.history.pushState({}, '', '?tab=cat&id=' + id);
    $(".link-cat-item-container").addClass("dnmob");
    $(".image_cat_item").hide();
    $(".image_cat_item").removeClass("image_cat_item_active");
    $(".container-cat-expand").show();
    $(".container-cat-expand").css("opacity", "1");
    $(".content-two-container").hide();
    $(".container-cat-expand").addClass("container-cat-expand-active");
    var w = window.innerWidth;
    if (w <= 991) {
        $(".open-cat-item-container").removeClass("open-cat-item-container-active");
    } else {
        $(".open-cat-item-container").removeClass("open-cat-item-container-active");
    }
    if ($(".container-cat-expand").html() == '') {
        checkViews();
    }
});

$(".arrow-back-prenota-cat").click(function () {
    $(".link-cat-item-container").removeClass("dnmob");
    if (!$(".request-container").is(":visible")) {
        $(".request-container").fadeIn();
        $(".confirm-container").hide();
    } else {
        $(".prenota-container").removeClass("prenota-container-active");
        $(".confirm-container").hide();
        if (before_prenota == 1) {
            $(".open-cat-item-container").show();
            $(".open-cat-item-container").addClass("open-cat-item-container-active");
            $(".image_cat_item").show();
            $(".image_cat_item").addClass("image_cat_item_active");
        } else if (before_prenota == 2) {
            $(".proposte-item-container").show();
            $(".proposte-item-container").addClass("proposte-item-container-active");
            $(".image_cat_item_proposte").show();
            $(".image_cat_item_proposte").addClass("image_cat_item_proposte_active");
        } else if (before_prenota == 3) {
            $(".eventItem-container").show();
            $(".eventItem-container").addClass("eventItem-container-active");
            $(".image_cat_item_evento").show();
            $(".image_cat_item_evento").addClass("image_cat_item_evento_active");
        } else if (before_prenota == 4) {
            $(".open-struttura-container").show();
            $(".open-struttura-container").addClass("open-struttura-container-active");
            $(".image_struttura").show();
            $(".image_struttura").addClass("image_struttura_active");
        }
    }
});
$('.slide-cat-container').owlCarousel({
    loop: true,
    margin: 60,
    dots: false,
    responsiveClass: true,
    navText: ['<svg xmlns="http://www.w3.org/2000/svg" class="arrow-back bk2" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M26.8,0A26.8,26.8,0,1,1,0,26.8,26.8,26.8,0,0,1,26.8,0ZM14.266,31.558H26.8v7.663a1.3,1.3,0,0,0,2.216.919L41.371,27.721a1.285,1.285,0,0,0,0-1.826L29.018,13.466a1.3,1.3,0,0,0-2.216.919v7.663H14.266a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.266,31.558Z" transform="translate(53.606 53.606) rotate(180)" fill="#5ae9d1"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" class="bk2" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M27.365.563a26.8,26.8,0,1,1-26.8,26.8A26.8,26.8,0,0,1,27.365.563ZM14.829,32.121H27.365v7.663a1.3,1.3,0,0,0,2.216.919L41.934,28.284a1.285,1.285,0,0,0,0-1.826L29.581,14.029a1.3,1.3,0,0,0-2.216.919V22.61H14.829a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.829,32.121Z" transform="translate(-0.563 -0.563)" fill="#5ae9d1"/></svg>'],
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        640: {
            items: 2,
            center: false,
            nav: true
        },
        1200: {
            items: 2,
            nav: true
        },
        1400: {
            items: 3,
            nav: true,
            loop: false
        }
    }
});


$('.owl-cat').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            dots: true
        },
        640: {
            items: 1,
            center: true,
            dots: true
        },
        1000: {
            items: 2,
            dots: true
        },
        1200: {
            items: 2,
            dots: true
        },
        1400: {
            items: 3,
            dots: true,
            loop: false
        }
    }
});


var owl = $('.carousel-eventi');
// Go to the next item
$('.arrow-car-next').click(function () {
    owl.trigger('next.owl.carousel');
})
// Go to the previous item
$('.arrow-car-prev').click(function () {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owl.trigger('prev.owl.carousel');
})


$('.owl-excellence').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            dots: true
        },
        640: {
            items: 1,
            center: true,
            dots: true
        },
        1000: {
            items: 1,
            dots: true
        },
        1200: {
            items: 1,
            dots: true
        },
        1400: {
            items: 1,
            dots: true,
            loop: false
        }
    }
});


$('.carousel-eventi').owlCarousel({
    margin: 20,
    responsiveClass: true,
    rewind: true,
    loop: false,
    responsive: {
        0: {
            items: 1,
            stagePadding: 30,
            dots: false
        },
        640: {
            items: 1,
            stagePadding: 30,
            dots: false
        },
        991: {
            items: 2,
            stagePadding: 30,
            dots: false
        },
        1200: {
            items: 2,
            stagePadding: 50,
            dots: false
        },
        1400: {
            stagePadding: 120,
            items: 2,
            dots: false
        }
    }
})

function openCatItem(id, cat) {
    var id_cat = $(this).attr("data-id-cat");
    var nome_cat = document.getElementById("nome-categoria").innerText;
    $.post("process/cat_item",
        {
            id: id,
            nome_cat: nome_cat,
            cat: cat
        },
        function (data, status) {
            $(".open-cat-item-container").html("");
            $(".open-cat-item-container").html(data);
            $(".link-cat-item-container").removeClass("dnmob");
            var elements = document.getElementsByClassName('link-cat-item-container');
            var requiredElement = elements[0];
            requiredElement.classList.remove("dnmob");
            $(".open-cat-item-container").css("opacity", "1");


            $('.owl-item-cat-small').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        dots: true
                    },
                    640: {
                        items: 1,
                        center: true,
                        dots: true
                    },
                    1000: {
                        items: 2,
                        dots: true
                    },
                    1200: {
                        items: 2,
                        dots: true
                    },
                    1400: {
                        items: 3,
                        dots: true,
                        loop: false
                    }
                }
            });


            $('.owl-item-cat').owlCarousel({
                loop: true,
                margin: 0,
                autoplay: true,
                responsiveClass: false,
                navText: ['<svg xmlns="http://www.w3.org/2000/svg" class="arrow-back bk2 bk3" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M26.8,0A26.8,26.8,0,1,1,0,26.8,26.8,26.8,0,0,1,26.8,0ZM14.266,31.558H26.8v7.663a1.3,1.3,0,0,0,2.216.919L41.371,27.721a1.285,1.285,0,0,0,0-1.826L29.018,13.466a1.3,1.3,0,0,0-2.216.919v7.663H14.266a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.266,31.558Z" transform="translate(53.606 53.606) rotate(180)" fill="#5ae9d1"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" class="bk2 bk3" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M27.365.563a26.8,26.8,0,1,1-26.8,26.8A26.8,26.8,0,0,1,27.365.563ZM14.829,32.121H27.365v7.663a1.3,1.3,0,0,0,2.216.919L41.934,28.284a1.285,1.285,0,0,0,0-1.826L29.581,14.029a1.3,1.3,0,0,0-2.216.919V22.61H14.829a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.829,32.121Z" transform="translate(-0.563 -0.563)" fill="#5ae9d1"/></svg>'],
                responsive: {
                    0: {
                        items: 1,
                        dots: false,
                        nav: true
                    },
                    640: {
                        items: 1,
                        center: true,
                        dots: false,
                        nav: true
                    },
                    1000: {
                        items: 1,
                        dots: false,
                        nav: true
                    },
                    1200: {
                        items: 1,
                        dots: false,
                        nav: true
                    },
                    1400: {
                        items: 1,
                        dots: false,
                        nav: true,
                        loop: true,
                    }
                }
            });


            $(".open-cat-item-container").addClass("open-cat-item-container-active");
            $(".container-cat-expand").removeClass("container-cat-expand-active");
            $(".image_cat_item").show();
            $(".image_cat_item").addClass("image_cat_item_active");
            before_prenota = 1;
            window.history.pushState({}, '', '?tab=item&section=booking&id=' + id + '&cat=' + cat);


        });


}

function openPrenota(section, follow_id, follow_type) {
    if (section == 'ev') {
        var nome_evento = document.getElementById('nome-evento').innerText;
        if (nome_evento.length > 10) ;
        nome_evento = nome_evento.substring(0, 10) + '...';
        var title_eventi = document.getElementById('title-eventi').innerText;
        $("#placeholder-nome").text(nome_evento);
        $("#placeholder-nome").prev().text(title_eventi);

    } else if (section == 'item') {
        var nome_struttura = document.getElementById('nome-struttura').innerText;
        if (nome_struttura != 'undefined' && nome_struttura != null) {
            if (nome_struttura.length > 10)
                nome_struttura = nome_struttura.substring(0, 10) + '...';
            $("#placeholder-nome").text(nome_struttura);

            var nome_cat = document.getElementById("cat-names").innerText;
            $("#placeholder-nome").prev().text(nome_cat);
        }
    } else if (section == 'prop') {
        var nome_struttura = document.getElementById('titolo-proposta').innerText;
        if (nome_struttura.length > 10)
            nome_struttura = nome_struttura.substring(0, 10) + '...';
        $("#placeholder-nome").text(nome_struttura);
        $("#placeholder-nome").prev().text($("#title-proposte").text());

    }

    $(".link-cat-item-container").addClass("dnmob");
    $(".image_cat_item").hide();
    $(".content-two-container").fadeOut();
    $(".menu-content-container").fadeOut();
    $(".image_cat_item").removeClass("image_cat_item_active");
    $(".image_cat_item_evento").removeClass("image_cat_item_evento_active");
    $(".eventItem-container").removeClass("eventItem-container-active");
    $(".eventItem-container").hide("eventItem-container-active");
    $(".proposte-item-container").removeClass("proposte-item-container-active");
    $(".image_cat_item_proposte").removeClass("image_cat_item_proposte_active");

    $(".open-struttura-container").removeClass("open-struttura-container-active");
    $(".image_struttura").removeClass("image_struttura_active");

    $(".prenota-container").addClass("prenota-container-active");
    $(".container-cat-expand-active").removeClass("container-cat-expand-active");
    $(".open-cat-item-container").removeClass("open-cat-item-container-active");
    $(".confirm-container").hide();
    $(".request-container").show();
    window.history.pushState({}, '', '?tab=request&section=' + section + '&follow_id=' + follow_id + '&follow_type=' + follow_type);
}

$(".confirm-prenota").click(function () {
    var error_one = 0;
    var error_two = 0;
    var error_three = 0;
    var error_four = 0;
    if ($(".day-item-real.bg-orange").length == 0 && $("#selected-date").length == 0)
        error_one++;
    if ($(".item-users.bg-orange").length == 0)
        error_four++;
    if ($(".hour-prenota").val() == "")
        error_two++;
    if ($(".minute-prenota").val() == "")
        error_three++;
    //console.log($(".hour-prenota").val());
    if (error_one == 0 && error_two == 0 && error_three == 0 && error_four == 0) {
        $(".request-container").hide();
        $(".confirm-container").fadeIn();
        $(".accetto-active").removeClass("accetto-active");
        $("#accetto").removeAttr("checked");
    } else {
        if (error_one == 1)
            $("#giorno-prenota").addClass("prenota-error");
        else
            $("#giorno-prenota").removeClass("prenota-error");
        if (error_two == 1)
            $("#ora-prenota").addClass("prenota-error");
        else
            $("#ora-prenota").removeClass("prenota-error");
        if (error_three == 1)
            $("#ora-prenota").addClass("prenota-error");
        else
            $("#ora-prenota").removeClass("prenota-error");
        if (error_four == 1)
            $("#quanti-prenota").addClass("prenota-error");
        else
            $("#quanti-prenota").removeClass("prenota-error");
    }
});

$(".accetto-container, #accetto").click(function () {
    /*if($("#accetto").prop("checked")) {
        $(".accetto-container").removeClass("accetto-active");
        $("#accetto").removeAttr("checked");
    } else {
        $(".accetto-container").addClass("accetto-active");
        $("#accetto").attr("checked","checked");
    }*/
    if ($("#accetto").prop("checked"))
        $("#accetto").removeAttr("checked");
    else
        $("#accetto").attr("checked", "checked");
    $(".accetto-container").toggleClass("accetto-active");
})

$(document).on("click", ".day-item-real", function () {
    $(".day-item-real").removeClass("bg-orange");
    $("#open-calendario").removeClass("bg-orange");
    $("#selected-date").remove();
    $(this).addClass("bg-orange");
})

$(".item-users-plus").click(function () {
    $(".item-users").removeClass("bg-orange");
    var last_number = $(".item-users").last().prev().text();
    var next = parseInt(last_number) + parseInt(1);
    $(".item-users").last().prev().after('<a href="#" class="day-item item-users">' + next + '</a>');
    $(".item-users").last().prev().addClass("bg-orange");
});

$(document).on("click", ".item-users", function () {
    if (!$(this).hasClass("item-users-plus")) {
        $(".item-users").removeClass("bg-orange");
        $(this).addClass("bg-orange");
    }
});


$(document).on("click", ".arrow-more", function () {
    var w = window.innerWidth;
    var scroll = $("#more").position().top - 250;
    $(".eventItem-container").scrollTop(scroll);
});

$(document).on("click", ".link-cat-item", function () {
    var currentScroll = $(".open-cat-item-container").scrollTop();
    var section = $(this).attr("data-section");

    if (!$(this).hasClass("link-cat-item-bis")) {
        var w = window.innerWidth;

        if (section == 1) {
            if (w > 991)
                var scroll = $("#ex-cont").position().top - 250;
            else
                var scroll = $("#ex-cont").position().top - 115;
            $(".open-cat-item-container").scrollTop(scroll);

        } else if (section == 2) {
            if (w > 991)
                var scroll = $("#da-provare").position().top - 250;
            else
                var scroll = $("#da-provare").position().top - 115;
            $(".open-cat-item-container").scrollTop(scroll);
        } else if (section == 3) {
            if (w > 991)
                var scroll = $("#prenota").position().top - 200;
            else
                var scroll = $("#prenota").position().top - 115;
            $(".open-cat-item-container").scrollTop(scroll);
        }
    }


});


$(document).on("click", ".link-cat-item-bis", function () {
    var currentScroll = $(".open-struttura-container").scrollTop();
    var section = $(this).attr("data-section");
    var w = window.innerWidth;

    if (section == 1) {
        if (w > 991)
            var scroll = $("#ex-cont-bis").position().top - 250;
        else
            var scroll = $("#ex-cont-bis").position().top - 115;
        $(".open-struttura-container").scrollTop(scroll);

    } else if (section == 2) {
        if (w > 991)
            var scroll = $("#da-provare-bis").position().top - 250;
        else
            var scroll = $("#da-provare-bis").position().top - 115;
        $(".open-struttura-container").scrollTop(scroll);
    } else if (section == 3) {
        if (w > 991)
            var scroll = $("#prenota-bis").position().top - 200;
        else
            var scroll = $("#prenota-bis").position().top - 115;
        $(".open-struttura-container").scrollTop(scroll);
    }


});


$(".send-prenota").click(function () {
    if ($(".accetto-container").hasClass("accetto-active")) {
        $(".thanks-container").css("opacity", "1");
        $(".prenota-container").hide();
        $(".container-menu-expand").addClass("out-side-now");
        $(".thanks-container").addClass("thanks-active");
        $(".content-container").addClass("thanks-active-now");

        if ($("#oggi").hasClass("bg-orange"))
            var date = $("#oggi").text();
        else if ($("#domani").hasClass("bg-orange"))
            var date = $("#domani").text();
        else
            var date = $("#selected-date").text();

        var ora = $(".hour-prenota").val();
        var minuti = $(".minute-prenota").val();

        var quanti = $(".item-users.bg-orange").text();

        $.post("process/send_prenota",
            {
                date: date,
                ora: ora,
                minuti: minuti,
                quanti: quanti
            },
            function (data, status) {

            });
    } else
        $(".accetto-container").addClass("accetto-error");
})

$('.datepicker').datepicker({
    onSelect: function (dateText, inst) {
        $(".day-item-real").removeClass("bg-orange");
        $("#selected-date").remove();
        $("#open-calendario").after('<div id="selected-date">' + dateText + '</div>');
    },
    dateFormat: 'D dd-mm-yy'
});
$.datepicker.regional['it'] = {
    closeText: 'Chiudi', // set a close button text
    currentText: 'Oggi', // set today text
    monthNames: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'], // set month names
    monthNamesShort: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'], // set short month names
    dayNames: ['Domenica', 'Luned&#236', 'Marted&#236', 'Mercoled&#236', 'Gioved&#236', 'Venerd&#236', 'Sabato'], // set days names
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'], // set short day names
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Me', 'Gio', 'Ve', 'Sa'], // set more short days names
    dateFormat: 'D dd/mm/yy' // set format date
};
var lingua = $("#cur_lang").val();
$.datepicker.setDefaults($.datepicker.regional[lingua]);


$('#open-calendario').click(function () {
    $(".day-item-real").removeClass("bg-orange");
    $(this).addClass("bg-orange");
    $('.datepicker').datepicker('show');
});


$("#back-home").click(function () {
    $(".link-cat-item-container").addClass("dnmob");
    $(".thanks-container").removeClass("thanks-active");
    $(".thanks-container").css("opacity", "0");
    $("#glass-menu").removeClass("out-side-now");
    $(".bg-white").removeClass("bg-white");
    $(".fc-black").removeClass("fc-black");
    $(".content-container").removeClass("thanks-active-now");
    $(".open-cat-item-container").removeClass("open-cat-item-container-active");
    $(".open-cat-item-container").show();
    $(".prenota-container").removeClass("prenota-container-active");
    $(".prenota-container").show();

    var w = window.innerWidth;
    if (w <= 991) {
        $(".content-two-container").css("display", "block");
        $(".menu-content-container").css("display", "block");
    }
});

$(document).on("click", ".see-all-eventi", function () {
    see_all_eventi = 1;
});

$("#open-menu-glass").hover(function () {
    $(".spanm").addClass("span-active");
});
$("#open-menu-glass").mouseleave(function () {
    $(".spanm").removeClass("span-active");
});


function openCurEvent() {

    $(".content-three-container").hide();
    $(".menu-content-container").hide();
    $(".event-container").show();
    $(".event-container").addClass("event-container-active");

    $.post("process/get_all_eventi",
        {},
        function (data, status) {
            $(".event-container").html("");
            $(".event-container").html(data);
        });

}

function openEvento(id_evento) {
    before_prenota = 3;
    if (!$(".event-container").hasClass("event-container-active")) {
        see_all_eventi = 0;
    }

    $.post("process/get_evento",
        {
            id: id_evento
        },
        function (data, status) {
            $(".eventItem-container").html("");
            $(".eventItem-container").html(data);
            $(".content-three-container").hide();
            $(".menu-content-container").hide();
            $(".event-container").removeClass("event-container-active");
            $(".event-container").hide();
            $(".eventItem-container").show();
            $(".eventItem-container").addClass("eventItem-container-active");
            $(".image_cat_item").show();
            $(".image_cat_item_evento").addClass("image_cat_item_evento_active");
            window.history.pushState({}, '', '?tab=prop&section=ev&id=' + id_evento);
        });


}

function openProposta(id) {
    $.post("process/get_proposta",
        {
            id: id
        },
        function (data, status) {
            $(".proposte-item-container").html("");
            $(".proposte-item-container").html(data);
            before_prenota = 2;
            $(".content-three-container").hide();
            $(".menu-content-container").hide();

            $('.owl-item-cat-small').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        dots: true
                    },
                    640: {
                        items: 1,
                        center: true,
                        dots: true
                    },
                    1000: {
                        items: 2,
                        dots: true
                    },
                    1200: {
                        items: 2,
                        dots: true
                    },
                    1400: {
                        items: 3,
                        dots: true,
                        loop: false
                    }
                }
            });


            $(".image_cat_item_proposte").show();
            $(".image_cat_item_proposte").addClass("image_cat_item_proposte_active");
            $(".proposte-item-container").show();
            $(".proposte-item-container").addClass("proposte-item-container-active");
            window.history.pushState({}, '', '?tab=prop&section=prop&id=' + id);
        });

}


$(document).on("click", ".openStruttura", function () {
    var id = $(this).attr("data-id");
    var type = $(this).attr("data-type");
    var title = document.getElementById("title-eventi").innerText;

    $.post("process/get_struttura",
        {
            id: id,
            type: type
        },
        function (data, status) {
            $(".open-struttura-container").html("");
            $(".open-struttura-container").html(data);
            before_prenota = 4;
            $(".eventItem-container").removeClass("eventItem-container-active");
            $(".eventItem-container").hide();
            $(".image_cat_item_evento").removeClass("image_cat_item_evento_active");
            $('.owl-item-cat').owlCarousel({
                loop: true,
                margin: 0,
                autoplay: true,
                responsiveClass: false,
                navText: ['<svg xmlns="http://www.w3.org/2000/svg" class="arrow-back bk2 bk3" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M26.8,0A26.8,26.8,0,1,1,0,26.8,26.8,26.8,0,0,1,26.8,0ZM14.266,31.558H26.8v7.663a1.3,1.3,0,0,0,2.216.919L41.371,27.721a1.285,1.285,0,0,0,0-1.826L29.018,13.466a1.3,1.3,0,0,0-2.216.919v7.663H14.266a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.266,31.558Z" transform="translate(53.606 53.606) rotate(180)" fill="#5ae9d1"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" class="bk2 bk3" width="53.606" height="53.606" viewBox="0 0 53.606 53.606"><path id="Icon_awesome-arrow-alt-circle-right" data-name="Icon awesome-arrow-alt-circle-right" d="M27.365.563a26.8,26.8,0,1,1-26.8,26.8A26.8,26.8,0,0,1,27.365.563ZM14.829,32.121H27.365v7.663a1.3,1.3,0,0,0,2.216.919L41.934,28.284a1.285,1.285,0,0,0,0-1.826L29.581,14.029a1.3,1.3,0,0,0-2.216.919V22.61H14.829a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.829,32.121Z" transform="translate(-0.563 -0.563)" fill="#5ae9d1"/></svg>'],
                responsive: {
                    0: {
                        items: 1,
                        dots: false,
                        nav: true
                    },
                    640: {
                        items: 1,
                        center: true,
                        dots: false,
                        nav: true
                    },
                    1000: {
                        items: 1,
                        dots: false,
                        nav: true
                    },
                    1200: {
                        items: 1,
                        dots: false,
                        nav: true
                    },
                    1400: {
                        items: 1,
                        dots: false,
                        nav: true,
                        loop: true,
                    }
                }
            });

            $(".image_cat_item_evento").hide();
            $(".image_struttura").show();
            $(".image_struttura").addClass("image_struttura_active");
            $(".open-struttura-container").show();
            $(".open-struttura-container").addClass("open-struttura-container-active");
            document.getElementById("title-struttura").innerText = title;
            window.history.pushState({}, '', '?tab=prop&section=str&id=' + id + '&type=' + type);
        });

});

function openOrariFull(id) {
    //$(".orariFullContainer").addClass("dn");
    $(".orariFullContainer-" + id).toggleClass("dn");
}

$(".submit-login").click(function (e) {
    e.preventDefault();
    var numero_stanza = $("#num_stanza").val();
    var code_stanza = $("#code_stanza").val();
    var strh = $("#strh").val();

    $.post("process/check_login.php", {num_stanza: numero_stanza, code_stanza: code_stanza, strh: strh})
        .done(function (data) {
            if (data == "ok") {
                $("#form-login").submit();
            } else {
                $(".alert-container").fadeIn();
            }
        })
        .fail(function (xhr, textStatus, errorThrown) {
            alert("Connection error");
        });
});


