<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Inventory</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h2>Manage Inventory</h2>
  <form id="productForm">
    <input type="text" id="name" placeholder="Product Name" required>
    <input type="number" id="stock" placeholder="Stock" required>
    <input type="number" step="0.01" id="price" placeholder="Price" required>
    <button type="submit">Add Product</button>
  </form>

  <table id="inventoryTable">
    <thead>
      <tr>
        <th>Product</th>
        <th>Stock</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script src="assets/js/script.js"></script>
</body>
</html>
