<?php
    header("Content-Type: application/json; charset=UTF-8");

    $db_host = 'localhost:8889';
    $db_user = 'root';
    $db_pass = 'root';
    $db_name = 'portfolio_main';

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $errors = array();

    $name = mysqli_real_escape_string($connection, $_POST['name']);
    if ($name == NULL) {
        $errors[] = "Name field is empty.";
    }

    $email = $_POST['email'];
    if ($email == NULL) {
        $errors[] = "Email field is empty.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "\"" . $email . "\" is not a valid email address.";
    }

    $message = mysqli_real_escape_string($connection, $_POST['message']);
    if ($message == NULL) {
        $errors[] = "Message field is empty.";
    }

    $errcount = count($errors);
    if ($errcount > 0) {
        $errmsg = array();
        for ($i = 0; $i < $errcount; $i++) {
            $errmsg[] = $errors[$i];
        }
        echo json_encode(array("errors" => $errmsg));
    } else {
        $querystring = "INSERT INTO contacts(contact_name, contact_email, contact_message) VALUES('" . $name . "','" . $email . "','" . $message . "')";
        $result = mysqli_query($connection, $querystring);
        echo json_encode(array("message" => "Form submitted. Thank you for your interest!"));
    }
?>