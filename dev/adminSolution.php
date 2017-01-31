<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");

    if(!isLoggedIn()){
        header('Location: http://www.thisisud.com/solutions.php');
        die();
    }
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

    <link rel="stylesheet" href="CSS/jquery.mobile.custom.structure.min.css">
    <link rel="stylesheet" href="CSS/jquery.mobile.custom.theme.min.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/custom.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/awesome-bootstrap-checkbox.css">
    
    
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
                            <div id="id-pane-solution" class="tab-pane">
                                <div>
                                    <div class="cl-div-site-breadcrumb">
                                        <span class="cl-span-site-breadcrumb-title">Solutions</span>
                                    </div>
                                </div>
                                <div class="cl-div-solutions-section-holder">
                                    <div class="cl-solutions-section-left">
                                        <div id="id-div-solution-chapter-holder">
                                            <a class="cl-div-solution-chapter-list-item" id="id-div-solution-chapter-list-item" role="button" href="">
                                                <div class="cl-div-active-bar hide">
                                                </div>
                                                <div class="cl-div-chapter-number">
                                                    1
                                                </div>
                                                <div class="cl-div-chapter-title-holder">
                                                    <div class="cl-div-chapter-title">
                                                        Design Process
                                                    </div>
                                                    <div class="cl-div-chapter-sub-title">
                                                        4 Credits
                                                    </div>
                                                    <div class="cl-div-chapter-credit-implemented-ratio-holder" id="id-div-chapter-credit-implemented-ratio-holder-">
                                                        <div class="cl-div-ratio-squared">
                                                            <div class="cl-div-ratio-square-elem-left">
                                                                <span>2</span>
                                                            </div>
                                                            <div class="cl-div-ratio-square-elem-right">
                                                                <span>of 3</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cl-div-chapter-chevron-holder">
                                                    <img class="cl-img-chapter-chevron" data-src="images/chapterarrow.png" src="" alt="chapter chevron" aria-hidden="true">
                                                </div>
                                                <div class="cl-div-chapter-spin-i-holder hide">
                                                    <i class="fa fa-circle-o-notch fa-spin cl-i-chapter-spin" aria-hidden="true"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="cl-solutions-section-right">
                                        <div id="id-div-chapter-content-loading" class="thick-border-no-grid hide">
                                        </div>
                                        <div id="id-div-chapter-content" class="thick-border-no-grid">
                                            <div id="id-div-chapter-content-top-info">
                                                <div class="cl-div-chapter-content-top-info-left-container">
                                                    <span>
                                                        Toggle yes or no to select sections applicable to your project
                                                    </span>
                                                </div>
                                                <div class="cl-div-chapter-content-top-info-right-container">
                                                    <div class="cl-div-info-implemented-holder">
                                                        <span>Solutions</span>
                                                    </div>
                                                    <div class="cl-div-info-earned-holder">
                                                        <span>Credits</span>                                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="id-div-chapter-content-h2-holder-dummy" class="hide">
                                                <div class="cl-div-chapter-content-h2-item panel" id="id-div-chapter-content-h2-item">
                                                    <div class="cl-div-chapter-content-h2-item-header btn" data-toggle="collapse">
                                                        <div class="cl-div-h2-item-image-holder" aria-hidden="true">
                                                            <img class="cl-img-h2-item-image" data-src="images/unitarrow_closed.png" src="" alt="chapter chevron">                                                                        
                                                        </div>
                                                        <div class="cl-div-h2-item-number">
                                                            1.1
                                                        </div>
                                                        <div class="cl-div-h2-item-title-section-holder">
                                                            <div class="cl-div-h2-item-title-holder">
                                                                <span class="cl-div-h2-item-title">
                                                                    Project Development Team
                                                                </span>
                                                                <div class="cl-div-h2-item-title-notification-holder">
                                                                    <a class="cl-link-black-font" target="_blank" href="/Docs/content/2016-07-11_Thermal_Comfort.pdf">
                                                                        <i class="fa fa-file-text cl-div-h2-item-pdf-notification" title="Download design resource"></i>
                                                                        <span class="hide">Download design resource</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="cl-div-h2-item-subtitle hide">
                                                                2 Credits : Implement 5 of 7 | 1 Credit: Implement 3 of 7
                                                            </div>
                                                        </div>
                                                        <div class="cl-div-hx-item-title-edit-status pull-right">
                                                            <div class="cl-div-implemented-ratio-holder">
                                                                <div class="cl-div-ratio-rounded">
                                                                    <div class="cl-div-ratio-rounded-elem-left">
                                                                        <span>2</span>
                                                                    </div>
                                                                    <div class="cl-div-ratio-rounded-elem-right">
                                                                        <span>of 3</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cl-div-earned-ratio-holder">
                                                                <div class="cl-div-ratio-squared">
                                                                    <div class="cl-div-ratio-square-elem-left">
                                                                        <span>2</span>
                                                                    </div>
                                                                    <div class="cl-div-ratio-square-elem-right">
                                                                        <span>of 3</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cl-div-selection-switch-holder ui-page-theme-a">
                                                                <form>
                                                                    <fieldset>
                                                                            <label for="slider-flip-m" class="ui-hidden-accessible">Selection switch</label>
                                                                            <select name="slider-flip-m" id="slider-flip-m" class="cl-slider-flip-m" data-role="flipswitch" data-mini="true">
                                                                                <option value="off">No</option>
                                                                                <option value="on">Yes</option>
                                                                            </select>
                                                                    </fieldset>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cl-div-chapter-content-h2-item-pane collapse" id="id-div-chapter-content-h2-item-pane">
                                                        <div class="cl-div-chapter-content-solutions-holder">
                                                            <div class="cl-div-h2-solutions-holder">
                                                                <div class="cl-div-h2-solution-item" id="id-div-h2-solution-item">
                                                                    <div class="cl-div-h2-solution-item-header" data-toggle="collapse">
                                                                        <div class="cl-div-h2-solution-item-chevron-holder" aria-hidden="true">
                                                                            <img class="cl-img-h2-solution-item-chevron" data-src="images/unitarrow_closed.png" src="" alt="h2 solution chevron">                                                                        
                                                                        </div>
                                                                        <div class="cl-div-h2-solution-item-number-holder sr-only">
                                                                            <span class="cl-div-h2-solution-item-number-text"></span>
                                                                        </div>
                                                                        <div class="cl-div-h2-solution-item-text-holder">
                                                                            <span class="cl-div-h2-solution-item-prequisite hide">Required</span>
                                                                            <span class="cl-div-h2-solution-item-text">Spaces with similar function and noise requirement are grouped together.</span>
                                                                            <div class="cl-div-h2-solution-item-image-notification-holder hide">
                                                                                <i class="fa fa-picture-o cl-div-h2-solution-item-image-notification"></i>
                                                                            </div>
                                                                        </div>
                                                                        <form role="form" class="cl-form-solution-checkbox">
                                                                            <div class="cl-div-h2-solution-item-checkbox-holder pull-right checkbox">
                                                                                <label class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input cl-div-hx-solution-item-checkbox" value="checkbox" aria-label="checkbox"/>
                                                                                    <span class="custom-control-indicator"></span>
                                                                                </label>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                
                                                                    <div class="cl-div-h2-solution-item-pane collapse" id="id-div-h2-solution-item-pane">
                                                                        <div class="cl-div-solution-item-pane-image-sec-holder">
                                                                            <div class="cl-div-solution-item-pane-image-holder">
                                                                                <div id="id-solution-item-carousel" class="carousel slide" data-ride="carousel">
                                                                                    <div class="cl-solution-item-carousel-inner carousel-inner" role="listbox">
                                                                                        <div class="cl-solution-item-carousel-item carousel-item active">
                                                                                            <img data-src="solution_images/Fig_dummy.png" src="" alt="First slide">
                                                                                            <div class="cl-solution-item-carousel-item-image-caption-holder carousel-caption">
                                                                                                <p class="cl-solution-item-carousel-item-image-caption">...</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="cl-solution-item-carousel-footer" aria-hidden="true">
                                                                                        <a class="left cl-solution-item-carousel-control carousel-control" href="#id-solution-item-carousel" role="button" data-slide="prev">
                                                                                            <span class="icon-prev" aria-hidden="true"></span>
                                                                                            <span class="sr-only">Previous</span>
                                                                                        </a>
                                                                                        <ol class="cl-solution-item-carousel-indicators carousel-indicators">
                                                                                            <li data-target="#id-solution-item-carousel" data-slide-to="0" class="active"></li>
                                                                                        </ol>
                                                                                        <a class="right cl-solution-item-carousel-control carousel-control" href="#id-solution-item-carousel" role="button" data-slide="next">
                                                                                            <span class="icon-next" aria-hidden="true"></span>
                                                                                            <span class="sr-only">Next</span>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn btn-primary cl-btn-h2-solution-item-close"><i class="fa fa-times" aria-hidden="true"></i><span>close</span></div>
                                                                            <!--<div class="cl-div-h2-solution-item-image-text-holder">
                                                                                <span class="cl-div-h2-solution-item-image-text">Spaces with similar function and noise requirement are grouped together.</span>
                                                                            </div>-->
                                                                        </div>
                                                                        <div class="cl-div-solution-item-pane-attrib-sec-holder pull-right">
                                                                            <div class="cl-div-solution-item-pane-attrib-sec-row">
                                                                                <div class="cl-div-h2-solution-item-attrib-header"><span><h6>Phases</h6></span></div>
                                                                                <div class="cl-div-h2-solution-item-attrib-holder" id="id-div-h2-solution-item-attrib-holder-phases">
                                                                                    <div class="cl-div-h2-solution-item-attrib-item">
                                                                                        <div class="cl-div-h2-solution-item-attrib-item-indicator"><i class="fa" aria-hidden="true"></i></div>
                                                                                        <span class="cl-div-h2-solution-item-attrib-item-text">Body Fit</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="cl-div-solution-item-pane-attrib-sec-row">
                                                                                <div class="cl-div-h2-solution-item-attrib-header"><span><h6>Goals of UD</h6></span></div>
                                                                                <div class="cl-div-h2-solution-item-attrib-holder" id="id-div-h2-solution-item-attrib-holder-goals">
                                                                                    <div class="cl-div-h2-solution-item-attrib-item">
                                                                                        <div class="cl-div-h2-solution-item-attrib-item-indicator"><i class="fa" aria-hidden="true"></i></div>
                                                                                        <span class="cl-div-h2-solution-item-attrib-item-text">Body Fit</span>
                                                                                    </div>                                                                       
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cl-div-hx-footer cl-div-h2-footer">
                                                                <div class="btn btn-primary btn-sm cl-btn-hx-footer-save" id="id-btn-hx-footer-save" data-role="button"><span>save</span></div>
                                                                <div class="btn btn-primary btn-sm cl-btn-hx-footer-clear" id="id-btn-hx-footer-clear" data-role="button"><span>clear</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="cl-div-chapter-content-h3-holder" id="id-div-chapter-content-h3-holder">
                                                            <div class="cl-div-chapter-content-h3-item panel" id="id-div-chapter-content-h3-item">
                                                                <div class="cl-div-chapter-content-h3-item-header btn" data-toggle="collapse">
                                                                    <div class="cl-div-h3-item-image-holder" aria-hidden="true">
                                                                        <img class="cl-img-h3-item-image" data-src="images/unitarrow_closed.png" src="" alt="chapter chevron">                                                                        
                                                                    </div>
                                                                    <div class="cl-div-h3-item-number">
                                                                        1.1
                                                                    </div>
                                                                    <div class="cl-div-h3-item-title-section-holder">
                                                                        <div class="cl-div-h3-item-title-holder">
                                                                            <span class="cl-div-h3-item-title">
                                                                                Project Development Team
                                                                            </span>
                                                                            <div class="cl-div-h3-item-title-notification-holder">
                                                                                <a class="cl-link-black-font" target="_blank" href="/Docs/content/2016-07-11_Thermal_Comfort.pdf">
                                                                                    <i class="fa fa-file-text cl-div-h3-item-pdf-notification" title="Download design resource"></i>
                                                                                    <span class="hide">Download design resource</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cl-div-h3-item-subtitle hide">
                                                                            2 Credits : Implement 5 of 7 | 1 Credit: Implement 3 of 7
                                                                        </div>
                                                                    </div>
                                                                    <!--<div class="cl-div-hx-item-title-edit-status pull-right">
                                                                        <div class="cl-div-implemented-ratio-holder">
                                                                            <div class="cl-div-ratio-rounded">
                                                                                <div class="cl-div-ratio-rounded-elem-left">
                                                                                    <span>2</span>
                                                                                </div>
                                                                                <div class="cl-div-ratio-rounded-elem-right">
                                                                                    <span>of 3</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cl-div-earned-ratio-holder">
                                                                            <div class="cl-div-ratio-squared">
                                                                                <div class="cl-div-ratio-square-elem-left">
                                                                                    <span>2</span>
                                                                                </div>
                                                                                <div class="cl-div-ratio-square-elem-right">
                                                                                    <span>of 3</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cl-div-selection-switch-holder">
                                                                            <select name="slider-flip-m" id="slider-flip-m" data-role="slider" data-mini="true">
                                                                                <option value="off">No</option>
                                                                                <option value="on" selected="">Yes</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>-->
                                                                </div>
                                                                <div class="cl-div-chapter-content-h3-item-pane collapse" id="id-div-chapter-content-h3-item-pane">
                                                                    <div class="cl-div-chapter-content-solutions-holder">
                                                                        <div class="cl-div-h3-solutions-holder">
                                                                            <div class="cl-div-h3-solution-item" id="id-div-h3-solution-item">
                                                                                <div class="cl-div-h3-solution-item-header" data-toggle="collapse">
                                                                                    <div class="cl-div-h3-solution-item-chevron-holder" aria-hidden="true">
                                                                                        <img class="cl-img-h3-solution-item-chevron" data-src="images/unitarrow_closed.png" src="" alt="h3 solution chevron">
                                                                                    </div>
                                                                                    <div class="cl-div-h3-solution-item-number-holder sr-only">
                                                                                        <span class="cl-div-h3-solution-item-number-text"></span>
                                                                                    </div>
                                                                                    <div class="cl-div-h3-solution-item-text-holder">
                                                                                        <span class="cl-div-h3-solution-item-prequisite hide">Required</span>
                                                                                        <span class="cl-div-h3-solution-item-text">Spaces with similar function and noise requirement are grouped together.</span>
                                                                                        <div class="cl-div-h3-solution-item-image-notification-holder hide">
                                                                                            <i class="fa fa-picture-o cl-div-h3-solution-item-image-notification"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <form role="form" class="cl-form-solution-checkbox">
                                                                                        <div class="cl-div-h3-solution-item-checkbox-holder pull-right checkbox">
                                                                                            <label class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input cl-div-hx-solution-item-checkbox" value="checkbox" aria-label="checkbox"/>
                                                                                                <span class="custom-control-indicator"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="cl-div-h3-solution-item-pane collapse" id="id-div-h3-solution-item-pane">
                                                                                    <div class="cl-div-solution-item-pane-image-sec-holder">
                                                                                        <div class="cl-div-solution-item-pane-image-holder">
                                                                                            <div id="id-solution-item-carousel" class="carousel slide" data-ride="carousel">
                                                                                                <div class="cl-solution-item-carousel-inner carousel-inner" role="listbox">
                                                                                                    <div class="cl-solution-item-carousel-item carousel-item active">
                                                                                                        <img data-src="solution_images/Fig_dummy.png" src="" alt="First slide">
                                                                                                        <div class="cl-solution-item-carousel-item-image-caption-holder carousel-caption">
                                                                                                            
                                                                                                            <p class="cl-solution-item-carousel-item-image-caption">...</p>
                                                                                                            
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="cl-solution-item-carousel-footer" aria-hidden="true">
                                                                                                    <a class="left cl-solution-item-carousel-control carousel-control" href="#id-solution-item-carousel" role="button" data-slide="prev">
                                                                                                        <span class="icon-prev" aria-hidden="true"></span>
                                                                                                        <span class="sr-only">Previous</span>
                                                                                                    </a>
                                                                                                    <ol class="cl-solution-item-carousel-indicators carousel-indicators">
                                                                                                        <li data-target="#id-solution-item-carousel" data-slide-to="0" class="active"></li>
                                                                                                    </ol>
                                                                                                    <a class="right cl-solution-item-carousel-control carousel-control" href="#id-solution-item-carousel" role="button" data-slide="next">
                                                                                                        <span class="icon-next" aria-hidden="true"></span>
                                                                                                        <span class="sr-only">Next</span>
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="btn btn-primary cl-btn-h3-solution-item-close"><i class="fa fa-times" aria-hidden="true"></i><span>close</span></div>
                                                                                        <!--<div class="cl-div-h3-solution-item-image-text-holder">
                                                                                            <span class="cl-div-h3-solution-item-image-text">Spaces with similar function and noise requirement are grouped together.</span>                                                                        
                                                                                        </div>-->
                                                                                    </div>
                                                                                    <div class="cl-div-solution-item-pane-attrib-sec-holder pull-right">
                                                                                        <div class="cl-div-solution-item-pane-attrib-sec-row">
                                                                                            <div class="cl-div-h3-solution-item-attrib-header"><span><h6>Phases</h6></span></div>
                                                                                            <div class="cl-div-h3-solution-item-attrib-holder" id="id-div-h3-solution-item-attrib-holder-phases">
                                                                                                <div class="cl-div-h3-solution-item-attrib-item">
                                                                                                    <div class="cl-div-h3-solution-item-attrib-item-indicator"><i class="fa" aria-hidden="true"></i></div>
                                                                                                    <span class="cl-div-h3-solution-item-attrib-item-text">Body Fit</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="cl-div-solution-item-pane-attrib-sec-row">
                                                                                            <div class="cl-div-h3-solution-item-attrib-header"><span><h6>Goals of UD</h6></span></div>
                                                                                            <div class="cl-div-h3-solution-item-attrib-holder" id="id-div-h3-solution-item-attrib-holder-goals">
                                                                                                <div class="cl-div-h3-solution-item-attrib-item">
                                                                                                    <div class="cl-div-h3-solution-item-attrib-item-indicator"><i class="fa" aria-hidden="true"></i></div>
                                                                                                    <span class="cl-div-h3-solution-item-attrib-item-text">Body Fit</span>
                                                                                                </div>                                                                       
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cl-div-hx-footer cl-div-h3-footer">
                                                                            <div class="btn btn-primary btn-sm cl-btn-hx-footer-save" id="id-btn-hx-footer-save" data-role="button"><span>save</span></div>
                                                                            <div class="btn btn-primary btn-sm cl-btn-hx-footer-clear" id="id-btn-hx-footer-clear" data-role="button"><span>clear</span></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="id-div-chapter-content-h2-holder">
                                            </div>
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
    <script src="JS/jquery.mobile.custom.min.js"></script>
    <script src="JS/lib-unveil.min.js"></script>
    <script src="JS/banner.min.js"></script>
    <script src="JS/adminSolution.min.js"></script>
    <script src="JS/progressbar.min.js"></script>
    <!--<script src="dist/index.min.js"></script>-->
    <!--<script src="dist/solution.min.js"></script>-->
    

</body>

</html>