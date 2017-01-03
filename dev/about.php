<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>About - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="isUD™ offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">
    
    <meta property="og:title" content="About - isUD™" />
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
                            <div id="about">
                                <div>
                                    <div class="col-md-8">
                                        <div class="cl-div-site-breadcrumb">
                                            <span class="cl-span-site-breadcrumb-title">About - test the change :)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 thick-border-light pull-right cl-div-search-box">
                                        <span>Search</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-8">
                                        <div class="cl-div-about-holder">
                                        <h6>isUD&#8482;</h6>
                                            <p>
                                                In 2005, the Center for Inclusive Design and Environmental Access (IDeA) started an initiative to 
                                                develop a stronger evidence base for <a href="#about-universal-design">universal design</a> practice. Increasingly, 
                                                professionals are being asked to provide evidence for their decisions. This is driving the development of 
                                                “evidence-based practice,” in which decisions are made based on the best available knowledge. This legitimizes 
                                                design decisions and makes universal design a more powerful force for improving design quality overall.
                                            </p>
                                            <p>
                                                The IDeA Center modeled its efforts on the success of the U.S. Green Building Council (USGBC) and the 
                                                Green Building Initiative (GBI), who have each developed successful standards (LEED and Green Globes, respectively). 
                                                Both organizations provide services such as certification of buildings and accreditation of professionals to 
                                                recognize competency in sustainable design practices. <i><b>innovative solutions for Universal Design  (isUD™)</i></b> is 
                                                designed to offer similar resources and services to support and recognize adopters of universal design.
                                            </p>

                                            <p class="cl-no-margin-bot">
                                                isUD&#8482; provides several benefits to adopters of universal design:
                                            </p>
                                            <ul>
                                                <li>A means to implement universal design solutions</li>
                                                <li>A branding opportunity for engaging in socially responsible activities</li>
                                                <li>
                                                    Reduced liability in the operation of buildings by making environments more accessible,
                                                    healthier, and safer
                                                </li>
                                                <li>
                                                    Increased employee and visitor satisfaction that leads to increased productivity, repeat visits,
                                                    and other benefits
                                                </li>
                                                <li>
                                                    Proponents of universal design could use the program as a focus of public education programs
                                                    to increase demand for universal design among consumers
                                                </li>
                                            </ul>
                                            <p>
                                                The current set of solutions on this website focus on universal design of public and commercial
                                                buildings. In the future, solutions for housing, transportation, products, etc. will become available.
                                            </p>


                                            <h6 id="about-universal-design">Universal Design</h6>
                                            <p class="cl-no-margin-bot">
                                                Universal design is a process that enables and empowers a diverse population by
                                                improving human performance, health and wellness, and social participation (Steinfeld
                                                and Maisel, 2012). The IDeA Center developed the eight <i>Goals of
                                                Universal Design</i> to help link UD to research. The Goals are stated very concisely in terms of measurable
                                                outcomes.
                                            </p>
                                            <ul>
                                                <li><i>Body fit:</i> Accommodate a wide a range of body sizes and abilities</li>
                                                <li><i>Comfort:</i> Keep demands within desirable limits of body function</li>
                                                <li><i>Awareness:</i> Ensure that critical information for use is perceived easily</li>
                                                <li><i>Understanding:</i> Make methods of operation and use intuitive, clear, and unambiguous</li>
                                                <li><i>Wellness:</i> Contribute to health promotion, avoidance of disease, and prevention of injury</li>
                                                <li><i>Social integration:</i> Treat all groups with dignity and respect</li>
                                                <li><i>
                                                    Personalization:</i> Incorporate opportunities for choice and the expression of individual
                                                    preferences
                                                </li>
                                                <li><i>
                                                    Cultural Appropriateness:</i> Respect and reinforce cultural values and the social and
                                                    environmental context of any design project.
                                                </li>
                                            </ul>

                                            <h6>Acknowledgements</h6>
                                            <p>
                                                This website was developed with funding from the National Institute on Disability, Independent Living, 
                                                and Rehabilitation Research (NIDILRR, 90RE5022-01-00). NIDILRR is a Center with the Administration for 
                                                Community Living (ACL), Department of Health and Human Services (HHS). The contents of this website do 
                                                not necessarily represent the policy of NIDILRR, ACL, HHS, and you should not assume endorsement by the 
                                                Federal Government.
                                            </p>

                                        </div>
                                    </div>
                                    <div class="col-md-3 pull-right">
                                        <img class="cl-img-search-bottom" data-src="images/aboutpage.png" alt="pedestrians on city street.">
                                        <div class="cl-div-search-bottom-img-caption"><span>Pedestrians on a city street.</span></div>
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

</body>

</html>