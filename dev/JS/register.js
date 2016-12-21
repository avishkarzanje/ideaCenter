/// <reference path="../../typings/jquery/jquery.d.ts"/>

var redir_addr = "";

/* Capatilize the first char */
String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

$(document).ready(function () {
    
    var user_email = "";

    $("img").unveil();
    $("img").trigger("unveil");
    
    // Reset all views
    var securityquesDiv = $("#id-div-forgot-pass-securityquestion");
    var forgotPasswordContent = $("#id-div-forgot-password-content");
    var forgotPasswordProgress = $("#id-div-forgot-password-progress");
    var newPasswordContent = $("#id-div-new-password-content");
    var newPasswordProgress = $("#id-div-new-password-progress");
    var registerContent = $("#id-form-register");
    var registerProgress = $("#id-div-register-progress");
    var reconfirmPasswordContent = $("#id-div-reconfirm-password-content");
    var reconfirmPasswordProgress = $("#id-div-reconfirm-password-progress");
    
    var registerPane = $("#id-pane-register");
    var forgotPassPane = $("#id-pane-forgot-pass");
    var newPassPane = $("#id-pane-new-pass");
    var reconfirmPassPane = $("#id-pane-reconfirm-pass");
    
    var loginDiv = $("#id-login-tbl");
    var registerDiv = $("#id-register-tbl");
    
    $(securityquesDiv).hide();
    $(forgotPasswordContent).show();
    $(forgotPasswordProgress).hide();
    $(newPasswordContent).show();
    $(newPasswordProgress).hide();
    $(registerContent).show();
    $(registerProgress).hide();
    $(reconfirmPasswordContent).show();
    $(reconfirmPasswordProgress).hide();
    
    $(registerPane).show();
    $(forgotPassPane).hide();
    $(newPassPane).hide();
    $(reconfirmPassPane).hide();
    
    
    
    var params={};window.location.search.replace(/[?&;#]+([^=&]+)=([^&]*)/gi,function(str,key,value){params[key] = value;});
    var path = window.location.pathname;
    path = path.substring(path.lastIndexOf("/")+1);

    if(params.reset && params.rl){
        $(registerPane).hide();
        $(forgotPassPane).hide();
        $(reconfirmPassPane).hide();
        $(newPassPane).show();

    } else if(path === "register.php" && params.edit){
        $(registerPane).hide();
        $(forgotPassPane).hide();
        $(newPassPane).hide();
        $(reconfirmPassPane).show();
        
    } else {
        $(loginDiv).removeClass("col-md-12");
        $(loginDiv).addClass("col-md-4");
        $(registerDiv).removeClass("col-md-12");
        $(registerDiv).addClass("col-md-8");
    }

    if(params.redir){
        redir_addr = params.redir;
    }
    
    $("#id-register-inp-phone").intlTelInput({
        nationalMode: true,
        utilsScript: "JS/intlTelInputUtils.js" // just for formatting/placeholders etc
    });
    
        
    
    $("#id-a-forgot-pass").click(function(){
        $("#id-pane-register").hide();
        $("#id-pane-forgot-pass").show();        
    });
    
    $("#id-login-a-forgot-pass").click(function(){
        $("#id-pane-register").hide();
        $("#id-pane-forgot-pass").show();        
    });
    
    $("#id-login-a-back-register").click(function(){
        $("#id-pane-register").show();
        $("#id-pane-forgot-pass").hide();
        grecaptcha.reset();       
    });
    
    $("#id-btn-reconfirm-pass-submit").click(function(){
       var passwordElem = $("#id-reconfirm-pass-inp-password");
       var password = $(passwordElem).val();
       var eventDataPassword = {target : $("#id-reconfirm-pass-inp-password")};
       
       if(validatePassword(eventDataPassword)){
           $.post("getStandards.php", { register: "RE_CONFIRM_PASS", password: password }, function (data) {
                if(data.response){
                    $(passwordElem).parent().parent().parent().parent().find(".cl-error-lbl").html("");
                    $("#id-div-banner-welcome").html("Welcome "+data.first_name+" "+data.last_name);
                    window.history.pushState("","Profile Change", "register.php?edit=true&profile="+data.link);

                    $(reconfirmPassPane).hide();
                    $(registerPane).show();
                    $(loginDiv).hide();
                    $("#id-form-register").addClass("edit");
                    $("#id-dropdown-item-editprofile").addClass("disabled");
                    $.post("getStandards.php", { register: "EDIT_PROFILE_RETRIEVE" }, function (data) {
                        
                        if(!data.response){
                            $(registerContent).find(".cl-div-section-msg > h6").html("Edit profile : Something went wrong!");
                            $(registerContent).find(".cl-div-section-msg > p").html("Logout and Login back to edit profile.");
                        } else {
                            var data_package = data.data;
                            $(registerContent).find(".cl-div-section-msg > h6").html("Edit profile");
                            $(registerContent).find(".cl-div-section-msg > p").html("");
                            $("div.cl-div-sub-section-header .fa").show();  
                            $("#id-span-register-section-2-header").show();
                            
                            $("#id-register-inp-email").val(data_package['email_id']);
                            data_package['password'] = $("#id-register-inp-password").val();
                            
                            $("#id-register-inp-firstname").val(data_package['first_name']);
                            // $("#id-register-inp-middlename").val(data_package['middle_name']);
                            $("#id-register-inp-lastname").val(data_package['last_name']);
                            $("#id-register-inp-organization").val(data_package['organization_id']);
                            // data_package['securityquestion_id'] = $("#id-register-inp-securityquestion").val();
                            if(data_package['phone'] !== null){
                                $("#id-register-inp-phone").intlTelInput("setNumber",data_package['phone']);
                            }

                            $("#id-btn-register-submit").html("Save");
                            $("#id-btn-register-submit").attr("id","id-btn-profile-save");
                            
                            $("#id-register-inp-recaptcha").hide();
                            user_email = data_package['email_id'];

                        }
                        
                    },"json");
                    
                } else {
                    $(passwordElem).parent().parent().parent().parent().find(".cl-error-lbl").html(data.message).show();
                    $("#id-div-banner-welcome").html("");
                    alert("The password you entered doesn't match with our records. Logging you out for security");
                    $.post("getStandards.php", { register: "LOGOUT" }, function (data) {
                        window.location.replace("index.php");  
                    });

                }
                //alert(data.response);
            },"json");
       } else {
            showErrorSpan($("#id-reconfirm-pass-inp-password"),!validatePassword(eventDataPassword));
       }
       
    });
    
    $("#id-btn-login-submit").click(function(){
       var usernameElem = $("#id-login-inp-email");
       var username = $("#id-login-inp-email").val();
       var password = $("#id-login-inp-password").val();
       var eventDataUsername = {target : $("#id-login-inp-email")};
       var eventDataPassword = {target : $("#id-login-inp-password")};
       
       if(validateEmail(eventDataUsername) && validatePassword(eventDataPassword)){
           $.post("getStandards.php", { register: "LOGIN", username: username, password: password }, function (data) {
                if(data.response){
                    $(usernameElem).parent().parent().parent().parent().find(".cl-error-lbl").html("");
                    $("#id-div-banner-welcome").html("Welcome "+data.first_name+" "+data.last_name);
                    if(!redir_addr || redir_addr === ""){
                        // window.location.replace("index.php"); // force reload from server
                        window.location.replace("solutions.php");
                    }else if(redir_addr ==="s"){
                        window.location.replace("solutions.php?view=browse"); // force reload from server
                    }
                    
                } else {
                    $(usernameElem).parent().parent().parent().parent().find(".cl-error-lbl").html(data.message).show();
                    $("#id-div-banner-welcome").html("");
                }
                //alert(data.response);
            },"json");
       } else {
            showErrorSpan($("#id-login-inp-email"),!validateEmail(eventDataUsername));
            showErrorSpan($("#id-login-inp-password"),!validatePassword(eventDataPassword));
       }

       return false;
       
    });
    
    
    $("#id-btn-login-short-submit").click(function(){
       var usernameElem = $("#id-login-short-inp-email");
       var msgElem = $("#id-login-short-inp-msg");
       var username = $("#id-login-short-inp-email").val();
       var password = $("#id-login-short-inp-password").val();
       var eventDataUsername = {target : $("#id-login-short-inp-email")};
       var eventDataPassword = {target : $("#id-login-short-inp-password")};
       
       if(validateEmail(eventDataUsername) && validatePassword(eventDataPassword)){
           $.post("getStandards.php", { register: "LOGIN", username: username, password: password }, function (data) {
                if(data.response){
                    $(usernameElem).parent().parent().parent().parent().find(".cl-error-lbl").html("");
                    $("#id-div-banner-welcome").html("Welcome "+data.first_name+" "+data.last_name);
                    $(msgElem).html("").hide();
                    // window.location.reload(true); // force reload from server
                    window.location.replace("solutions.php");
                    
                } else {
                    if(data.message === "NO USER"){
                        data.message = "Please check the E-mail Address."
                    }
                    $(usernameElem).parent().parent().parent().parent().find(".cl-error-lbl").html(data.message).show();
                    $("#id-div-banner-welcome").html("");
                    $(msgElem).html(data.message).show();
                }
                //alert(data.response);
            },"json");
       } else {
            showErrorSpan($("#id-login-short-inp-email"),!validateEmail(eventDataUsername));
            showErrorSpan($("#id-login-short-inp-password"),!validatePassword(eventDataPassword));
       }

       return false;
       
    });
    
    $("#id-btn-register-submit").click(function (){
        var flag = true;

        if($(this).html() === "Register"){
            // flag = validateOrganization() && flag;
            flag = validateFirstName() && flag;
            // flag = validateMiddleName() && flag;
            flag = validateLastName() && flag;
            flag = validateEmail() && flag;
            flag = validatePassword() && flag;
            flag = validateConfirmPassword() && flag;
            flag = validateSecurityQuestion() && flag;
            flag = validateSecurityAnswer() && flag;
            flag = validatePhoneNumber() && flag;
            flag = validateRecaptcha() && flag;
            
            if(flag){
                var data_package = new Object;
                data_package['email_id'] = $("#id-register-inp-email").val();
                data_package['password'] = $("#id-register-inp-password").val();
                data_package['first_name'] = $("#id-register-inp-firstname").val();
                data_package['middle_name'] = $("#id-register-inp-middlename").val();
                data_package['last_name'] = $("#id-register-inp-lastname").val();
                data_package['organization_id'] = $("#id-register-inp-organization").val();
                data_package['authtype_id'] = 3;
                data_package['securityquestion_id'] = $("#id-register-inp-securityquestion").val();
                data_package['securityquestion_ans'] = $("#id-register-inp-securityanswer").val();
                data_package['recaptcha'] = $("#g-recaptcha-response").val();
                data_package['phone'] = $("#id-register-inp-phone").intlTelInput("getNumber");
                data_package['country_name'] = $("#id-register-inp-phone").intlTelInput("getSelectedCountryData").name;
                data_package['country_code'] = $("#id-register-inp-phone").intlTelInput("getSelectedCountryData").iso2;
                data_package['uses_sr'] = ($("#id-register-inp-sr").is(":checked") ? 1 : 0);                

                showErrorSpan($("#id-register-inp-firstname"), false);
                showErrorSpan($("#id-register-inp-organization"), false);
                showErrorSpan($("#id-register-inp-password"), false);
                showErrorSpan($("#id-register-inp-email"), false);
                showErrorSpan($("#id-register-inp-securityanswer"), false);
                showErrorSpan($("#id-register-inp-phone").parent(), false);
                showErrorSpan($("#id-register-inp-recaptcha"), false);
                
                $("#id-form-register").hide();
                $("#id-div-register-progress").show();
                
                $("#id-div-register-progress-icon").addClass("fa-2x");
                $("#id-div-register-progress-icon").addClass("fa-spin");
                $("#id-div-register-progress-icon").addClass("fa-spinner");
                $("#id-div-register-progress-msg").html("We are working on registering you to our system. Please wait!");
                
                $.post("getStandards.php", { register: "REGISTER", data: JSON.stringify(data_package) }, function (data) {
                    $("#id-div-register-progress-icon").removeClass("fa-spinner");
                    $("#id-div-register-progress-icon").removeClass("fa-spin");
                    if(data.response){
                        $("#id-div-register-progress-icon").addClass("fa-2x");
                        $("#id-div-register-progress-icon").addClass("fa-check");
                        $("#id-div-register-progress-msg").html("You have successfully been registered. Please Login to use our systems.");
                    } else {
                        $("#id-div-register-progress-icon").addClass("fa-2x");
                        $("#id-div-register-progress-icon").addClass("fa-close");
                        $("#id-div-register-progress-msg").html("Something went wrong! We couldn't register you. Please retry in a while. Error : "+data.message);
                        
                        if(data.message === "Duplicate User"){
                            $("#id-div-register-progress-msg").html("This Email address is registered in our system. If you have forgotten your password, click the 'forgot your password?' link in the login section.");
                        }
                    }
                },"json");
            } else {
                showErrorSpan($("#id-register-inp-firstname"), (!validateFirstName() || !validateMiddleName() || !validateLastName()));
                // showErrorSpan($("#id-register-inp-organization"), !validateOrganization());
                showErrorSpan($("#id-register-inp-password"), (!validatePassword() || !validateConfirmPassword()));
                showErrorSpan($("#id-register-inp-email"), !validateEmail());
                showErrorSpan($("#id-register-inp-phone").parent(), !validatePhoneNumber());
                showErrorSpan($("#id-register-inp-securityanswer"), (!validateSecurityQuestion() || !validateSecurityAnswer()));
            }
        } else if ($(this).html() === "Save"){
            flag = validateOrganization() && flag;
            flag = validateFirstName() && flag;
            // flag = validateMiddleName() && flag;
            flag = validateLastName() && flag;
            flag = validateEmail() && flag;
            flag = validatePhoneNumber() && flag;
            // flag = validateRecaptcha() && flag;

            flag = ($("#id-register-inp-password").val() !=="" ? validatePassword() : true) && flag;
            flag = ($("#id-register-inp-password").val() !=="" ? validateConfirmPassword() : true) && flag;
            // flag = validateSecurityQuestion() && flag;
            flag = ($("#id-register-inp-securityanswer").val() !=="" ? validateSecurityAnswer() : true) && flag;

            if(user_email !== $("#id-register-inp-email").val()){
                alert("Modifying the E-mail address will mean you will have to login with the new E-mail from the next session.")
            }
            
            if(flag){
                var data_package = new Object;
                data_package['email_id'] = $("#id-register-inp-email").val();
                data_package['password'] = $("#id-register-inp-password").val();
                data_package['first_name'] = $("#id-register-inp-firstname").val();
                data_package['middle_name'] = $("#id-register-inp-middlename").val();
                data_package['last_name'] = $("#id-register-inp-lastname").val();
                data_package['organization_id'] = $("#id-register-inp-organization").val();
                data_package['authtype_id'] = 3;
                data_package['securityquestion_id'] = $("#id-register-inp-securityquestion").val();
                data_package['securityquestion_ans'] = $("#id-register-inp-securityanswer").val();
                data_package['recaptcha'] = $("#g-recaptcha-response").val();
                data_package['phone'] = $("#id-register-inp-phone").intlTelInput("getNumber");
                data_package['country_name'] = $("#id-register-inp-phone").intlTelInput("getSelectedCountryData").name;
                data_package['country_code'] = $("#id-register-inp-phone").intlTelInput("getSelectedCountryData").iso2;
                data_package['uses_sr'] = ($("#id-register-inp-sr").is(":checked") ? 1 : 0); 


                showErrorSpan($("#id-register-inp-firstname"), false);
                showErrorSpan($("#id-register-inp-organization"), false);
                showErrorSpan($("#id-register-inp-password"), false);
                showErrorSpan($("#id-register-inp-email"), false);
                showErrorSpan($("#id-register-inp-securityanswer"), false);
                showErrorSpan($("#id-register-inp-phone").parent(), false);
                showErrorSpan($("#id-register-inp-recaptcha"), false);
                
                // $("#id-form-register").hide();
                $("#id-div-register-progress").show();
                
                $("#id-div-register-progress-icon").addClass("fa-2x");
                $("#id-div-register-progress-icon").addClass("fa-spin");
                $("#id-div-register-progress-icon").addClass("fa-spinner");
                $("#id-div-register-progress-msg").html("We are working on modifying your profile data. Please wait!");
                
                $.post("getStandards.php", { register: "EDIT_PROFILE_SAVE", data: JSON.stringify(data_package) }, function (data) {
                    $("#id-div-register-progress-icon").removeClass("fa-spinner");
                    $("#id-div-register-progress-icon").removeClass("fa-spin");
                    if(data.response){
                        $("#id-div-register-progress-icon").addClass("fa-2x");
                        $("#id-div-register-progress-icon").addClass("fa-check");
                        $("#id-div-register-progress-msg").html("Profile Data has been successfully modified.");

                        // $("#id-div-register-progress").hide();
                    } else {
                        $("#id-div-register-progress-icon").addClass("fa-2x");
                        $("#id-div-register-progress-icon").addClass("fa-close");
                        $("#id-div-register-progress-msg").html("Something went wrong! We couldn't modify your profile data. Error : "+data.message);
                    }
                },"json");
            } else {
                showErrorSpan($("#id-register-inp-firstname"), (!validateFirstName() || !validateMiddleName() || !validateLastName()));
                showErrorSpan($("#id-register-inp-organization"), !validateOrganization());
                showErrorSpan($("#id-register-inp-email"), !validateEmail());
                showErrorSpan($("#id-register-inp-phone").parent(), !validatePhoneNumber());

                if($("#id-register-inp-password").val() !== "")
                    showErrorSpan($("#id-register-inp-password"), (!validatePassword() || !validateConfirmPassword()));
                if($("#id-register-inp-securityanswer").val() !== "")
                    showErrorSpan($("#id-register-inp-securityanswer"), (!validateSecurityQuestion() || !validateSecurityAnswer()));
            }
        } 
    });

    $("#id-btn-forgot-pass-submit").click(function(){
        var email = $("#id-forgot-pass-inp-email");
        var securityanswer = $("#id-forgot-pass-inp-securityanswer");
        var securityquesDiv = $("#id-div-forgot-pass-securityquestion");
        
        var username_val = $(email).val();
        var securityanswer_val = $(securityanswer).val();
        
        var eventDataUsername = {target : $(email)};
        var eventDataSecurityAnswer = {target : $(securityanswer)};
        showErrorSpan($(email),!validateEmail(eventDataUsername));
                
        if((securityquesDiv.css("display") === "none") && validateEmail(eventDataUsername)){
            $("#id-btn-forgot-pass-submit").html("Please Wait..");
            $("#id-btn-forgot-pass-submit").addClass("disabled");
            $.post("getStandards.php", { register: "RESET_PASSWORD_PREP", username: username_val }, function (data) {
                if(data.response){
                    $(email).parent().parent().find(".cl-lbl").html("");
                    $(securityquesDiv).show();
                    $("#id-span-forgot-pass-securityquestion").html(data.data.securityquestion_text);
                } else {
                    $(email).parent().parent().find(".cl-lbl").html(data.message).show();
                }
                //alert(data.response);
                
                $("#id-btn-forgot-pass-submit").html("Submit");
                $("#id-btn-forgot-pass-submit").removeClass("disabled");
            
            },"json");
        } 
        
        if((securityquesDiv.css("display") !== "none") && validateEmail(eventDataUsername) && validateSecurityAnswer(eventDataSecurityAnswer)){
            showErrorSpan($(securityanswer),!validateSecurityAnswer(eventDataUsername));            
            $("#id-div-forgot-password-content").hide();
            $("#id-div-forgot-password-progress").show();
            
            $("#id-div-forgot-password-progress-icon").addClass("fa-2x");
            $("#id-div-forgot-password-progress-icon").addClass("fa-spin");
            $("#id-div-forgot-password-progress-icon").addClass("fa-spinner");
            $("#id-div-forgot-password-progress-msg").html("We are working on initiating a password reset request. Please wait!");
            
            
            $.post("getStandards.php", { register: "RESET_PASSWORD_INIT", username: username_val, securityanswer: securityanswer_val }, function (data) {
                $("#id-div-forgot-password-progress-icon").removeClass("fa-spinner");
                $("#id-div-forgot-password-progress-icon").removeClass("fa-spin");
                if(data.response){
                    $("#id-div-forgot-password-progress-icon").addClass("fa-2x");
                    $("#id-div-forgot-password-progress-icon").addClass("fa-check");
                    $("#id-div-forgot-password-progress-msg").html("Reset Password successfully initiated. A reset link has been sent to your registered e-mail address. Kindly follow that link to reset your password.");
                    $("#id-div-forgot-pass-submit").hide();                        
                } else {
                    $("#id-btn-forgot-pass-submit").hide();
                    $("#id-div-forgot-password-progress-icon").addClass("fa-2x");
                    $("#id-div-forgot-password-progress-icon").addClass("fa-close");
                    $("#id-div-forgot-password-progress-msg").html("Something went wrong! We couldn't initiate a reset password request. Error : "+data.message);
                }
                //alert(data.response);
            },"json");
        }
    });
    
    $("#id-btn-new-pass-submit").click(function(){
        var passwordElem = $("#id-new-pass-inp-password");
        var confirmpasswordElem = $("#id-new-pass-inp-confirmpassword");
        
        var password = $(passwordElem).val();
        var confirmpassword = $(confirmpasswordElem).val();
        
        var eventDataPassword = {target : $(passwordElem)};
        var eventDataConfirmPassword = {target : $(confirmpasswordElem)};
        showErrorSpan($(passwordElem),!validatePassword(eventDataPassword));
        showErrorSpan($(confirmpasswordElem),!validateConfirmPassword(eventDataConfirmPassword,eventDataPassword));
        
        if(validatePassword(eventDataPassword) && validateConfirmPassword(eventDataConfirmPassword,eventDataPassword)){
            showErrorSpan($(passwordElem),!validatePassword(eventDataPassword));
        showErrorSpan($(confirmpasswordElem),!validateConfirmPassword(eventDataConfirmPassword,eventDataPassword));            
            $("#id-div-new-password-content").hide();
            $("#id-div-new-password-progress").show();
            
            $("#id-div-new-password-progress-icon").addClass("fa-2x");
            $("#id-div-new-password-progress-icon").addClass("fa-spin");
            $("#id-div-new-password-progress-icon").addClass("fa-spinner");
            $("#id-div-new-password-progress-msg").html("We are working on reseting your password. Please wait!");
            
            
            $.post("getStandards.php", { register: "RESET_PASSWORD_CONF", password: password, confirmpassword: confirmpassword, reset_link: params.rl }, function (data) {
                $("#id-div-new-password-progress-icon").removeClass("fa-spinner");
                $("#id-div-new-password-progress-icon").removeClass("fa-spin");
                if(data.response){
                    $("#id-div-new-password-progress-icon").addClass("fa-2x");
                    $("#id-div-new-password-progress-icon").addClass("fa-check");
                    $("#id-div-new-password-progress-msg").html("Password successfully reset. Please login to access your account.");
                    $("#id-div-new-pass-submit").hide();                        
                } else {
                    $("#id-btn-new-pass-submit").hide();
                    $("#id-div-new-password-progress-icon").addClass("fa-2x");
                    $("#id-div-new-password-progress-icon").addClass("fa-close");
                    $("#id-div-new-password-progress-msg").html("Something went wrong! We couldn't complete the reset password request. Error : "+data.message);
                    
                    if(data.message === "NO SUCH LINK"){
                        $("#id-div-new-password-progress-msg").html("This reset link seems invalid. It might have be incorrectly copied or corrupted.");
                    }
                }
                //alert(data.response);
            },"json");
        }
    });
    
    var eventData = {focus : true};
    $("#id-register-inp-organization").focusout(eventData, validateOrganization);
    $("#id-register-inp-firstname").focusout(eventData, validateFirstName);
    $("#id-register-inp-middlename").focusout(eventData, validateMiddleName);
    $("#id-register-inp-lastname").focusout(eventData, validateLastName);
    $("#id-register-inp-email").focusout(eventData, validateEmail);
    $("#id-register-inp-password").focusout(eventData, validatePassword);
    $("#id-register-inp-confirmpassword").focusout(eventData, validateConfirmPassword);
    $("#id-register-inp-securityquestion").on('changed.bs.select', validateSecurityQuestion);
    $("#id-register-inp-securityanswer").focusout(eventData, validateSecurityAnswer);
    $("#id-register-inp-phone").focusout(eventData, validatePhoneNumber);
    
    var eventDataLoginUsername = {target : $("#id-login-inp-email"), focus : true};
    var eventDataLoginPassword = {target : $("#id-login-inp-password"), focus : true};
    $("#id-login-inp-email").focusout(eventDataLoginUsername, validateEmail);
    $("#id-login-inp-password").focusout(eventDataLoginPassword, validatePassword);
    
    var eventDataLoginShortUsername = {target : $("#id-login-short-inp-email"), focus : true};
    var eventDataLoginShortPassword = {target : $("#id-login-short-inp-password"), focus : true};
    $("#id-login-short-inp-email").focusout(eventDataLoginShortUsername, validateEmail);
    $("#id-login-short-inp-password").focusout(eventDataLoginShortPassword, validatePassword);
    
    $.post("getStandards.php", { register: "QUESTIONS" }, function (data) {
        var container = $("#id-register-inp-securityquestion");
        var generated_option = '';
        $(container).html('');
        
        $.each(data, function(index,elem){
            generated_option += '<option value="'+elem.sl_no+'">'+elem.question+'</option>';
        });
        container.html(generated_option);
        $(container).selectpicker('refresh');
    }, 'json');

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

function validateOrganization(data){
    var elem = $("#id-register-inp-organization");
    var parent = $(elem).parent();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var filter = /^([a-zA-Z0-9,.\-'\s\(\)]{1,})$/;
    if(val && val!='' && filter.test(val)){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger"); 
        $(elem).removeClass("form-control-danger");
        $(elem).addClass("form-control-success");                     
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");        
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");     
        return false;
    }
}

function validateFirstName(data){
    var elem = $("#id-register-inp-firstname");
    if(data){
        elem = data.target;
    }
    var parent = $(elem).parent();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var filter = /^([a-zA-Z,.\-'\s\(\)]{1,})$/;
    var checkEmpty = !(data && data.focus);
    if(((checkEmpty && val && val!='') || !checkEmpty) && filter.test(val)){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger"); 
        $(elem).removeClass("form-control-danger");       
        $(elem).addClass("form-control-success");      
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");        
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");     
        return false;
    }
}

function validateMiddleName(data){
    var elem = $("#id-register-inp-middlename");
    var parent = $(elem).parent();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var filter = /^([a-zA-Z,.\-'\s\(\)]{0,})$/;
    if(val.length == 0 || filter.test(val)){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger"); 
        $(elem).removeClass("form-control-danger");       
        $(elem).addClass("form-control-success");      
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");        
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");      
        return false;
    }
}

function validateLastName(data){
    var elem = $("#id-register-inp-lastname");
    var parent = $(elem).parent();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var filter = /^([a-zA-Z,.\-'\s\(\)]{1,})$/;
    var checkEmpty = !(data && data.focus);
    if(((checkEmpty && val && val!='') || !checkEmpty) && filter.test(val)){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger"); 
        $(elem).removeClass("form-control-danger");       
        $(elem).addClass("form-control-success");       
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");        
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");      
        return false;
    }
}

function validateEmail(data){
    var elem = $("#id-register-inp-email");
    if(data){
        elem = data.target;
    }
    var parent = $(elem).parent();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var checkEmpty = true || !(data && data.focus);
    if(((checkEmpty && val && val!='') || !checkEmpty) && filter.test(val)){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger");
        $(span).addClass("has-success");
        $(span).removeClass("has-danger"); 
        $(elem).removeClass("form-control-danger");       
        $(elem).addClass("form-control-success");     
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");
        $(span).addClass("has-danger");
        $(span).removeClass("has-success");        
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");   
        return false;
    }
}

function validatePassword(data){
    var elem = $("#id-register-inp-password");
    if(data){
        elem = data.target;
    }
    var parent = $(elem).parent();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var filter = /^(?=.*[a-z])(?=.*[\d])[A-Za-z\d$@$!%*?&]{6,}/;
    var checkEmpty = true || !(data && data.focus);
    if(((checkEmpty && val && val!='') || !checkEmpty) && filter.test(val)){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger"); 
        $(span).addClass("has-success");
        $(span).removeClass("has-danger");  
        $(elem).removeClass("form-control-danger");       
        $(elem).addClass("form-control-success");      
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");
        $(span).addClass("has-danger");
        $(span).removeClass("has-success");          
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");    
        return false;
    }
}

function validateConfirmPassword(data1, data2){
    var elem = $("#id-register-inp-confirmpassword");
    var elem2 = $("#id-register-inp-password");
    if(data1){
        elem = data1.target;
        if(data2){
            elem2 = data2.target;
        }
    }
    
    var parent = $(elem).parent();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var val2 = $(elem2).val();
    var filter = /^(?=.*[a-z])(?=.*[\d])[A-Za-z\d$@$!%*?&]{6,}/;
    if(val && val!='' && filter.test(val) && val === val2){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger"); 
        $(elem).removeClass("form-control-danger");       
        $(elem).addClass("form-control-success");      
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");        
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");      
        return false;
    }
}

function validateSecurityAnswer(data){
    var elem = $("#id-register-inp-securityanswer");
    if(data){
        elem = data.target;
    }
    var parent = $(elem).parent();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var filter = /^(?=.*[a-z])[A-Za-z\d$@$!%*?&\s]{3,}/;
    if(val && val!='' && filter.test(val)){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger"); 
        $(elem).removeClass("form-control-danger");       
        $(elem).addClass("form-control-success");     
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");        
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");      
        return false;
    }
}

function validateSecurityQuestion(data){
    var elem = $("#id-register-inp-securityquestion");
    var parent = $(elem).parents(".bootstrap-select").first();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var filter = /^(?=.*[0-9])[0-9]{0,}/;
    if(val && val!='' && filter.test(val)){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger"); 
        $(elem).removeClass("form-control-danger");       
        $(elem).addClass("form-control-success");      
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");        
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");      
        return false;
    }
}

function validatePhoneNumber(data){
    var elem = $("#id-register-inp-phone");
    var parent = $(elem).parent();
    var span = $(parent).parents(".form-group").find(".cl-lbl");
    var val = $(elem).val();
    var isValid = $(elem).intlTelInput("isValidNumber");
    if(isValid){
        $(parent).addClass("has-success");
        $(parent).removeClass("has-danger"); 
        $(elem).removeClass("form-control-danger");       
        $(elem).addClass("form-control-success");      
        return true;
    } else {
        $(parent).addClass("has-danger");
        $(parent).removeClass("has-success");        
        $(elem).addClass("form-control-danger");       
        $(elem).removeClass("form-control-success");      
        return false;
    }
}

function validateRecaptcha(data){
    var elem = $("#g-recaptcha-response");
    var span = $("#id-register-inp-recaptcha").parent().find(".cl-lbl");
    var val = $(elem).val();
    if(val && val!=''){
        $(span).addClass("has-success");
        $(span).removeClass("has-danger");                   
        return true;
    } else {
        $(span).addClass("has-danger");
        $(span).removeClass("has-success");             
        return false;
    }
}
