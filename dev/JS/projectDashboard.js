/// <reference path="../../typings/jquery/jquery.d.ts"/>
//var pbar;
$(document).ready(function () { 

    $("#id-nav-holder-right").css("border-bottom", "2px solid #555");

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
            var projectEditButton = $(projectTemplete).find(".cl-project-edit-btn");


            $(projectEditButton).attr("data-project-id",elem._id);
            $(projectEditButton).click(function(ev){
                var target = "solutions_l.php?edit=true&id=" + $(this).attr("data-project-id");
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

            //Project Number
            $(projectInfoItem).find(".cl-span-project-info-item-value-text").html(elem.sl_pr_no);
            $(projectInfoItem).find(".cl-span-project-info-item-value-text").val(elem.sl_pr_no);

            //Project Owner
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("Project Owner");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(elem.project_owner);
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(elem.project_owner);
            $(projectLeftContainer).append(projectInfoItemClone);

            //Architect
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("Architect");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(elem.project_architect);
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(elem.project_architect);
            $(projectLeftContainer).append(projectInfoItemClone);

            //City
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("Location");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(elem.project_city);
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(elem.project_city);
            $(projectLeftContainer).append(projectInfoItemClone);

            //Building Type
            var building_type_string = elem.building_type.replace(new RegExp(";{2,}","g"), "").replace(new RegExp(";","g"),",");
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("Building Type");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(building_type_string);
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(building_type_string);
            $(projectLeftContainer).append(projectInfoItemClone);

            //isUD Start Date
            var projectInfoItemClone = $(projectInfoItem).clone();
            $(projectInfoItemClone).find(".cl-span-project-info-item-header-text").html("isUD Start Date");
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").html(elem.project_isud_creation_date);
            $(projectInfoItemClone).find(".cl-span-project-info-item-value-text").val(elem.project_isud_creation_date);
            $(projectLeftContainer).append(projectInfoItemClone);

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