 <?php
    include_once("CUtil.php");
  ?>      
        
        <section id="id-section-banner">
            <div>
                <div id="banner">
                    <div id="id-div-banner-site-banner">
                        <div>
                            <a href="index.php"><img id="site-header" src="images/header.png" data-src="images/header.png" alt="isUD logo with an infographic rendering showing people of different abilities in a an outdoor environment" /></a>
                            <script>
                                if(document.documentElement.clientWidth < 768){
                                    document.getElementById("site-header").src = "images/header_mobile.png";
                                }
                            </script>
                        </div>
                        <div id="id-div-site-navigation">
                            <div id="id-div-mobile-nav">
                                <div id="id-div-mobile-nav-icon-holder">
                                    <div class="fa-stack fa-lg btn">
                                        <i class="fa fa-square-o fa-stack-2x"></i>
                                        <i class="fa fa-bars fa-stack-1x" aria-hidden="true" title="menu"></i>
                                    </div>
                                </div>
                                <div id="id-div-mobile-nav-text-holder">
                                    <span><?php
                                                $s = substr(ucfirst($includerFile),0,strpos($includerFile,"."));
                                                $s = ($s === "Index" ? "Home" : $s );
                                                $s = ($s === "Solutions_l" ? "Solutions" : $s );
                                                echo ($s);

                                                // Util::getEncodedFileName("");
                                                // echo("<!--");
                                                // echo(Util::getEncodedFileName(".htaccess"));
                                                // echo(Util::$fileNameRemapper[".htaccess"]);
                                                // //var_dump(Util::$file);
                                                // // var_dump(Util::$file);
                                                // echo("-->");
                                                
                                          ?>
                                    </span>
                                </div>
                            </div>
                            <div id="id-nav-holder-right">
                                <ul class="cl-nav-cus nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link <?php echo($includerFile === "index.php"? ' active': '');?>" href="index.php"><span>Home</span></a></li>
                                        <li class="nav-item"><a class="nav-link <?php echo($includerFile === "about.php"? ' active': '');?>" href="about.php"><span>About</span></a></li>
                                        <li class="nav-item"><a class="nav-link <?php echo($includerFile === "instructions.php"? ' active': '');?>" href="instructions.php"><span>Instructions</span></a></li>
                                        <li class="nav-item"><a class="nav-link <?php echo($includerFile === "solutions.php"? ' active': '');?>" href="solutions.php"><span>Solutions</span></a></li>
                                        <li class="nav-item"><a class="nav-link <?php echo($includerFile === "contact.php"? ' active': '');?>" href="contact.php"><span>Contact</span></a></li>
                                        <?php
                                            echo("<!-- Logged in : ".isLoggedIn()." includer : ".$includerFile);
                                            echo("  -->");
                                            
                                            if(!isLoggedIn()){ 
                                                echo ('<li class="nav-item" id="id-li-logout-dropdown-container"><a class="nav-link" href="register.php"><span>Login</span></a></li>');
                                            } else {
                                                    echo ('<li class="nav-item dropdown">'.
                                                            '<div class="nav-link " id="id-logout-dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog fa-fw fa-2x" aria-hidden="true"></i></div>'.
                                                            '<div class="dropdown-menu" aria-labelledby="id-logout-dropdown">'.
                                                                '<div class="dropdown-item" id="id-dropdown-item-editprofile" href="#"><span>Edit Profile</span><i class="pull-right fa fa-pencil fa-fw" aria-hidden="true"></i></div>'.
                                                                '<div class="dropdown-item" id="id-dropdown-item-logout" href="#"><span>Logout</span><i class="pull-right fa fa-share fa-fw" aria-hidden="true"></i></div>'.
                                                            '</div>'.
                                                        '</li>');
                                            }
                                        ?>
                                </ul>
                                <?php
                                    $s = substr(ucfirst($includerFile),0,strpos($includerFile,"."));
                                    if($s === "Solutions_l" || $s === "AdminSolution"){
                                        echo('<div class="cl-div-nav-image-holder">
                                        <a href="projectDashboard.php"><img id="id-img-navbar-p-manage" src="images/manage_inactive.png"/></a>
                                        <a href="#"><img id="id-img-navbar-p-solutions" src="images/solutions_inactive.png"/></a>
                                        <a href="#"><img id="id-img-navbar-p-upload" src="images/upload_inactive.png"/></a>
                                        </div>
                                        <div class="cl-div-nav-project-award-details-holder">
                                            <div class="cl-div-project-award-credit-details">
                                                <div class="cl-div-project-award-credit-title-holder">
                                                    <span class="cl-span-project-award-credit-title">Total Credits</span>
                                                </div>
                                                <div class="cl-div-project-award-credit-value-holder">
                                                    <div class="cl-div-project-award-credit-item-holder" id="id-div-project-award-credit-earned">
                                                        <span class="cl-span-project-award-credit-item-title">Earned</span>
                                                        <span class="cl-span-project-award-credit-item-value">0</span>
                                                    </div>
                                                    <div class="cl-div-project-award-credit-item-holder" id="id-div-project-award-credit-available">
                                                        <span class="cl-span-project-award-credit-item-title">Available</span>
                                                        <span class="cl-span-project-award-credit-item-value">100</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cl-div-project-award">
                                                <div class="cl-div-project-award-title-holder">
                                                    <span class="cl-span-project-award-credit-title"></span>
                                                </div>
                                                <div class="cl-div-project-award-progress-container" id="id-div-project-award-progress-container"></div>                                                                    
                                            </div>
                                        </div>');
                                    }
                                ?>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
