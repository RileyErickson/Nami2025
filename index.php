<?php
    session_cache_expire(30);
    session_start();

    date_default_timezone_set("America/New_York");
    if (!isset($_SESSION['access_level']) || $_SESSION['access_level'] < 1) {
        if (isset($_SESSION['change-password'])) {
            header('Location: changePassword.php');
        } 
        elseif(isset($_SESSION['_id'])){
            header('Location: pending.php');
        }
        else {
            header('Location: login.php');
        } 
        die();
    }
        
    include_once('database/dbPersons.php');
    include_once('domain/Person.php');
    // Get date?
    if (isset($_SESSION['_id'])) {
        $person = retrieve_person($_SESSION['_id']);
    }
    $notRoot = $person->get_id() != 'vmsroot';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require('universal.inc'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <title>NAMI Rappahannock Volunteer System | Dashboard</title>
    </head>
    <body>
        <?php 
        require('header.php'); ?>
        <?php
        
    $announcementFile = 'announcement.txt';
    if (file_exists($announcementFile)) {
        $announcementText = trim(file_get_contents($announcementFile));
        if (!empty($announcementText)) {
          echo "<div style='background-color: #ffdddd; color: #a33; border: 1px solid #a33; padding: 10px 20px; margin: 10px 20px; font-weight: bold;'>
                 <strong>Announcement:</strong><br>" . nl2br(htmlspecialchars($announcementText)) . "
               </div>";
        }
}
?>
        <br>
        <p style="font-size: 45px; color: #0c499c; text-align: left; padding-left: 50px"><b>Welcome back, <?php echo $person->get_first_name() ?>!</b></p>
        <p  style="font-size: 20px;  color: #0c499c; text-align: left; padding-left: 50px">Today is <?php echo date('l, F j, Y'); ?>.</p>
        <br>

            
            <?php if (isset($_GET['pcSuccess'])): ?>
                <div class="happy-toast">Password changed successfully!</div>
            <?php elseif (isset($_GET['deleteService'])): ?>
                <div class="happy-toast">Service successfully removed!</div>
            <?php elseif (isset($_GET['serviceAdded'])): ?>
                <div class="happy-toast">Service successfully added!</div>
            <?php elseif (isset($_GET['animalRemoved'])): ?>
                <div class="happy-toast">Animal successfully removed!</div>
            <?php elseif (isset($_GET['locationAdded'])): ?>
                <div class="happy-toast">Location successfully added!</div>
            <?php elseif (isset($_GET['deleteLocation'])): ?>
                <div class="happy-toast">Location successfully removed!</div>
            <?php elseif (isset($_GET['registerSuccess'])): ?>
                <div class="happy-toast">Volunteer registered successfully!</div>
            <?php endif ?>



<!--                  <?php
                    require_once('database/dbMessages.php');
                    $unreadMessageCount = get_user_unread_count($person->get_id());
                    $inboxIcon = 'inbox.svg';
                    if ($unreadMessageCount) {
                        $inboxIcon = 'inbox-unread.svg';
                    }
                    
                ?>
                
                <div class="dashboard-item" data-link="inbox.php">
                    <img src="images/<?php echo $inboxIcon ?>">
                    <span>Notifications<?php 
                        if ($unreadMessageCount > 0) {
                            echo ' (' . $unreadMessageCount . ')';
                        }
                    ?></span>
                </div>

                <div class="dashboard-item" data-link="viewAllEvents.php">
                    <img src="images/new-event.svg">
                    <span>Sign-Up for Event</span>
                </div> -->

                
                <!-- ADMIN ONLY -->
                <?php if ($_SESSION['access_level'] >= 3): ?>

                <div class="top-bar">

                    <a href="volunteerDirectory.php" class="clickable-box">
                        <div class="highlight">
                            <span class="box-text">Volunteer Management</span>
                            <img src="images/highlight_background.jpg" alt="highlight" />
                        </div>
                    </a>

                    <a href="hours.php" class="clickable-box">
                        <div class="highlight">
                            <span class="box-text">Hours Management</span>
                            <img src="images/highlight_background.jpg" alt="highlight" />
                        </div>
                    </a>

                </div>

                <main class='dashboard'>

                    <p style="font-size: 45px; color: #0c499c; text-align: left; padding-left: 50px; padding-top: 20px; padding-right: 0px;"><b>Dashboard</b></p>

                    <div id="dashboard">

                        <div class="dashboard-item" data-link="viewForms.php">
                            <i class="fa-solid fa-list"></i>
                            <span>View Forms</span>
                        </div>

                        <div class="dashboard-item" data-link="formSearch.php">
                            <img src="images/emailList.png">
                            <span>Search Forms</span>
                        </div>

<!--                    <div class="dashboard-item" data-link="register.php">-->
<!--                        <img src="images/add-person.svg">-->
<!--                        <span>Register Volunteer</span>-->
<!--                    </div>-->
<!---->
<!---->
                    <!--Pending Volunteers-->
<!--                    <div class="dashboard-item" data-link="pending_volunteers.php">-->
<!--                        <i class="fa-solid fa-users"></i>-->
<!--                        <span>Pending Volunteers</span>--><?php
//                        require_once('database/dbEvents.php');
//                        require_once('database/dbPersons.php');
//                        $pending = pendingperson($notRoot);
//                        //$pending = all_pending_names();
//                        if (sizeof($pending) > 0) {
//                            echo ' (' . sizeof($pending) . ')';
//                        }
//                        ?>
<!--                    </div>-->
<!---->
<!--                    <div class="dashboard-item" data-link="deleteVolunteer.php">-->
<!--                        <img src="images/removeVolunteer.svg">-->
<!--                        <span><center>Remove Volunteer</center></span>-->
<!--                    </div>-->
<!---->
<!---->
<!---->
<!--                    <div class="dashboard-item" data-link="editVolunteer.php">-->
<!--                        <img src="images/editVolunteer.png">-->
<!--                        <span><center>Edit Volunteer Profile</center></span>-->
<!--                    </div>-->
<!---->
<!--                    <div class="dashboard-item" data-link="personSearch.php">-->
<!--                        <img src="images/person-search.svg">-->
<!--                        <span><center>Search Volunteer Details</center></span>-->
<!--                    </div>-->
                    <!-- add some sort of search capability to this -->
                    <!-- could use adminViewingEvents.php as base? -->
<!--                    <div class="dashboard-item" data-link="blacklist.php">-->
<!--                        <img src="images/volunteerDenied.png">-->
<!--                        <span><center>View Volunteer Denied List</center></span>-->
<!--                    </div>-->

                    
                                         <!-- get link to guide -->
                        <div class="dashboard-item" data-link="https://docs.google.com/document/d/1WmSks4xxZgkmTgTRkqziBNb2G9J8lz1brWqgWSS0Nps/edit?tab=t.0">
                            <img src="images/staffGuide.png">
                            <span><center>Access Staff and Affiliate Guide</center></span>
                        </div>
                    
                        <div class="dashboard-item" data-link="https://www.namirapp.org/#calendar">
                            <img src="images/view-calendar.svg">
                            <span><center>View Calendar</center></span>
                        </div>

                    <!-- do we want to have general report page first and then choose type of report -->
                        <div class="dashboard-item" data-link="generateReport.php">
                            <img src="images/generateReports.png">
                            <span><center>Generate Reports</center></span>
                        </div>

                        <div class="dashboard-item" data-link="emailList.php">
                            <img src="images/emailList.png">
                            <span><center>Email List Generation</center></span>
                        </div>

                        <div class="dashboard-item" data-link="minutes.php">
                            <img src="images/minutes.svg">
                            <span><center>Minutes</center></span>
                        </div>
                        <div class="dashboard-item" data-link="">
                            <img src="images/csv.png">
                            <span><center>Download CSV Data File</center></span>
                        </div>
		    
		                <div class="dashboard-item" data-link="announcement.php">
                            <img src="images/volunteer-history.svg">
                            <span><center>Announcements</center></span>
                        </div>

                        <div class="dashboard-item" data-link="changePassword.php">
                            <img src="images/change-password.svg">
                            <span><center>Change Password</center></span>
                        </div>
                    
                    </div>
                
                </main>

<!--                --><?php //endif ?>

                <!-- FOR VOLUNTEERS AND PARTICIPANTS ONLY -->
                <?php elseif ($notRoot) : ?>
                    <main class='dashboard'>
                        <div id="dashboard">
                            <div class="dashboard-item" data-link="viewForms.php">
                                <img src="images/viewforms.png">
                                <span><center>View Forms</center></span>
                            </div>
                            <div class="dashboard-item" data-link="https://docs.google.com/document/d/18IXHfsIesFVmo1fnPSZmimUZqvEymKUG1xr3fhEaa_k/edit?tab=t.0">
                                <img src="images/staffGuide.png">
                                <span><center>Access Volunteer Handbook</center></span>
                            </div>
                            <div class="dashboard-item" data-link="minutes.php">
                                <img src="images/minutes.svg">
                                <span><center>Minutes</center></span>
                            </div>
                            <div class="dashboard-item" data-link="viewProfile.php">
                                <img src="images/view-profile.svg">
                                <span><center>View Profile</center></span>
                            </div>
                            <div class="dashboard-item" data-link="editProfile.php">
                                <img src="images/manage-account.svg">
                                <span><center>Edit Profile</center></span>
                            </div>
                            <div class="dashboard-item" data-link="viewMyUpcomingEvents.php">
                                <i class="fa-solid fa-list"></i>
                                <span><center>My Upcoming Events</center></span>
                            </div>
                            <div class="dashboard-item" data-link="volunteerReport.php">
                                <img src="images/volunteer-history.svg">
                                <span><center>View Volunteering Report</center></span>
                            </div>
                            <div class="dashboard-item" data-link="editHours.php">
                                <img src="images/add-person.svg">
                                <span><center>View & Change My Event Hours</center></span>
                            </div>
                            <div class="dashboard-item" data-link="changePassword.php">
                                <img src="images/change-password.svg">
                                <span><center>Change Password</center></span>
                            </div>
                        </div>
                    </main>
                <?php endif ?>
                <!-- autoredirects home as volunteer currently -->
                <!-- <div class="dashboard-item" data-link="editHours.php">
                        <img src="images/add-person.svg">
                        <span>View & Change Event Hours</span>
                </div> -->
    </body>
	<?php require('footer.php'); ?>
</html>