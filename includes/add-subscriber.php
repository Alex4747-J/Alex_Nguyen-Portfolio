<?php
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(array("errors" => ["Invalid request."]));
        exit;
    }

    $db_host = 'localhost:8889';
    $db_user = 'root';
    $db_pass = 'root';
    $db_name = 'portfolio_main';

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $errors = array();

    $email = $_POST['email'];
    if ($email == NULL) {
        $errors[] = "Email field is empty.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "\"" . $email . "\" is not a valid email address.";
    }

    $errcount = count($errors);
    if ($errcount > 0) {
        $errmsg = array();
        for ($i = 0; $i < $errcount; $i++) {
            $errmsg[] = $errors[$i];
        }
        echo json_encode(array("errors" => $errmsg));
    } else {
        $email = mysqli_real_escape_string($connection, $email);
        $querystring = "INSERT INTO contacts(contact_name, contact_email, contact_message) VALUES('CTA Subscriber','" . $email . "','Subscribed via CTA form')";
        $result = mysqli_query($connection, $querystring);
        echo json_encode(array("message" => "Thanks for reaching out! I'll be in touch soon."));
    }
?>