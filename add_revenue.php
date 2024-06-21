<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm Doanh Thu</title>
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
      <h1>Thêm Doanh Thu</h1>
    </div>
    <div class="content">
      <form action="save_revenue.php" method="POST">
        <label for="id_video">ID Video:</label>
        <input type="text" id="id_video" name="id_video" required>
        
        <label for="check_date">Ngày kiểm tra:</label>
        <input type="date" id="check_date" name="check_date" required>
        
        <label for="revenue">Doanh thu:</label>
        <input type="number" id="revenue" name="revenue" required>
        
        <label for="share_count">Số lượt chia sẻ:</label>
        <input type="number" id="share_count" name="share_count" required>
        
        <label for="comment_count">Số bình luận:</label>
        <input type="number" id="comment_count" name="comment_count" required>
        
        <label for="like_count">Số lượt thích:</label>
        <input type="number" id="like_count" name="like_count" required>
        
        <label for="reach_count">Số người tiếp cận:</label>
        <input type="number" id="reach_count" name="reach_count" required>
        
        <label for="published_date">Ngày xuất bản:</label>
        <input type="date" id="published_date" name="published_date" required>
        
        <button type="submit">Lưu</button>
      </form>
    </div>
  </div>
</body>
</html>
