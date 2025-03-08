<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $message = htmlspecialchars($_POST["message"]);

    $to = "support@thekgo.com"; // Change this to your email
    $subject = "New Quote Request from $name";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
    $headers = "From: $email";

    // Handle file attachments
    if (!empty($_FILES["attachments"]["name"][0])) {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_paths = [];
        foreach ($_FILES["attachments"]["tmp_name"] as $key => $tmp_name) {
            $file_name = basename($_FILES["attachments"]["name"][$key]);
            $file_path = $upload_dir . $file_name;
            if (move_uploaded_file($tmp_name, $file_path)) {
                $file_paths[] = $file_path;
            }
        }

        $body .= "\n\nAttachments:\n" . implode("\n", $file_paths);
    }

    if (mail($to, $subject, $body, $headers)) {
        echo "Quote request submitted successfully.";
    } else {
        echo "Error sending quote request.";
    }
}
?>
