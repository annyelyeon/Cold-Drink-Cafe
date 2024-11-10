<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $productName = $_POST['productName'];
    $listPrice = $_POST['listPrice'];
    $categoryID = $_POST['categoryID'];

    // Insert new drink into the database
    $query = "INSERT INTO PRODUCTS (productName, listPrice, categoryID) VALUES (:productName, :listPrice, :categoryID)";
    $stmt = $db->prepare($query);
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
    <link rel="stylesheet" href="add.css">
    <title>Cold Drink Cafe</title>
</head>
<body>
    <main>
        <div class="header">
            <h2>Cold Drink Cafe</h2> <hr>
            <h3>Add Drink</h3>
        </div>

        <div id="data">
                <label>Drink Name: </label>
                <input type="text" name="productName" id="productName" required><br>


            <label for="listPrice">Price:</label>
            <input type="number" step="0.01" name="listPrice" id="listPrice" required><br>

            <label for="categoryID">Category:</label>
            <select name="categoryID" id="categoryID">
                <option value="1">Regular</option>
                <option value="2">Zero Sugar</option>
                <option value="3">Energy</option>
            </select><br>

            </div>
    
            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" value="Add Drink" /><br />
            </div>
    
    </main>
</body>
</html>
