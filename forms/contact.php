<?php
  // Replace with your real receiving email address
  $receiving_email_address = 'danteoguns@gmail.com';

  if (file_exists('../assets/vendor/php-email-form/php-email-form.php')) {
    include('../assets/vendor/php-email-form/php-email-form.php');
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  $contact->to = $receiving_email_address;
  $contact->from_name = isset($_POST['name']) ? $_POST['name'] : '';
  $contact->from_email = isset($_POST['email']) ? $_POST['email'] : '';
  $contact->subject = isset($_POST['subject']) ? $_POST['subject'] : '';

  $contact->add_message($contact->from_name, 'From');
  $contact->add_message($contact->from_email, 'Email');
  $contact->add_message(isset($_POST['message']) ? $_POST['message'] : '', 'Message', 10);

  echo $contact->send() ? 'OK' : 'Error sending message';
?>
