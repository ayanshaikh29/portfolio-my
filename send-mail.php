<?php
// send-mail.php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    die('All fields are required.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid e-mail address.');
}

// ----  CONFIG  -------------------------------------------------
$to      = 'asshaikh7033@gmail.com';
$subject = 'New Inquiry – AS Edits Portfolio';
$headers = [
    "From: $email",
    "Reply-To: $email",
    "X-Mailer: PHP/" . phpversion(),
    "MIME-Version: 1.0",
    "Content-Type: text/plain; charset=UTF-8"
];
$body = "Name: $name\r\nE-mail: $email\r\n\r\nMessage:\r\n$message";
// --------------------------------------------------------------

if (mail($to, $subject, $body, implode("\r\n", $headers))) {
    // Success – redirect back to the contact section
    header('Location: index.html#contact?sent=1');
    exit;
} else {
    die('Sorry, something went wrong while sending the e-mail.');
}