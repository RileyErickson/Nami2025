<?php
    // In this section, I've removed code that ensures the user is already logged in.
    // This is because we want users without accounts to be able to create new accounts.

    // Author: Lauren Knight
    // Description: Registration page for new volunteers

    require_once('include/input-validation.php');
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once('universal.inc'); ?>
    <title>NAMI Rappahannock | Register</title>

</head>
<body>
    
    <?php
        require_once('header.php');
        require_once('domain/Person.php');
        require_once('database/dbPersons.php');
        require_once('domain/GenVol.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // make every submitted field SQL-safe except for password
            $ignoreList = array('password');
            $args = sanitize($_POST, $ignoreList);

            // echo "<p>The form was submitted:</p>";
            // foreach ($args as $key => $value) {
            //     echo "<p>$key: $value</p>";
            // }
            
            $errors = false;
            $first_name = $args['first_name'];
            $last_name = $args['last_name'];

            $phone1 = validateAndFilterPhoneNumber($args['phone']);
            if (!$phone1) {
                $errors = true;
                echo 'bad phone';
            }

            $may_text = $args['text'];

            //put contact method here
            $contact_method = $args['communication'];

            $email = strtolower($args['email']);
            $email = validateEmail($email);
            if (!$email) {
                $errors = true;
                ECHO '<div class="error-toast">ERROR: Improper Email</div>';
                echo 'bad email';
            }

            $street_address = $args['street_address'];
            $city = $args['city'];
            $state = $args['state'];
            if (!valueConstrainedTo($state, array('AK', 'AL', 'AR', 'AZ', 'CA', 'CO', 'CT', 'DC', 'DE', 'FL', 'GA',
                    'HI', 'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA', 'MA', 'MD', 'ME',
                    'MI', 'MN', 'MO', 'MS', 'MT', 'NC', 'ND', 'NE', 'NH', 'NJ', 'NM',
                    'NV', 'NY', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX',
                    'UT', 'VA', 'VT', 'WA', 'WI', 'WV', 'WY'))) {
                $errors = true;
            }
            $zip_code = $args['zip'];
            if (!validateZipcode($zip_code)) {
                $errors = true;
                echo 'bad zip';
            }

            $strengths = $args['strengths_and_weaknesses'];
            $primary_role = $args['primary_role'];
            $work_best = $args['work_best'];
            $learning_method = $args['learning'];
            $introOrExtro = $args['personality'];
            $family_with_mental_illness = $args['mental_illness'];
            $involvement_in_nami = $args['why_volunteer'];
            if (array_key_exists('additional_interest', $args)){
                $interest = $args['additional_interest'];
            }
            else{
                $interest = 'no';
            }
            if (array_key_exists('activePayingNamiAffiliate', $args)){
                $active_paying_nami_affiliate = $args['activePayingNamiAffiliate'];
            }
            else{
                $active_paying_nami_affiliate = 'no';
            }
            if (array_key_exists('ifNotAreWilling', $args)){
                $if_not_are_willing = $args['ifNotAreWilling'];
            }
            else{
                $if_not_are_willing = 'no';
            }
            $choice_nami_affiliate = $args['choiceNamiAffiliate'];

            $username = $args['username'];
            // May want to enforce password requirements at this step
            //$username = $args['username'];
            $password = isSecurePassword($args['password']);
            if (!$password) {
                $errors = true;
            } else {
                $password = password_hash($args['password'], PASSWORD_BCRYPT);
            } 


            if ($errors) {
                echo '<p>Your form submission contained unexpected input.</p>';
                die();
            }

            $start_date = date("Y-m-d");
            
            $newVol = new GenVol(
                $first_name, $last_name, $phone1, $contact_method, $email, 
                $street_address, $city, $state, $zip_code, $strengths, 
                $primary_role, $work_best, $learning_method, $introOrExtro,
                $family_with_mental_illness, $involvement_in_nami,
                $interest, $active_paying_nami_affiliate, $if_not_are_willing,
                $choice_nami_affiliate, $username, $password, $may_text, $start_date
            );
            $result = add_genVol($newVol);
            if (!$result) {
                echo '<h1>Volunteer Application</h1>';
                echo '<main class="signup-form">';
                echo '<p class="error-toast">That username is already in use! <a href="http://localhost/php/project/register.php">Try again?</a></p></main>';
            } else {
                /*if ($loggedIn) {
                    echo '<script>document.location = "index.php?registerSuccess";</script>';
                } else {*/
                    echo '<script>document.location = "login.php?registerSuccess";</script>';
                /*}*/
            }
        } else {
            require_once('volunteerApp.php'); 
        }
    ?>
</body>
<?php require('footer.php'); ?>
</html>