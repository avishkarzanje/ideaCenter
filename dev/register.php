<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register/Login - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="innovative solutions for Universal Design(isUD™) offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">

    <meta property="og:title" content="Register/Login - isUD™" />
    <meta property="og:description" content="isUD™ offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD." />
    <meta property="og:image" content="/images/isUD_PR_PublicTransit_Facebook.png" />
    <meta property="og:site_name" content="thisisUD" />
    <meta property="og:image:width" content="470" />
    <meta property="og:image:height" content="246" />

    <link rel="Shortcut Icon" href="favicon.ico">

    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap-select.min.css">
    <link rel="stylesheet" href="CSS/intlTelInput.css">
    <link rel="stylesheet" href="CSS/custom.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>

    <div class="cl-container cl-wrapper" id="id-wrapper">
        <?php
            Util::ScopedIncludeOnce("Banner.php", array('includerFile' => __FILE__));
        ?>

        <section id="id-global-container">
            <div class="cl-div-width-container">
                <div class="tab-content">
                    <div class="active tab-pane">
                        <section>
                            <div class="col-md-8">
                                <div class="cl-div-site-breadcrumb">
                                    <span class="cl-span-site-breadcrumb-title">Login</span>
                                </div>
                            </div>
                            <div class="col-md-3 thick-border-light pull-right cl-div-search-box">
                                <span>Search</span>
                            </div>
                            <div class="col-md-8">                
                                <table class="cl-tbl-navs">
                                    <tr>
                                        <td>
                                            <div id="content-holder">
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div class="tab-pane" id="id-pane-register">
                                                        <div class="thick-border-no-grid col-md-4 cl-div-login-tbl" id="id-login-tbl">
                                                            <form id="id-form-login" method="post">
                                                                <div class="cl-div-section-msg">
                                                                    <h6>Returning User?</h6>
                                                                    <p>Login with your credentials here</p>
                                                                </div>
                                                                <div class="cl-div-formset">
                                                                    <div class="cl-login-tbl-div">
                                                                        <div class="form-group cl-div-formset">
                                                                            <div class="cl-login-tbl-div-right">
                                                                                <div><label class="label cl-label-login-short" for="id-login-inp-email">E-mail address</label></div>
                                                                                <div><input class="form-control" type="text" id="id-login-inp-email" name="id-login-inp-email" placeholder="E-mail address" /></div>
                                                                                <div><span class="cl-login-inp-error-lbl cl-lbl" id="id-login-inp-error-lbl-email">Please check if your e-mail address is correct.</span></div>                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group cl-div-formset">
                                                                            <div class="cl-login-tbl-div-right">
                                                                                <div><label class="label cl-label-login-short" for="id-login-inp-password">Password</label></div>
                                                                                <div><input class="form-control" type="password" id="id-login-inp-password" name="id-login-inp-password" placeholder="Password" /></div>
                                                                                <div><span class="cl-login-inp-error-lbl cl-lbl" id="id-login-inp-error-lbl-password">Passwords should contain at least one letter and one digit, and be longer than 6 characters</span></div>                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div><span class="cl-login-inp-error-lbl cl-error-lbl" id="id-login-inp-error-lbl-name">No such user was found.</span></div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div id="id-div-login-submit">
                                                                        <a class="cl-login-a-forgot-pass" id="id-login-a-forgot-pass" href="#">Forgot your password ?</a>
                                                                        <input id="id-btn-login-submit" class="btn btn-primary pull-right" type="submit" value="Login"/>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="thick-border-no-grid col-md-8 cl-div-register-tbl" id="id-register-tbl">
                                                            <div id="id-div-register-progress">
                                                                <div class="col-md-4 cl-register-progress-tbl-div-left" ><i class="fa" id="id-div-register-progress-icon"></i></div>
                                                                <div class="col-md-8 cl-register-progress-tbl-div-right"><span id="id-div-register-progress-msg" >Success</span></div>
                                                            </div>
                                                            <form id="id-form-register">
                                                                <div class="cl-div-section-msg">
                                                                    <h6>New User?</h6>
                                                                    <p>Create a new account here</p>
                                                                </div>
                                                                <div class="cl-div-sub-section">
                                                                    <div class="cl-div-sub-section-header">
                                                                        <i class="fa fa-pencil-square-o pull-right" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Edit section"></i>
                                                                    </div>
                                                                    <div class="form-group cl-div-formset">
                                                                        <div class="col-md-5 cl-register-tbl-div-left">
                                                                            <div class="div-register-tbl"><h5><label class="label pull-top" for="id-register-inp-firstname">Name</label></h5></div>
                                                                            <div class="div-register-tbl"><h5><label class="label pull-top hide" for="id-register-inp-lastname">Last Name</label></h5></div>
                                                                        </div>
                                                                        <div class="col-md-7 cl-register-tbl-div-right">
                                                                            <div><input class="form-control" type="text" id="id-register-inp-firstname" name="id-register-inp-firstname" placeholder="First Name" /></div>
                                                                            <!--<div><input class="form-control hide" type="text" id="id-register-inp-middlename" placeholder="Middle Name" /></div>-->
                                                                            <div><input class="form-control" type="text" id="id-register-inp-lastname" name="id-register-inp-lastname" placeholder="Last Name"/></div>
                                                                            <div><span class="cl-register-inp-error-lbl cl-lbl" id="id-register-inp-error-lbl-name">Please check if Names contain digits or special characters.</span></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group cl-div-formset">
                                                                        <div class="col-md-5 cl-register-tbl-div-left"><div class="div-register-tbl"><h5><label class="label pull-top" for="id-register-inp-organization">Organization</label></h5></div></div>
                                                                        <div class="col-md-7 cl-register-tbl-div-right">
                                                                            <div><input class="form-control" type="text" id="id-register-inp-organization" name="id-register-inp-organization" placeholder="Name of your Organization" /></div>
                                                                            <div><span class="cl-register-inp-error-lbl cl-lbl" id="id-register-inp-error-lbl-organization">Please check if Organization name is empty or contains illegal characters.</span></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group cl-div-formset">
                                                                        <div class="col-md-5 cl-register-tbl-div-left"><div class="div-register-tbl"><h5><label for="id-register-inp-phone" class="label pull-top">Phone Number</label></h5></div></div>
                                                                        <div class="col-md-7 cl-register-tbl-div-right">
                                                                            <div><input id="id-register-inp-phone" name="id-register-inp-phone" class="form-control" type="tel" data-width="100%"></select></div>
                                                                            <div><span class="cl-register-inp-error-lbl cl-lbl" id="id-register-inp-error-lbl-phone-number">Enter a valid Phone number</span></div>                                                                
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group cl-div-formset">
                                                                        <div class="col-md-5 cl-register-tbl-div-left"><div class="div-register-tbl"><h5><label for="id-register-inp-email" class="label pull-top">E-mail address</label></h5></div></div>
                                                                        <div class="col-md-7 cl-register-tbl-div-right">
                                                                            <div><input class="form-control" type="text" id="id-register-inp-email" name="id-register-inp-email" placeholder="E-mail address" /></div>
                                                                            <div><span class="cl-register-inp-error-lbl cl-lbl" id="id-register-inp-error-lbl-email">Please check if E-mail address contains illegal characters.</span></div>                                                                
                                                                        </div>
                                                                    </div>

                                                                    <!-- SR only option -->
                                                                    <div class="form-group cl-div-formset sr-only">
                                                                        <div class="col-md-5 cl-register-tbl-div-left"><div class="div-register-tbl"><h5><label for="id-register-inp-sr" class="label pull-top">Do you use a screen reader?</label></h5></div></div>
                                                                        <div class="col-md-7 cl-register-tbl-div-right">
                                                                            <div><input class="form-control" type="checkbox" id="id-register-inp-sr" name="id-register-inp-sr"/></div>
                                                                            <div><span class="cl-register-inp-error-lbl cl-lbl" id="id-register-inp-error-lbl-sr"></span></div>                                                                
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="cl-div-sub-section">
                                                                    <div class="cl-div-sub-section-header">
                                                                        <span class="pull-left" id="id-span-register-section-2-header">Leaving this section blank will retain the old values</span>
                                                                        <i class="fa fa-pencil-square-o pull-right" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Edit section"></i>
                                                                    </div>
                                                                    <div class="form-group cl-div-formset">
                                                                        <div class="col-md-5 cl-register-tbl-div-left">
                                                                            <div class="div-register-tbl"><h5><label class="label pull-top" for="id-register-inp-password">Password</label></h5></div>
                                                                            <div class="div-register-tbl"><h5><label class="label pull-top hide" for="id-register-inp-confirmpassword">Confirm Password</label></h5></div>
                                                                        </div>
                                                                        <div class="col-md-7 cl-register-tbl-div-right">
                                                                            <div><input class="form-control" type="password" id="id-register-inp-password" name="id-register-inp-password" placeholder="Password" /></div>
                                                                            <div><input class="form-control" type="password" id="id-register-inp-confirmpassword" name="id-register-inp-confirmpassword" placeholder="Confirm Password" /></div>
                                                                            <div><span class="cl-register-inp-error-lbl cl-lbl" id="id-register-inp-error-lbl-password">Passwords should contain at least one letter and one digit, and be longer than 6 characters. Both the password fields must match.</span></div>                                                                
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group cl-div-formset">
                                                                        <div class="col-md-5 cl-register-tbl-div-left">
                                                                            <div class="div-register-tbl"><h5><label class="label pull-top" for="id-register-inp-securityquestion">Security Question</label></h5></div>
                                                                            <div class="div-register-tbl"><h5><label class="label hide" for="id-register-inp-securityanswer">Security Answer</label></h5></div>
                                                                        </div>
                                                                        <div class="col-md-7 cl-register-tbl-div-right">
                                                                            <div><select id="id-register-inp-securityquestion" name="id-register-inp-securityquestion" class="selectpicker" data-width="100%"></select></div>
                                                                            <div><input class="form-control" type="text" id="id-register-inp-securityanswer" name="id-register-inp-securityanswer" placeholder="Security Answer" /></div>
                                                                            <div><span class="cl-register-inp-error-lbl cl-lbl" id="id-register-inp-error-lbl-securityanswer">Security Answer should be longer than 3 characters</span></div>                                                                
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group cl-div-formset"> <!-- Recaptcha -->
                                                                    <div class="col-md-5 cl-register-tbl-div-left"><div class="div-register-tbl"><h5 class="hide"><label for="g-recaptcha-response">Recaptcha</label></h5></div></div>
                                                                    <div class="col-md-7 cl-register-tbl-div-right">
                                                                        <div class="g-recaptcha" id="id-register-inp-recaptcha" name="id-register-inp-recaptcha" data-sitekey="6LcmTSATAAAAACNslepu1t-51FMh47G354aGURLp"></div>
                                                                        <div><span class="cl-register-inp-error-lbl cl-lbl" id="id-register-inp-error-lbl-recaptcha">Complete the re-captcha verification</span></div>                                                                
                                                                    </div>
                                                                </div>
                                                                
                                                                <div id="id-div-register-submit">
                                                                    <div class=
                                                                    "col-md-5 cl-register-tbl-div-left"><div class="div-register-tbl"></div></div>
                                                                    <div class="col-md-7 cl-register-tbl-div-right">
                                                                        <button id="id-btn-register-submit" class="btn btn-primary" type="button">Register</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div id="id-pane-forgot-pass" class="tab-pane hide thick-border-no-grid">
                                                        <div id="id-div-forgot-password-content">
                                                            <div class="cl-div-section-msg">
                                                                <h6>Forgot your password ?</h6>
                                                                <p>Answer a few questions and we will mail you a password-reset link</p>
                                                            </div>
                                                            <div class="form-group cl-div-formset">
                                                                <div class="div-forgot-pass-tbl"><h6><label class="pull-top" for="id-forgot-pass-inp-email">E-mail address</label></h6></div>
                                                                <div>
                                                                    <div><input class="form-control" type="text" id="id-forgot-pass-inp-email" name="id-forgot-pass-inp-email" placeholder="E-mail address" /></div>
                                                                    <div><span class="cl-forgot-pass-inp-error-lbl cl-lbl" id="id-forgot-pass-inp-error-lbl-email">Please check if E-mail address contains illegal characters.</span></div>                                                                
                                                                </div>
                                                            </div>
                                                            <div class="form-group cl-div-formset hide" id="id-div-forgot-pass-securityquestion">
                                                                <div class="div-forgot-pass-tbl"><h6><label class="pull-top" id="id-span-forgot-pass-securityquestion">Security Question</label></h6></div>
                                                                <div>
                                                                    <div class="hide"><h6><label class="pull-top" for="id-forgot-pass-inp-securityanswer">Security Answer</label></h6></div>
                                                                    <div><input class="form-control" type="text" id="id-forgot-pass-inp-securityanswer" name="id-forgot-pass-inp-securityanswer" placeholder="Security Answer" /></div>
                                                                    <div><span class="cl-forgot-pass-inp-error-lbl cl-lbl" id="id-forgot-pass-inp-error-lbl-securityanswer">Security Answer should be longer than 3 characters</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="id-div-forgot-password-progress" class="hide">
                                                            <div class="col-md-4 cl-register-progress-tbl-div-left" ><i class="fa" id="id-div-forgot-password-progress-icon"></i></div>
                                                            <div class="col-md-8 cl-register-progress-tbl-div-right"><span id="id-div-forgot-password-progress-msg" >SUCCESS</span></div>
                                                        </div>
                                                        <div id="id-div-forgot-pass-submit">
                                                                <a class="cl-login-a-back-register" id="id-login-a-back-register" href="#">Back to Login/Register section</a>
                                                                <button id="id-btn-forgot-pass-submit" class="btn btn-primary pull-right" type="button">Submit</button>
                                                        </div>
                                                    </div>
                                                    <div id="id-pane-reconfirm-pass" class="thick-border-no-grid tab-pane hide">
                                                        <div id="id-div-reconfirm-password-content">
                                                            <div class="cl-div-section-msg">
                                                                <h6>Enter your password</h6>
                                                                <p>As an added security measure, re-enter your password again</p>
                                                            </div>
                                                            <div class="form-group cl-div-formset">
                                                                <div class="div-reconfirm-pass-tbl"><h6><label class="pull-top" for="id-reconfirm-pass-inp-password">Password</label></h6></div>
                                                                <div>
                                                                    <div><input class="form-control" type="password" id="id-reconfirm-pass-inp-password" name="id-reconfirm-pass-inp-password" placeholder="Password" /></div>
                                                                    <div><span class="cl-reconfirm-pass-inp-error-lbl cl-lbl" id="id-reconfirm-pass-inp-error-lbl-password">Passwords should contain at least one letter and one digit, and be longer than 6 characters</span></div>              
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="id-div-reconfirm-password-progress" class="hide">
                                                            <div class="col-md-4 cl-register-progress-tbl-div-left" ><i class="fa" id="id-div-reconfim-password-progress-icon"></i></div>
                                                            <div class="col-md-8 cl-register-progress-tbl-div-right"><span id="id-div-forgot-reconfim-progress-msg" >SUCCESS</span></div>
                                                        </div>
                                                        <div id="id-div-reconfim-pass-submit">
                                                                <a class="cl-login-a-back-home" id="id-login-a-back-home" href="index.php">Back to Home Page</a>
                                                                <button id="id-btn-reconfirm-pass-submit" class="btn btn-primary pull-right" type="button">Submit</button>
                                                        </div>
                                                    </div>
                                                    <div id="id-pane-new-pass" class="thick-border-no-grid tab-pane hide">
                                                        <div id="id-div-new-password-content">
                                                            <div class="cl-div-section-msg">
                                                                <h6>Reset Password</h6>
                                                                <p>Enter your new password</p>
                                                            </div>
                                                            <div class="form-group cl-div-formset">
                                                                <div class="div-new-pass-tbl"><h6><label class="pull-top" for="id-new-pass-inp-password">Password</label></h6></div>
                                                                <div>
                                                                    <div><input class="form-control" type="password" id="id-new-pass-inp-password" name="id-new-pass-inp-password" placeholder="Password" /></div>
                                                                    <div><span class="cl-new-pass-inp-error-lbl cl-lbl" id="id-new-pass-inp-error-lbl-password">Passwords should contain at least one letter and one digit, and be longer than 6 characters</span></div>                                                                
                                                                </div>
                                                            </div>
                                                            <div class="form-group cl-div-formset" id="id-div-new-pass-confirmpassword">
                                                                <div class="div-new-pass-tbl"><h6><label class="pull-top" id="id-span-new-pass-confirmpassword" for="id-new-pass-inp-confirmpassword">Confirm Password</label></h6></div>
                                                                <div>
                                                                    <div><input class="form-control" type="password" id="id-new-pass-inp-confirmpassword" name="id-new-pass-inp-confirmpassword" placeholder="Confirm Password" /></div>
                                                                    <div><span class="cl-new-pass-inp-error-lbl cl-lbl" id="id-new-pass-inp-error-lbl-confirmpassword">Both passwords should match</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="id-div-new-password-progress" class="hide">
                                                            <div class="col-md-4 cl-new-pass-progress-tbl-div-left" ><i class="fa" id="id-div-new-password-progress-icon"></i></div>
                                                            <div class="col-md-8 cl-new-pass-progress-tbl-div-right"><span id="id-div-new-password-progress-msg" >SUCCESS</span></div>
                                                        </div>
                                                        <div id="id-div-new-pass-submit">
                                                                <a class="cl-login-a-back-register" id="id-login-a-back-register" href="#">Back to Login/Register section</a>
                                                                <button id="id-btn-new-pass-submit" class="btn btn-primary pull-right" type="button">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3 pull-right">
                                <img class="cl-img-search-bottom" data-src="images/loginpage.png" alt="Talking street crossing button.">
                                <div class="cl-div-search-bottom-img-caption"><span>Talking street crossing button.</span></div>
                            </div>
                        </section>

                        <?php
                            include_once("Footer.php");
                        ?>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/bootstrap-select.min.js"></script>
    <script src="JS/intlTelInput.min.js"></script>
    <script src="JS/lib-unveil.min.js"></script>
    <script src="JS/banner.min.js"></script>
    <script src="JS/register.min.js"></script>

</body>

</html>