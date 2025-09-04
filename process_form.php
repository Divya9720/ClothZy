<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'db_connect.php'; // connect to DB

    // Sanitize form data
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $orderid = htmlspecialchars(trim($_POST['orderid']));
    $querytype = htmlspecialchars(trim($_POST['querytype']));
    $message = htmlspecialchars(trim($_POST['message']));

    // File upload
    $file_name = "";
    if (isset($_FILES["screenshot"]) && $_FILES["screenshot"]["error"] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir);
        }

        $file_name = basename($_FILES["screenshot"]["name"]);
        $targetPath = $targetDir . $file_name;

        if (!move_uploaded_file($_FILES["screenshot"]["tmp_name"], $targetPath)) {
            echo "❌ File upload failed.";
            exit;
        }
    }

    // Insert query
    $stmt = $conn->prepare("INSERT INTO contact_form (fullname, email, phone, order_id, query_type, message, file_name)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fullname, $email, $phone, $orderid, $querytype, $message, $file_name);

    if ($stmt->execute()) {
        echo "<h2 style='color:green;'>✅ Your message has been submitted successfully!</h2>";
        echo "<a href='contact.html'>🔙 Go Back</a>";
    } else {
        echo "<h2 style='color:red;'>❌ Error saving data. Try again.</h2>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request!";
}
?>
