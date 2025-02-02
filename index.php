<?php
include "pms_connect.php"; 

$sql = "SELECT p.*, c.name AS category_name FROM products p JOIN categories c ON p.category_id = c.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>product /th><th>Category</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['name']}</td><td>{$row['category_name']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT o.id, o.total, u.name AS user_name, o.status FROM orders o JOIN users u ON o.user_id = u.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Order number</th><th>Amount</th><th>user</th><th>the condition</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['total']}</td><td>{$row['user_name']}</td><td>{$row['status']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT c.name AS category_name, COUNT(p.id) AS product_count FROM categories c LEFT JOIN products p ON c.id = p.category_id GROUP BY c.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Category</th><th>Number of products</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['category_name']}</td><td>{$row['product_count']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT r.*, p.name AS product_name, u.name AS user_name FROM reviews r JOIN products p ON r.product_id = p.id JOIN users u ON r.user_id = u.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>product name</th><th>User</th><th>Evaluation</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['product_name']}</td><td>{$row['user_name']}</td><td>{$row['stars_number']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT order_id, SUM(qty) AS total_products_sold FROM order_product GROUP BY order_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Order number</th><th>Total Products</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['order_id']}</td><td>{$row['total_products_sold']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT * FROM products ORDER BY price DESC LIMIT 5";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>product name</th><th>Price</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['name']}</td><td>{$row['price']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT user_id, COUNT(id) AS order_count FROM orders GROUP BY user_id HAVING order_count > 5";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>User number</th><th>Number of requests</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['user_id']}</td><td>{$row['order_count']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT product_id, AVG(stars_number) AS average_rating FROM reviews GROUP BY product_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Product No.</th><th>Average rating</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['product_id']}</td><td>{$row['average_rating']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT * FROM products WHERE qty < 10";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>product name</th><th>Stock/th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['name']}</td><td>{$row['qty']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT SUM(total) AS total_revenue FROM orders";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "Total Revenue: " . $row['total_revenue'];
//----------------

$sql = "SELECT p.name, COUNT(r.id) AS review_count 
        FROM reviews r 
        JOIN products p ON r.product_id = p.id 
        GROUP BY p.id 
        ORDER BY review_count DESC 
        LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Most Reviewed Product:" . $row['name'] . " - Number of ratings: " . $row['review_count'];
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT p.name, SUM(op.qty) AS total_sold 
        FROM order_product op 
        JOIN products p ON op.product_id = p.id 
        GROUP BY p.id 
        ORDER BY total_sold DESC 
        LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Most purchased product: " . $row['name'] . " - Total sales: " . $row['total_sold'];
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT * FROM orders WHERE total > 1000";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>order number</th><th>Amount</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['total']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT p.name, AVG(r.stars_number) AS avg_rating, COUNT(r.id) AS review_count 
        FROM products p 
        LEFT JOIN reviews r ON p.id = r.product_id 
        GROUP BY p.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>product name</th><th>Average rating</th><th>Number of reviews</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['name']}</td><td>" . number_format($row['avg_rating'], 2) . "</td><td>{$row['review_count']}</td></tr>";
    }
    echo "</table>";
} else { echo "No data."; }

// --------------------------------------------------------------------------------

$sql = "SELECT c.name FROM categories c 
        LEFT JOIN products p ON c.id = p.category_id 
        WHERE p.id IS NULL";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['name']}</li>";
    }
    echo "</ul>";
} else { echo "There are no categories without products."; }

$conn->close();
?>


