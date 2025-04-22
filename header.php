<!-- This looks really, really great!  -Thomas -->

<?php
/*
 * Copyright 2013 by Allen Tucker. 
 * This program is part of RMHP-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */
?>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>

<header>

    <?PHP
    //Log-in security
    //If they aren't logged in, display our log-in form.
    $showing_login = false;
    if (!isset($_SESSION['logged_in'])) {
        echo '
            <nav>
                <div class="nav-left">
                    <span id="nav-top"><span class="logo"><img class="nami-logo" src="images/logoLong.jpg"></span>
                </div>
                <div class="nav-right">
                    <ul>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="logout-logo" src="images/logout.svg" alt="logout"></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="login.php">Log in</a>
                        </div>
                        </li>
                    </ul>
                </div>
            </nav>';

    } else if ($_SESSION['logged_in']) {

        /*         * Set our permission array.
         * anything a guest can do, a volunteer and manager can also do
         * anything a volunteer can do, a manager can do.
         *
         * If a page is not specified in the permission array, anyone logged into the system
         * can view it. If someone logged into the system attempts to access a page above their
         * permission level, they will be sent back to the home page.
         */
        //pages guests are allowed to view
        // LOWERCASE
        $permission_array['index.php'] = 0;
        $permission_array['about.php'] = 0;
        $permission_array['apply.php'] = 0;
        $permission_array['logout.php'] = 0;
        $permission_array['register.php'] = 0;
        $permission_array['findanimal.php'] = 0;
        $permission_array['pending.php'] = 0;
        //pages volunteers can view
        $permission_array['help.php'] = 1;
        $permission_array['dashboard.php'] = 1;
        $permission_array['calendar.php'] = 1;
        $permission_array['eventsearch.php'] = 1;
        $permission_array['changepassword.php'] = 1;
        $permission_array['editprofile.php'] = 1;
        $permission_array['inbox.php'] = 1;
        $permission_array['date.php'] = 1;
        $permission_array['event.php'] = 1;
        $permission_array['viewprofile.php'] = 1;
        $permission_array['viewnotification.php'] = 1;
        $permission_array['volunteerreport.php'] = 1;
        $permission_array['viewmyupcomingevents.php'] = 1;
        $permission_array['inactivedash.php'] = 1;
        //pages only managers can view
        $permission_array['viewallevents.php'] = 0;
        $permission_array['personsearch.php'] = 2;
        $permission_array['personedit.php'] = 0; // changed to 0 so that applicants can apply
        $permission_array['viewschedule.php'] = 2;
        $permission_array['addweek.php'] = 2;
        $permission_array['log.php'] = 2;
        $permission_array['reports.php'] = 2;
        $permission_array['eventedit.php'] = 2;
        $permission_array['modifyuserrole.php'] = 2;
        $permission_array['addevent.php'] = 2;
        $permission_array['editevent.php'] = 2;
        $permission_array['roster.php'] = 2;
        $permission_array['report.php'] = 2;
        $permission_array['reportspage.php'] = 2;
        $permission_array['resetpassword.php'] = 2;
        $permission_array['addappointment.php'] = 2;
        $permission_array['addanimal.php'] = 2;
        $permission_array['addservice.php'] = 2;
        $permission_array['addlocation.php'] = 2;
        $permission_array['viewservice.php'] = 2;
        $permission_array['viewlocation.php'] = 2;
        $permission_array['viewarchived.php'] = 2;
        $permission_array['animal.php'] = 2;
        $permission_array['editanimal.php'] = 2;
        $permission_array['eventsuccess.php'] = 2;
        $permission_array['viewsignuplist.php'] = 2;
        $permission_array['vieweventsignups.php'] = 2;
        $permission_array['viewalleventsignups.php'] = 2;
        $permission_array['resources.php'] = 2;
        $permission_array['edithours.php'] = 2;
        $permission_array['edithours.php'] = 2;
        $permission_array['eventlist.php'] = 1;
        $permission_array['eventsignup.php'] = 1;
        $permission_array['eventfailure.php'] = 1;
        $permission_array['signupsuccess.php'] = 1;
        $permission_array['edittimes.php'] = 1;
        $permission_array['adminviewingevents.php'] = 2;
        $permission_array['signuppending.php'] = 1;
        $permission_array['requestfailed.php'] = 1;
        $permission_array['settimes.php'] = 1;
        $permission_array['eventfailurebaddeparturetime.php'] = 1;
        $permission_array['emaillist.php'] = 2;
        $permission_array['viewforms.php'] = 0;
        $permission_array['editform.php'] = 0;
        $permission_array['deletevolunteer.php'] = 2;
        $permission_array['volunteerdenied.php'] = 2;
        $permission_array['editvolunteer.php'] = 2;
        $permission_array['generatereport.php'] = 2;
        $permission_array['addblacklist.php'] = 2;
        $permission_array['blacklist.php'] = 2;
        $permission_array['searchblacklist.php'] = 2;
        $permission_array['addminutes.php'] = 2;
		$permission_array['editminutes.php'] = 2;
        $permission_array['searchminutes.php'] = 2;
        $permission_array['minutes.php'] = 2;
		$permission_array['selectminutes.php'] = 2;
    	$permission_array['pending_volunteers.php'] = 2;
    	$permission_array['hours.php'] = 1;
		$permission_array['loghours.php'] = 1;
		$permission_array['approvehours.php'] = 2;
		$permission_array['viewhours.php'] = 1;
		$permission_array['announcement.php'] = 2;
		$permission_array['deletehours.php'] = 2;
		$permission_array['formsearch.php'] = 2;
		$permission_array['volunteerdirectory.php'] = 2;
		$permission_array['displaycurrentvolunteers.php'] = 2;
		$permission_array['createform.php'] = 2;
        $permission_array['sendmessages.php'] = 2;
        $permission_array['emailmanager.php'] = 2;
        $permission_array['adddonors.php'] = 2;
        $permission_array['viewdonors.php'] = 2;
        $permission_array['donormanager.php'] = 2;
        $permission_array['forms.php'] = 1;


	// LOWERCASE

        //Check if they're at a valid page for their access level.
        $current_page = strtolower(substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1));
        $current_page = substr($current_page, strpos($current_page,"/"));

        if($permission_array[$current_page]>$_SESSION['access_level']){
            //in this case, the user doesn't have permission to view this page.
            //we redirect them to the index page.
            echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
            //note: if javascript is disabled for a user's browser, it would still show the page.
            //so we die().
            die();
        }
        //This line gives us the path to the html pages in question, useful if the server isn't installed @ root.
        $path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));
		$venues = array("portland"=>"RMH Portland");
        
        //they're logged in and session variables are set.
        echo('<nav>');
        echo('<style>

            nav {
                display: flex;
                flex-direction: row;
                padding: 1rem 2rem;
                justify-content: space-between;
                height: var(--header-height);
                box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
                width: 100%;
                background-color: var(--page-background-color);
                max-width: 100vw;
            }

            .nav-left,
            .nav-right {
                display: flex;
            }

            .nami-logo {
                height: 5rem;
                max-width: 100%;
            }

            .home-logo,
            .person-logo,
            .logout-logo {
                height: 2.5rem;
                cursor: pointer;
            }

            .home-logo:hover,
            .person-logo:hover,
            .logout-logo:hover {
                filter: brightness(0) saturate(100%) invert(60%) sepia(100%) saturate(500%) hue-rotate(25deg);
            }

            nav ul {
                display: inline-flex;
                flex-direction: row;
                gap: 1rem;
            }

            nav ul li a:hover {
                color: var(--accent-color);
            }

            #menu-toggle {
                display: none;
            }

            .mobile-menu {
                display: none;
            }

            .mobile-menu a {
                display: none;
            }

            /* RESPONSIVE PORTION for nav bar */
            @media only screen and (max-width: 1079px) {
                
                .nav-right {
                    display: none;
                }
  
                #menu-toggle {
                    display: block;
                }

                #menu-toggle img:hover {
                    filter: brightness(0) saturate(100%) invert(60%) sepia(100%) saturate(500%) hue-rotate(25deg);
                }
  
                .mobile-menu {
                    display: none;
                    position: absolute;
                    top: var(--header-height);
                    left: 0;
                    width: 100%;
                    background-color: var(--page-background-color);
                    padding: 1rem 2rem;
                    flex-direction: column;
                    z-index: 1000;
                    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
                }

                .mobile-menu a {
                    display: flex;
                    padding: 0.75rem 0;
                    color: var(--main-color);
                    text-decoration: none;
                    font-weight: 500;
                    border-bottom: 1px solid #ccc;
                    flex-direction: column;
                }

                .mobile-menu a:hover {
                    color: var(--accent-color);
                }
    
            }
        </style>');

        echo('<div class="nav-left">');
        echo('<span class="logo"><a class="navbar-brand" href="' . $path . 'index.php"><img class="nami-logo" src="images/logoLong.jpg"></a></span>');
        echo('</div>');

        echo('<div class="nav-right">');
            echo('<ul>');
            if ($_SESSION['access_level'] <= 3) {
                echo('<li><a class="nav-link active" aria-current="page" href="' . $path . 'index.php"><img class="home-logo" src="images/home.svg" alt="home"></a></li>');
                echo('<li class="nav-item dropdown">');
                    echo('<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="person-logo" src="images/account.svg" alt="account"></a>');
                    echo('<div class="dropdown-menu">');
                        echo('<a class="dropdown-item" href="' . $path . 'viewProfile.php">View Profile</a>');
                        echo('<a class="dropdown-item" href="' . $path . 'editProfile.php">Edit Profile</a>');
                        echo('<a class="dropdown-item" href="' . $path . 'changePassword.php">Change Password</a>');
                    echo('</div>');
                echo('</li>'); 
            }

                echo('<li class="nav-item dropdown">');
                    echo('<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="logout-logo" src="images/logout.svg" alt="logout"></a>');
                    echo('<div class="dropdown-menu">');
                        echo('<a class="dropdown-item" href="' . $path . 'logout.php">Log out</a>');
                    echo('</div>');
                echo('</li>'); 
         
            echo('</ul>');
        echo('</div>');
         
        echo('<div id="menu-toggle" class="menu-toggle" onclick="toggleMenu()">');
            echo('<img src="images/menu.svg" alt="Menu" style="height: 5rem;">');
        echo('</div>');

        echo('<div class="mobile-menu" id="mobileMenu">');
            echo('<a class="nav-link active" aria-current="page" href="' . $path . 'index.php">Home</a>');
            echo('<a class="nav-link active" aria-current="page" href="' . $path . 'viewProfile.php">View Profile</a>');
            echo('<a class="nav-link active" aria-current="page" href="' . $path . 'editProfile.php">Edit Profile</a>');
            echo('<a class="nav-link active" aria-current="page" href="' . $path . 'changePassword.php">Change Password</a>');
            echo('<a class="nav-link active" aria-current="page" href="' . $path . 'logout.php">Log out</a>');
        echo('</div>');

        echo('<script>');
        echo('function toggleMenu() {const menu = document.getElementById(\'mobileMenu\'); menu.style.display = (menu.style.display === \'flex\') ? \'none\' : \'flex\';}');
        echo('</script>');
        
    }
    ?>
</header>