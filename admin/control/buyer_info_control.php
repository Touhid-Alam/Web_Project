<?php
include '../model/admindb.php';
session_start();

$mydb = new mydb();
$connobject = $mydb->openCon();

// Check if a search request is made
if (isset($_GET['BuyerUsername'])) {
    $username = trim($_GET['BuyerUsername']); // Get the username from the form

    if (!empty($username)) {
        $result = $mydb->searchBuyer("buyer", $username, $connobject);

        if ($result && $result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table border='1' cellspacing='0' cellpadding='5'>
                    <tr>
                        <th>Buyer Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>
                        <th>Action</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['BuyerUsername']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Fullname']) . "</td>
                        <td>" . htmlspecialchars($row['Phone']) . "</td>
                        <td>" . htmlspecialchars($row['DateOfBirth']) . "</td>
                        <td>
                            <a href='update_buyer.php?BuyerUsername=" . urlencode($row['BuyerUsername']) . "'>Update</a> |
                            <a href='../control/delete_buyer.php?BuyerUsername=" . urlencode($row['BuyerUsername']) . "'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No buyer found with username: " . htmlspecialchars($username) . "</p>";
        }
    } else {
        echo "<p>Please enter a valid username to search.</p>";
    }
} 
// Check if "View All" request is made
elseif (isset($_GET['viewAll'])) {
    $result = $mydb->showAllBuyer('buyer', $connobject);

    if ($result && $result->num_rows > 0) {
        echo "<h3>All Buyers:</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>
                <tr>
                    <th>Buyer Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['BuyerUsername']) . "</td>
                    <td>" . htmlspecialchars($row['Email']) . "</td>
                    <td>" . htmlspecialchars($row['Fullname']) . "</td>
                    <td>" . htmlspecialchars($row['Phone']) . "</td>
                    <td>" . htmlspecialchars($row['DateOfBirth']) . "</td>

                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No buyers found in the database.</p>";
    }
} else {
    echo "<p>Invalid request. Please use the search or view all options.</p>";
}

// Close the connection
$connobject->close();
?>
