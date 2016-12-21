/// <reference path="../../typings/jquery/jquery.d.ts"/>

var global_data = [];  //Holds global data. Complete row set
var global_columns_goals = []; //Holds column names for goals, and selected state
var global_columns_phases = []; //Holds column names for phases, and selected state
var global_filtering = false;

$(document).ready(function () {  
    
    //passing -1 results in getting the top most level - h1
    var accordian = $("#accordion");
    var listGroup = accordian.find(".list-group");
    var elem = listGroup.find(".list-group-item");
    var id;

    //Lazy load images
    $("img").unveil();
    $("img").trigger('unveil');
    $(".cl-carousel-image").trigger("unveil");
    $(".cl-carousel-image").trigger("lookup");

    $(".carousel").carousel("pause");
    
    var params={};window.location.search.replace(/[?&;#]+([^=&]+)=([^&]*)/gi,function(str,key,value){params[key] = value;});
    var path = window.location.pathname;
    if(params.r){
        $('.cl-nav-cus a[href="#'+params.r+'"]').tab('show');

        if(params.r ==="home"){
            $(".cl-span-site-breadcrumb-title").html(isSmallScreen()?"":"Welcome to innovative solutions for Universal Design");
            $(".cl-div-site-breadcrumb").css("border-bottom","none");

            if(params.sc === "true"){
                $.post("getStandards.php",{survey_complete: true}, function(data){
                },"json");
            }
        } else {
            $(".cl-span-site-breadcrumb-title").html(params.r.capitalizeFirstLetter());
            document.title = 'isUD - ' + params.r.capitalizeFirstLetter();
            $(".cl-div-site-breadcrumb").css("border-bottom","3px solid #888");
            $("#content-holder").find(".tab-content").find(".tab-pane").addClass("active");
        }

    } else {
        if(path.substr(path.lastIndexOf("/")+1) === "index.php") {
            $('.cl-nav-cus a[href="#home"]').tab('show');
            $(".cl-span-site-breadcrumb-title").html(isSmallScreen()?"":"Welcome to innovative solutions for Universal Design");
            $(".cl-div-site-breadcrumb").css("border-bottom","none");
        } else {
            $("#content-holder").find(".tab-content").find(".tab-pane").tab('show');
        }
    }
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    
    listGroup.html('');

    var anchor;
    var icon;
    var stdNo;
    var collapse;
    var table;
    var checkbox;
    var checked;
    
    $(".cl-filter-header-checkbox").find("input").click(function (){
        var container = $(this).parents(".cl-section-filter");
        
        /*
            set or reset all checkboxes
            
            set data-checked to opposite value so that the click handler inverts it and does the row 
            showing/hiding
        */
        $(container).find(".cl-filter-elem .tbl-std-checkbox").attr("data-checked",(!$(this).prop("checked")).toString());
        $(container).find(".cl-filter-elem").click();
    });

});

$("#id-btn-contact-emailer-clear").click(function(){
    $(".cl-lbl").removeClass("has-danger");
    $(".cl-lbl").removeClass("has-success");
    $("#id-div-emailer-holder .has-success").removeClass("has-success");
    $("#id-div-emailer-holder .has-danger").removeClass("has-danger");
    $("#id-div-emailer-holder .form-control").val("");
});

$("#id-btn-contact-emailer-submit").click(function(){
    var NameElem = $("#id-contact-emailer-form-inp-name");
    var EmailElem = $("#id-contact-emailer-form-inp-email");
    var CommentElem = $("#id-contact-emailer-form-inp-comment");

    var NameVal = $(NameElem).val();
    var EmailVal = $(EmailElem).val();
    var CommentVal = $(CommentElem).val();

    var eventDataName = {target : $(NameElem)};
    var eventDataEmail = {target : $(EmailElem)};
    var eventDataComment = {target : $(CommentElem)};

    var progressContainer = $("#id-div-contact-emailer-progress");
    var progressIcon = $("#id-div-contact-emailer-progress-icon");
    var progressMsg = $("#id-div-contact-emailer-progress-msg");

    var flag = true;

    flag = validateFirstName(eventDataName) && flag;
    flag = validateEmail(eventDataEmail) && flag;

    if(flag){
        var data_package = new Object();
        data_package['name'] = NameVal;
        data_package['email'] = EmailVal;
        data_package['comment'] = CommentVal;

        showErrorSpan(NameElem, false);
        showErrorSpan(EmailElem, false);

        $(progressContainer).show();
        $(progressIcon).addClass("fa-2x");
        $(progressIcon).addClass("fa-spin");
        $(progressIcon).addClass("fa-spinner");
        $(progressMsg).html("Your questions/comments are being logged. Please wait...");

        $.post("getStandards.php",{contact: "CONTACT_EMAILER", data: JSON.stringify(data_package)}, function(data){
            $("#id-btn-contact-emailer-clear").click();
            $(progressIcon).removeClass("fa-spinner");
            $(progressIcon).removeClass("fa-spin");

            if(data.response){
                $(progressIcon).addClass("fa-2x");
                $(progressIcon).addClass("fa-check");
                $(progressMsg).html("Thank you for your questions/comments!");
            } else {
                $(progressIcon).addClass("fa-2x");
                $(progressIcon).addClass("fa-close");
                $(progressMsg).html("Something went wrong! Please try again.");
            }

            $(progressContainer).delay(3000).fadeOut(500);
        },"json");
    } else {
        showErrorSpan(NameElem, !validateFirstName(eventDataName));
        showErrorSpan(EmailElem, !validateEmail(eventDataEmail));
    }

});
