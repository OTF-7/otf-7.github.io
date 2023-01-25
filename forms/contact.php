<?php
/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'omartaha.tech7@gmail.com';

//  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
//    include( $php_email_form );
//  } else {
//    die( 'Unable to load the "PHP Email Form" Library!');
//  }

$errors = '';
if (empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['subject']) ||
    empty($_POST['message'])) {
    $errors .= "\n Error: all fields are required";
}

//  $contact = new PHP_Email_Form;
//  $contact->ajax = true;
$name = $_POST['name'];
$email_address = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if (!preg_match(
    "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
    $email_address)) {
    $errors .= "\n Error: Invalid email address";
}
if (empty($errors)) {
    $to = $receiving_email_address;
    $email_subject = "Contact form submission: $name and the subject: $subject";
    $email_body = "You have received a new message. " .
        " Here are the details:\n Name: $name \n Email: $email_address \n Message \n $message";

    $headers = "From: $receiving_email_address\n";
    $headers .= "Reply-To: $email_address";

    mail($to, $email_subject, $email_body, $headers);
    echo "<script>
 sent = document.getElementById('sent-message').innerHTML = 'Your message has been sent. Thank you';
setTimeout(function(){
     sent.innerHTML = '';
}, 3000)</script>";
    //redirect to the 'thank you' page
//    header('Location: contact-form-thank-you.html');
} else {
    echo "<script>
error = document.getElementById('error-message').innerHTML = $errors;
setTimeout(function(){
    document.getElementById('error-message').innerHTML = '';
}, 3000)</script>";
}

//  $contact->to = $receiving_email_address;
//  $contact->from_name = $_POST['name'];
//  $contact->from_email = $_POST['email'];
//  $contact->subject = $_POST['subject'];

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
$contact->smtp = array(
  'host' => 'example.com',
  'username' => 'example',
  'password' => 'pass',
  'port' => '587'
);
*/

//  $contact->add_message( $_POST['name'], 'From');
//  $contact->add_message( $_POST['email'], 'Email');
//  $contact->add_message( $_POST['message'], 'Message', 10);

//  echo $contact->send();
?>
