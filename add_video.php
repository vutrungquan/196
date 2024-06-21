<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm Video</title>
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
      <h1>Thêm Video</h1>
    </div>
    <div class="content">
      <form action="save_video.php" method="POST">
        <label for="id_video">ID Video:</label>
        <input type="text" id="id_video" name="id_video" required>
        
        <label for="title_video">Tên Video:</label>
        <input type="text" id="title_video" name="title_video" required>
        
        <label for="id_page">Chọn Page:</label>
        <select id="id_page" name="id_page">
          <?php
          $result = $connection->query("SELECT * FROM pages");
          while ($row = $result->fetch(PDO::FETCH_ASSOC)):
          ?>
          <option value="<?php echo $row['id_page']; ?>"><?php echo $row['page_title']; ?></option>
          <?php endwhile; ?>
        </select>
        
        <label for="published_date">Ngày xuất bản:</label>
        <input type="date" id="published_date" name="published_date" required>
        

        <button type="submit">Lưu</button>
      </form>
    </div>
  </div>
</body>
</html>
