<?php

function validate($data) {
// Server-side validations

    $name    = trim($data['email_name']);
    $company = trim($data['email_company']);
    $phone   = trim($data['email_phone']);
    $email   = trim($data['email_email']);
    $date    = trim($data['email_date']);

    $success = true;
    $msg     = "<ul>";

    // *** Validation #1: Presence of required fields (name and phone or email)
    if (empty($name)) {
        $success = false;
        $msg .= "<li>Please provide your name</li>";
    }
    if (empty($phone) && empty($email)) {
        $success = false;
        $msg .= "<li>Please provide your phone number, email address, or both</li>";
    }

    // *** Validation #2: Only valid characters used in name, company, and phone
    if (strlen($name) > 0 && !preg_match('/^[a-zA-Z0-9&,.\- ]+$/', $name)) {      // "\" escapes "-"
        $success = false;
        $msg .= '<li>The Name field will accept only alphanumeric characters, spaces, and the special characters ", . &"</li>';
    }
    if (strlen($company) > 0 && !preg_match('/^[a-zA-Z0-9&,.\- ]+$/', $company)) {
        $success = false;
        $msg .= '<li>The Company field will accept only alphanumeric characters, spaces, and the special characters ", . &"</li>';
    }
    if (strlen($phone) > 0 && !preg_match('/^[0-9().\- ]+$/', $phone)) {
        $success = false;
        $msg .= "<li>Please use only numbers, parentheses, dashes, periods and spaces in the Phone field</li>";
    }

    // *** Validation #3: Valid email address, if provided
    if (strlen($email) > 0 && !filter_var($email, FILTER_VALIDATE_EMAIL)) {     
        $success = false;
        $msg .= "<li>$email is not a valid e-mail address</li>";
    }

    // *** Validation #4: Valid date, if provided
    if (strlen($date > 0)) {
        $date = str_replace("/", "-", $date);       // If slashes are used, replace with dashes
        $date_array = explode("-", $date);          // Convert string to an array, separating at the dashes

        if (is_array($date_array) && count($date_array) == 3) {
            if (!checkdate($date_array[0], $date_array[1], $date_array[2])) {
                $success = false;
                $msg .= "<li>Please enter a date in mm/dd/yyyy format</li>";
            }
        } else {
            $success = false;
            $msg .= "<li>Please enter a date in mm/dd/yyyy format</li>";
        }
    }

    $msg .= "</ul>";

    return array("success"=>$success, "message"=>$msg);
}
