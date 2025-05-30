<?php
    session_cache_expire(30);
    session_start();

    date_default_timezone_set("America/New_York");

    // Ensure user is logged in
    if (!isset($_SESSION['access_level']) || $_SESSION['access_level'] < 1) {
        header('Location: login.php');
        die();
    }

    // Redirect to current month
    if (!isset($_GET['month'])) {
        $month = date("Y-m");
    } else {
        $month = $_GET['month'];
    }
    
    $year = substr($month, 0, 4);
    $month2digit = substr($month, 5, 2);

    $today = strtotime(date("Y-m-d"));

    $first = $month . '-01';
    // Convert to date
    $month = strtotime($month);
    // Find first day of the month
    $first = strtotime($first);
    // Find previous and next month
    $previousMonth = strtotime(date('Y-m', $month) . ' -1 month');
    $nextMonth = strtotime(date('Y-m', $month) . ' +1 month');
    // Validate; redirect if bad arg given
    if (!$month) {
        header('Location: calendar.php?month=' . date("Y-m"));
        die();
    }
    $calendarStart = $first;
    // Back up until we find the first Sunday that should appear on the calendar
    while (date('w', $calendarStart) > 0) {
        $calendarStart = strtotime(date('Y-m-d', $calendarStart) . ' -1 day');
    }
    $calendarEnd = date('Y-m-d', strtotime(date('Y-m-d', $calendarStart) . ' +34 day'));
    $calendarEndEpoch = strtotime($calendarEnd);
    $weeks = 5;
    // Add another row if it's needed to display all days in the month
    if (date('m', strtotime($calendarEnd . ' +1 day')) == date('m', $first)) {
        $calendarEnd = date('Y-m-d', strtotime($calendarEnd . ' +7 day'));
        $calendarEndEpoch = strtotime($calendarEnd);
        $weeks = 6;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require('universal.inc'); ?>
        <script src="js/calendar.js"></script>
        <title>NAMI Rappahannock | Events Calendar</title>
        <style>.happy-toast { margin: 0 1rem 1rem 1rem; }</style>
    </head>
    <body>
        <div id="month-jumper-wrapper" class="hidden">
            <form id="month-jumper">
                <p>Choose a month to jump to</p>
                <div>
                    <select id="jumper-month">
                        <?php
                            $months = [
                                'January', 'February', 'March', 'April',
                                'May', 'June', 'July', 'August',
                                'September', 'October', 'November', 'December'
                            ];
                            $digit = 1;
                            foreach ($months as $m) {
                                $month_digits = str_pad($digit, 2, '0', STR_PAD_LEFT);
                                if ($month_digits == $month2digit) {
                                    echo "<option value='$month_digits' selected>$m</option>";
                                } else {
                                    echo "<option value='$month_digits'>$m</option>";
                                }
                                $digit++;
                            }
                        ?>
                    </select>
                    <input id="jumper-year" type="number" value="<?php echo $year ?>" required min="2023">
                </div>
                <input type="hidden" id="jumper-value" name="month" value="<?php echo 'test' ?>">
                <input type="submit" value="View">
                <button id="jumper-cancel" class="cancel" type="button">Cancel</button>
            </form>
        </div>
        <?php require('header.php'); ?>
        <main class="calendar-view">
            <h1 class='calendar-header'>
                <img id="previous-month-button" src="images/arrow-back.png" data-month="<?php echo date("Y-m", $previousMonth); ?>">
                <span id="calendar-heading-month">Appointments - <?php echo date('F Y', $month); ?></span>
                <img id="next-month-button" src="images/arrow-forward.png" data-month="<?php echo date("Y-m", $nextMonth); ?>">
            </h1>
            <!-- <input type="date" id="month-jumper" value="<?php echo date('Y-m-d', $month); ?>" min="2023-01-01"> -->
            <?php if (isset($_GET['deleteSuccess'])) : ?>
                <div class="happy-toast">Event deleted successfully.</div>
            <?php elseif (isset($_GET['completeSuccess'])) : ?>
                <div class="happy-toast">Event completed successfully.</div>
            <?php elseif (isset($_GET['cancelSuccess'])) : ?>
                <div class="happy-toast">Event canceled successfully.</div>
                <?php elseif (isset($_GET['cancelSuccess'])) : ?>
                <div class="happy-toast">Event canceled successfully.</div>
            <?php endif ?>
            <div class="table-wrapper">
                <table id="calendar">
                    <thead>
                        <tr>
                            <th>Sunday</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $date = $calendarStart;
                        $start = date('Y-m-d', $calendarStart);
                        $end = date('Y-m-d', $calendarEndEpoch);
                        require_once('database/dbEvents.php');
                        $events = fetch_events_in_date_range($start, $end);
                        for ($week = 0; $week < $weeks; $week++) {
                            echo '
                                <tr class="calendar-week">
                            ';
                            for ($day = 0; $day < 7; $day++) {
                                $extraAttributes = '';
                                $extraClasses = '';
                                if ($date == $today) {
                                    $extraClasses = ' today';
                                }
                                if (date('m', $date) != date('m', $month)) {
                                    $extraClasses .= ' other-month';
                                    $extraAttributes .= ' data-month="' . date('Y-m', $date) . '"';
                                }
                                $eventsStr = '';
                                $e = date('Y-m-d', $date);

                                if (isset($events[$e])) {
                                    $dayEvents = $events[$e];
                                    foreach ($dayEvents as $info) {

                                        $backgroundCol = '#00aeef'; // default color

                                        if (is_archived($info['id'])) { // archived event
                                            if ($_SESSION['access_level'] < 2) {
                                                continue; // users cannot see archived events
                                            }
                                            $backgroundCol = '#aaaaaa';

                                        } elseif (check_if_signed_up($info['id'], $_SESSION['_id'])) {
                                            $backgroundCol = '#1cc202';// user is signed-up for event

                                        } elseif($info['restricted_signup'] == 1) { //Restricted Event
                                            $backgroundCol = '#c73d06'; // Sets background color to a red to show the restriction
                                        }
                                        
                                        $eventsStr .= '<a class="calendar-event" style="background-color: ' . $backgroundCol . '" href="event.php?id=' . $info['id'] . '&user_id=' . $_SESSION['_id'] . '">' . htmlspecialchars_decode($info['name']) . '</a>';

                                    }
                                }
                                echo '<td class="calendar-day' . $extraClasses . '" ' . $extraAttributes . ' data-date="' . date('Y-m-d', $date) . '">
                                    <div class="calendar-day-wrapper">
                                        <p class="calendar-day-number">' . date('j', $date) . '</p>
                                        ' . $eventsStr . '
                                    </div>
                                </td>';
                                $date = strtotime(date('Y-m-d', $date) . ' +1 day');
                            }
                            echo '
                                </tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">            
            
            <?php
            //archive = grey
            //restricted = red
            //signed up for = green
            //blue = unrestricted
            ?>
            <center>
            <p></p>
            <i class="fa-solid fa-circle fa-xl" style="color: #c73d06;"></i>
                 <span style="font-size: 25px;">
                    Restricted
                </span>
            <i class="fa-solid fa-circle" style="color: #00aeef"> </i>
                <span style="font-size: 25px;">
                    Unrestricted
                </span>
            <i class="fa-solid fa-circle" style="color: #aaaaaa"> </i>
                <span style="font-size: 25px;">
                    Archived
                </span>
            <i class="fa-solid fa-circle" style="color: #1cc202"> </i>
                <span style="font-size: 25px;">
                    Signed-Up
                </span>
            </center>
                            <p></p>
        
            <div id="calendar-footer">
                <a class="button cancel" href="index.php">Return to Dashboard</a>
            </div>
        </main>
    </body>
</html>
