<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="innovative solutions for Universal Design(isUD™) offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">

    <meta property="og:title" content="Contact - isUD™" />
    <meta property="og:description" content="isUD™ offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD." />
    <meta property="og:image" content="/images/isUD_PR_PublicTransit_Facebook.png" />
    <meta property="og:site_name" content="thisisUD" />
    <meta property="og:image:width" content="470" />
    <meta property="og:image:height" content="246" />

    <link rel="Shortcut Icon" href="favicon.ico">

    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap-select.min.css">
    <link rel="stylesheet" href="CSS/custom.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body>

    <div class="cl-container cl-wrapper" id="id-wrapper">

        <?php
            Util::ScopedIncludeOnce("Banner.php", array('includerFile' => __FILE__));
        ?>

        <section id="id-global-container">
            <div class="cl-div-width-container">
                <section>
                    <div id="content-holder">
                        <!-- Tab panes -->
                        <div>
                            <div id="contact">
                                <div>
                                    <div class="col-md-8">
                                        <div class="cl-div-site-breadcrumb">
                                            <span class="cl-span-site-breadcrumb-title">Contact</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 thick-border-light pull-right cl-div-search-box">
                                        <span>Search</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-8" id="id-div-contact-pane-holder">
                                        <div id="id-div-contact-holder" class="cl-div-contact-pane-item">
                                            <div>
                                                <p>
                                                    The IDeA Center is located in Buffalo, NY on the University at Buffalo South Campus. The IDeA Center is temporarily located in the Hayes Annex A (Room 20) while renovations continue in Hayes Hall.
                                                </p>
                                            </div>
                                            <div>
                                                <div class="cl-contact-section">
                                                    <img class="cl-img-contact-section" aria-hidden="true" src="" data-src="images/addressicon.png" alt="address icon"/>
                                                    <div class="cl-contact-section-content">
                                                        <span><h6>Mailing Address:</h6></span>
                                                        <span>Center for Inclusive Design and Environmental Access</span>
                                                        <span>University at Buffalo</span>
                                                        <span>School of Architecture and Planning</span>
                                                        <span>3435 Main Street</span>
                                                        <span>Buffalo, NY 14214-3087</span>
                                                    </div>
                                                </div>
                                                <div class="cl-contact-section">
                                                    <img class="cl-img-contact-section" aria-hidden="true" src="" data-src="images/telephoneicon.png" alt="telephone icon"/>
                                                    <div class="cl-contact-section-content">
                                                        <span><h6>Telephone:</h6></span>
                                                        <span>+1 (716) 829.5902</span></br>
                                                    </div>
                                                </div>
                                                <div class="cl-contact-section">
                                                    <img class="cl-img-contact-section" aria-hidden="true" src="" data-src="images/faxicon.png" alt="fax icon"/>
                                                    <div class="cl-contact-section-content">
                                                        <span><h6>Fax:</h6></span>
                                                        <span>+1 (716) 829.3861</span></br>
                                                    </div>
                                                </div>
                                                <div class="cl-contact-section">
                                                    <img class="cl-img-contact-section" aria-hidden="true" src="" data-src="images/emailicon.png" alt="email icon"/>
                                                    <div class="cl-contact-section-content">
                                                        <span><h6>E-mail:</h6></span>
                                                        <span><a href="mailto:ap-idea@buffalo.edu" target="_blank">ap-idea@buffalo.edu</a></span></br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="id-div-emailer-holder" class="cl-div-contact-pane-item">
                                            <h6>Questions/Comments?</h6>
                                            <br />
                                            <div id="id-div-contact-emailer-progress">
                                                <div class="col-md-4" ><i class="fa" id="id-div-contact-emailer-progress-icon"></i></div>
                                                <div class="col-md-8"><span id="id-div-contact-emailer-progress-msg" >Success</span></div>
                                            </div>
                                            <div class="form-group cl-div-formset">
                                                <div class="cl-div-contact-emailer-form-label-holder"><label class="label" for="id-contact-emailer-form-inp-name">Name:</label></div>
                                                <div class="cl-div-contact-emailer-form-label-holder">
                                                    <div><input class="form-control" type="text" id="id-contact-emailer-form-inp-name" name="id-contact-emailer-form-inp-name" placeholder="Name" /></div>
                                                    <div><span class="cl-contact-inp-error-lbl cl-lbl" id="id-contact-emailer-form-inp-error-lbl-name">Please check if Name contains illegal characters.</span></div>                                                                
                                                </div>
                                            </div>
                                            <div class="form-group cl-div-formset">
                                                <div class="cl-div-contact-emailer-form-label-holder"><label class="label" for="id-contact-emailer-form-inp-email">Email:</label></div>
                                                <div class="cl-div-contact-emailer-form-label-holder">
                                                    <div><input class="form-control" type="text" id="id-contact-emailer-form-inp-email" name="id-contact-emailer-form-inp-email" placeholder="Email address" /></div>
                                                    <div><span class="cl-contact-inp-error-lbl cl-lbl" id="id-contact-emailer-form-inp-error-lbl-email">Please check if Email contains illegal characters.</span></div>                                                                
                                                </div>
                                            </div>
                                            <div class="form-group cl-div-formset">
                                                <div class="cl-div-contact-emailer-form-label-holder"><label class="label" for="id-contact-emailer-form-inp-comment">Questions/Comments:</label></div>
                                                <div class="cl-div-contact-emailer-form-label-holder">
                                                    <div><textarea class="form-control" type="text" rows="5" id="id-contact-emailer-form-inp-comment" name="id-contact-emailer-form-inp-comment" placeholder="Questions/Comments" ></textarea></div>
                                                    <div><span class="cl-contact-inp-error-lbl cl-lbl" id="id-contact-emailer-form-inp-error-lbl-comment">Please check if Comments contains illegal characters.</span></div>                                                                
                                                </div>
                                            </div>
                                            <div id="id-div-contact-emailer-submit-holder">
                                                <div class="pull-right">
                                                    <button id="id-btn-contact-emailer-clear" class="btn btn-primary" type="button">Clear</button>
                                                    <button id="id-btn-contact-emailer-submit" class="btn btn-primary" type="button">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pull-right">
                                        <img class="cl-img-search-bottom" data-src="images/contactpage.png" alt="Crosby Hall and Hayes Hall on the University at Buffalo's South Campus.">
                                        <div class="cl-div-search-bottom-img-caption"><span>Crosby Hall and Hayes Hall on the University at Buffalo's South Campus.</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                    include_once("Footer.php");
                ?>
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
    <script src="JS/index.min.js"></script>

</body>

</html>