<?php
    include_once("CUserSession.php");
    include_once("CUtil.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Instructions - isUD™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="innovative solutions for Universal Design(isUD™) offers resources and services to support and recognize adopters of universal design. isUD™ provides an interactive platform for browsing innovate solutions for UD, reference designs for designers and design resources that summarize the state of knowledge on a variety of topics related to UD.">
    <meta name="keywords" content="inclusive design, universal design, accessibility, ada, barrier free design, wayfinding, anthropometry, design for all, diversity, wheelchair">
    <meta name="copyright" content="innovative solutions for Universal Design is a product of the University at Buffalo, Center for Inclusive Design and Environmental Access. All rights reserved.">
    <meta name="dcterms.rightsHolder" content="The University at Buffalo, Center for Inclusive Design and Environmental Access.">

    <meta property="og:title" content="Instructions - isUD™" />
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
                            <div id="instructions">
                                <div>
                                    <div class="col-md-8">
                                        <div class="cl-div-site-breadcrumb">
                                            <span class="cl-span-site-breadcrumb-title">Instructions</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 thick-border-light pull-right cl-div-search-box">
                                        <span>Search</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-8">
                                        <div class=" cl-div-instructions-holder">
                                            <h6>Solutions</h6>
                                            <p>
                                                Users must create a free account to access the <b><i>innovative solutions for Universal Design (isUD™)</i></b>. 
                                                The solutions are organized into nine chapters. Many of the solutions contain supporting information 
                                                including drawings, photographs, and best practices that provide easy references for designers.  
                                                A <i class="fa fa-picture-o" title="picture icon"></i> next to a solution indicates that supporting information is available. Each solution also indicates 
                                                applicable Goals of Universal Design and phases of building project (i.e., Initiate, Schematic Design, 
                                                Design Development, Specifications, and Operations). A <i class="fa fa-file-text" title="file icon"></i> 
                                                next to a subheading indicates that a Design Resource is available. Design Resources exist at the subheading level and 
                                                summarize the state of knowledge in a variety of fields such as anthropometry of wheeled mobility, 
                                                wayfinding technologies, etc.
                                            </p>

                                            <h6>Modes</h6>
                                            <p>
                                                isUD&#8482; is available in two different modes: (1) Browse Mode and (2)
                                                Project Mode. In Browse Mode, users can view the solutions, supporting information, and
                                                design resources. In Project Mode (under development) users will be able to create a
                                                project, customize the solutions list to remove those not applicable to their project,
                                                select solutions they wish to implement, and save their selections for future use. Users
                                                will also be able to keep track of their score (i.e., credits), self-certify, and apply in the
                                                future for third party certification (see below).
                                            </p>

                                            <h6 id="credits">Credits (under development)</h6>
                                            <div>
                                                <p>
                                                    <b>Earning Credit</b> — Each chapter has several sections and subsections that list
                                                    several <i>innovative solutions for Universal Design</i>. The number of credits earned
                                                    measures the degree to which universal design is included in a project. Credit is earned
                                                    by implementing the stated number of solutions in each section or subsection. For
                                                    example, a section states, “2 Credits: Implement 4 of 7 | 1 Credit: Implement 3 of 7.”
                                                    Sometimes, implementing one solution automatically counts toward a second solution.
                                                    For example, implementing the solution, “clear floor spaces … are at least 34 inches
                                                    wide …” also means they are “at least 32 inches wide.” Thus, both solutions count
                                                    toward the minimum necessary to earn the 2 credits available in this section. There are
                                                    100 regular <i>credits</i> available, plus up to 10 <i>bonus credits</i> and 10 <i>innovation credits</i>.
                                                </p>
                                                <p>
                                                    <b>Bonus Credits</b> — The purpose of <i>bonus credits</i> is to reward projects that implement
                                                    some solutions, even if not enough credits are earned for a particular section, and to
                                                    encourage designing beyond the minimum number of solutions needed to earn the
                                                    assigned credit. If a project implements some solutions in a section, but not enough to
                                                    earn the <i>credit</i> for that section, the solutions used will count towards <i>bonus credit</i>.
                                                    Similarly, if a project implements more solutions than necessary to earn the <i>credit</i> for
                                                    that sections, the solutions implemented in excess of the minimum will also count
                                                    towards <i>bonus credit</i>. One bonus credit is awarded for every five extra solutions
                                                    implemented, for a maximum of 10 bonus credits.
                                                </p>
                                                <p>
                                                    <b>Innovation Credits</b> — <i>Innovation credits</i> can be earned for implementing innovative solutions
                                                    developed by the designers that are not found in the isUD&#8482;. One <i>innovation credit</i> is awarded
                                                    for every five documented solutions implemented in any project, for a maximum of
                                                    10 <i>innovation credits</i>. Stay tuned for details on how to submit <i>innovation credits</i>.
                                                </p>
                                                <p>
                                                    <b>Prerequisites</b> — Certain solutions are marked as a <i>prerequisite</i>. If a section is applicable, then
                                                    all <i>prerequisites</i> must be implemented to earn any <i>credit</i> or <i>bonus credit</i> for that section,
                                                    regardless of the number of other solutions implemented. Prerequisites are essential features for achieving 
                                                    universal design.
                                                </p>
                                                <p>
                                                    <b>Applicable Credits</b> — Every project is different, thus for some projects it may not be possible to
                                                    earn certain credits because such features may not exist in a particular building. For example, a
                                                    restaurant does not likely have sleeping rooms. For any section that is not applicable, the credits
                                                    for that section are subtracted from the total available credits. Users will be responsible for
                                                    deciding which sections are not applicable to their project. However, some sections will apply
                                                    automatically, such as toilet and bathing rooms. Other sections are linked together so that one
                                                    applicable section triggers another section. For example, locker rooms are automatically
                                                    applicable if exercise spaces apply. When the scoring section is fully operable, the user will establish a
                                                    building profile that will automatically generate a list of applicable sections, although it
                                                    will be possible to customize the list.
                                                </p>
                                                <p>
                                                    <b>Scope</b> — Often, an entire space or element occurs multiple times in a building. For example,
                                                    toilet and bathing rooms, sleeping rooms, and workstations may repeat many times in a
                                                    building. Unless otherwise specified, each solution listed applies to all elements in the space. For
                                                    example, the solution, “Lavatories have automatic faucets, or are operated following a common
                                                    conceptual model”, does not specify a number of lavatories. Thus, all lavatories in the restroom
                                                    must have either an automatic faucet or one that follows a common conceptual model.
                                                    Conversely, the solution, “Selected lavatories and counters are adjustable in height,” has a more
                                                    narrow scope. It allows the designer to select certain lavatories and counters to be adjustable in
                                                    height. The selection process must be intentional and equitable. For example, a feature cannot
                                                    be “selected” to be in only Men’s toilet rooms. Other solutions might specify, “at least one,” or
                                                    &quot;at least 50%.” If the scope of the solution is unclear, assume it applies to “all.”
                                                </p>
                                                <p>
                                                    <b>Scoring</b> — A score is computed by dividing the total <i>credits</i> earned (including <i>bonus
                                                    credits</i> and <i>innovation credits</i>) by the total applicable credits (not including <i>bonus
                                                    credits</i> and <i>innovation credits</i>). Projects with scores over a certain threshold (to be
                                                    determined) will be recognized for their achievement through certification. In future
                                                    versions, achievement levels will be established to distinguish projects with
                                                    exceptionally high <i>scores</i>.  
                                                </p>
                                            </div>

                                            <h6 id="certification">Certification Program (under development)</h6>
                                            <p>
                                                Different types of certification will be available. The first type will be self-certification
                                                through use of the isUD&#8482; scoring interface. There will also be two types of third party
                                                certification. One will require an onsite audit of a project to provide proof that the
                                                building actually was constructed as planned. A second will be based on a post
                                                occupancy evaluation conducted by the IDeA Center. The intent of such evaluations is
                                                to provide feedback for improving the solutions and collect evidence on the benefits of
                                                universal design. Both types of third party certification will recognize different levels of
                                                achievement.
                                            </p>
                                            <p>
                                                While the certification program is not yet available, follow these criteria to
                                                understand the projects that will be eligible. This will put you in a good position to apply
                                                when the program is launched.
                                            </p>
                                            <div>
                                                <p>
                                                    <b>Applicability and Eligibility</b> — The solutions are designed for use in newly constructed or
                                                    renovated public buildings or public accommodations. The solutions may apply to other
                                                    project types (e.g., housing); however, these other project types will not be eligible for
                                                    certification until we have expanded the site to include other building types. To be
                                                    eligible for certification, the project development team must certify to the best of their
                                                    knowledge that the project meets all applicable federal, state, and local building
                                                    regulations. Implementing the solutions and/or the issuance of isU&#8482; certification will
                                                    not in any way signify a claim, warranty, guarantee, or certify compliance with any
                                                    federal, state, and/or local laws, regulations, standards, or codes.
                                                </p>
                                                <p>
                                                    <b>New Work, Additions, and Alterations</b> — Certification will be issued to new projects and
                                                    existing buildings. To ensure that certification recognizes only universal design
                                                    practices, it is important that projects receiving certification clearly identify the portions
                                                    of a facility seeking recognition. In new construction, certification will recognize the
                                                    entire facility. In new buildings on existing sites, certification will apply to the new
                                                    building only. Additions to existing buildings must have a clear separation between it
                                                    and the existing building to be eligible. This is best accomplished by a physical
                                                    separation such as a breezeway connecting the new and old buildings, and naming
                                                    each building separately. Signs, graphics, and finishes may also make the distinction
                                                    clear. If there is no clear separation between the new and old building, or if the project
                                                    involves only alterations to an existing building, then the entire building or site must
                                                    implement isUD&#8482; to be considered for certification. Single rooms, spaces, or elements
                                                    will not be considered. Even though a single space may not be eligible, we encourage
                                                    implementing the solutions in any project because UD benefits all people and future
                                                    alterations may eventually qualify the entire building.
                                                </p>
                                                <p>
                                                    <b>Project Breadth</b> — The solutions for public and commercial buildings are intended as a
                                                    holistic document to ensure universal design in public buildings and public
                                                    accommodations. They are not intended to provide guidance on the design of stand-
                                                    alone products or spaces, but instead to ensure that the sum of these parts result in the
                                                    universal design of a larger facility. Thus, some projects may not have the breadth
                                                    required to qualify for certification. For example, there are solutions available for
                                                    transaction machines and play areas. The design of a single transaction machine or
                                                    play area would require more guidance than these solutions alone can provide and
                                                    would result in too few available <i>credits</i> to justify certification. Generally, a project must
                                                    have earned applicable <i>credits</i> in at least five chapters to be eligible. In future versions,
                                                    a minimum applicable <i>credit</i> threshold will ensure the project breadth is commensurate
                                                    with the intent of the solutions.
                                                </p>
                                            </div>

                                            <h6>Graphics and Definitions</h6>
                                            <div>
                                                <p>
                                                    <b>Graphic Conventions</b> — Where specific solutions differ from more general solutions, the specific
                                                    solutions shall apply.
                                                </p>
                                                <p>
                                                    <b>Dimensions</b> — Dimensions that are not stated as “maximum” or “minimum” are absolute. All
                                                    dimensions are subject to conventional industry tolerances.
                                                </p>
                                                <p>
                                                    <b>Figures</b> — Figures included herein are considered part of the solutions. Standard graphic
                                                    conventions apply. A table is under development for the most commonly used graphic
                                                    conventions.
                                                </p>
                                                <p>
                                                    <b>Referenced Documents</b> — Referenced documents shall be considered part of the solutions to the
                                                    prescribed extent of each such reference. Where solutions differ from specifications of these
                                                    referenced documents, the most stringent shall apply.
                                                </p>
                                                <p class="cl-no-margin-bot">
                                                    <b>Definitions</b>
                                                </p>
                                                <div>
                                                    <p class="cl-no-margin-bot">
                                                        Singular and Plural Words, Terms, and Phrases — Words, terms, and phrases used in the
                                                        singular include the plural, and those used in the plural include the singular.
                                                    </p>
                                                    <p class="cl-no-margin-bot">
                                                        Undefined Terms — The meaning of terms not specifically defined shall be as defined by
                                                        collegiate dictionaries in the sense that the context implies.
                                                    </p>
                                                    <p class="cl-no-margin-bot">
                                                        Defined Terms — A definition will appear on screen when the cursor hovers over an
                                                        italicized term on the solutions page. Definitions are still under development.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pull-right">
                                        <img class="cl-img-search-bottom" data-src="images/greinerhall_1.png" alt="Exterior view of Greiner Hall on the University at Buffalo's North Campus">
                                        <div class="cl-div-search-bottom-img-caption"><span>Exterior view of Greiner Hall on the University at Buffalo's North Campus</span></div>
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