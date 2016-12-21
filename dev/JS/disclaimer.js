/// <reference path="../../typings/jquery/jquery.d.ts"/>

$(document).ready(function () {

    var accordian = $("#accordion");
    var id;
    
    var params={};window.location.search.replace(/[?&;#]+([^=&]+)=([^&]*)/gi,function(str,key,value){params[key] = value;});
    var path = window.location.pathname;
    var paneName = path.substring(path.lastIndexOf("/")+1, path.lastIndexOf("."));

    $("#id-pane-"+paneName).show();

    //Lazy load images
    $("img").unveil();
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
});