<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $ticket_id = $_GET['id'];

    // Database connection
    $servername = "localhost:3307";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "train_booking";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch ticket details
    $sql = "SELECT * FROM tickets WHERE ticket_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ticket = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $train_name = $_POST['train_name'];
        $departure = $_POST['departure'];
        $arrival = $_POST['arrival'];
        $price = $_POST['price'];

        // Update ticket in the database
        $update_sql = "UPDATE tickets SET train_name = ?, departure = ?, arrival = ?, price = ? WHERE ticket_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssdi", $train_name, $departure, $arrival, $price, $ticket_id);
        $update_stmt->execute();

        echo "<script>alert('Ticket updated successfully!'); window.location='admin_dashboard.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-
