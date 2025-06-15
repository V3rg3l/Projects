<style>
td {
  word-break: break-word;
}
</style>

<?php
// DB connection
$host = "localhost";
$user = "root";
$password = "";
$database = "wknd";

session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit;
}

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch stats
$totalOrders = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];
$totalRevenue = $conn->query("SELECT SUM(price * quantity) as total FROM orders")->fetch_assoc()['total'] ?? 0;
$topDrinks = $conn->query("
  SELECT drink_name, SUM(quantity) AS total_qty
  FROM orders
  GROUP BY drink_name
  ORDER BY total_qty DESC
  LIMIT 5
");
$recentOrders = $conn->query("SELECT * FROM orders ORDER BY order_time DESC LIMIT 10");

?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard - WKND</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <h2 class="mb-4">📊 WKND Order Dashboard</h2>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card bg-primary text-white text-center">
          <div class="card-body">
            <h5>Total Orders</h5>
            <h2><?= $totalOrders ?></h2>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-success text-white text-center">
          <div class="card-body">
            <h5>Total Revenue</h5>
            <h2>₱<?= number_format($totalRevenue, 2) ?></h2>
          </div>
        </div>
      </div>
    </div>

    <hr class="my-5">

    <h4>🍹 Top 5 Most Ordered Drinks</h4>
    <ul class="list-group mb-4">
      <?php while ($row = $topDrinks->fetch_assoc()): ?>
        <li class="list-group-item d-flex justify-content-between">
          <strong><?= $row['drink_name'] ?></strong>
          <span><?= $row['total_qty'] ?> cups</span>
        </li>
      <?php endwhile; ?>
    </ul>

    <h4>🕒 Recent Orders</h4>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Drink</th>
          <th>Size</th>
          <th>Qty</th>
          <th>Notes</th>
          <th>₱ Total</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $recentOrders->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['customer_name']) ?></td>
            <td><?= $row['drink_name'] ?></td>
            <td><?= $row['size'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= htmlspecialchars($row['notes']) ?></td>
            <td>₱<?= number_format($row['price'] * $row['quantity'], 2) ?></td>
            <td><?= $row['order_time'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <a href="admin_logout.php" style="
    display: inline-block;
    background-color: #e74c3c;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    margin-top: 20px;
    transition: background-color 0.3s ease;
" onmouseover="this.style.backgroundColor='#c0392b'" onmouseout="this.style.backgroundColor='#e74c3c'">
    Logout
</a>

</body>
</html>

<?php $conn->close(); ?>
