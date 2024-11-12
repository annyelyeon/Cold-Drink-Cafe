<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $productName = $_POST['productName'];
    $listPrice = $_POST['listPrice'];
    $categoryID = $_POST['categoryID'];
    $productCode = $_POST['productCode'];


    // Insert new drink into the database
    $query = "INSERT INTO PRODUCTS (productName, listPrice, categoryID) VALUES (:productName, :listPrice, :categoryID)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':productName', $productName);
    $stmt->bindParam(':productName', $productName);
    $stmt->bindParam(':listPrice', $listPrice);
    $stmt->bindParam(':categoryID', $categoryID);
    $stmt->execute();

    // Redirect back to the main page
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/add.css">
    <title>Cold Drink Cafe</title>
</head>
<body>
    <main>
        <div class="header">
            <h2>Cold Drink Cafe</h2> <hr>
            <h3>Add Drink</h3>
        </div>

        <form method="POST" action="">

        <label for="productCode">Product Category:</label>
            <select name="productCategory" id="productCategory">
                <option value="1">Regular</option>
                <option value="2">Zero Sugar</option>
                <option value="3">Energy</option>
            </select><br>

            <label for="productCode">Code:</label>
            <input type="text" name="productCode" id="productCode" required><br>
            
            <label for="productName">Drink Name:</label>
            <input type="text" name="productName" id="productName" required><br>

            <label for="listPrice">Price:</label>
            <input type="number" step="0.01" name="listPrice" id="listPrice" required><br>

            <button type="submit">Add Drink</button>
        </form>

        <div class="buttons">
                <a href="index.php">View Drink List</a> <br>
        </div> 
    </main>
    <br>
    <footer>
        <hr>
        <p>&copy2024 Cold Drink Cafe, Inc.</p>
    </footer>
</body>
</html>
