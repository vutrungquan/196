<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="sidebar">
    <h2>Menu</h2>
    <a href="index.php">Trang chủ</a>
    <a href="manage_videos.php">Quản lý Video</a>
    <a href="manage_pages.php">Quản lý Page</a>
    <a href="manage_revenue.php">Quản lý Doanh Thu</a>
  </div>
  <div class="main-content">
    <div class="navbar">
      <h1>Thêm Page</h1>
    </div>
    <div class="content">
      <form action="save_page.php" method="POST">
        <label for="page_title">Title Page:</label>
        <input type="text" id="page_title" name="page_title" required>
        
        <button type="submit">Lưu</button>
      </form>
    </div>
  </div>
</body>
</html>
