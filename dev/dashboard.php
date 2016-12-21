<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
    include_once("SessionAdmin.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="isUD™ offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">
    
    <meta property="og:title" content="Dashboard - isUD™" />
    <meta property="og:description" content="isUD™ offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD." />
    <meta property="og:image" content="/images/isUD_PR_PublicTransit_Facebook.png" />
    <meta property="og:site_name" content="thisisUD" />
    <meta property="og:image:width" content="470" />
    <meta property="og:image:height" content="246" />

    <link rel="Shortcut Icon" href="favicon.ico">

    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap-select.min.css">
    <!--<link rel="stylesheet" href="CSS/jquery.dataTables.css">-->
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
                        <div>
                            <div id="dashboard">
                                <div>
                                    <div>
                                        <div class="cl-div-site-breadcrumb">
                                            <span class="cl-span-site-breadcrumb-title">Dashboard</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <div class="cl-div-dashboard-holder">
                                            <table id="id-table-dashboard" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Organization</th>
                                                    <th>Email Id</th>
                                                    <th>Phone No.</th>
                                                    <th>Country</th>
                                                    <th>Last Login</th>
                                                    <th>Login Count</th>
                                                </thead>
                                            </table>
                                        </div>
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
    <script src="JS/jquery.dataTables.js"></script>
    <script src="JS/dataTables.bootstrap4.js"></script>
    <script src="JS/dashboard.min.js"></script>

</body>

</html>