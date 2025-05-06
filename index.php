<?php 
include 'db.php'; 

// Fetch total number of products
$total_products_result = $conn->query("SELECT COUNT(*) AS total_products FROM products");
$total_products = $total_products_result->fetch_assoc()['total_products'];

// Fetch total sales (sum of total_price in sales)
$total_sales_result = $conn->query("SELECT SUM(total_price) AS total_sales FROM sales");
$total_sales = $total_sales_result->fetch_assoc()['total_sales'];

// Fetch products with low stock (e.g., stock < 5)
$low_stock_threshold = 5;
$low_stock_result = $conn->query("SELECT COUNT(*) AS low_stock_products FROM products WHERE quantity < $low_stock_threshold");
$low_stock_products = $low_stock_result->fetch_assoc()['low_stock_products'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BizTracker - Dashboard</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>📊 BizTracker</h1>
      <p>Simple Inventory & Sales Manager for Small Businesses</p>
    </header>

    <section class="summary">
      <!-- Total Products Card -->
      <div class="card">
        <h2>Total Products</h2>
        <span id="productCount"><?php echo $total_products; ?></span>
      </div>

      <!-- Total Sales Card -->
      <div class="card">
        <h2>Total Sales</h2>
        <span>₹<span id="totalSales"><?php echo number_format($total_sales, 2); ?></span></span>
      </div>

      <!-- Low Stock Products Card -->
      <div class="card">
        <h2>Low Stock Items</h2>
        <span id="lowStockCount"><?php echo $low_stock_products; ?></span>
      </div>
    </section>

    <section class="home-links">
      <a class="home-btn" href="inventory.php">📦 Manage Inventory</a>
      <a class="home-btn" href="sales.php">💰 Manage Sales</a>
    </section>
  </div>

  <script src="assets/js/script.js"></script>
</body>
</html>
