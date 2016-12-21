/// <reference path="../../typings/jquery/jquery.d.ts"/>

var redir_addr = "";
var projectTitle;
var projectOwner;
var projectArchitect;
var habitableFloorArea;
var siteArea;
var projectCost;
var projectAStartDate;
var projectAEndDate;

var contactPerson;
var contactEmail;
var contactTelephone;
var addressLine1;
var addressLine2;
var projectCity;
var projectState;
var projectCountry;
var projectZipcode;

var editMode = false;

/* Capatilize the first char */
String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

$(document).ready(function () {
    
    var user_email = "";

    $("img").unveil();
    $("img").trigger("unveil");
    
    var params={};window.location.search.replace(/[?&;#]+([^=&]+)=([^&]*)/gi,function(str,key,value){params[key] = value;});
    var path = window.location.pathname;
    path = path.substring(path.lastIndexOf("/")+1);

    if(params.redir){
        redir_addr = params.redir;
    }

    $("#id-new-project-inp-p-contact-telephone").intlTelInput({
        nationalMode: true,
        utilsScript: "JS/intlTelInputUtils.js" // just for formatting/placeholders etc
    });

    //fields
    projectTitle = $("#id-new-project-inp-p-title");
    projectOwner = $("#id-new-project-inp-p-owner");
    projectArchitect = $("#id-new-project-inp-p-architect");
    habitableFloorArea = $("#id-new-project-inp-habitable-floor-area");
    siteArea = $("#id-new-project-inp-site-area");
    projectCost = $("#id-new-project-inp-p-cost");
    projectAStartDate = $("#id-new-project-inp-p-a-start-date");
    projectAEndDate = $("#id-new-project-inp-p-a-end-date");

    contactPerson = $("#id-new-project-inp-p-contact-person");
    contactEmail = $("#id-new-project-inp-p-contact-email");
    contactTelephone = $("#id-new-project-inp-p-contact-telephone");
    addressLine1 = $("#id-new-project-inp-p-address-line-1");
    addressLine2 = $("#id-new-project-inp-p-address-line-2");
    projectCity = $("#id-new-project-inp-p-city");
    projectState = $("#id-new-project-inp-p-state");
    projectCountry = $("#id-new-project-inp-p-country");
    projectZipcode = $("#id-new-project-inp-p-zipcode");

    if(params.edit && params.edit === "true" && params.p && params.p != ""){
        editMode = true;
        $.post("getStandards.php",{project: "DETAILS", id: params.p}, function(data){
            populateFields(data);
        }, "json");
    }


    $(".form-check-input").change(function(){
        var val = $(this).val();
        var parentHeaderElem = $(this).parent().parent().parent().find("span");
        var parentVal = $(parentHeaderElem).attr("data-checked-vals");
        parentVal = typeof parentVal === "undefined" ? "": parentVal;
        var parentValArr = parentVal === ""? [] : parentVal.split(",");
        if(parentValArr.includes(val)){
            parentValArr = parentValArr.filter(function(v){
                return (v !== val);                
            });
        }

        if($(this).prop("checked")){
            parentValArr.push(val);
        }
        
        $(parentHeaderElem).attr("data-checked-vals",parentValArr.toString());
    });

    $("#id-btn-new-project-submit").click(function(){
        var projectTitleVal = $("#id-new-project-inp-p-title").val();
        var projectOwnerVal = $("#id-new-project-inp-p-owner").val();
        var projectArchitectVal = $("#id-new-project-inp-p-architect").val();
        var habitableFloorAreaVal = $("#id-new-project-inp-habitable-floor-area").val();
        var siteAreaVal = $("#id-new-project-inp-site-area").val();
        var projectCostVal = $("#id-new-project-inp-p-cost").val();
        var projectAStartDateVal = $("#id-new-project-inp-p-a-start-date").val();
        var projectAEndDateVal = $("#id-new-project-inp-p-a-end-date").val();

        var contactPersonVal = $("#id-new-project-inp-p-contact-person").val();
        var contactEmailVal = $("#id-new-project-inp-p-contact-email").val();
        var contactTelephoneVal = $("#id-new-project-inp-p-contact-telephone").intlTelInput("getNumber");
        var contactTelephoneCCodeVal = $("#id-new-project-inp-p-contact-telephone").intlTelInput("getSelectedCountryData").iso2;
        var addressLine1Val = $("#id-new-project-inp-p-address-line-1").val();
        var addressLine2Val = $("#id-new-project-inp-p-address-line-2").val();
        var projectCityVal = $("#id-new-project-inp-p-city").val();
        var projectStateVal = $("#id-new-project-inp-p-state").val();
        var projectCountryVal = $("#id-new-project-inp-p-country").val();
        var projectZipcodeVal = $("#id-new-project-inp-p-zipcode").val();

        if( projectTitleVal != '' && projectOwnerVal != '' && projectArchitectVal != '' &&
            contactPersonVal != '' && contactEmailVal != '' &&
            contactTelephoneVal != '' && contactTelephoneCCodeVal != '' && addressLine1Val != '' &&
            projectCityVal != '' && projectStateVal != '' && projectCountryVal != '' && projectZipcodeVal != '' &&
            $.isNumeric(habitableFloorAreaVal) && $.isNumeric(siteAreaVal) && $.isNumeric(projectCostVal) && (new Date(projectAEndDateVal) >= new Date(projectAStartDateVal))){

                var data_package = new Object;
                data_package['title'] = projectTitleVal;
                data_package['owner'] = projectOwnerVal;
                data_package['architect'] = projectArchitectVal;
                data_package['habitable_floor_area'] = habitableFloorAreaVal;
                data_package['site_area'] = siteAreaVal;
                data_package['cost'] = projectCostVal;
                data_package['a_start_date'] = projectAStartDateVal;
                data_package['a_end_date'] = projectAEndDateVal;

                data_package['contact_person'] = contactPersonVal;
                data_package['contact_email'] = contactEmailVal;
                data_package['contact_telephone'] = contactTelephoneVal;
                data_package['contact_telephone_c_code'] = contactTelephoneCCodeVal;
                data_package['address_line_1'] = addressLine1Val;
                data_package['address_line_2'] = addressLine2Val;
                data_package['city'] = projectCityVal;
                data_package['state'] = projectStateVal;
                data_package['country'] = projectCountryVal;
                data_package['zipcode'] = projectZipcodeVal;

                
                var b_val = "";
                $.each($(".cl-div-new-project-building-type-sub-header"), function(index, elem){
                    var t = typeof $(elem).attr("data-checked-vals") === "undefined" ? "": $(elem).attr("data-checked-vals");
                    b_val += t+";";
                });
                b_val = b_val.substr(0, b_val.length - 1);
                data_package['building_type'] = b_val;

                $("#id-new-project-tbl").css("display","none");
                $("#id-div-new-project-progress").css("display","flex");
                
                if(editMode){
                    mode = "UPDATE_INFO";
                    msgWait = "Please wait while the project is being updated.";
                    msgSuccess = "The project has been updated."
                    msgFailure =  "Something went wrong! We couldn't update the project for you. Please retry in a while. Error : ";
                    data_package["id"] = params.p;
                } else {
                    mode = "CREATE";
                    msgWait = "Please wait while a project is being created.";
                    msgSuccess = "A new project has been created."
                    msgFailure =  "Something went wrong! We couldn't create a new project for you. Please retry in a while. Error : ";
                }

                $("#id-div-new-project-progress-icon").addClass("fa-spinner");
                $("#id-div-new-project-progress-icon").addClass("fa-spin");
                $("#id-div-new-project-progress-msg").html(msgWait);

                $.post("getStandards.php", { project: mode, data: JSON.stringify(data_package) }, function (data) {
                    $("#id-div-new-project-progress-icon").removeClass("fa-spinner");
                    $("#id-div-new-project-progress-icon").removeClass("fa-spin");
                    if(data.response){
                        $("#id-div-new-project-progress-icon").addClass("fa-2x");
                        $("#id-div-new-project-progress-icon").addClass("fa-check");
                        $("#id-div-new-project-progress-msg").html(msgSuccess);
                    } else {
                        $("#id-div-new-project-progress-icon").addClass("fa-2x");
                        $("#id-div-new-project-progress-icon").addClass("fa-close");
                        $("#id-div-new-project-progress-msg").html(msgFailure+data.message);
                    }
                },"json");

        } else {
            // Show error spans
        }
    });

    $("#id-btn-new-project-clear").click(function(){
        $("#id-form-new-project-details").trigger("reset");
        $("#id-form-new-project-contact").trigger("reset");
        $("input[type='checkbox']").prop("checked",false);
    });
    
    // var eventData = {focus : true};
    // $("#id-register-inp-organization").focusout(eventData, validateOrganization);
    // $("#id-register-inp-firstname").focusout(eventData, validateFirstName);
    // $("#id-register-inp-middlename").focusout(eventData, validateMiddleName);
    // $("#id-register-inp-lastname").focusout(eventData, validateLastName);
    // $("#id-register-inp-email").focusout(eventData, validateEmail);
    // $("#id-register-inp-password").focusout(eventData, validatePassword);
    // $("#id-register-inp-confirmpassword").focusout(eventData, validateConfirmPassword);
    // $("#id-register-inp-securityquestion").on('changed.bs.select', validateSecurityQuestion);
    // $("#id-register-inp-securityanswer").focusout(eventData, validateSecurityAnswer);
    // $("#id-register-inp-phone").focusout(eventData, validatePhoneNumber);
    
    // var eventDataLoginUsername = {target : $("#id-login-inp-email"), focus : true};
    // var eventDataLoginPassword = {target : $("#id-login-inp-password"), focus : true};
    // $("#id-login-inp-email").focusout(eventDataLoginUsername, validateEmail);
    // $("#id-login-inp-password").focusout(eventDataLoginPassword, validatePassword);
    
    // var eventDataLoginShortUsername = {target : $("#id-login-short-inp-email"), focus : true};
    // var eventDataLoginShortPassword = {target : $("#id-login-short-inp-password"), focus : true};
    // $("#id-login-short-inp-email").focusout(eventDataLoginShortUsername, validateEmail);
    // $("#id-login-short-inp-password").focusout(eventDataLoginShortPassword, validatePassword);
    
    // $.post("getStandards.php", { register: "QUESTIONS" }, function (data) {
    //     var container = $("#id-register-inp-securityquestion");
    //     var generated_option = '';
    //     $(container).html('');
        
    //     $.each(data, function(index,elem){
    //         generated_option += '<option value="'+elem.sl_no+'">'+elem.question+'</option>';
    //     });
    //     container.html(generated_option);
    //     $(container).selectpicker('refresh');
    // }, 'json');

});

/*
    Validate Register form fields  
*/

function showErrorSpan(elem, show){
    var span = $(elem).parent().parent().find(".cl-lbl");
    if(show){
        $(span).removeClass("has-success");       
        $(span).addClass("has-danger");
        // $(span).show();
    } else {
        $(span).removeClass("has-danger");       
        $(span).addClass("has-success");
    }
}

function populateFields(data){
    if(data == null || data[0] == null)
        return;

    data = data[0];
    projectTitle.val(data.project_title);
    projectOwner.val(data.project_owner);
    projectArchitect.val(data.project_architect);
    habitableFloorArea.val(data.habitable_floor_area);
    siteArea.val(data.site_area);
    projectCost.val(data.project_cost);
    
    s_date = new Date(data.project_a_start_date);
    e_date = new Date(data.project_a_end_date);
    s_date_converted = s_date.getFullYear()+"-"+("0"+(s_date.getMonth()+1)).slice(-2)+"-"+("0"+s_date.getDate()).slice(-2)
    e_date_converted = e_date.getFullYear()+"-"+("0"+(e_date.getMonth()+1)).slice(-2)+"-"+("0"+e_date.getDate()).slice(-2)

    projectAStartDate.val(s_date_converted);
    projectAEndDate.val(e_date_converted);

    contactPerson.val(data.project_contact_person);
    contactEmail.val(data.project_contact_email);

    if(data.project_contact_telephone && data.project_contact_telephone != null)
        contactTelephone.intlTelInput("setNumber",data.project_contact_telephone);
    
    addressLine1.val(data.project_address_line_1);
    addressLine2.val(data.project_address_line_2);
    projectCity.val(data.project_city);
    projectState.val(data.project_state);
    projectCountry.val(data.project_country);
    projectZipcode.val(data.project_zipcode);

    var buildingTypeArr = data.building_type.split(";");
    var buildingTypeSubContainers = $(".cl-div-new-project-building-type-sub-container");
    if(buildingTypeArr.length === buildingTypeSubContainers.length){
        for(var i=0; i< buildingTypeSubContainers.length; i++){
            var buildingSubTypeArr = buildingTypeArr[i].split(",");
            for(var j=0; j<buildingSubTypeArr.length; j++){
                $(buildingTypeSubContainers[i]).find('input[value="'+buildingSubTypeArr[j]+'"]').prop("checked",true);
            }
        }
    }

}
