/// <reference path="../../typings/jquery/jquery.d.ts"/>
//var pbar;
$(document).ready(function () { 

    $("#id-nav-holder-right").css("border-bottom", "2px solid #555");

    // variable for storing an admin list
    var reviewers ={};

    // get the list of reviewers 
    $.post("getUserInfo.php",{user:"REVIEWERS"},function(data2){
        reviewers =  data2;
    },"json");


    $.post("getStandards.php",{project: "LIST"}, function(data){
        var OngoingContainer = $(".cl-div-ongoing-p-holder").find(".cl-div-p-item-holder");
        var CompletedContainer = $(".cl-div-completed-p-holder").find(".cl-div-p-item-holder");
        var project = $(OngoingContainer).find(".cl-div-project").clone();
        $(OngoingContainer).empty();
        $(CompletedContainer).empty();
        
        $.each(data, function(index, elem){
            var projectTemplete = $(project).clone();
            var projectTitle = $(projectTemplete).find(".cl-span-project-title-text");
            var projectEditIcon = $(projectTemplete).find(".cl-i-project-edit");
            var projectLeftContainer = $(projectTemplete).find(".cl-div-project-info-left");
            var projectRightContainer = $(projectTemplete).find(".cl-div-project-info-right");
            var projectEditButton = $(projectTemplete).find(".cl-project-review-btn");

            // when admin clicks on review button open admin solution review page.
            // to do : do solution  page for admin
            $(projectEditButton).attr("data-project-id",elem._id);
            $(projectEditButton).click(function(ev){
                var target = "adminSolution.php?edit=true&id=" + $(this).attr("data-project-id");
                window.location.href = target;
            });

            $(projectEditIcon).attr("data-project-id",elem._id);
            $(projectEditIcon).click(function(ev){
                var target = "createProject.php?edit=true&p=" + $(this).attr("data-project-id");
                window.location.href = target;
            });
            
            var projectInfoItem = $(projectLeftContainer).find(".cl-div-project-info-item");
            var projectAwardDetailsHolder = $(projectRightContainer).find(".cl-div-project-award-details-holder");
            var projectEarnedCredits = $(projectAwardDetailsHolder).find(".cl-span-project-award-credit-earned");
            var projectApplicableCredits = $(projectAwardDetailsHolder).find(".cl-span-project-award-credit-applicable");
            var projectAwardChart = $(projectAwardDetailsHolder).find(".cl-div-project-award-progress-container");

            // project title
            projectTitle.html(elem.project_title);

            //Project Number
            $(projectInfoItem).find(".cl-span-project-info-item-value-text").html(elem.sl_pr_no);
            // $(projectInfoItem).find(".cl-span-project-info-item-value-text").val(elem.sl_pr_no);

            //Project Owner
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("Project Owner");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(elem.project_owner);
            // $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(elem.project_owner);
            $(projectLeftContainer).append(projectInfoItemClone);

            //Architect
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("Architect");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(elem.project_architect);
            // $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(elem.project_architect);
            $(projectLeftContainer).append(projectInfoItemClone);

            //City
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("Location");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(elem.project_city);
            // $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(elem.project_city);
            $(projectLeftContainer).append(projectInfoItemClone);

            //Building Type
            var building_type_string = elem.building_type.replace(new RegExp(";{2,}","g"), "").replace(new RegExp(";","g"),",");
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("Building Type");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(building_type_string);
            // $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(building_type_string);
            $(projectLeftContainer).append(projectInfoItemClone);

            //isUD Start Date
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("isUD Start Date");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(elem.project_isud_creation_date);
            // $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(elem.project_isud_creation_date);
            $(projectLeftContainer).append(projectInfoItemClone);

            //Reviewer List
            // var projectInfoItemClone = $(projectInfoItem).clone();
            // $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("Assign Reviewer");
            // $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(reviewers[0].first_name);
            // $(projectLeftContainer).append(projectInfoItemClone);
            var projectReviewer = $(projectTemplete).find("#dropdown-reviewer");
            $(projectReviewer).attr("id",elem._id);
            var output = [];
            $.each(reviewers, function(index_reviewer, reviewer)
            {
                // console.log( reviewer.first_name );
                output.push('<option value="'+ reviewer.email_id +'">'+ reviewer.first_name +'</option>');
            });
            $(projectReviewer).html(output.join(''));
            $(projectReviewer).val(elem.reviewer);

            $(projectReviewer).change(function(){
                var reviewer = $(this).val();
                var project_id = $(this).attr("id");
                console.log( project_id + " : " + reviewer );

                 $.post("updateProjectReviewer.php",{ project_id: project_id , reviewer:reviewer },function(resp)
                 {
                    console.log("Reviewer updated successfully");
                    console.log(resp);
                 },"json");

                alert("Reviewer updated successfully");            
            });

            if(parseInt(elem.isud_status,10) === 0){
                $(OngoingContainer).append(projectTemplete);
            } else {
                $(CompletedContainer).append(projectTemplete);                
            }

            $(projectAwardChart).attr("id",$(projectAwardChart).attr("id")+elem._id);

            var pbar = new ProgressBar.Circle("#"+projectAwardChart.attr("id"), {
                color: '#F7941E',
                strokeWidth: 10,
                trailColor: '#ffffff',
                trailWidth: 10,
                outlineColor: '#444444',
                outlineWidth: 2,
                text: {
                    autoStyleContainer: false
                }
            });
            pbar.setText("0%");
            pbar.set(0.0);
            pbar.text.style.fontSize = '1em';
            pbar.text.style.color = 'black';
            pbar.text.style.fontWeight = '600';


            pbar.setText(Math.floor(elem.award_percentage)+"%");
            pbar.set(elem.award_percentage/100.0);
            projectEarnedCredits.html(elem.earned_credits);
            projectApplicableCredits.html(elem.applicable_credits);
        });
    },"json"); 
});

// if reviewer is changed in drop down box, it will be added to the Database
$('.dropdown-reviewer').change(function()
{
      var data= $(this).val();
      alert(data);       
});

$(".dropdown-reviewer").on("change", function(ev)
{
    alert("reviewer changed !!");
});