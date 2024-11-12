<?php
require_once('db.php'); // Include the database connection file

// Get the product ID from the URL
$productID = $_GET['id'] ?? null; // Retrieve productID from the URL, default is null

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If the request method is POST, retrieve form data
    $productName = $_POST['productName'];
    $listPrice = $_POST['listPrice'];

    // Update the drink in the database
    $query = "UPDATE PRODUCTS SET productName = :productName, listPrice = :listPrice WHERE productID = :productID";
    $stmt = $db->prepare($query); // Prepare the SQL statement
    $stmt->bindParam(':productName', $productName); // Bind productName parameter
    $stmt->bindParam(':listPrice', $listPrice); // Bind listPrice parameter
    $stmt->bindParam(':productID', $productID); // Specify the productID to update

    try {
        $stmt->execute(); // Execute the prepared statement
        // Redirect to the main page after modification
        header("Location: index.php");
        exit(); // Prevent further execution after redirection
    } catch (PDOException $e) {
        // If an error occurs while executing the query, display the error message
        echo "Error executing query: " . $e->getMessage();
    }
}

// Retrieve existing data for the drink to be modified
$query = "SELECT * FROM PRODUCTS WHERE productID = :productID";
$stmt = $db->prepare($query); // Prepare the SQL statement
$stmt->bindParam(':productID', $productID); // Bind productID parameter
$stmt->execute(); // Execute the statement
$product = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the product data as an associative array

// Handle case where the product does not exist
if (!$product) {
    echo "Product not found."; // Display message if product is not found
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/add.css"> <!-- Link to the CSS stylesheet -->
    <title>Cold Drink Cafe - Modify Drink</title>
</head>
<body>
    <main>
        <div class="header">
            <h2>Cold Drink Cafe</h2> <hr>
            <h2 style="color:orange">Modify Drink</h2>
        </div>

        <form method="POST" action=""> <!-- Form for modifying drink -->
            <label for="productName">Drink Name:</label>
            <input type="text" name="productName" id="productName" value="<?php echo htmlspecialchars($product['productName']); ?>" required><br>

            <label for="listPrice">Price:</label>
            <input type="number" step="0.01" name="listPrice" id="listPrice" value="<?php echo htmlspecialchars($product['listPrice']); ?>" required><br>

            <button type="submit">Modify Drink</button> <!-- Submit button to modify the drink -->
        </form>

        <div class="buttons">
            <a href="index.php">View Drink List</a> <br> <!-- Link to view the drink list -->
        </div> 
    </main>
    <br>
    <footer>
        <hr>
        <p>&copy2024 Cold Drink Cafe, Inc.</p>
    </footer>
</body>
</html>
