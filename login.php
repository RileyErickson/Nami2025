<?php
    // Comment for assignment -Madi
    // Template for new VMS pages. Base your new page on this one

    // Make session information accessible, allowing us to associate
    // data with the logged-in user.
    session_cache_expire(30);
    session_start();
    
    ini_set("display_errors",1);
    error_reporting(E_ALL);

    // redirect to index if already logged in
    if (isset($_SESSION['_id'])) {
        header('Location: index.php');
        die();
    }
    $badLogin = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once('include/input-validation.php');
        $ignoreList = array('password');
        $args = sanitize($_POST, $ignoreList);
        $required = array('username', 'password');
        if (wereRequiredFieldsSubmitted($args, $required)) {
            require_once('domain/Person.php');
            require_once('database/dbPersons.php');
            /*@require_once('database/dbMessages.php');*/
            /*@dateChecker();*/
            $username = strtolower($args['username']);
            $password = $args['password'];
            $user = retrieve_person($username);
            if (!$user) {
                $badLogin = true;
            } else if (password_verify($password, $user->get_password())) {
                $_SESSION['logged_in'] = true;

                $_SESSION['access_level'] = $user->get_access_level();
                $_SESSION['f_name'] = $user->get_first_name();
                $_SESSION['l_name'] = $user->get_last_name();

                
                $_SESSION['type'] = 'admin';
                $_SESSION['_id'] = $user->get_id();
                
                // hard code root privileges
                if ($user->get_id() == 'vmsroot') {
                    $_SESSION['access_level'] = 3;
                    header('Location: index.php');
                }
                //if ($changePassword) {
                //    $_SESSION['access_level'] = 0;
                //    $_SESSION['change-password'] = true;
                //    header('Location: changePassword.php');
                //    die();
                //} 
                else {
                    header('Location: index.php');
                    die();
                }
                die();
            } else {
                $badLogin = true;
            }
        }
    }
    //<p>Or <a href="register.php">register as a new volunteer</a>!</p>
    //Had this line under login button, took user to register page
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('universal.inc') ?>
        <title>NAMI Rappahannock System | Log In</title>
    </head>
    <body style="width: 100%; padding: 0px; margin-left: 0px">
        <table style="width: 100%; height: 100vh; background-image: url('images/loginbackground.png'); background-size: cover; background-position: center; border-collapse: collapse; color: white;">
            <tr>
                <td style="padding: 10px;"><img src="images/whitenamilogo.png" alt="logo" style="width: 10%;"/></td>
            </tr>
            <tr>
                <td style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; padding: 20px;">
                    <div style="background-color: rgba(255, 255, 255, 0.9); border-radius: 15px; padding: 40px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px; min-height: 625px;">
                        <main class="login">
                            <p style="font-size: 45px; color: #0c499c;"><b>Login</b></p>
                            <?php if (isset($_GET['registerSuccess'])): ?>
                                <div class="happy-toast">
                                    Your registration was successful! Please log in below.
                                </div>
                            <?php else: ?>
                                <p style="font-size: 20px;  color: #0c499c; text-align: center">Welcome to the NAMI Rappahannock Volunteer Management System!<br>Please log in below.</p>
                            <?php endif ?>
                            <form method="post">
                                <?php
                                    if ($badLogin) {
                                        echo '<span class="error">No login with that username and password combination currently exists.</span>';
                                    }
                                ?>
                                <label for="username" style="font-size: 22px;">Username</label>
        		                <input type="text" name="username" placeholder="Enter your username" style="font-size: 22px; background-color: white; border: 1px;" required>
        		                <label for="password" style="font-size: 22px;">Password</label>
                                <input type="password" name="password" placeholder="Enter your password" style="font-size: 22px; background-color: white; border: 1px;" required>
                                <input type="submit" name="login" value="Login" style="font-size: 22px;">
                            </form>
                            <p></p>
                            <p style="color: #0c499c;">Don't have an account? <a href = "register.php">Sign Up</a>!</p>
                            <p style="color: #0c499c;">Looking for <a href="https://www.namirapp.org/">NAMI Rappahannock</a>?</p>
                        </main>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>