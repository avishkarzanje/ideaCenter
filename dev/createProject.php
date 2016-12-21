<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Project - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="innovative solutions for Universal Design(isUD™) offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">

    <meta property="og:title" content="New Project - isUD™" />
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
                                    <span class="cl-span-site-breadcrumb-title">New Project Information</span>
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
                                                    <div class="tab-pane" id="id-pane-new-project">
                                                        <div class="thick-border-no-grid col-md-12 cl-div-new-project-tbl" id="id-new-project-tbl">
                                                            <div id="id-div-new-project-upper-container">
                                                                <div id="id-div-new-project-upper-left-container">
                                                                    <form id="id-form-new-project-details" method="post">
                                                                        <div class="cl-div-section-msg cl-div-new-project-section-header">
                                                                            <h6>Project Details</h6>
                                                                        </div>
                                                                        <div class="cl-div-formset">
                                                                            <div class="cl-new-project-tbl-div">
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-title">Project Title</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-title" name="id-new-project-inp-p-title" placeholder="Project Title" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-title">Field cannot be empty</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-owner">Project Owner</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-owner" name="id-new-project-inp-p-owner" placeholder="Project Owner" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-owner">Field cannot be empty</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-architect">Project Architect</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-architect" name="id-new-project-inp-p-architect" placeholder="Project architect" ></textarea></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-architect">Field cannot be empty</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-habitable-floor-area">Habitable Floor Area</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div class="input-group">
                                                                                            <input class="form-control" type="text" id="id-new-project-inp-habitable-floor-area" name="id-new-project-inp-habitable-floor-area" placeholder="Habitable Floor Area" />
                                                                                            <div class="input-group-addon">sq. ft.</div>
                                                                                        </div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-habitable-floor-area">Should be a number</span></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-site-area">Site Area</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div class="input-group">
                                                                                            <input class="form-control" type="text" id="id-new-project-inp-site-area" name="id-new-project-inp-site-area" placeholder="Site Area" />
                                                                                            <div class="input-group-addon">sq. ft.</div>
                                                                                        </div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-site-area">Should be a number</span></div>                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-cost">Project Cost</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-cost" name="id-new-project-inp-p-cost" placeholder="Project Cost" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-cost">Should be a number</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-a-start-date">Anticipated Start Date</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="date" id="id-new-project-inp-p-a-start-date" name="id-new-project-inp-p-a-start-date" placeholder="" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-a-start-date">Field cannot be empty</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-a-end-date">Anticipated End Date</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" data-role="date" data-inline="true" id="id-new-project-inp-p-a-end-date" name="id-new-project-inp-p-a-end-date" placeholder="" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-a-end-date">Field cannot be empty</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div id="id-div-new-project-upper-right-container">
                                                                    <form id="id-form-new-project-contact" method="post">
                                                                        <div class="cl-div-section-msg cl-div-new-project-section-header">
                                                                            <h6>Project Contact</h6>
                                                                        </div>
                                                                        <div class="cl-div-formset">
                                                                            <div class="cl-new-project-tbl-div">
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-contact-person">Primary Contact Person</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-contact-person" name="id-new-project-inp-p-contact-person" placeholder="Primary Contact Person" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-contact-person">Field cannot be empty</span></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-contact-email">Primary Contact Email</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-contact-email" name="id-new-project-inp-p-contact-email" placeholder="Primary Contact Email" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-contact-email">Field cannot be empty</span></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-contact-telephone">Primary Contact Telephone</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class= "form-control" id="id-new-project-inp-p-contact-telephone" name="id-new-project-inp-p-contact-telephone" type="tel" data-width="100%"></select></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-contact-telephone">Enter a valid Phone number</span></div> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-address-line-1">Project Address Line 1</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-address-line-1" name="id-new-project-inp-p-address-line-1" placeholder="Project Address Line 1" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-address-line-1">Field cannot be empty</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-address-line-2">Project Address Line 2</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-address-line-2" name="id-new-project-inp-p-address-line-2" placeholder="Project Address Line 2" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-address-line-2">Field cannot be empty</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-city">City</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-city" name="id-new-project-inp-p-city" placeholder="City" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-city">Should be a number</span></div>                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-state">State</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-state" name="id-new-project-inp-p-state" placeholder="State" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-state">Field cannot be empty</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-country">Country</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-country" name="id-new-project-inp-p-country" placeholder="Country" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-country">Field cannot be empty</span></div>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group cl-div-formset">
                                                                                    <div class="col-md-5 cl-new-project-tbl-div-left">
                                                                                        <div><label class="label cl-label-new-project-short" for="id-new-project-inp-p-zipcode">Zipcode</label></div>
                                                                                    </div>
                                                                                    <div class="col-md-7 cl-new-project-tbl-div-right">
                                                                                        <div><input class="form-control" type="text" id="id-new-project-inp-p-zipcode" name="id-new-project-inp-p-zipcode" placeholder="Zipcode" /></div>
                                                                                        <div><span class="cl-new-project-inp-error-lbl cl-lbl" id="id-new-project-inp-error-lbl-p-zipcode">Field cannot be empty</span></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div id="id-div-new-project-lower-container">
                                                                <div class="cl-div-new-project-section-header">
                                                                    <h6>Building Type</h6>
                                                                </div>
                                                                <div class="cl-div-new-project-building-types-holder">
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Community/Recreation</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Community Center">
                                                                                Community Center
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Gym">
                                                                                Gym
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Pool">
                                                                                Pool
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Sports Complex">
                                                                                Sports Complex
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Cultural</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Attractions(e.g.,zoo)">
                                                                                Attractions(e.g.,zoo)
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Library">
                                                                                Library
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Museum/Gallery">
                                                                                Museum/Gallery
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Visitor Center">
                                                                                Visitor Center
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Educational</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="College/University">
                                                                                College/University
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="K-12">
                                                                                K-12
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Preschool/Daycare">
                                                                                Preschool/Daycare
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Food Service</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Banquet Facility">
                                                                                Banquet Facility
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Cafeteria">
                                                                                Cafeteria
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Fast Food">
                                                                                Fast Food
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Restaurant/Cafe/Bar">
                                                                                Restaurant/Cafe/Bar
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Healthcare</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Clinic/Outpatient/Medical Offices">
                                                                                Clinic/Outpatient/Medical Offices
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Hospital">
                                                                                Hospital
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Nursing home/Assisted Living">
                                                                                Nursing home/Assisted Living
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Industrial</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Manufacturing">
                                                                                Manufacturing
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Power Stations/Plants">
                                                                                Power Stations/Plants
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Lodging</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Dormitory">
                                                                                Dormitory
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Hotal/Motel/Inn">
                                                                                Hotal/Motel/Inn
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Office</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Administrative/Professional">
                                                                                Administrative/Professional
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Government">
                                                                                Government
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Public Assembly</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Convention Center">
                                                                                Convention Center
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Entertainment(e.g.,concert hall)">
                                                                                Entertainment(e.g.,concert hall)
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Stadium/Arena">
                                                                                Stadium/Arena
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Public Safety</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Police Station">
                                                                                Police Station
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Fire Hall">
                                                                                Fire Hall
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Retail</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Bank Branch">
                                                                                Bank Branch
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Convenience Store">
                                                                                Convenience Store
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Grocery Store/Food Market">
                                                                                Grocery Store/Food Market
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Large Retail Store">
                                                                                Large Retail Store
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Shopping Mall/Small Retail">
                                                                                Shopping Mall/Small Retail
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Store/Boutique">
                                                                                Store/Boutique
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cl-div-new-project-building-type-sub-container">
                                                                        <span class="cl-div-new-project-building-type-sub-header">Warehouse</span>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="General">
                                                                                General
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Data Center">
                                                                                Data Center
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Distribution/Shipping">
                                                                                Distribution/Shipping
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" value="Self-Storage Units">
                                                                                Self-Storage Units
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="id-div-new-project-button-container">
                                                                <input type="button" class="btn btn-primary" id="id-btn-new-project-submit" text="Save" value="Save"/>
                                                                <input type="button" class="btn btn-primary" id="id-btn-new-project-clear" text="Clear" value="Clear"/>
                                                            </div>
                                                        </div>
                                                        <div id="id-div-new-project-progress" class="hide">
                                                            <div class="col-md-4 cl-new-project-progress-tbl-div-left" ><i class="fa" id="id-div-new-project-progress-icon"></i></div>
                                                            <div class="col-md-6 cl-new-project-progress-tbl-div-right"><span id="id-div-new-project-progress-msg" >SUCCESS</span></div>
                                                            <div class="col-md-2 cl-new-project-progress-tbl-div-right"><a href="projectDashboard.php"><img id="id-div-new-project-progress-link" src="images/manage_inactive.png"></img></a></div>
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
    <script src="JS/project.min.js"></script>

</body>

</html>