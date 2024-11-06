<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

echo "<h2>Welcome, " . $_SESSION['admin'] . "!</h2>";
echo "<p><a href='logout.php'>Logout</a></p>";

// Database connection
$servername = "localhost:3307";
$dbusername = "root";  // Your database username
$dbpassword = "";      // Your database password
$dbname = "booking system";  // Your database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch train tickets
$sql = "SELECT * FROM ticket";
$result = $conn->query($sql);

echo "<h3>Train Tickets</h3>";
echo "<table border='1'>
        <tr>
            <th>Ticket ID</th>
            <th>Train Name</th>
            <th>Departure</th>
            <th>Arrival</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row['ticket_id'] . "</td>
            <td>" . $row['train_name'] . "</td>
            <td>" . $row['departure'] . "</td>
            <td>" . $row['arrival'] . "</td>
            <td>" . $row['price'] . "</td>
            <td>
                <a href='edit_ticket.php?id=" . $row['ticket_id'] . "'>Edit</a> | 
                <a href='delete_ticket.php?id=" . $row['ticket_id'] . "'>Delete</a>
            </td>
          </tr>";
}

echo "</table>";

$conn->close();
?>
