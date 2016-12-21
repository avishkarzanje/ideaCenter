<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Technical Acknowledgements - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="isUD™ offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">
    
    <meta property="og:title" content="Technical Acknowledgements - isUD™" />
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
                            <div id="tech">
                                <div>
                                    <div class="col-md-8">
                                        <div class="cl-div-site-breadcrumb">
                                            <span class="cl-span-site-breadcrumb-title">Technical Acknowledgements</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 thick-border-light pull-right cl-div-search-box">
                                        <span>Search</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-8">
                                        <div class="cl-div-tech-holder">
                                            <p>
                                                We would like to thank the authors and collaborators for these awesome libraries and plugins
                                                for making our life easier in creating this website, and making it so much better. 
                                            </p>

                                            <table class="table table-bordered table-striped">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th colspan="2">
                                                            jQuery
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">Bootstrap 4 alpha</td>
                                                        <td class="cl-td-tech-ack-right"><a href="http://v4-alpha.getbootstrap.com/" target="_blank">http://v4-alpha.getbootstrap.com/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">Data Tables</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://datatables.net/" target="_blank">https://datatables.net/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">Intl-tel-input</td>
                                                        <td class="cl-td-tech-ack-right"><a href="http://jackocnr.com/intl-tel-input.html" target="_blank">http://jackocnr.com/intl-tel-input.html</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered table-striped">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th colspan="2">
                                                            gulp
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp</td>
                                                        <td class="cl-td-tech-ack-right"><a href="http://gulpjs.com/" target="_blank">http://gulpjs.com/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-changed</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-changed" target="_blank">https://www.npmjs.com/package/gulp-changed</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-bytediff</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-bytediff" target="_blank">https://www.npmjs.com/package/gulp-bytediff</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-postcss</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-postcss" target="_blank">https://www.npmjs.com/package/gulp-postcss</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-sourcemaps</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-sourcemaps" target="_blank">https://www.npmjs.com/package/gulp-sourcemaps</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-htmlmin</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-htmlmin" target="_blank">https://www.npmjs.com/package/gulp-htmlmin</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-minify</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-minify" target="_blank">https://www.npmjs.com/package/gulp-minify</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-dest</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-dest" target="_blank">https://www.npmjs.com/package/gulp-dest</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-rename</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-rename" target="_blank">https://www.npmjs.com/package/gulp-rename</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-imagemin</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-imagemin" target="_blank">https://www.npmjs.com/package/gulp-imagemin</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-rev-all</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-rev-all" target="_blank">https://www.npmjs.com/package/gulp-rev-all</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cl-td-tech-ack-left">gulp-filter</td>
                                                        <td class="cl-td-tech-ack-right"><a href="https://www.npmjs.com/package/gulp-filter" target="_blank">https://www.npmjs.com/package/gulp-filter</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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