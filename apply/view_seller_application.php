<?php
// Database configuration
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "apply"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch sellers from the database
$sql = "SELECT * FROM sellerapplication";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Seller Applications</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="view.css"> <!-- Ensure this is the correct path to your CSS file -->
</head>
<body>

<div class="seller-list-container">
    <h2>Seller Applications</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Business Name</th>
            <th>Business Address</th>
            <th>Business Description</th>
            <th>Valid ID</th>
            <th>Action</th> <!-- New header for action buttons -->
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data for each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['business_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['business_address']) . "</td>";
                echo "<td>" . htmlspecialchars($row['business_description']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($row['valid_id']) . "' alt='Valid ID' style='width: 100px; height: auto;'></td>";
                echo "<td>
                         <form action='accept_reject.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='seller_id' value='" . htmlspecialchars($row['id']) . "'>
                    <div class='action-buttons'> <!-- New container for action buttons -->
                        <button type='submit' name='action' value='accept' class='accept-button'>Accept</button>
                        <button type='submit' name='action' value='reject' class='reject-button'>Reject</button>
                      </td>"; // Action buttons
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No applications found.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
