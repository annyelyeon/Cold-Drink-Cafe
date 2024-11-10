<?php
require_once('db.php');

// Fetch drinks from the database
$query = "SELECT * FROM PRODUCTS";
$drinks = [];

try {
    // Fetch all products
    $result = $db->query($query);
    $drinks = $result->fetchAll(PDO::FETCH_ASSOC); 

    // Example of using array_push() to add a new drink to the array
    if (isset($_GET['add_example'])) {
        $new_drink = [
            'productID' => null,  // Inserting a new product, so no ID initially
            'productName' => 'Mountain Dew',
            'listPrice' => 2.50,
            'categoryID' => 1  // Regular category for example
        ];

        // Add the new drink to the array
        array_push($drinks, $new_drink);
    }

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
    header("Location: index.php");  // Refresh the page after deletion
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Cold Drink Cafe</title>
</head>
<body>
    <main>
        <div class="header">
            <h2>Cold Drink Cafe</h2> <hr>
            <h3>Drink List</h3>
        </div>
        
        <div class="container">
            <div class="categories">
                <span id="categories">Categories</span> <br>
                <a href="#">Regular</a> <br>
                <a href="#">Zero Sugar</a> <br>
                <a href="#">Energy</a> <br>
            </div>

            <div class="product-list">
                <span id ="table-title">Regular</span>
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
                        foreach ($drinks as $drink) {
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
                <a href="add.php">Add Drink</a> <br>
                <a href="asscending.php">Sort Drink in Ascending Order</a> <br>
                <a href="asscending.php">Sort Drink in Descending Order</a>
            </div>  
        </div>             
    </main>
</body>
</html>