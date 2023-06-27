<!DOCTYPE html>
<html>
<body>
<?php
session_start();

$uid = $_POST['userid'];
$pw =$_POST['password'];



// Check if the user is currently locked
if (isset($_SESSION['lock_time']) && $_SESSION['lock_time'] > time()) {
    $remainingTime = $_SESSION['lock_time'] - time() + rand(30, 60);
    echo "Your account is currently locked. Please try again after $remainingTime seconds.";
} else {
    // Check if the submitted username and password are correct
    if ($uid === 'ben') {
        // Split the password into individual words
        $passwords = explode(" ", $pw);

        // Define the expected password words in the right order
        $expectedPasswords = array('ben23', 'password2', 'example123');

        // Check if the number of words and their order matches the expected password
        if (count($passwords) === count($expectedPasswords) && $passwords === $expectedPasswords) {
            // Reset login attempts
            unset($_SESSION['login_attempts']);

            // Set session ID
            $_SESSION['sid'] = session_id();

            echo "Logged in successfully";
        } else {
            // Increment failed login attempts and store in session
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;

            // Check if the user has exceeded the maximum number of login attempts
            if ($_SESSION['login_attempts'] >= 3) {
                // Lock the user for 30 seconds
                $_SESSION['lock_time'] = time() + 30;
                echo "Too many failed login attempts. Your account has been locked for 30 seconds.";
            } else {
                echo "Incorrect password";
            }
        }
    } else {
        echo "Incorrect username";
    }
}
?>
</body>
</html>
