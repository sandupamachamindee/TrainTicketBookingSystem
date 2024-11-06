<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $train_name = $_POST['train_name'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    $price = $_POST['price'];

    // Database connection
    $servername = "localhost:3307";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "train_booking";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert new ticket into the database
    $sql = "INSERT INTO tickets (train_name, departure, arrival, price) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $train_name, $departure, $arrival, $price);
    $stmt->execute();

    echo "<script>alert('Ticket added successfully!'); window.location='admin_dashboard.php';</script>";

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ticket</title>
</head>
<body>
    <h2>Add New Ticket</h2>
    <form action="add_ticket.php" method="POST">
        <label for="train_name">Train Name</label>
        <input type="text" id="train_name" name="train_name" required>

        <label for="departure">Departure</label>
        <input type="text" id="departure" name="departure" required>

        <label for="arrival">Arrival</label>
        <input type="text" id="arrival" name="arrival" required>

        <label for="price">Price</label>
        <input type="number" id="price" name="price" required>

        <button type="submit" name="submit">Add Ticket</button>
    </form>
</body>
</html>
