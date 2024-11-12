<?php
require_once('db.php');

// Fetch drinks from the database in ascending order by productName
$query = "SELECT * FROM PRODUCTS ORDER BY productName ASC";
$drinks = [];

try {
    // Fetch all products in ascending order
    $result = $db->query($query);
    $drinks = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM PRODUCTS WHERE productID = :productID";
    $stmt = $db->prepare($delete_query);
    $stmt->bindParam(':productID', $delete_id);
    $stmt->execute();
    header("Location: ascending.php");  // Refresh the page after deletion
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Cold Drink Cafe - Ascending Order</title>
</head>
<body>
    <main>
        <div class="header">
            <h2>Cold Drink Cafe</h2><hr>
            <h2 style="color:orange">Drink List</h2>
        </div>
        
        <div class="container">
            <div class="categories">
                <span id="categories"><b>Categories</b></span> <br>
                <a href="#">Regular</a> <br>
                <a href="#">Zero Sugar</a> <br>
                <a href="#">Energy</a> <br>
            </div>


            <div class="product-list">
                <span id ="table-title"><b>Regular</b></span>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display each drink
                        for ($i = 0; $i < count($drinks); $i++) {
                            $drink = $drinks[$i];
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($drink['productName']) . "</td>";
                            echo "<td>$" . number_format($drink['listPrice'], 2) . "</td>";
                            echo "<td>
                                <a href='?delete_id=" . $drink['productID'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>";
                            echo "<td>
                                <a href='modify.php?id=" . $drink['productID'] . "'>Modify</a>
                            </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="buttons">
                <a href="add.php">Add Drink</a><br>
                <a href="index.php">View Drink List</a> <br>
            </div>  
        </div>             
    </main>
    <br>
    <footer>
        <hr>
        <p>&copy2024 Cold Drink Cafe, Inc.</p>
    </footer>
</body>
</html>
