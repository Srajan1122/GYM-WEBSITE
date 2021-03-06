<?php

function emptyInputAddTrainer($email,$username,$number,$password,$confirm_password) {

    if (empty($email) || empty($username) || empty($number) || empty($password) || empty($confirm_password)) {
        //if true then redirect the user to signup page
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUsername($name) {
    return false;
}

function invalidEmail($email) {

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //if true then redirect the user to signup page
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($password,$confirm_password) {

    if ($password !== $confirm_password) {
        //if true then redirect the user to signup page
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emailExists($conn, $email) {
    //This statement is used to prevent SQL Injection
    $sql = "SELECT * from trainer WHERE Trainer_Email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../../admin/addTrainer.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $number, $admin_id, $email, $password) {
    //This statement is used to prevent SQL Injection
    $sql = "INSERT INTO trainer (Trainer_Name, Phone_Number, Admin_id, Trainer_Email, Trainer_Password) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../../admin/addTrainer.php?error=insertFailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    // $name = "null";
    // $location = "null";

    mysqli_stmt_bind_param($stmt, "siiss", $name, $number, $admin_id, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    // console_log($name);

    mysqli_stmt_close($stmt);

    header("location:../../admin/addTrainer.php?error=none");
    exit();
}