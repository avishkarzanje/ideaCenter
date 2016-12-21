<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>innovative solutions for Universal Design(isUD™)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="innovative solutions for Universal Design(isUD™) offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">

    <meta property="og:title" content="innovative solutions for Universal Design(isUD™)" />
    <meta property="og:description" content="isUD™ offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD." />
    <meta property="og:image" content="/images/isUD_PR_PublicTransit_Facebook.png" />
    <meta property="og:site_name" content="thisisUD" />
    <meta property="og:image:width" content="470" />
    <meta property="og:image:height" content="246" />
    

    <link rel="Shortcut Icon" href="favicon.ico">
    <!--<link rel="icon" href="/favicon.ico"> -->

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
                    <div>
                        <table class="cl-tbl-navs">
                            <!--<tr>
                                <td>
                                    <nav class="cl-nav-cus nav nav-tabs">
                                        <a class="nav-link" href="#home" data-toggle="tab"><span>Home</span></a>
                                        <a class="nav-link" href="#about" data-toggle="tab"><span>About</span></a>
                                        <a class="nav-link" href="#standards" data-toggle="tab"><span>Standards</span></a>
                                        <a class="nav-link" href="#resources" data-toggle="tab"><span>Resources</span></a>
                                        <a class="nav-link" href="#contact" data-toggle="tab"><span>Contact Us</span></a>
                                        <a class="nav-link" href="register.php"><span>Login</span></a>
                                    </nav>
                                </td>
                            </tr>-->
                            <!--<tr>
                                <td>
                                    <div id="id-div-nav-tab-msg">
                                        <span>Universal Design Initiative</span>
                                    </div>
                                </td>
                            </tr>-->
                            <tr>
                                <td>
                                    <div id="content-holder">
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="home" role="tabpanel">
                                                <div>
                                                    <div class="cl-div-site-breadcrumb">
                                                        <span class="cl-span-site-breadcrumb-title">Welcome to innovative solutions for Universal Design</span>
                                                    </div>
                                                    <div id="carousel-holder">
                                                        <div id="carousel-example-generic" class="small-screen-hidden no-border-left carousel slide" data-ride="carousel">
                                                            <ol class="carousel-indicators">
                                                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                                            </ol>
                                                            <div class="carousel-inner" role="listbox">
                                                                <div class="carousel-item active">
                                                                    <a href="about.php">
                                                                        <img class="cl-carousel-image" data-src="images/slider1.png" src="images/slider1.png" alt="Cane User walking">
                                                                    </a>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <a href="about.php">
                                                                        <img class="cl-carousel-image" data-src="images/slider2.png" src="" alt="Woman pushing a stroller">
                                                                    </a>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <a href="about.php">
                                                                        <img class="cl-carousel-image" data-src="images/slider3.png" src="" alt="Elderly using a walker">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                                <span class="icon-prev" aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                                <span class="icon-next" aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="hide col-md-3 thick-border no-border-right" id="id-div-twitter-container">
                                                        <!--
                                                            <a class="twitter-timeline" href="https://twitter.com/IDeA_Center" data-widget-id="737712371360256005" data-width="100%" data-height="470px">Tweets by @IDeA_Center</a>
                                                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                                        -->
                                                    </div>
                                                </div>
                                                <div class="big-screen-hidden" id="id-div-middle-image-holder">
                                                    <a href="instructions.php">
                                                        <img id="id-img-middle-image" src="images/MiddleImage.png" data-src="images/MiddleImage.png" alt="Making the environment more inclusive for all">
                                                    </a>
                                                </div>
                                                <div>
                                                    <div class="cl-cards-bottom no-border-left">
                                                        <div>
                                                            <div class="card-deck">
                                                                <div class="card">
                                                                    <a href="instructions.php#credits">                                                                
                                                                        <img class="card-img-top" data-src="images/scoring.png" src="images/scoring.png" alt="Person pushing a street crossing signal button">
                                                                        <div class="card-block">
                                                                            <h5 class="card-title">Credits</h5>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="card">
                                                                    <a href="instructions.php#certification">
                                                                        <img class="card-img-top" data-src="images/award.png" src="" alt="Wheelchair user with his arm raised">
                                                                        <div class="card-block">
                                                                            <h5 class="card-title">Certification </h5>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                
                                                                <?php if(!isLoggedIn()){
                                                                    echo ('
                                                                <div class="card small-screen-hidden" id="id-div-card-quick-login">
                                                                    <div class="card-block">
                                                                        <h5 class="card-title">Quick Login</h5>
                                                                        <form id="id-form-login" method="post">
                                                                            <div id="id-div-form">
                                                                                <fieldset class="form-group">
                                                                                    <label class="sr-only" for="id-login-short-inp-email">E-mail address</label>
                                                                                    <input type="email" class="form-control" id="id-login-short-inp-email" name="id-login-short-inp-email" placeholder="E-mail address">
                                                                                </fieldset>
                                                                                <fieldset class="form-group">
                                                                                    <label class="sr-only" for="id-login-short-inp-password">Password</label>
                                                                                    <input type="password" class="form-control" id="id-login-short-inp-password" name="id-login-short-inp-password" placeholder="Password">
                                                                                </fieldset>
                                                                                <div>
                                                                                    <span id="id-login-short-inp-msg"></span>
                                                                                </div>
                                                                            
                                                                            </div>
                                                                            <div id="id-login-btn">
                                                                                <div class="cl-div-card-links-holder">
                                                                                    <a href="#" id="id-a-forgot-pass" class="cl-a-card-links pull-left">Forgot your password?</a>
                                                                                    <a href="register.php" id="id-a-new-user" class="cl-a-card-links pull-right">New User?</a>
                                                                                </div>
                                                                                <input class="btn btn-primary" id="id-btn-login-short-submit" type="submit" value="Login"/>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>'); } else {
                                                                    if($_SESSION["user"]->authtype_id === 1){
                                                                        echo ('
                                                                        <div class="card small-screen-hidden">
                                                                            <a href="dashboard.php">
                                                                                <img class="card-img-top" data-src="images/dashboard.jpg" alt="University at Buffalo: Greiner Hall">
                                                                                <div class="card-block">
                                                                                    <h5 class="card-title">Dashboard</h5>
                                                                                </div>
                                                                            </a>
                                                                        </div>');
                                                                    } else {
                                                                        echo ('
                                                                        <div class="card small-screen-hidden disabled">
                                                                            <a href="#">
                                                                                <img class="card-img-top" data-src="images/casestudies.png" alt="University at Buffalo: Greiner Hall">
                                                                                <div class="card-block">
                                                                                    <h5 class="card-title">Case studies</h5>
                                                                                    <p class="card-text">Under Construction</p>
                                                                                </div>
                                                                            </a>
                                                                        </div>');
                                                                    }
                                                                 }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--
                                                    <div class="hide cl-cards-bottom col-md-3 thick-border no-border-right" id="id-div-home-ad-sponsor">
                                                        <div class="card" id="id-div-card-sponsor">
                                                            <img class="card-img" data-src="images/NIDILRR_1.jpg" src="" alt="NIDILRR">
                                                            <div class="card-img-overlay">
                                                                <h5 class="card-title">Sponsor</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
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
    <script src="JS/lib-unveil.min.js"></script>
    <script src="JS/banner.min.js"></script>
    <script src="JS/intlTelInput.min.js"></script>
    <script src="JS/register.min.js"></script>
    <script src="JS/index.min.js"></script>


    <?php
        echo '<!-- isLoggedIn() : '.isLoggedIn() .'-->';
        echo '<!-- ts_survey_Complete  : '.$_SESSION["user"]->ts_survey_completed .'-->';
        echo '<!-- ts_survey_Complete !== NULL : '.($_SESSION["user"]->ts_survey_completed !== NULL) .'-->';
        echo '<!-- ($_SESSION["user"]->login_success_count%3 == 0) : '.($_SESSION["user"]->login_success_count%3 == 0) .'-->';
        if(isLoggedIn() && ($_SESSION["user"]->login_success_count%3 === 0) && ($_SESSION["user"]->ts_survey_completed !== NULL)){
            echo '<!-- showed survey -->';
            echo '<script>showSurvey()</script>';
        }
    ?>

</body>

</html>