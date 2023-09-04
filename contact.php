<?php

// Get the form fields and remove whitespace
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);

// Check for errors
if (empty($name) || empty($email) || empty($message)) {
  http_response_code(400);
  echo "Please fill out all fields.";
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo "Invalid email address.";
  exit;
}

// Set the recipient email address
$to = "youremail@example.com";

// Set the email subject
$subject = "New contact from $name";

// Build the email content
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Message:\n$message\n";

// Build the email headers
$headers = "From: $name <$email>";

// Send the email
if (mail($to, $subject, $email_content, $headers)) {
  http_response_code(200);
  echo "Thank You! Your message has been sent.";
} else {
  http_response_code(500);
  echo "Oops! Something went wrong and we couldn't send your message.";
}
?>