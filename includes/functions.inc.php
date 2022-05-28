<?php
    function error_alert($message, $redirection) {
        echo "<script>
        alert('$message');
        window.location.href='../php/$redirection';
        </script>";
    }

    function emptyInputSignup($username, $email, $password, $rePassword) {
        if (empty($username) || empty($email) || empty($password) || empty($rePassword)) {
            return true;
        }
        else {
            return false;
        }
    }

    function invalidEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
    }

    function pwdMatch($password, $rePassword) {
        if ($password !== $rePassword) {
            return true;
        }
        else {
            return false;
        }
    }

    function userExists($connect, $email) {
        $sql = "SELECT * FROM user WHERE email = ?;";
        $stmt = mysqli_stmt_init($connect);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            // Check the error of "$sql"
            header("location: ../php/register.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            // fetch(get) a row data from db, return false if none data
            // which mean email exist
            return $row;
        }
        else {
            return false;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($connect, $username, $email, $password) {
        $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($connect);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            // Check the error of "$sql"
            error_alert("stmtFailed", "register.php");
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        error_alert("Register Successfully", "login.php");
        exit();
    }

    function emptyInputLogin($email, $password) {
        if (empty($email) || empty($password)) {
            return true;
        }
        else {
            return false;
        }
    }

    function loginUser($connect, $email, $password) {
        $Exists = userExists($connect, $email);

        if ($Exists === false) {
            error_alert("No User", "login.php");
            exit();
        }

        $pwdHashed = $Exists["password"];
        $checkPwd = password_verify($password, $pwdHashed);

        if ($checkPwd === false) {
            error_alert("password Wrong", "login.php");
            exit();
        }
        else if ($checkPwd === true) {
            session_start();
            $_SESSION["id"] = $Exists["id"];
            $_SESSION["username"] = $Exists["username"];
            $_SESSION["email"] = $Exists["email"];
            header("location: ../php/index.php");
            exit();
        }
    }
?>