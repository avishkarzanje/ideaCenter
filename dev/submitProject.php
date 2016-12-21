<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Submit Project - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="innovative solutions for Universal Design(isUD™) offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">

    <meta property="og:title" content="Submit Project - isUD™" />
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
                                    <span class="cl-span-site-breadcrumb-title">Project Name</span>
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
                                                    <div class="tab-pane" id="id-pane-submit-project">
                                                        <div class="thick-border-no-grid col-md-12 cl-div-submit-project-tbl" id="id-new-project-tbl">
                                                            <div id="id-div-submit-project-upper-container">
                                                                <div id="id-div-submit-project-upper-left-container" class="cl-div-submit-project-upper-sub-container">
                                                                    <form id="id-form-submit-project-details" method="post">
                                                                        <div class="cl-div-section-msg cl-div-submit-project-section-header">
                                                                            <h6>Document Checklist</h6>
                                                                            <span>Please select document type, browse files to upload. Document will automatically upload when you click open.</span>
                                                                        </div>
                                                                        <div class="cl-div-formset">
                                                                            <div class="cl-submit-project-tbl-div">
                                                                                <div class="cl-div-submit-project-building-type-sub-container">
                                                                                    <span class="cl-div-new-project-building-type-sub-header">Document Type</span>
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-label">
                                                                                            <input class="form-check-input" type="checkbox" value="Document 1">
                                                                                            Document 1
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-label">
                                                                                            <input class="form-check-input" type="checkbox" value="Document 2">
                                                                                            Document 2
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-label">
                                                                                            <input class="form-check-input" type="checkbox" value="Document 3">
                                                                                            Document 3
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-label">
                                                                                            <input class="form-check-input" type="checkbox" value="Document 4">
                                                                                            Document 4
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div id="id-div-submit-project-upper-right-container" class="cl-div-submit-project-upper-sub-container">
                                                                    <form id="id-form-submit-project-upload" method="post">
                                                                        <div class="cl-div-section-msg cl-div-new-project-section-header">
                                                                            <h6>File Upload</h6>
                                                                        </div>
                                                                        <div class="cl-div-formset">
                                                                            <label class="custom-file">
                                                                                <input type="file" id="file" class="custom-file-input">
                                                                                <span class="custom-file-control"></span>
                                                                            </label>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div id="id-div-submit-project-lower-container">
                                                                <div class="cl-div-submit-project-section-header">
                                                                    <h6>Uploaded Files</h6>
                                                                </div>
                                                                <div class="cl-div-submit-project-uploaded-holder">
                                                                    <table class="table table-hover cl-tbl-submit-project-uploaded">
                                                                        <thead>
                                                                            <tr>
                                                                            <th>#</th>
                                                                            <th>Document Name</th>
                                                                            <th>Document Type</th>
                                                                            <th>Delete</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row">1</th>
                                                                                <td>Mark</td>
                                                                                <td>Otto</td>
                                                                                <td>@mdo</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">2</th>
                                                                                <td>Jacob</td>
                                                                                <td>Thornton</td>
                                                                                <td>@fat</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">3</th>
                                                                                <td>Larry</td>
                                                                                <td>Thornton</td>
                                                                                <td>@twitter</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div id="id-div-submit-project-button-container">
                                                                <input type="button" class="btn btn-primary" id="id-btn-submit-project-submit" text="Save" value="Save"/>
                                                                <input type="button" class="btn btn-primary" id="id-btn-submit-project-clear" text="Clear" value="Clear"/>
                                                            </div>
                                                        </div>
                                                        <div id="id-div-submit-project-progress" class="hide">
                                                            <div class="col-md-4 cl-submit-project-progress-tbl-div-left" ><i class="fa" id="id-div-submit-project-progress-icon"></i></div>
                                                            <div class="col-md-6 cl-submit-project-progress-tbl-div-right"><span id="id-div-submit-project-progress-msg" >SUCCESS</span></div>
                                                            <div class="col-md-2 cl-submit-project-progress-tbl-div-right"><a href="projectDashboard.php"><img id="id-div-submit-project-progress-link" src="images/manage_inactive.png"></img></a></div>
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
    <script src="JS/submitProject.min.js"></script>

</body>

</html>