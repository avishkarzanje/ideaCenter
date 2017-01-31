/// <reference path="../../typings/jquery/jquery.d.ts"/>

var global_columns_goals = []; //Holds column names for goals, and selected state
var global_columns_phases = []; //Holds column names for phases, and selected state

var deferredOpenElem = null;
var srVersion = false;
var preFetchImages = true;

var creditDict = {};
var header_mask_arr = {};
var G_projectCreditCountApplicable = 100;
var G_projectCreditCountEarned = 0;
var G_projectCreditBonusCount = 0;
var G_projectAwardPercentage = 0.0;
var G_h1CreditsArrString = '';
var G_h1CreditsArrEarnedString = '';
var G_h1CreditsArrApplicableString = '';
var G_h1CreditsArr = [];
var G_h1CreditsArrEarned = [];
var editMode = false;
var initialPopulationMode = true;
var params={};
var pbar;

String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

$(document).ready(function () {
    
    var user_email = "";

    window.location.search.replace(/[?&;#]+([^=&]+)=([^&]*)/gi,function(str,key,value){params[key] = value;});

    $("img").unveil();
    $("img").trigger("unveil");

    // TODO : Fix this temp //////////
    if(typeof params.edit !== "undefined" && params.edit ==="true" && (typeof params.id !== "undefined")){
        editMode = true;
        $(".cl-div-chapter-sub-title").hide();
        $(".cl-div-nav-image-holder").css("display","flex");
        $(".cl-div-nav-project-award-details-holder").css("display","flex");
        $(".cl-form-solution-checkbox").show();
        $(".cl-div-hx-item-title-edit-status").show();
        $(".cl-div-chapter-credit-implemented-ratio-holder").show();
        $(".cl-div-hx-footer").show();
        fillGlobalDataFromDB(params.id); 
        $("#id-img-navbar-p-solutions").attr("src","images/solutions_active.png");
        $("#id-img-navbar-p-solutions").parent().css("pointer-events","none");
        $(".cl-div-site-breadcrumb").addClass("hide");
    } else {
        $(".cl-div-chapter-sub-title").show();
        $(".cl-div-nav-image-holder").css("display","none");
        $(".cl-div-nav-project-award-details-holder").css("display","none");
        $(".cl-form-solution-checkbox").hide();
        $(".cl-div-hx-item-title-edit-status").hide();
        $(".cl-div-chapter-credit-implemented-ratio-holder").hide();  
        $("#id-div-chapter-content-top-info").hide();
        $(".cl-div-hx-footer").hide();  
        $(".cl-div-nav-image-holder").addClass("hide"); 
        $(".cl-div-nav-project-award-details-holder").addClass("hide"); 
        getChapters();           
    }

    // $(".cl-div-selection-switch-holder").on("click",function(){
    //     return false;
    // });

    ///////////////////////////////////

    pbar = new ProgressBar.Circle('#id-div-project-award-progress-container', {
        color: '#F7941E',
        strokeWidth: 10,
        trailColor: '#ffffff',
        trailWidth: 10,
        text: {
            autoStyleContainer: false
        }
    });
    pbar.setText("0%");
    pbar.set(0.0);
    pbar.text.style.fontSize = '1em';
    pbar.text.style.color = 'black';
    pbar.text.style.fontWeight = '600';


    $(".cl-span-site-breadcrumb-title").html("Solutions");
    var solutionLandingPane = $("#id-pane-solution-landing");
    var solutionPane = $("#id-pane-solution");

    if (!global_columns_goals || global_columns_goals.length == 0) {
        $.post("getStandards.php", { columns: "GOALS" }, function (data) {
            $.each(data, function (index, elem){
                global_columns_goals.push({name : elem, selected : true});
            });
        },"json");
    }

    if (!global_columns_phases || global_columns_phases.length == 0) {
        $.post("getStandards.php", { columns: "PHASES" }, function (data) {
            $.each(data, function (index, elem){
                global_columns_phases.push({name : elem, selected : true});
            });
        },"json");
    }

});

function getChapters(){
    $.post("getStandards.php", { chapter: -1 }, function (data) {
        var chapterListHolder = $("#id-div-solution-chapter-holder");
        var elem = $("#id-div-solution-chapter-list-item");
        //chapterListHolder.html('');
        $.each(data, function (index, e) {
            var newElem = elem.clone();
            e = e.header;
            id = newElem.attr("id") + "-" + e.h1.toString();
            newElem.attr("id", id);

            var chapterNo = newElem.find(".cl-div-chapter-number");
            chapterNo.html(e.h1.toString());

            var chapterTitle = newElem.find(".cl-div-chapter-title");
            chapterTitle.html(e.h1_title.toString());

            var chapterSubtitle = newElem.find(".cl-div-chapter-sub-title");
            chapterSubtitle.html(e.h1_points.toString()+" Credits");

            var chapterCreditRatioHolder = newElem.find(".cl-div-chapter-credit-implemented-ratio-holder");
            var chapterCreditRatioTotal = $(chapterCreditRatioHolder).find(".cl-div-ratio-square-elem-right span");
            var chapterCreditRatioEarned = $(chapterCreditRatioHolder).find(".cl-div-ratio-square-elem-left span");

            id = chapterCreditRatioHolder.attr("id") + e.h1.toString();
            chapterCreditRatioHolder.attr("id",id);

            newElem.on("click", getSolutionsForChapter);
            chapterListHolder.append(newElem);
            
            if(!editMode && typeof creditDict[index] === "undefined"){
                var creditH1Dict = {};
                creditH1Dict.earned_credits = 0;
                creditH1Dict.total_credits = parseInt(e.h1_points,10);
                creditH1Dict.applicable_credits = parseInt(e.h1_points,10);
                creditDict[index] = creditH1Dict;
            } else if(editMode){
                creditDict[index].total_credits = parseInt(e.h1_points,10); 
            }
            
            chapterCreditRatioTotal.html("of "+creditDict[index].applicable_credits);
            chapterCreditRatioEarned.html(creditDict[index].earned_credits);
        });
        chapterListHolder.children().first().remove();
        $("#id-pane-solution").show();
        $(".cl-solutions-section-right").css("min-height",($(".cl-solutions-section-left").height()));

        $.post("getStandards.php", { query: "sr_version"}, function (data){
            if(data.response){
                srVersion = true;
                var ev = {currentTarget: {id: "-sr"}};
                $("#id-div-solution-chapter-holder").find(".cl-div-solution-chapter-list-item").first().click();
                //getSolutionsForChapter(ev);
            } else {
                $("#id-div-solution-chapter-holder").find(".cl-div-solution-chapter-list-item").first().click();        
            }
        }, "json");

    }, "json");
}
    
function getSolutionsForChapter(event){
        event.preventDefault();
        var chapter = event.currentTarget.id.substr(event.currentTarget.id.lastIndexOf("-")+1);
        initialPopulationMode = true;
        //close all previously opened panes to save them
        $(".cl-div-chapter-content-h2-item-pane.collapse.in").collapse("hide");

        // if(!srVersion){
            $(".cl-div-solution-chapter-list-item").removeClass("active");
            $("#id-div-solution-chapter-list-item-"+chapter+" .cl-div-chapter-spin-i-holder").removeClass("hide");
            $("#id-div-solution-chapter-list-item-"+chapter+" .cl-div-chapter-chevron-holder").addClass("hide");
        // }
        
        $.post("getStandards.php", { chapter: chapter }, function (data) {
            var h2Holder = $("#id-div-chapter-content-h2-holder");
            var h2elem = $("#id-div-chapter-content-h2-holder-dummy .cl-div-chapter-content-h2-item")[0];
            h2Holder.empty();
            
            // $(".cl-div-chapter-content-h2-item-true").remove();
            $.each(data, function (i, e){
                d = e.header.h2_elems;
            
                $.each(d, function (index, e2) {
                    var newH2Elem = $(h2elem).clone();

                    newH2Elem.removeClass("hide");
                    newH2Elem.removeClass("cl-div-chapter-content-h2-item");
                    newH2Elem.addClass("cl-div-chapter-content-h2-item-true");
                    newH2Elem.addClass("unmarked");

                    var replacedHeaderTextH2 = e2.header_text.replace(/\./g,"-").toString();

                    id = newH2Elem.attr("id") + "-" + replacedHeaderTextH2;
                    newH2Elem.attr("id", id);

                    var h2Header = newH2Elem.find(".cl-div-chapter-content-h2-item-header");
                    var h2Pane = newH2Elem.find(".cl-div-chapter-content-h2-item-pane");
                    var h2Footer = newH2Elem.find(".cl-div-h2-footer");

                    var h2SaveBtn = h2Footer.find("#id-btn-hx-footer-save");
                    var h2ClearBtn = h2Footer.find("#id-btn-hx-footer-clear");
                    id = h2SaveBtn.attr("id") + "-" + replacedHeaderTextH2;
                    h2SaveBtn.attr("id",id);
                    id = h2ClearBtn.attr("id") + "-" + replacedHeaderTextH2;
                    h2ClearBtn.attr("id",id);

                    id = h2Pane.attr("id") + "-" + replacedHeaderTextH2;
                    h2Pane.attr("id",id);
                    h2Header.attr("data-target","#"+id);
                    h2Header.attr("data-parent","#"+$(h2Holder).attr("id"));

                    var h2FlipSwitch = h2Header.find(".cl-slider-flip-m");
                    id = h2FlipSwitch.attr("id") + "-" + replacedHeaderTextH2;
                    h2FlipSwitch.attr("id",id);
                    //h2FlipSwitch.flipswitch("refresh");

                    var h2Image = newH2Elem.find(".cl-div-h2-item-image");
                    h2Image.attr("src","images/unitarrow_closed.png");
                    h2Image.attr("data-src","images/unitarrow_closed.png");

                    var h2Text = newH2Elem.find(".cl-div-h2-item-number");
                    h2Text.html(e2.header_text.toString());

                    var h2Title = newH2Elem.find(".cl-div-h2-item-title");
                    h2Title.html(e2.h2_title.toString());

                    var instruction = newH2Elem.find(".cl-div-h2-item-subtitle");
                    instruction.html(e2.instruction.toString());

                    var h2Points = newH2Elem.find(".cl-div-h2-item-points");
                    h2Points.html(e2.h2_points.toString());

                    var numChildSolutions = Object.keys(e2.solutions).length;
                    $.each(e2.h3_elems, function(index, h3e){
                        numChildSolutions += Object.keys(h3e.solutions).length;
                    });

                    var h2SolutionsImplememtedRatioHolder = newH2Elem.find(".cl-div-implemented-ratio-holder");
                    var h2SolutionsImplememtedRatioTotal = $(h2SolutionsImplememtedRatioHolder).find(".cl-div-ratio-rounded-elem-right span");
                    var h2SolutionsImplememtedRatioImplemented = $(h2SolutionsImplememtedRatioHolder).find(".cl-div-ratio-rounded-elem-left span");

                    var h2CreditsRatioHolder = newH2Elem.find(".cl-div-earned-ratio-holder");
                    var h2CreditsRatioTotal = $(h2CreditsRatioHolder).find(".cl-div-ratio-square-elem-right span");
                    var h2CreditsRatioEarned = $(h2CreditsRatioHolder).find(".cl-div-ratio-square-elem-left span");

                    var h2NotificationHolder = newH2Elem.find(".cl-div-h2-item-title-notification-holder");
                    if(e2.design_resource !== null && e2.design_resource !== "NULL"&& e2.design_resource != null && e2.design_resource !== ""){
                        $(h2NotificationHolder).find("a").attr("href",e2.design_resource);
                    } else {
                        $(h2NotificationHolder).empty();
                    }

                    var h2SolutionsHolder = newH2Elem.find(".cl-div-h2-solutions-holder");
                    var h2SolutionsElem = newH2Elem.find(".cl-div-h2-solution-item");
                    h2SolutionsHolder.empty();

                    var h2s = e2.solutions;

                    if(!editMode && typeof creditDict[e2.h1][index] === "undefined"){
                        var creditH2Dict = {};
                        creditH2Dict.earned_credits = 0;
                        creditH2Dict.total_credits = parseInt(e2.h2_points,10);
                        creditH2Dict.applicable_credits = parseInt(e2.h2_points,10);
                        creditH2Dict.total_solutions = Object.keys(e2.solutions).length;
                        creditH2Dict.checked_solutions = 0;
                        creditH2Dict.thresholds = [];
                        creditH2Dict.thresholdLevels = [];

                        var th_s = e2.instruction;
                        while(th_s.indexOf(" of")>=0){
                            creditH2Dict.thresholds.unshift(parseInt(th_s.substring(th_s.substr(0,th_s.indexOf(" of")).lastIndexOf(" ")+1, th_s.indexOf(" of")),10));
                            th_s = th_s.substr(th_s.indexOf(" of")+3);
                        }

                        var th_s = e2.instruction;
                        while(th_s.indexOf(" Credit")>=0){
                            creditH2Dict.thresholdLevels.unshift(parseInt(th_s.substring(Math.max(0,th_s.substr(0,th_s.indexOf(" Credit")).lastIndexOf("|")+1), th_s.indexOf(" Credit")),10));
                            th_s = th_s.substr(th_s.indexOf(" Credit")+7);
                        }

                        creditDict[e2.h1][index] = creditH2Dict;
                    } else if(editMode){
                        creditDict[e2.h1][index].total_credits = parseInt(e2.h2_points,10);
                        creditDict[e2.h1][index].applicable_credits = header_mask_arr[e2.h1][index] == 0? 0 : parseInt(e2.h2_points,10);
                        creditDict[e2.h1][index].total_solutions = Object.keys(e2.solutions).length;
                        var th_s = e2.instruction;
                        while(th_s.indexOf(" of")>=0){
                            creditDict[e2.h1][index].thresholds.unshift(parseInt(th_s.substring(th_s.substr(0,th_s.indexOf(" of")).lastIndexOf(" ")+1, th_s.indexOf(" of")),10));
                            th_s = th_s.substr(th_s.indexOf(" of")+3);
                        }

                        var th_s = e2.instruction;
                        while(th_s.indexOf(" Credit")>=0){
                            creditDict[e2.h1][index].thresholdLevels.unshift(parseInt(th_s.substring(Math.max(0,th_s.substr(0,th_s.indexOf(" Credit")).lastIndexOf("|")+1), th_s.indexOf(" Credit")),10));
                            th_s = th_s.substr(th_s.indexOf(" Credit")+7);
                        }
                    }

                    if(h2s.length > 0){

                    }

                    $.each(h2s, function (index, s){
                        var newSolutionElem = $(h2SolutionsElem).clone();
                        id = newSolutionElem.attr("id") + "-" + s.standard_no.replace(/\./g,"-").toString();
                        newSolutionElem.attr("id",id);

                        var solutionText = newSolutionElem.find(".cl-div-h2-solution-item-text");
                        solutionText.html(s.standard_text.toString());

                        var solutionPrequisite = newSolutionElem.find(".cl-div-h2-solution-item-prequisite");
                        if(s.prerequisite){
                            $(newSolutionElem).addClass("prequisite");
                        }

                        var solutionItemNumber = newSolutionElem.find(".cl-div-h2-solution-item-number-text");
                        solutionItemNumber.html("Solution "+s.standard_no);

                        var solutionItemHeader = newSolutionElem.find(".cl-div-h2-solution-item-header");
                        var solutionItemPane = newSolutionElem.find(".cl-div-h2-solution-item-pane");
                        id = solutionItemPane.attr("id") + "-" + s.standard_no.replace(/\./g,"-").toString();
                        solutionItemPane.attr("id",id);
                        solutionItemHeader.attr("data-target","#"+id);

                        var solutionItemImageNotificationHolder = newSolutionElem.find(".cl-div-h2-solution-item-image-notification-holder");

                        var solutionItemAttribGoalsHolder = newSolutionElem.find("#id-div-h2-solution-item-attrib-holder-goals"); 
                        var solutionItemAttribGoalsItem = solutionItemAttribGoalsHolder.find(".cl-div-h2-solution-item-attrib-item");
                        solutionItemAttribGoalsHolder.children().not(".cl-div-h2-solution-item-attrib-header").remove();

                        var solutionItemAttribPhasesHolder = newSolutionElem.find("#id-div-h2-solution-item-attrib-holder-phases");
                        var solutionItemAttribPhasesItem = solutionItemAttribPhasesHolder.find(".cl-div-h2-solution-item-attrib-item");
                        solutionItemAttribPhasesHolder.children().not(".cl-div-h2-solution-item-attrib-header").remove();

                        var solutionItemImageHolder = newSolutionElem.find(".cl-div-solution-item-pane-image-holder");
                        var solutionItemImageTextHolder = newSolutionElem.find(".cl-div-h2-solution-item-image-text-holder");                    
                        var solutionItemImageCarousel = solutionItemImageHolder.find("#id-solution-item-carousel");
                        var solutionItemImageCarouselIndicators = solutionItemImageCarousel.find(".cl-solution-item-carousel-indicators");
                        var solutionItemImageCarouselInner = solutionItemImageCarousel.find(".cl-solution-item-carousel-inner");
                        var solutionItemImageCarouselControlLeft = solutionItemImageCarousel.find(".left.carousel-control");
                        var solutionItemImageCarouselControlRight = solutionItemImageCarousel.find(".right.carousel-control");
                        
                        var id = solutionItemImageCarousel.attr("id") + "-" + s.standard_no.replace(/\./g,"-").toString();
                        solutionItemImageCarousel.attr("id",id);
                        solutionItemImageCarouselControlLeft.attr("href","#"+id);
                        solutionItemImageCarouselControlRight.attr("href","#"+id);

                        if(s.fig_arr.length <= 0){
                            //solutionItemImageHolder.empty();
                            //solutionItemImageHolder.hide();
                            //solutionItemImageTextHolder.hide();
                            $(solutionItemImageHolder).find(".carousel-inner").hide();
                            solutionItemImageCarouselControlLeft.hide();
                            solutionItemImageCarouselControlRight.hide();
                            solutionItemImageCarouselIndicators.hide();
                        } else if(s.fig_arr.length == 1){
                            solutionItemImageCarouselControlLeft.hide();
                            solutionItemImageCarouselControlRight.hide();
                            solutionItemImageCarouselIndicators.hide();
                        }

                        if(s.fig_arr.length >= 1){
                            $(solutionItemImageHolder).css("min-height","360px");
                        }

                        $.each(s.fig_arr, function(index, fig){
                            
                            var solutionItemImageCarouselIndicatorsLi = solutionItemImageCarouselIndicators.find("li").first().clone();
                            solutionItemImageCarouselIndicatorsLi.attr("data-slide-to",index);
                            solutionItemImageCarouselIndicatorsLi.attr("data-target","#"+id);
                            
                            var solutionItemImageCarouselInnerItem = solutionItemImageCarouselInner.find(".cl-solution-item-carousel-item").first().clone();
                            var solutionItemImageCarouselInnerItemImage = solutionItemImageCarouselInnerItem.find("img");
                            var solutionItemImageCarouselInnerItemImageCaption = solutionItemImageCarouselInnerItem.find(".cl-solution-item-carousel-item-image-caption");
                            solutionItemImageCarouselInnerItemImage.attr("data-src",fig.fig_no);
                            solutionItemImageCarouselInnerItemImage.attr("alt",fig.fig_no);
                            solutionItemImageCarouselInnerItemImage.attr("data-caption",fig.fig_caption);
                            solutionItemImageCarouselInnerItemImage.attr("data-num",index);
                            solutionItemImageCarouselInnerItemImage.attr("src","");
                            solutionItemImageCarouselInnerItemImageCaption.html(fig.fig_caption);

                            if(fig.fig_caption===''){
                                solutionItemImageCarouselInnerItemImageCaption.html(s.standard_no+" : "+fig.fig_no.replace("solution_images/",""));                            
                            }
                            
                            if(index === 0){
                                solutionItemImageCarouselIndicators.empty();
                                solutionItemImageCarouselInner.empty();
                                solutionItemImageCarouselIndicatorsLi.removeClass("active");
                                solutionItemImageCarouselIndicatorsLi.addClass("active");
                                solutionItemImageCarouselInnerItem.removeClass("active");
                                solutionItemImageCarouselInnerItem.addClass("active");
                                solutionItemImageNotificationHolder.removeClass("hide");
                            } else {
                                solutionItemImageCarouselIndicatorsLi.removeClass("active");
                                solutionItemImageCarouselInnerItem.removeClass("active");
                            }

                            solutionItemImageCarouselIndicators.append(solutionItemImageCarouselIndicatorsLi);
                            solutionItemImageCarouselInner.append(solutionItemImageCarouselInnerItem);

                        });

                        $.each(global_columns_goals, function (index, goal){
                            var newAttribItem = $(solutionItemAttribGoalsItem).clone();
                            $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-text").html(goal.name);
                            if(s.goals.search(goal.name) != -1){ // goal active for this solution
                                $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-indicator .fa").addClass("fa-check");
                                $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-indicator .fa").removeClass("fa-square");
                                $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-text").addClass("active");
                            } else {
                                $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-text").attr("aria-hidden","true");
                            }

                            solutionItemAttribGoalsHolder.append(newAttribItem);
                        });

                        $.each(global_columns_phases, function (index, phase){
                            var newAttribItem = $(solutionItemAttribPhasesItem).clone();
                            $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-text").html(phase.name);
                            if(s.phases.search(phase.name) != -1){ // goal active for this solution
                                $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-indicator .fa").addClass("fa-check");
                                $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-indicator .fa").removeClass("fa-square");
                                $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-text").addClass("active");
                            } else {
                                $(newAttribItem).find(".cl-div-h2-solution-item-attrib-item-text").attr("aria-hidden","true");                                
                            }

                            solutionItemAttribPhasesHolder.append(newAttribItem);
                        });

                        h2SolutionsHolder.append(newSolutionElem);

                        if(typeof creditDict[s.h1][s.h2][index] === "undefined"){
                            creditDict[s.h1][s.h2][index] = {checked: 0};
                        } else {
                            $(solutionItemHeader).find(".cl-div-hx-solution-item-checkbox").prop("checked",creditDict[s.h1][s.h2][index].checked === 1 ? true: false);
                            if(initialPopulationMode){
                                updateCreditCountandUI(s.h1,s.h2,-1,index,creditDict[s.h1][s.h2][index].checked);
                            }
                        }

                    });
                    
                    // h2CreditsRatioTotal.html("of "+creditDict[e2.h1][index].applicable_credits);
                    // h2CreditsRatioEarned.html(creditDict[e2.h1][index].earned_credits);
                    // h2SolutionsImplememtedRatioImplemented.html(creditDict[e2.h1][index].checked_solutions);
                    // h2SolutionsImplememtedRatioTotal.html("of "+creditDict[e2.h1][index].total_solutions);     
                    
                    var h3Holder = newH2Elem.find(".cl-div-chapter-content-h3-holder");
                    var h3elem = newH2Elem.find(".cl-div-chapter-content-h3-item")[0];
                    h3Holder.empty();
                    id = $(h3Holder).attr("id") + "-" + replacedHeaderTextH2;                
                    $(h3Holder).attr("id",id);
                    // $(".cl-div-chapter-content-h3-item-true").remove();
                    var d = e2.h3_elems;

                    if(Object.keys(d).length > 0){
                        $(instruction).addClass("hide");
                        $(h2Footer).addClass("hide");
                    }

                    $.each(d, function (index, e3) {
                        var newH3Elem = $(h3elem).clone();
                        var replacedHeaderTextH3 = e3.header_text.replace(/\./g,"-").toString();
                        id = newH3Elem.attr("id") + "-" + replacedHeaderTextH3;
                        newH3Elem.attr("id", id);
                        newH3Elem.removeClass("cl-div-chapter-content-h3-item");
                        newH3Elem.addClass("cl-div-chapter-content-h3-item-true");

                        var h3Header = newH3Elem.find(".cl-div-chapter-content-h3-item-header");
                        var h3Pane = newH3Elem.find(".cl-div-chapter-content-h3-item-pane");
                        var h3Footer = newH3Elem.find(".cl-div-h3-footer");

                        var h3SaveBtn = h2Footer.find("#id-btn-hx-footer-save");
                        var h3ClearBtn = h2Footer.find("#id-btn-hx-footer-clear");
                        id = h3SaveBtn.attr("id") + "-" + replacedHeaderTextH3;
                        h3SaveBtn.attr("id",id);
                        id = h3ClearBtn.attr("id") + "-" + replacedHeaderTextH3;
                        h3ClearBtn.attr("id",id);

                        id = h3Pane.attr("id") + "-" + replacedHeaderTextH3;
                        h3Pane.attr("id",id);
                        h3Header.attr("data-target","#"+id);
                        // h3Header.attr("data-parent","#"+$(h3Holder).attr("id"));

                        var h3Image = newH3Elem.find(".cl-div-h3-item-image");
                        h3Image.attr("src","images/unitarrow_closed.png");
                        h3Image.attr("data-src","images/unitarrow_closed.png");

                        var h3Text = newH3Elem.find(".cl-div-h3-item-number");
                        h3Text.html(e3.header_text.toString());

                        var h3Title = newH3Elem.find(".cl-div-h3-item-title");
                        h3Title.html(e3.h3_title.toString());

                        var instruction = newH3Elem.find(".cl-div-h3-item-subtitle");
                        instruction.html(e3.instruction.toString());

                        var h3Points = newH3Elem.find(".cl-div-h3-item-points");
                        h3Points.html(e3.h3_points.toString());

                        var h3NotificationHolder = newH3Elem.find(".cl-div-h3-item-title-notification-holder");
                        if(e3.design_resource !== null && e3.design_resource !== "NULL"&& e3.design_resource != null && e3.design_resource !== ""){
                            $(h3NotificationHolder).find("a").attr("href",e3.design_resource);
                        } else {
                            $(h3NotificationHolder).empty();
                        }

                        var h3SolutionsHolder = newH3Elem.find(".cl-div-h3-solutions-holder");
                        var h3SolutionsElem = newH3Elem.find(".cl-div-h3-solution-item");
                        h3SolutionsHolder.empty();

                        var h3s = e3.solutions;

                        if(h3s.length > 0){

                        }

                        if(!editMode && typeof creditDict[e3.h1][e3.h2][index] === "undefined"){
                            var creditH3Dict = {};
                            creditH3Dict.earned_credits = 0;
                            creditH3Dict.total_credits = parseInt(e3.h3_points,10);
                            creditH3Dict.applicable_credits = parseInt(e3.h3_points,10);
                            creditH3Dict.total_solutions = Object.keys(e3.solutions).length;
                            creditH3Dict.checked_solutions = 0;
                            creditH3Dict.thresholds = [];
                            creditH3Dict.thresholdLevels = [];

                            var th_s = e3.instruction;
                            while(th_s.indexOf(" of")>=0){
                                creditH3Dict.thresholds.unshift(parseInt(th_s.substring(th_s.substr(0,th_s.indexOf(" of")).lastIndexOf(" ")+1, th_s.indexOf(" of")),10));
                                th_s = th_s.substr(th_s.indexOf(" of")+3);
                            }

                            var th_s = e3.instruction;
                            while(th_s.indexOf(" Credit")>=0){
                                creditH3Dict.thresholdLevels.unshift(parseInt(th_s.substring(Math.max(0,th_s.substr(0,th_s.indexOf(" Credit")).lastIndexOf("|")+1), th_s.indexOf(" Credit")),10));
                                th_s = th_s.substr(th_s.indexOf(" Credit")+7);
                            }

                            creditDict[e3.h1][e3.h2][index] = creditH3Dict;
                        } else if (editMode){
                            creditDict[e3.h1][e3.h2][index].total_credits = parseInt(e3.h3_points,10);
                            creditDict[e3.h1][e3.h2][index].applicable_credits = parseInt(e3.h3_points,10);
                            creditDict[e3.h1][e3.h2][index].total_solutions = Object.keys(e3.solutions).length;
                            var th_s = e3.instruction;
                            while(th_s.indexOf(" of")>=0){
                                creditDict[e3.h1][e3.h2][index].thresholds.unshift(parseInt(th_s.substring(th_s.substr(0,th_s.indexOf(" of")).lastIndexOf(" ")+1, th_s.indexOf(" of")),10));
                                th_s = th_s.substr(th_s.indexOf(" of")+3);
                            }

                            var th_s = e3.instruction;
                            while(th_s.indexOf(" Credit")>=0){
                                creditDict[e3.h1][e3.h2][index].thresholdLevels.unshift(parseInt(th_s.substring(Math.max(0,th_s.substr(0,th_s.indexOf(" Credit")).lastIndexOf("|")+1), th_s.indexOf(" Credit")),10));
                                th_s = th_s.substr(th_s.indexOf(" Credit")+7);
                            }
                        }

                        $.each(h3s, function (index, s){
                            var newSolutionElem = $(h3SolutionsElem).clone();
                            id = newSolutionElem.attr("id") + "-" + s.standard_no.replace(/\./g,"-").toString();
                            newSolutionElem.attr("id",id);

                            var solutionText = newSolutionElem.find(".cl-div-h3-solution-item-text");
                            solutionText.html(s.standard_text.toString());

                            var solutionPrequisite = newSolutionElem.find(".cl-div-h3-solution-item-prequisite");
                            if(s.prerequisite){
                                $(newSolutionElem).addClass("prequisite");                                
                            }

                            var solutionItemNumber = newSolutionElem.find(".cl-div-h3-solution-item-number-text");
                            solutionItemNumber.html("Solution "+s.standard_no);

                            var solutionItemHeader = newSolutionElem.find(".cl-div-h3-solution-item-header");
                            var solutionItemPane = newSolutionElem.find(".cl-div-h3-solution-item-pane");
                            id = solutionItemPane.attr("id") + "-" + s.standard_no.replace(/\./g,"-").toString();
                            solutionItemPane.attr("id",id);
                            solutionItemHeader.attr("data-target","#"+id);

                            var solutionItemImageNotificationHolder = newSolutionElem.find(".cl-div-h3-solution-item-image-notification-holder");

                            var solutionItemAttribGoalsHolder = newSolutionElem.find("#id-div-h3-solution-item-attrib-holder-goals"); 
                            var solutionItemAttribGoalsItem = solutionItemAttribGoalsHolder.find(".cl-div-h3-solution-item-attrib-item");
                            solutionItemAttribGoalsHolder.children().not(".cl-div-h3-solution-item-attrib-header").remove();

                            var solutionItemAttribPhasesHolder = newSolutionElem.find("#id-div-h3-solution-item-attrib-holder-phases");
                            var solutionItemAttribPhasesItem = solutionItemAttribPhasesHolder.find(".cl-div-h3-solution-item-attrib-item");
                            solutionItemAttribPhasesHolder.children().not(".cl-div-h3-solution-item-attrib-header").remove();

                            var solutionItemImageHolder = newSolutionElem.find(".cl-div-solution-item-pane-image-holder");
                            var solutionItemImageTextHolder = newSolutionElem.find(".cl-div-h3-solution-item-image-text-holder");
                            var solutionItemImageCarousel = solutionItemImageHolder.find("#id-solution-item-carousel");
                            var solutionItemImageCarouselIndicators = solutionItemImageCarousel.find(".cl-solution-item-carousel-indicators");
                            var solutionItemImageCarouselInner = solutionItemImageCarousel.find(".cl-solution-item-carousel-inner");
                            var solutionItemImageCarouselControlLeft = solutionItemImageCarousel.find(".left.carousel-control");
                            var solutionItemImageCarouselControlRight = solutionItemImageCarousel.find(".right.carousel-control");
                            
                            var id = solutionItemImageCarousel.attr("id") + "-" + s.standard_no.replace(/\./g,"-").toString();
                            solutionItemImageCarousel.attr("id",id);
                            solutionItemImageCarouselControlLeft.attr("href","#"+id);
                            solutionItemImageCarouselControlRight.attr("href","#"+id);

                            if(s.fig_arr.length <= 0){
                                //solutionItemImageHolder.empty();
                                //solutionItemImageHolder.hide();
                                //solutionItemImageTextHolder.hide();
                                $(solutionItemImageHolder).find(".carousel-inner").hide();
                                solutionItemImageCarouselControlLeft.hide();
                                solutionItemImageCarouselControlRight.hide();
                                solutionItemImageCarouselIndicators.hide();
                            } else if(s.fig_arr.length == 1){
                                solutionItemImageCarouselControlLeft.hide();
                                solutionItemImageCarouselControlRight.hide();
                                solutionItemImageCarouselIndicators.hide();
                            }

                            if(s.fig_arr.length >= 1){
                                $(solutionItemImageHolder).css("min-height","360px");
                            }

                            $.each(s.fig_arr, function(index, fig){
                                
                                var solutionItemImageCarouselIndicatorsLi = solutionItemImageCarouselIndicators.find("li").first().clone();
                                solutionItemImageCarouselIndicatorsLi.attr("data-slide-to",index);
                                solutionItemImageCarouselIndicatorsLi.attr("data-target","#"+id);
                                
                                var solutionItemImageCarouselInnerItem = solutionItemImageCarouselInner.find(".cl-solution-item-carousel-item").first().clone();
                                var solutionItemImageCarouselInnerItemImage = solutionItemImageCarouselInnerItem.find("img");
                                var solutionItemImageCarouselInnerItemImageCaption = solutionItemImageCarouselInnerItem.find(".cl-solution-item-carousel-item-image-caption");
                                solutionItemImageCarouselInnerItemImage.attr("data-src",fig.fig_no);
                                solutionItemImageCarouselInnerItemImage.attr("alt",fig.fig_no);
                                solutionItemImageCarouselInnerItemImage.attr("data-caption",fig.fig_caption);
                                solutionItemImageCarouselInnerItemImage.attr("data-num",index);
                                solutionItemImageCarouselInnerItemImage.attr("src","");
                                solutionItemImageCarouselInnerItemImageCaption.html(fig.fig_caption);

                                if(fig.fig_caption===''){
                                    solutionItemImageCarouselInnerItemImageCaption.html(s.standard_no+" : "+fig.fig_no.replace("solution_images/",""));                            
                                }
                                
                                if(index === 0){
                                    solutionItemImageCarouselIndicators.empty();
                                    solutionItemImageCarouselInner.empty();
                                    solutionItemImageCarouselIndicatorsLi.removeClass("active");
                                    solutionItemImageCarouselIndicatorsLi.addClass("active");
                                    solutionItemImageCarouselInnerItem.removeClass("active");
                                    solutionItemImageCarouselInnerItem.addClass("active");
                                    solutionItemImageNotificationHolder.removeClass("hide");
                                } else {
                                    solutionItemImageCarouselIndicatorsLi.removeClass("active");
                                    solutionItemImageCarouselInnerItem.removeClass("active");
                                }

                                solutionItemImageCarouselIndicators.append(solutionItemImageCarouselIndicatorsLi);
                                solutionItemImageCarouselInner.append(solutionItemImageCarouselInnerItem);

                            });

                            $.each(global_columns_goals, function (index, goal){
                                var newAttribItem = $(solutionItemAttribGoalsItem).clone();
                                $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-text").html(goal.name);
                                if(s.goals.search(goal.name) != -1){ // goal active for this solution
                                    $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-indicator .fa").addClass("fa-check");
                                    $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-indicator .fa").removeClass("fa-square");                                
                                    $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-text").addClass("active");
                                } else {
                                    $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-text").attr("aria-hidden","true");                                    
                                }

                                solutionItemAttribGoalsHolder.append(newAttribItem);
                            });

                            $.each(global_columns_phases, function (index, phase){
                                var newAttribItem = $(solutionItemAttribPhasesItem).clone();
                                $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-text").html(phase.name);
                                if(s.phases.search(phase.name) != -1){ // goal active for this solution
                                    $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-indicator .fa").addClass("fa-check");
                                    $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-indicator .fa").removeClass("fa-square");
                                    $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-text").addClass("active");
                                } else {
                                    $(newAttribItem).find(".cl-div-h3-solution-item-attrib-item-text").attr("aria-hidden","true");                                    
                                }

                                solutionItemAttribPhasesHolder.append(newAttribItem);
                            });

                            h3SolutionsHolder.append(newSolutionElem);

                            if(typeof creditDict[s.h1][s.h2][s.h3][index] === "undefined"){
                                creditDict[s.h1][s.h2][s.h3][index] = {checked: 0};
                            } else {
                                $(solutionItemHeader).find(".cl-div-hx-solution-item-checkbox").prop("checked",creditDict[s.h1][s.h2][s.h3][index].checked === 1 ? true: false);
                                if(initialPopulationMode){
                                    updateCreditCountandUI(s.h1,s.h2,s.h3,index,creditDict[s.h1][s.h2][s.h3][index].checked);
                                }
                            }

                        });

                        h3Holder.append(newH3Elem);
                    });

                    h2Holder.append(newH2Elem);

                    h2CreditsRatioTotal.html("of "+creditDict[e2.h1][index].applicable_credits);
                    h2CreditsRatioEarned.html(creditDict[e2.h1][index].earned_credits);
                    h2SolutionsImplememtedRatioImplemented.html(creditDict[e2.h1][index].checked_solutions);
                    h2SolutionsImplememtedRatioTotal.html("of "+creditDict[e2.h1][index].total_solutions);

                    $(h2FlipSwitch.children()[0]).prop("selected",false);
                    $(h2FlipSwitch.children()[1]).prop("selected",false);

                    if(typeof header_mask_arr[chapter] === "undefined" || typeof header_mask_arr[chapter][index] === "undefined"){
                        $(h2FlipSwitch.children()[1]).prop("selected",true);
                        $(newH2Elem).removeClass("unmarked");                        
                    } else {
                        $(h2FlipSwitch.children()[parseInt(header_mask_arr[chapter][index],10)]).prop("selected",true);
                        updateCreditApplicableCountAndUI(chapter,index, parseInt(header_mask_arr[chapter][index],10) === 1, false);
                        
                        if(parseInt(header_mask_arr[chapter][index],10) === 1)
                            $(newH2Elem).removeClass("unmarked");               
                                                
                    }

                    h2FlipSwitch.flipswitch();
                });

                initialPopulationMode = false;

            });

            if(srVersion){
                $(".collapse").addClass("in");
                $(".collapse").addClass("active");
                // $(".collapse").collapse("show");
                $("img").unveil();
                $("img").trigger("unveil");
                $("img").trigger("lookup");
            }

            $("#id-div-solution-chapter-list-item-"+chapter).addClass("active");
            $("#id-div-solution-chapter-list-item-"+chapter+" .cl-div-chapter-spin-i-holder").addClass("hide");
            $("#id-div-solution-chapter-list-item-"+chapter+" .cl-div-chapter-chevron-holder").removeClass("hide");
            
            $(".cl-div-chapter-content-h2-item-pane").on("hidden.bs.collapse", function(){
                $(this).parent().find(".cl-div-chapter-content-h2-item-header .cl-div-h2-item-subtitle").addClass("hide");
                $(this).parent().find(".cl-div-chapter-content-h2-item-header .cl-img-h2-item-image").attr("src","images/unitarrow_closed.png");

                return false;
            });

            $(".cl-div-chapter-content-h2-item-pane").on("hide.bs.collapse", function(){
                var target = $(this).attr("id");
                target = target.substr(target.indexOf("pane-")+5);
                var elems = target.split("-");

                if(editMode){
                    $.post("getStandards.php", {project: "UPDATE", id :params.id, target: target, applicable_credits: G_projectCreditCountApplicable, earned_credits: G_projectCreditCountEarned, bonus_credits: G_projectCreditBonusCount, award_percentage: G_projectAwardPercentage, award_category: "Bronze", h1_credits_applicable: G_h1CreditsArrApplicableString, h1_credits_earned: G_h1CreditsArrEarnedString, data: creditDict[elems[0]][elems[1]]} , function (data) {
                    },"json");
                }

            });

            $(".cl-div-chapter-content-h3-item-pane").on("hidden.bs.collapse", function(){
                $(this).parent().find(".cl-div-chapter-content-h3-item-header .cl-div-h3-item-subtitle").addClass("hide");                
                $(this).parent().find(".cl-div-chapter-content-h3-item-header .cl-img-h3-item-image").attr("src","images/unitarrow_closed.png");

                if(deferredOpenElem != null){
                    $(deferredOpenElem).collapse("show");
                    deferredOpenElem = null;
                }

                return false;                                
            });

            $(".cl-div-chapter-content-h3-item-pane").on("hide.bs.collapse", function(){

                var target = $(this).attr("id");
                target = target.substr(target.indexOf("pane-")+5);
                var elems = target.split("-");

                // always send the H2 item equalant of the creditDict.
                if(editMode){
                    $.post("getStandards.php", {project: "UPDATE", id :params.id, target: target, applicable_credits: G_projectCreditCountApplicable, earned_credits: G_projectCreditCountEarned, bonus_credits: G_projectCreditBonusCount, award_percentage: G_projectAwardPercentage, award_category: "Bronze", h1_credits_applicable: G_h1CreditsArrApplicableString, h1_credits_earned: G_h1CreditsArrEarnedString, data: creditDict[elems[0]][elems[1]]} , function (data) {
                    },"json");
                }
                             
            });

            $(".cl-div-chapter-content-h2-item-pane").on("shown.bs.collapse", function(){
                $(this).parent().find(".cl-div-chapter-content-h2-item-header .cl-div-h2-item-subtitle").removeClass("hide");                
                $(this).parent().find(".cl-div-chapter-content-h2-item-header .cl-img-h2-item-image").attr("src","images/unitarrow_open.png");

                // $('html,body').animate({scrollTop: $(this).parent().offset().top}, 'fast');
                
                return false;                
            });

            $(".cl-div-chapter-content-h3-item-pane").on("shown.bs.collapse", function(){
                // $(".cl-div-chapter-content-h3-item-pane").not(this).collapse("hide");
                $(this).parent().find(".cl-div-chapter-content-h3-item-header .cl-div-h3-item-subtitle").removeClass("hide");              
                $(this).parent().find(".cl-div-chapter-content-h3-item-header .cl-img-h3-item-image").attr("src","images/unitarrow_open.png");

                // $('html,body').animate({scrollTop: $(this).parent().offset().top}, 'fast');
                
                return false;                
            });

            $(".cl-div-h2-solution-item-pane").on("shown.bs.collapse", function(){
                // $(".cl-div-h2-solution-item-pane").not(this).collapse("hide");     
                $(this).parent().find(".cl-div-h2-solution-item-header .cl-img-h2-solution-item-chevron").attr("src","images/unitarrow_open.png");
                $(this).parent().find(".cl-div-h2-solution-item-header").toggleClass("active");
                $(this).toggleClass("active");

                var carousel = $(this).find(".carousel");
                var img = $(carousel).find("img");
                $(carousel).carousel();
                $(carousel).carousel('pause');
                $(img).unveil(0, function(){
                    $(this).load(function(){
                        if(Number($(carousel).css('min-width').replace(/[^\d\.\-]/g, '')) < $(carousel).height()){
                            $(carousel).css("min-height",$(carousel).height());
                        }
                    });
                });                
                $(img).trigger("unveil");
                $(img).trigger("lookup");

                //$('html,body').animate({scrollTop: $(this).parent().offset().top}, 'fast');
                               
                return false;
             });


             $(".cl-div-h2-solution-item-pane").on("hidden.bs.collapse", function(){
                $(this).parent().find(".cl-div-h2-solution-item-header .cl-img-h2-solution-item-chevron").attr("src","images/unitarrow_closed.png");
                $(this).parent().find(".cl-div-h2-solution-item-header").toggleClass("active");
                $(this).toggleClass("active");
                
                if(deferredOpenElem != null){
                    $(deferredOpenElem).collapse("show");
                    deferredOpenElem = null;
                }

                return false;
             });

            $(".cl-div-h3-solution-item-header").on("click", function(){
                var pane = $(this).parent().find(".cl-div-h3-solution-item-pane");
                var others = $(this).parent().parent().find(".cl-div-h3-solution-item-pane").not(pane);
                $(others).collapse("hide");
                deferredOpenElem = pane;
                $(deferredOpenElem).collapse("show");
                deferredOpenElem = null;
                if($(pane).hasClass("in")){
                    deferredOpenElem = null;
                }

                if(preFetchImages){
                    var img = $(this).parent().next().find("img");
                    $(img).unveil(0);                
                    $(img).trigger("unveil");
                    $(img).trigger("lookup");
                }

                return !$(others).hasClass("in");
            });

            $(".cl-div-h2-solution-item-header").on("click", function(){
                var pane = $(this).parent().find(".cl-div-h2-solution-item-pane");
                var others = $(this).parent().parent().find(".cl-div-h2-solution-item-pane").not(pane);              
                $(others).collapse("hide");
                deferredOpenElem = pane;
                $(deferredOpenElem).collapse("show");
                deferredOpenElem = null;
                if($(pane).hasClass("in")){
                    deferredOpenElem = null;
                }

                if(preFetchImages){
                    var img = $(this).parent().next().find("img");
                    $(img).unveil(0);                
                    $(img).trigger("unveil");
                    $(img).trigger("lookup");
                }

                return !$(others).hasClass("in");
            });

            $(".cl-div-chapter-content-h3-item-header").on("click", function(){
                var pane = $(this).parent().find(".cl-div-chapter-content-h3-item-pane");
                var others = $(this).parent().parent().find(".cl-div-chapter-content-h3-item-pane").not(pane);
                $(others).collapse("hide");
                deferredOpenElem = pane;
                $(deferredOpenElem).collapse("show");
                deferredOpenElem = null;
                if($(pane).hasClass("in")){
                    deferredOpenElem = null;
                }
                return !$(others).hasClass("in");
            });

            $(".cl-div-h3-solution-item-pane").on("shown.bs.collapse", function(){
                // $(".cl-div-h3-solution-item-pane").not(this).collapse("hide");     
                $(this).parent().find(".cl-div-h3-solution-item-header .cl-img-h3-solution-item-chevron").attr("src","images/unitarrow_open.png");
                $(this).parent().find(".cl-div-h3-solution-item-header").toggleClass("active");
                $(this).toggleClass("active");

                var carousel = $(this).find(".carousel");
                var img = $(carousel).find("img");
                $(carousel).carousel("pause");
                $(img).unveil(0, function(){
                    $(this).load(function(){
                        if(Number($(carousel).css('min-width').replace(/[^\d\.\-]/g, '')) < $(carousel).height()){
                            $(carousel).css("min-height",$(carousel).height());
                        }
                    });
                });                
                $(img).trigger("unveil");
                $(img).trigger("lookup");
                // $('html,body').animate({scrollTop: $(this).parent().offset().top}, 'fast');
                
                return false;
             });

             $(".cl-div-h3-solution-item-pane").on("hidden.bs.collapse", function(){
                $(this).parent().find(".cl-div-h3-solution-item-header .cl-img-h3-solution-item-chevron").attr("src","images/unitarrow_closed.png");
                $(this).parent().find(".cl-div-h3-solution-item-header").toggleClass("active");
                $(this).toggleClass("active");

                if(deferredOpenElem != null){
                    $(deferredOpenElem).collapse("show");
                    deferredOpenElem = null;
                }

                return false;
             });

             $(".cl-btn-h3-solution-item-close").on("click", function(){
                deferredOpenElem = null;
                $(this).parent().parent().collapse("hide");
             });

            $(".cl-btn-h2-solution-item-close").on("click", function(){
                deferredOpenElem = null;
                $(this).parent().parent().collapse("hide");
             });

             $(".cl-link-black-font").on("click",function(ev){
                 ev.stopPropagation();
             });

             $(".cl-div-hx-solution-item-checkbox").on("change", function(ev){
                 console.log("checkbox changed: "+$(this).parent().parent().parent().parent().attr("data-target"));
                 var target = $(this).parent().parent().parent().parent().attr("data-target");
                 target = target.substr(target.indexOf("pane-")+5);
                 var elems = target.split("-");
                 var checkedVal = $(this).prop("checked") === true ? 1: 0 ;
                 if(elems.length === 4){
                    updateCreditCountandUI(elems[0], elems[1], elems[2], elems[3],checkedVal);
                 } else if(elems.length === 3){
                     updateCreditCountandUI(elems[0], elems[1], -1, elems[2],checkedVal);
                 }

                 ev.stopPropagation();
             });

              $(".cl-div-h3-solution-item-checkbox-holder, .cl-div-h2-solution-item-checkbox-holder").on("click", function(ev){
                  ev.stopPropagation();
              });

             $(".cl-div-selection-switch-holder").click(function(ev){
                 return false;
             });

             $(".cl-btn-hx-footer-clear").on("click", function(ev){
                 var solutionCheckboxes = $(this).parent().parent().find(".cl-div-hx-solution-item-checkbox");
                 $.each(solutionCheckboxes, function(index, c){
                    $(c).prop("checked",false);
                    var target = $(c).parent().parent().parent().parent().attr("data-target");
                    target = target.substr(target.indexOf("pane-")+5);
                    var elems = target.split("-");
                    var checkedVal = 0 ;
                    if(elems.length === 4){
                        updateCreditCountandUI(elems[0], elems[1], elems[2], elems[3],checkedVal);
                    } else if(elems.length === 3){
                        updateCreditCountandUI(elems[0], elems[1], -1, elems[2],checkedVal);
                    }
                 });
             });

             $(".cl-btn-hx-footer-save").on("click", function(ev){
                var target = $(this).attr("id");
                target = target.substr(target.indexOf("save-")+5);
                var elems = target.split("-");
                var h1 = elems[0];
                var h2 = elems[1];
                if(editMode && (elems.length === 2 || elems.length === 3)){
                    $.post("getStandards.php", {project: "UPDATE", id :params.id, target: h1+"-"+h2, applicable_credits: G_projectCreditCountApplicable, earned_credits: G_projectCreditCountEarned, bonus_credits: G_projectCreditBonusCount, award_percentage: G_projectAwardPercentage, award_category: "Bronze", h1_credits_applicable: G_h1CreditsArrString, h1_credits_earned: G_h1CreditsArrEarnedString, data: creditDict[h1][h2]} , function (data) {
                    },"json");
                }
             });

             //$(".cl-slider-flip-m").not("#id-div-chapter-content-h2-holder-dummy .ui-flipswitch").flipswitch();

             $(".cl-slider-flip-m").on("change",function(){
                 var selVal = $(this).find("option:selected").text();
                 console.log("FlipSwitch ID: "+$(this).attr("id")+" val : "+selVal);
                var target = $(this).attr("id");
                 target = target.substr(target.indexOf("-m-")+3);
                 var elems = target.split("-");
                 $(this).parents(".cl-div-chapter-content-h2-item-true").find(".cl-div-hx-solution-item-checkbox:checked").click();
                 if(selVal ==="Yes"){
                    $(this).parents(".cl-div-chapter-content-h2-item-true").find(".cl-form-solution-checkbox").removeClass("disabled");
                    $(this).parents(".cl-div-chapter-content-h2-item-true").removeClass("unmarked");
                    updateCreditApplicableCountAndUI(elems[0],elems[1],true);
                 } else {
                    $(this).parents(".cl-div-chapter-content-h2-item-true").find(".cl-form-solution-checkbox").addClass("disabled");
                    $(this).parents(".cl-div-chapter-content-h2-item-true").addClass("unmarked");
                    updateCreditApplicableCountAndUI(elems[0],elems[1],false);                    
                 }

             });

        }, "json");

}

// checked = 0 [unchecked]
// checked = 1 [checked]
function updateCreditCountandUI(h1, h2, h3, solution, checked){
    var solutionRatioHolder = $("#id-div-chapter-content-h2-item-"+h1+"-"+h2).find(".cl-div-implemented-ratio-holder");
    var creditRatioHolder = $("#id-div-chapter-content-h2-item-"+h1+"-"+h2).find(".cl-div-earned-ratio-holder");

    var solutionRatioEarned = $(solutionRatioHolder).find(".cl-div-ratio-rounded-elem-left span");
    var creditRatioEarned = $(creditRatioHolder).find(".cl-div-ratio-square-elem-left span");

    var solutionCheckedCount = 0;
    var solutionCheckedCount_lowerLevel = 0;
    var creditsEarnedCount = 0;

    if(h3<=0){
        creditDict[h1][h2][solution].checked = checked;

        $.each(creditDict[h1][h2], function(index,h){
            if((typeof h === "object") && !$.isArray(h)) {
                solutionCheckedCount += h.checked;
            }
        });
        creditDict[h1][h2].checked_solutions = solutionCheckedCount;

        for (var index = 0; index < creditDict[h1][h2].thresholds.length; index++) {
            var element = creditDict[h1][h2].thresholds[index];
            if(creditDict[h1][h2].checked_solutions >= element){
                creditsEarnedCount = creditDict[h1][h2].thresholdLevels[index];
            } else {
                break;
            }
        }
        creditDict[h1][h2].earned_credits = creditsEarnedCount;


    } else {
        creditDict[h1][h2][h3][solution].checked = checked;
        
        $.each(creditDict[h1][h2], function(index,h){
            if((typeof h === "object") && !$.isArray(h) && !("checked" in h)){  // has a h3 level
                solutionCheckedCount_lowerLevel = 0;
                $.each(h, function(i, s){
                    if((typeof s === "object") && !$.isArray(s) && ("checked" in s)){                
                        solutionCheckedCount += s.checked;
                        solutionCheckedCount_lowerLevel += s.checked;
                    }
                });
                h.checked_solutions = solutionCheckedCount_lowerLevel;
            }
        });

        creditDict[h1][h2].checked_solutions = solutionCheckedCount;

        for (var index = 0; index < creditDict[h1][h2][h3].thresholds.length; index++) {
            var element = creditDict[h1][h2][h3].thresholds[index];
            if(creditDict[h1][h2][h3].checked_solutions >= element){
                creditsEarnedCount = creditDict[h1][h2][h3].thresholdLevels[index];
            } else {
                break;
            }
        }
        creditDict[h1][h2][h3].earned_credits = creditsEarnedCount;

        creditsEarnedCount = 0;
        $.each(creditDict[h1][h2], function(index, h){
            if((typeof h === "object") && !$.isArray(h) && ("earned_credits" in h)){                
                creditsEarnedCount += h.earned_credits;
            }
        });
        creditDict[h1][h2].earned_credits = creditsEarnedCount;
    }

    //Update chapter credits
    var chapterCreditRatioHolder = $("#id-div-chapter-credit-implemented-ratio-holder-"+h1);
    var chapterCreditRatioEarned = chapterCreditRatioHolder.find(".cl-div-ratio-square-elem-left span");
    var chapterCreditCount = 0;

    $.each(creditDict[h1], function(index, elem){
        if((typeof elem === "object") && !$.isArray(elem) && ("earned_credits" in elem)){
            chapterCreditCount += elem.earned_credits;
        }
    });
    creditDict[h1].earned_credits = chapterCreditCount;

    //Update project credits
    var projectCreditRatioEarned = $("#id-div-project-award-credit-earned").find(".cl-span-project-award-credit-item-value");
    var projectCreditCountApplicable = 0;
    var projectCreditCountEarned = 0;

    var h1_credits_applicable = '';
    var h1_credits_earned = '';

    $.each(creditDict, function(index, elem){
        if((typeof elem === "object") && !$.isArray(elem) && ("earned_credits" in elem)){
            projectCreditCountEarned += elem.earned_credits;
            projectCreditCountApplicable += elem.applicable_credits;
            h1_credits_earned += elem.earned_credits+",";
            h1_credits_applicable += elem.applicable_credits+",";
        }
    });

    h1_credits_earned = h1_credits_earned.substr(0,h1_credits_earned.length-1);
    h1_credits_applicable = h1_credits_applicable.substr(0,h1_credits_applicable.length-1);
    G_h1CreditsArr = h1_credits_applicable.split(",");
    G_h1CreditsArrEarned = h1_credits_earned.split(","); 
    G_h1CreditsArrEarnedString = h1_credits_earned;
    G_h1CreditsArrApplicableString = h1_credits_applicable;

    chapterCreditRatioEarned.html(chapterCreditCount);
    solutionRatioEarned.html(solutionCheckedCount);
    creditRatioEarned.html(creditsEarnedCount);
    projectCreditRatioEarned.html(projectCreditCountEarned);

    var percentage = Math.round( (projectCreditCountEarned * 100 / projectCreditCountApplicable) * 10 ) / 10;
    pbar.setText(Math.floor(percentage) + "%");
    pbar.set(projectCreditCountEarned/projectCreditCountApplicable);

    G_projectCreditCountEarned = projectCreditCountEarned;
    G_projectAwardPercentage = percentage;    
}

function updateCreditApplicableCountAndUI(h1,h2,applicable, updateDB = true){
    var creditRatioHolder = $("#id-div-chapter-content-h2-item-"+h1+"-"+h2).find(".cl-div-earned-ratio-holder");
    var creditRatioApplicable = $(creditRatioHolder).find(".cl-div-ratio-square-elem-right span");

    var chapterCreditRatioHolder = $("#id-div-chapter-credit-implemented-ratio-holder-"+h1);
    var chapterCreditRatioApplicable = chapterCreditRatioHolder.find(".cl-div-ratio-square-elem-right span");
    var chapterCreditCount = 0;

    var projectCreditRatioAvailable = $("#id-div-project-award-credit-available").find(".cl-span-project-award-credit-item-value");
    var projectProgressContainer = $("#id-div-project-award-progress-container");
    var projectCreditCountApplicable = 0;
    var projectCreditCountEarned = 0;
    var h1_credit_arr = '';

    creditDict[h1][h2].applicable_credits = applicable ? creditDict[h1][h2].total_credits : 0;
    $.each(creditDict[h1][h2], function(index, elem){
        if((typeof elem === "object") && !$.isArray(elem) && ("applicable_credits" in elem)){
            elem.applicable_credits = applicable ? elem.total_credits : 0;
        }
    });

    $.each(creditDict[h1], function(index, elem){
        if((typeof elem === "object") && !$.isArray(elem) && ("applicable_credits" in elem)){
            chapterCreditCount += elem.applicable_credits;
        }
    });
    creditDict[h1].applicable_credits = chapterCreditCount;

    $.each(creditDict, function(index, elem){
        if((typeof elem === "object") && !$.isArray(elem) && ("applicable_credits" in elem)){
            projectCreditCountApplicable += elem.applicable_credits;
            projectCreditCountEarned += elem.earned_credits;
            h1_credit_arr += elem.applicable_credits+",";
        }
    });

    h1_credit_arr = h1_credit_arr.substr(0,h1_credit_arr.length-1);
    header_mask_arr[h1][h2] = applicable ? 1 : 0;

    $(creditRatioApplicable).html("of "+creditDict[h1][h2].applicable_credits);
    $(chapterCreditRatioApplicable).html("of "+chapterCreditCount);
    $(projectCreditRatioAvailable).html(projectCreditCountApplicable);

    var percentage = Math.round( (projectCreditCountEarned * 100 / projectCreditCountApplicable) * 10 ) / 10;
    pbar.setText(Math.floor(percentage) +"%");
    pbar.set(projectCreditCountEarned/projectCreditCountApplicable);

    G_projectCreditCountApplicable = projectCreditCountApplicable;
    G_projectAwardPercentage = percentage;
    G_h1CreditsArrString = h1_credit_arr; 
    G_h1CreditsArr = G_h1CreditsArrString.split(",");

    if(editMode && updateDB){
        $.post("getStandards.php", {project: "UPDATE", id :params.id, target: h1+"-"+h2, applicable_credits: G_projectCreditCountApplicable, earned_credits: G_projectCreditCountEarned, bonus_credits: G_projectCreditBonusCount, award_percentage: G_projectAwardPercentage, award_category: "Bronze", h1_credits_applicable: G_h1CreditsArrString, h1_credits_earned: G_h1CreditsArrEarnedString, data: creditDict[h1][h2]} , function (data) {
        },"json");
    }
}

function fillGlobalDataFromDB(id){
    $.post("getStandards.php", {project: "DETAILS", id :id}, function (data) {
        //console.log(data);
        var d = data[0];
        G_projectAwardPercentage = d.award_percentage;
        G_projectCreditBonusCount = d.bonus_credits;
        G_projectCreditCountApplicable = d.applicable_credits;
        G_projectCreditCountEarned = d.earned_credits;
        G_h1CreditsArrString = d.h1_credits_applicable;
        G_h1CreditsArr = G_h1CreditsArrString.split(",");
        G_h1CreditsArrEarnedString = d.h1_credits_earned;
        G_h1CreditsArrEarned = G_h1CreditsArrEarnedString.split(",");
        delete d.h1_credits;
        delete d.award_percentage;
        delete d.award_category;
        delete d.bonus_credits;
        delete d.earned_credits;
        delete d.applicable_credits;
        delete d.innovative_credits;
        delete d.innovative_credits_submitted_count;
        delete d.project_id;
        delete d.h1_credits_applicable;
        delete d.h1_credits_earned;

        var header_mask = d.header_mask;
        delete d.header_mask;

        var header_mask_h1 = header_mask.split(";");

        $.each(header_mask_h1, function(index,val){
            var header_mask_h2 = val.split(",");
            header_mask_arr[index+1] = {};
            $.each(header_mask_h2, function(index2,val2){
                header_mask_arr[index+1][index2+1] = parseInt(val2,10);
            });
        });

        var sol;
        var splits = [];
        for (var key in d) {
            if (d.hasOwnProperty(key)) {
                sol = d[key];
                splits = key.split("_").splice(1);

                if(splits.length === 3){ //h2 Solution
                    if(typeof creditDict[splits[0]] === "undefined"){
                        var creditH1Dict = {};
                        creditH1Dict.earned_credits = parseInt(typeof G_h1CreditsArrEarned[parseInt(splits[0],10)-1] === "undefined" ? 0 : G_h1CreditsArrEarned[parseInt(splits[0],10)-1], 10);
                        creditH1Dict.total_credits = 0;
                        creditH1Dict.applicable_credits = parseInt(typeof G_h1CreditsArr[parseInt(splits[0],10)-1] === "undefined" ? 0 : G_h1CreditsArr[parseInt(splits[0],10)-1], 10);
                        creditDict[splits[0]] = creditH1Dict;
                    }

                    if(typeof creditDict[splits[0]][splits[1]] === "undefined"){
                        var creditH2Dict = {};
                        creditH2Dict.earned_credits = 0;
                        creditH2Dict.total_credits = 0;
                        creditH2Dict.applicable_credits = 0;
                        creditH2Dict.total_solutions = 0;
                        creditH2Dict.checked_solutions = 0;
                        creditH2Dict.thresholds = [];
                        creditH2Dict.thresholdLevels = [];
                        creditDict[splits[0]][splits[1]] = creditH2Dict;
                    }

                    if(typeof creditDict[splits[0]][splits[1]][splits[2]] === "undefined"){
                        var solutionDict = {};
                        solutionDict.checked = parseInt(d[key]);
                        creditDict[splits[0]][splits[1]][splits[2]] = solutionDict;
                    }
                } else if (splits.length === 4){ //h3 Solution
                    if(typeof creditDict[splits[0]] === "undefined"){
                        var creditH1Dict = {};
                        creditH1Dict.earned_credits = parseInt(typeof G_h1CreditsArrEarned[parseInt(splits[0],10)-1] === "undefined" ? 0 : G_h1CreditsArrEarned[parseInt(splits[0],10)-1], 10);
                        creditH1Dict.total_credits = 0;
                        creditH1Dict.applicable_credits = parseInt(typeof G_h1CreditsArr[parseInt(splits[0],10)-1] === "undefined" ? 0 : G_h1CreditsArr[parseInt(splits[0],10)-1], 10);
                        creditDict[splits[0]] = creditH1Dict;
                    }

                    if(typeof creditDict[splits[0]][splits[1]] === "undefined"){
                        var creditH2Dict = {};
                        creditH2Dict.earned_credits = 0;
                        creditH2Dict.total_credits = 0;
                        creditH2Dict.applicable_credits = 0;
                        creditH2Dict.total_solutions = 0;
                        creditH2Dict.checked_solutions = 0;
                        creditH2Dict.thresholds = [];
                        creditH2Dict.thresholdLevels = [];
                        creditDict[splits[0]][splits[1]] = creditH2Dict;
                    }

                    if(typeof creditDict[splits[0]][splits[1]][splits[2]] === "undefined"){
                        var creditH2Dict = {};
                        creditH2Dict.earned_credits = 0;
                        creditH2Dict.total_credits = 0;
                        creditH2Dict.applicable_credits = 0;
                        creditH2Dict.total_solutions = 0;
                        creditH2Dict.checked_solutions = 0;
                        creditH2Dict.thresholds = [];
                        creditH2Dict.thresholdLevels = [];
                        creditDict[splits[0]][splits[1]][splits[2]] = creditH2Dict;
                    }

                    if(typeof creditDict[splits[0]][splits[1]][splits[2]][splits[3]] === "undefined"){
                        var solutionDict = {};
                        solutionDict.checked = parseInt(d[key]);
                        creditDict[splits[0]][splits[1]][splits[2]][splits[3]] = solutionDict;
                    }
                }
            }
        }

        getChapters();
    },"json");
}

function getMaskString(){
    var str = '';
    $.each(header_mask_arr, function(index1, h1_mask){
        $.each(h1_mask, function(index2, h2_mask){
            str += h2_mask+",";
        });
        str = str.substr(0,str.length-1);
        str += ";";
    });
    str = str.substr(0,str.length-1);

    return str;
}
