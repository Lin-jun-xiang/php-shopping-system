<?php
    // Error handling of Register website
    if (isset($_POST["submit"])) {

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $rePassword = $_POST["rePassword"];

        // import other php file
        require_once './dbh.inc.php';
        require_once './functions.inc.php';

        if (emptyInputSignup($username, $email, $password, $rePassword) !== false) {
            error_alert("Some thing not filled", "register.php");           
            exit();
        }
    
        if (invalidEmail($email) !== false) {
            error_alert("Invalid email", "register.php");
            exit();
        }

        if (pwdMatch($password, $rePassword) !== false) {
            error_alert("Repassword no match", "register.php");
            exit();
        }

        if (userExists($connect, $email) !== false) {
            error_alert("Email already regist", "register.php");
            exit();
        }

        createUser($connect, $username, $email, $password);

    }
    else {
        require_once './functions.inc.php';
        error_alert("SubmitWrong", "register.php");
    }
?>