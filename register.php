<?php
    // In this section, I've removed code that ensures the user is already logged in.
    // This is because we want users without accounts to be able to create new accounts.

    // Author: Lauren Knight
    // Description: Registration page for new volunteers

    require_once('include/input-validation.php');
    require_once('email.php'); //  Added to support verification sending

    // Handle Send Verification Code button logic
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['send_code'])) {
        $email = validateEmail(strtolower($_POST['email']));
        if ($email) {
            $codeSent = sendVerification($email);
            if ($codeSent) {
                echo "<p style='color:green;'>Verification code sent to {$email}.</p>";
            } else {
                echo "<p style='color:red;'>Failed to send verification code. Please try again.</p>";
            }
        } else {
            echo "<p style='color:red;'>Invalid email format.</p>";
        }
    }
?>
<?php
session_start();
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

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['send_code'])) {
            // make every submitted field SQL-safe except for password
            $ignoreList = ['password'];
            $args = sanitize($_POST, $ignoreList);
            $show = true;
            $errors = false;

            // Your existing validations...
            $first_name = $args['first_name'];
            $last_name  = $args['last_name'];

            $phone1 = validateAndFilterPhoneNumber($args['phone']);
            if (!$phone1) {
                $errors = true;
                echo 'bad phone';
            }

            $may_text       = $args['text'];
            $contact_method = $args['communication'];

            $email = strtolower($args['email']);
            $email = validateEmail($email);
            if (!$email) {
                $errors = true;
                echo 'bad email';
            }

            $street_address = $args['street_address'];
            $city           = $args['city'];
            $state          = $args['state'];
            if (!valueConstrainedTo($state, [
                'AK','AL','AR','AZ','CA','CO','CT','DC','DE','FL','GA',
                'HI','IA','ID','IL','IN','KS','KY','LA','MA','MD','ME',
                'MI','MN','MO','MS','MT','NC','ND','NE','NH','NJ','NM',
                'NV','NY','OH','OK','OR','PA','RI','SC','SD','TN','TX',
                'UT','VA','VT','WA','WI','WV','WY'
            ])) {
                $errors = true;
            }

            $zip_code = $args['zip'];
            if (!validateZipcode($zip_code)) {
                $errors = true;
                echo 'bad zip';
            }

            $strengths                   = $args['strengths_and_weaknesses'];
            $primary_role               = $args['primary_role'];
            $work_best                  = $args['work_best'];
            $learning_method            = $args['learning'];
            $introOrExtro               = $args['personality'];
            $family_with_mental_illness = $args['mental_illness'];
            $involvement_in_nami        = $args['why_volunteer'];
            $interest = $args['additional_interest'] ?? 'no';
            $active_paying_nami_affiliate = $args['activePayingNamiAffiliate'] ?? 'no';
            $if_not_are_willing           = $args['ifNotAreWilling']       ?? 'no';
            $choice_nami_affiliate        = $args['choiceNamiAffiliate'];

            $username = $args['username'];

            // --- Minimal add: check verification code ---
            $verification_code = trim($args['verification_code']);
            require_once('database/dbinfo.php');
            $conn = connect();
            $stmt = $conn->prepare("SELECT id FROM verification WHERE email = ? AND code = ?");
            $stmt->bind_param("ss", $email, $verification_code);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo "<p style='color:red;'>Invalid or missing verification code for this email.</p>";
                $stmt->close();
                $conn->close();
                $show = false;
                $errors = true;
            } else {
                // Verified — delete any matching verification codes
                $stmt->close();
                $delete = $conn->prepare("DELETE FROM verification WHERE email = ?");
                $delete->bind_param("s", $email);
                $delete->execute();
                $delete->close();
                $conn->close();
            }

            // Password hashing
            $password = isSecurePassword($args['password']);
            if (!$password) {
                $errors = true;
            } else {
                $password = password_hash($args['password'], PASSWORD_BCRYPT);
            }

            if ($errors) {
                if($show){
                echo '<p>Your form submission contained unexpected input.</p>';
                }
                $formData = $_POST;
                require_once('volunteerApp.php');
                exit;    
            }
            $newVol = new GenVol(
                $first_name, $last_name, $phone1, $contact_method, $email, 
                $street_address, $city, $state, $zip_code, $strengths, 
                $primary_role, $work_best, $learning_method, $introOrExtro,
                $family_with_mental_illness, $involvement_in_nami,
                $interest, $active_paying_nami_affiliate, $if_not_are_willing,
                $choice_nami_affiliate, $username, $password, $may_text,
                $emergency_contact_first_name, $emergency_contact_last_name, $emergency_contact_relation, $emergency_contact_phone
            );
            $result = add_genVol($newVol);
            if (!$result) {
                echo '<p>That username is already in use.</p>';
            } else {
                echo '<script>document.location = "login.php?registerSuccess";</script>';
            }

        } else {
            // Initial GET or after send_code: display form
            $formData = $_POST ?? [];
            require_once('volunteerApp.php');
        }
    ?>
</body>
<?php require('footer.php'); ?>
</html>
