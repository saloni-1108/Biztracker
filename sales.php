<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Sales - BizTracker</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h2>💰 Record Sale</h2>
    <form id="salesForm">
      <select id="productSelect" required></select>
      <input type="number" id="quantity" placeholder="Quantity" min="1" required>
      <button type="submit">Record Sale</button>
    </form>

    <h3>📋 Sales History</h3>
    <table>
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Total Price</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody id="salesList"></tbody>
    </table>
  </div>

  <script>
    const productSelect = document.getElementById('productSelect');
    const salesList = document.getElementById('salesList');
    const salesForm = document.getElementById('salesForm');

    async function loadProducts() {
      const res = await fetch('server.php?get_products=true');
      const products = await res.json();
      productSelect.innerHTML = '';
      products.forEach(product => {
        const option = document.createElement('option');
        option.value = product.id;
        option.textContent = `${product.name} (₹${product.price})`;
        productSelect.appendChild(option);
      });
    }

    async function loadSales() {
      const res = await fetch('server.php?get_sales=true');
      const sales = await res.json();
      salesList.innerHTML = '';
      sales.forEach(sale => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${sale.product_name}</td>
          <td>${sale.quantity_sold}</td>
          <td>₹${parseFloat(sale.total_price).toFixed(2)}</td>
          <td>${sale.sale_date}</td>
        `;
        salesList.appendChild(row);
      });
    }

    salesForm.onsubmit = async (e) => {
      e.preventDefault();
      const productId = productSelect.value;
      const quantity = parseInt(document.getElementById('quantity').value);

      const res = await fetch('server.php', {
        method: 'POST',
        body: new URLSearchParams({
          'record_sale': true,
          'product_id': productId,
          'quantity': quantity
        })
      });

      const data = await res.json();
      alert(data.message);
      if (data.status === 'success') {
        salesForm.reset();
        loadSales();
        loadProducts(); // refresh stock display
      }
    };

    window.onload = () => {
      loadProducts();
      loadSales();
    };
  </script>
</body>
</html>
