<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Solutions - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="innovative solutions for Universal Design(isUD™) offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">

    <meta property="og:title" content="Solutions - isUD™" />
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
                        <div class="tab-content" id="id-tab-content-solution">
                            
                            <div class="tab-pane" id="id-pane-solution-landing">
                                <div>
                                    <div class="col-md-8">
                                        <div class="cl-div-site-breadcrumb">
                                            <span class="cl-span-site-breadcrumb-title">Solutions</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 thick-border-light pull-right cl-div-search-box">
                                        <span>Search</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-8">
                                        <div class="small-screen-hidden">
                                            <div class="card-deck" id="id-div-solution-cardgroup">
                                                <div class="card cl-div-solution-card">
                                                    <div class="card-header">
                                                        Browse Solutions
                                                    </div>
                                                    <div class="card-block">
                                                        <p class="card-text"><?php echo(isLoggedIn()?"Click the browse link below to access the solutions for Universal Design.":'You will need to login to view the solutions for Universal Design.  Please <a href="#" class="cl-a-solution-card-link" id="id-a-solution-card-browse-link">click here</a> to login or create an account.');?></p>
                                                    </div>                                                  
                                                    <div class="card-img-holder" id="id-div-solution-card-browse-img-holder">
                                                        <img class="card-img" data-src="images/browsesolutions.png" src="" alt="Browse Solutions">
                                                    </div>
                                                    <a href="#" class="cl-card-btn-solution btn" id="id-card-btn-browse-solutions">Browse</a>
                                                </div>
                                                <div class="card cl-div-solution-card">
                                                    <div class="card-header">
                                                        Start New Project
                                                    </div>
                                                    <div class="card-block">
                                                        <p class="card-text">Account holders will be able to create a project, customize the solutions and score their projects.</p>
                                                    </div>
                                                    <div class="card-img-holder" id="id-div-solution-card-create-img-holder">
                                                        <img class="card-img" data-src="images/startnewproject.png" src="" alt="Start new Project">
                                                    </div>
                                                    <a href="#" class="cl-card-btn-solution btn" id="id-card-btn-create-project">Create Project</a>
                                                </div>
                                                <div class="card cl-div-solution-card">
                                                    <div class="card-header">
                                                        Manage Projects
                                                    </div>
                                                    <div class="card-block">
                                                        <p class="card-text">Account holders will be able to create, save, edit and assign members to multiple projects.</p>
                                                    </div>                                                  
                                                    <div class="card-img-holder">
                                                        <img class="card-img" data-src="images/manageproject.png" src="" alt="Manage Projects">
                                                    </div>
                                                    <a href="#" class="cl-card-btn-solution btn" id="id-card-btn-manage-projects">Manage Projects</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="big-screen-hidden cl-div-solutions-holder">
                                            <p>
                                                Thank you for your interest in innovative solutions for Universal Design (isUD™).  Due to the large amount of content, the solutions are not available on small screens or small browser windows. To see the complete list of solutions, please make your browser window full screen, or access the site on device with a larger screen. If you have any questions, please contact us at <a href="mailto:info@thisisud.com" target="_blank">info@thisisud.com</a>.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pull-right">
                                        <img class="cl-img-search-bottom" data-src="images/solutionspage.png" alt="Solutions side image">
                                        <div class="cl-div-search-bottom-img-caption"><span>Directional sign pointing toward a restroom. The sign includes common pictograms indicating a nearby men’s, women’s and an accessible restroom.</span></div>
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
    <script src="JS/solutionJS.php"></script>
    <!--<script src="dist/index.min.js"></script>-->
    <!--<script src="dist/solution.min.js"></script>-->
    

</body>

</html>