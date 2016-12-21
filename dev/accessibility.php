<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accessibility - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="innovative solutions for Universal Design(isUD™) offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">

    <meta property="og:title" content="Accessibility - isUD™" />
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
                    <table class="cl-tbl-navs">
                        <tr>
                            <td>
                                <div id="content-holder">
                                    <!-- Tab panes -->
                                    <div id="id-tab-content-accessibility">
                                        <div id="id-pane-accessibility">
                                            <div>
                                                <div class="col-md-8">
                                                    <div class="cl-div-site-breadcrumb">
                                                        <span class="cl-span-site-breadcrumb-title">Accessibility Statement</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 thick-border-light pull-right cl-div-search-box">
                                                    <span>Search</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="col-md-8">
                                                    <div class="cl-div-accessibility-holder">
                                                        <p>
                                                            thisisUD.com is committed to making our site fully inclusive. We are constantly looking to improve our site so that users of all abilities can experience the content we deliver with ease. Every effort has been made to make these pages as accessible as possible in accordance with the applicable state and federal guidelines. Find out more about <a href ="https://www.w3.org/WAI/intro/accessibility.php">web accessibility</a>.
                                                        </p>
                                                    </div>
                                                </div>
                                                    <div class="col-md-3 pull-right">
                                                        <img class="cl-img-search-bottom" data-src="images/solutionspage.png" alt="Directional sign pointing towards restrooms indicating men, women, and accessible.">
                                                        <div class="cl-div-search-bottom-img-caption"><span>Directional sign pointing towards restrooms indicating men, women, and accessible.</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
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
    <script src="JS/disclaimer.min.js"></script>
    <script src="JS/banner.min.js"></script>
    

</body>

</html>