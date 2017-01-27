<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
    //include_once("SessionAdmin.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project Dashboard - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="isUD™ offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">
    
    <meta property="og:title" content="Project Dashboard - isUD™" />
    <meta property="og:description" content="isUD™ offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD." />
    <meta property="og:image" content="/images/isUD_PR_PublicTransit_Facebook.png" />
    <meta property="og:site_name" content="thisisUD" />
    <meta property="og:image:width" content="470" />
    <meta property="og:image:height" content="246" />

    <link rel="Shortcut Icon" href="favicon.ico">

    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap-select.min.css">
    <link rel="stylesheet" href="CSS/dataTables.bootstrap4.css">
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
                        <div id="dashboard">
                            <!--
                            <div>
                                <div>
                                    <div class="cl-div-site-breadcrumb">
                                        <span class="cl-span-site-breadcrumb-title">Dashboard</span>
                                    </div>
                                </div>
                                
                            </div> 
                            -->
                            <div id="id-div-create-project-button-holder">
                                <a href="createProject.php"><img src= "images/create_inactive.png" /></a>
                            </div>
                            <div class="cl-div-project-dashboard-holder">
                                <div class="cl-div-ongoing-p-holder">
                                    <div class="cl-div-p-holder-title">
                                        <span class="cl-span-p-holder-title">Ongoing Projects</span>
                                    </div>
                                        
                                    <div class="cl-div-p-item-holder">
                                        <div class="cl-div-project">
                                            <div class="cl-div-project-title-holder">
                                                <span class="cl-span-project-title-text">Mary Free Bed</span>
                                                <i class="cl-i-project-edit fa fa-pencil-square" aria-hidden="true"></i>                                               
                                            </div>


                                            <div class="cl-div-project-info-holder">
                                                <div class="cl-div-project-info-right">
                                                    <div class="cl-div-project-award-details-holder">
                                                        <div class="cl-div-project-award-credit-details">
                                                            <div class="cl-div-project-award-credit-title-holder">
                                                                <span class="cl-span-project-award-credit-title">Total Credits</span>
                                                            </div>
                                                            <div class="cl-div-project-award-credit-value-holder">
                                                                <div class="cl-div-project-award-credit-item-holder">
                                                                    <span class="cl-span-project-award-credit-item-title">Earned</span>
                                                                    <span class="cl-span-project-award-credit-item-value cl-span-project-award-credit-earned">0</span>
                                                                </div>
                                                                <div class="cl-div-project-award-credit-item-holder">
                                                                    <span class="cl-span-project-award-credit-item-title">Available</span>
                                                                    <span class="cl-span-project-award-credit-item-value cl-span-project-award-credit-applicable">100</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cl-div-project-award">
                                                            <div class="cl-div-project-award-title-holder">
                                                                <span class="cl-span-project-award-credit-title"></span>
                                                            </div>
                                                            <div class="cl-div-project-award-progress-container" id="id-div-project-award-progress-container"></div>                                                                    
                                                        </div>
                                                        <div class="cl-div-project-buttons">
                                                            <div class="cl-div-project-button-img-holder">
                                                                <img src="images/solutions_inactive.png" class="cl-project-edit-btn"></img>
                                                                <span>Edit</span>
                                                            </div>
                                                            <div class="cl-div-project-button-img-holder">
                                                                <img src="images/upload_inactive.png" class="cl-project-submit-btn"></img>
                                                                <span>Submit</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--<div class="cl-div-project-nav-button-holder">
                                                            <label class="cl-lbl-project-nav-item tag tag-pill tag-default cl-project-edit-btn">Edit Solutions</label>
                                                        </div>-->
                                                </div>
                                                <div class="cl-div-project-info-left">
                                                    <div class="cl-div-project-info-item">
                                                        <div class="cl-div-project-info-item-header">
                                                            <span class="cl-span-project-info-item-header-text">Project Number</span>
                                                        </div>
                                                        <div class="cl-div-project-info-item-value">
                                                            <span class="cl-span-project-info-item-value-text">003</span>                                                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- adding assign reviewer button -->
                                            <div class="reviewer-holder">
                                                <div class="cl-div-project-info-item-value">
                                                    <select class="dropdown-reviewer" id="dropdown-reviewer">
                                                        <option value=""></option>
                                                    </select>                                                                
                                                </div> 
                                                <span class="text-assign-reviewer">Assign Reviewer</span>                                             
                                            </div>
                                            <!-- -->

                                        </div>
                                    </div>
                                </div>
                                <div class="cl-div-under-review-p-holder">
                                    <div class="cl-div-p-holder-title">
                                        <span class="cl-span-p-holder-title">Pending Review</span>                                                
                                    </div>
                                    <div class="cl-div-p-item-holder">
                                    </div>
                                </div>
                                <div class="cl-div-completed-p-holder">
                                    <div class="cl-div-p-holder-title">
                                        <span class="cl-span-p-holder-title">Completed Projects</span>   
                                        <div id="accordion">
                                        <h3>Section 1</h3>
                                        <div>
                                            <p>
                                            Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
                                            ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
                                            amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
                                            odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                                            </p>
                                        </div>
                                        <h3>Section 2</h3>
                                        <div>
                                            <p>
                                            Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
                                            purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
                                            velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
                                            suscipit faucibus urna.
                                            </p>
                                        </div>
                                        <h3>Section 3</h3>
                                        <div>
                                            <p>
                                            Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
                                            Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
                                            ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                                            lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                                            </p>
                                            <ul>
                                            <li>List item one</li>
                                            <li>List item two</li>
                                            <li>List item three</li>
                                            </ul>
                                        </div>
                                        <h3>Section 4</h3>
                                        <div>
                                            <p>
                                            Cras dictum. Pellentesque habitant morbi tristique senectus et netus
                                            et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
                                            faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
                                            mauris vel est.
                                            </p>
                                            <p>
                                            Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
                                            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
                                            inceptos himenaeos.
                                            </p>
                                        </div>
                                        </div>                                             
                                    </div>
                                    <div class="cl-div-p-item-holder">
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
    <script src="JS/lib-unveil.min.js"></script>
    <script src="JS/banner.min.js"></script>
    <script src="JS/index.min.js"></script>
    <script src="JS/progressbar.min.js"></script>
    <script src="JS/adminDashboard.min.js"></script>

</body>

</html>