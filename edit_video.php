<?php
include 'config.php';

$id = $_GET['id'];

try {
 
    $sql = "SELECT * FROM videos WHERE id_video = :id_video";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id_video', $id);
    $stmt->execute();
    $video = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chỉnh sửa Video</title>
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
      <h1>Chỉnh sửa Video</h1>
    </div>
    <div class="content">
      <form action="update_video.php" method="POST">
      <label for="id_video">ID Video:</label>
        <input type="text" name="id_video" value="<?php echo htmlspecialchars($video['id_video']); ?>">
        
        <label for="title_video">Tên Video:</label>
        <input type="text" id="title_video" name="title_video" value="<?php echo htmlspecialchars($video['title_video']); ?>" required>
        
        <label for="id_page">Chọn Page:</label>
        <select id="id_page" name="id_page">
          <?php
          try {
              $stmt = $connection->query("SELECT * FROM pages");
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                $selected = $row['id_page'] == $video['id_page'] ? 'selected' : '';
          ?>
          <option value="<?php echo htmlspecialchars($row['id_page']); ?>" <?php echo $selected; ?>><?php echo htmlspecialchars($row['page_title']); ?></option>
          <?php
              endwhile;
          } catch (PDOException $e) {
              echo "Lỗi: " . $e->getMessage();
          }
          ?>
        </select>
        
        <label for="published_date">Ngày xuất bản:</label>
        <input type="date" id="published_date" name="published_date" value="<?php echo htmlspecialchars($video['published_date']); ?>" required>
        
        <button type="submit">Cập nhật</button>
      </form>
    </div>
  </div>
</body>
</html>
