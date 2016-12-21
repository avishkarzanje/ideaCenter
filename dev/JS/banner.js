/// <reference path="../../typings/jquery/jquery.d.ts"/>

var documentWidth = 0;
var detatchedCarousel;
var path;

$("#id-dropdown-item-logout").click(function(){
    $.post("getStandards.php", { register: "LOGOUT" }, function (data) {
            window.location.replace("index.php");  
    });
});
    
$("#id-dropdown-item-editprofile").click(function(){
    window.location.replace("register.php?edit=true");
});

/* Footer */
$(document).scroll(function(){
    var elem = $(".cl-section-top-scroller");
    var footer = $(".cl-section-footer");
    
    if($(this).scrollTop() > ($(window).height())){
        $(elem).show();
    } else {
        $(elem).hide();
    }

    if($(window).width() > 1366){
        $(elem).css("right","auto");
        $(elem).css("left",($(window).width()/2 + 1366/2 - 50)+"px");
    } else {
        $(elem).css("right",isSmallScreen()?"10px":"50px");
        $(elem).css("left","auto");
    }

    /* maintain position above the footer */
    if(($(elem).offset().top + 10 + $(elem).height()) >= $(footer).offset().top){
        // $(elem).offset({top: $(footer).offset().top - 10 - $(elem).height()});
        $(elem).css("bottom", $(footer).height() -  ($(footer)[0].getBoundingClientRect().bottom - $(window).height()) + 10 + "px");
    } else {
        $(elem).css("bottom",isVerySmallScreen()?"50px":"100px");
    }
    
});

$('.cl-section-top-scroller').click(function(){
    $('html,body').animate({ scrollTop: 0 }, 600);
    return false;
});

function reAdjustView(){
    var currentDocumentWidth = document.documentElement.clientWidth;
    if((documentWidth >= 768 && currentDocumentWidth < 768) || (documentWidth < 768 && currentDocumentWidth >= 768) || (documentWidth === 0)){
        if(currentDocumentWidth < 768){
            $("#site-header").attr("src","images/header_mobile.png");
            $("#site-header").attr("data-src","images/header_mobile.png");
            $("#site-header").unveil("unveil");
            detatchedCarousel = $("#carousel-example-generic").detach();

            if(path === "index.php"){
                $(".cl-div-site-breadcrumb").hide();
            }

        } else {
            if(detatchedCarousel){
                detatchedCarousel.appendTo("#carousel-holder");
            }
            $("#site-header").attr("src","images/header.png");
            $("#site-header").attr("data-src","images/header.png");
            $("#site-header").unveil("unveil");
            $(".cl-div-site-breadcrumb").show();
        }
    }

    documentWidth = document.documentElement.clientWidth;
}

function isSmallScreen(){
    return (documentWidth <= 768);
}

function isVerySmallScreen(){
    return (documentWidth <= 550);
}

$(window).resize(function(){
    reAdjustView();
});

$(document).ready(function(){
    path = window.location.pathname;
    path = path.substr(path.lastIndexOf("/")+1);
    reAdjustView();
});

$("#id-div-mobile-nav").click(function(){
    $("#id-div-site-navigation").find(".cl-nav-cus").css("max-height","200px");
    $("#id-div-site-navigation").find(".cl-nav-cus").animate({
        height: "toggle"
    });
});