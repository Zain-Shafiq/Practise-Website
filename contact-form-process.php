<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email_to = "zshafiq1223@gmail.com";
    $email_subject = "New form submission";

    $errors = [];

   
    $f_name = $_POST['f_name'];
    $f_name = strip_tags($f_name);
    $f_name = trim($f_name);
    
    $l_name = $_POST['l_name'];
    $l_name = strip_tags($l_name);
    $l_name = trim($l_name);

    $email = $_POST['Email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = trim($email);

    $reason = $_POST['Reason'];
    $reason = strip_tags($reason);
    $reason = trim($reason);

    $message = $_POST['Message'];
    $message = strip_tags($message);
    $message = trim($message);

    if (strlen($f_name) < 3 | strlen($f_name) > 20) {
        $errors[] = 'First name must be between 3 and 20 characters in length.';
    } elseif (ctype_alpha($f_name) === false) {
        $errors[] = 'First name must contain letters only.';
    }

    if (strlen($l_name) < 3 | strlen($l_name) > 30) {
        $errors[] = 'Last name must be between 3 and 30 characters in length.';
    } elseif (ctype_alpha($l_name) === false) {
        $errors[] = 'Last name must contain letters only.';
    }

    if (strlen($email) < 3 | strlen($email) > 50) {
        $errors[] = 'Email must be between 3 and 50 characters in length.';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'The Email address you entered does not appear to be valid.';
    }

    if (strlen($reason) < 3 | strlen($reason) > 500) {
        $errors[] = 'Reason must be between 3 and 500 characters in length.';
    } elseif (ctype_alpha($reason) === false) {
        $errors[] = 'Reason must contain letters only.';
    }

    if (strlen($message) < 3 | strlen($message) > 1000) {
        $errors[] = 'Message must be between 3 and 1000 characters in length.';
    } elseif (ctype_alpha($message) === false) {
        $errors[] = 'Message must contain letters only.';
    }


    if (empty($f_name) || empty($l_name) || empty($email) || empty($reason) || empty($message)) {
        $errors[] = 'All fields are required.';
    }

    if (empty($errors)) {
        
        $email_message = "Form details below.\n\n";
        $email_message .= "First name: $f_name\n";
        $email_message .= "Last name: $l_name\n";
        $email_message .= "Email: $email\n";
        $email_message .= "Reason for contact: $reason\n";
        $email_message .= "Message:\n$message\n";

       
        $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

      
        if (@mail($email_to, $email_subject, $email_message, $headers)) {
            
            header('Location: thank_you.php');
            exit();
        } else {
            echo 'An error occurred while sending the email.';
        }
    } else {
        // Display errors to the user
        echo "We're sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br><br>";
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        echo "Please go back and fix these errors.<br><br>";
    }
}       
?>
