<?php 
    header("Content-type: application/javascript");
    include_once("../CUserSession.php");
 ?>

var global_columns_goals = []; //Holds column names for goals, and selected state
var global_columns_phases = []; //Holds column names for phases, and selected state

String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

$(document).ready(function () {
    
    var user_email = "";

    var params={};window.location.search.replace(/[?&;#]+([^=&]+)=([^&]*)/gi,function(str,key,value){params[key] = value;});

    $("img").unveil();
    $("img").trigger("unveil");

    $(".cl-span-site-breadcrumb-title").html("Solutions");
    var solutionLandingPane = $("#id-pane-solution-landing");
    var solutionPane = $("#id-pane-solution");
    
    if(params && params.view === "browse"){
        <?php
            if(isLoggedIn()){
                echo('window.location.href = "solutions_l.php?";');
            } else {
                echo('window.location.href = "register.php?redir=s";');
            }
        ?>
        
    } else {
        $(solutionLandingPane).show();
        $(solutionLandingPane).addClass("active");
        $(solutionPane).hide();
        $(solutionPane).removeClass("active");    
    }

    $("#id-div-solution-card-browse-img-holder").click(function(){
        $("#id-card-btn-browse-solutions").click();
    });

    $("#id-div-solution-card-create-img-holder").click(function(){
        $("#id-card-btn-create-project").click();
    });

    $("#id-div-solution-card-manage-img-holder").click(function(){
        $("#id-card-btn-manage-projects").click();
    });

    $("#id-a-solution-card-browse-link").click(function(){
        $("#id-card-btn-browse-solutions").click();
    });

    $("#id-card-btn-browse-solutions").click(function(){
        <?php
            if(isLoggedIn()){
                echo('window.location.href = "solutions_l.php?";');
            } else {
                echo('window.location.href = "register.php?redir=s";');
            }
        ?>
    });

    $("#id-card-btn-create-project").click(function(){
        <?php
            if(isLoggedIn()){
                echo('window.location.href = "createProject.php";');
            } else {
                echo('window.location.href = "register.php?redir=s";');
            }
        ?>
    });

    $("#id-card-btn-manage-projects").click(function(){
        <?php
            if(isLoggedIn()){
                echo('window.location.href = "projectDashboard.php";');
            } else {
                echo('window.location.href = "register.php?redir=s";');
            }
        ?>
    });
});