<?php
include 'config.php';

$id = $_GET['id'];

try {

    $sql = "SELECT * FROM statistical WHERE id_statistical = :id_statistical";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id_statistical', $id, PDO::PARAM_INT);
    $stmt->execute();
    $revenue = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chỉnh sửa Doanh Thu</title>
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
      <h1>Chỉnh sửa Doanh Thu</h1>
    </div>
    <div class="content">
      <form action="update_revenue.php" method="POST">
        <input type="hidden" name="id_statistical" value="<?php echo htmlspecialchars($revenue['id_statistical']); ?>">
        
        <label for="id_video">Chọn Video:</label>
        <select id="id_video" name="id_video">
          <?php
          try {
              $videos = $connection->query("SELECT * FROM videos");
              while ($video = $videos->fetch(PDO::FETCH_ASSOC)):
                $selected = $video['id_video'] == $revenue['id_video'] ? 'selected' : '';
          ?>
          <option value="<?php echo htmlspecialchars($video['id_video']); ?>" <?php echo $selected; ?>><?php echo htmlspecialchars($video['title_video']); ?></option>
          <?php
              endwhile;
          } catch (PDOException $e) {
              echo "Lỗi: " . $e->getMessage();
          }
          ?>
        </select>
        
        <label for="check_date">Ngày kiểm tra:</label>
        <input type="date" id="check_date" name="check_date" value="<?php echo htmlspecialchars($revenue['check_date']); ?>" required>
        
        <label for="revenue">Doanh thu:</label>
        <input type="number" step="0.01" id="revenue" name="revenue" value="<?php echo htmlspecialchars($revenue['revenue']); ?>" required>
        
        <label for="share_count">Số lượt chia sẻ:</label>
        <input type="number" id="share_count" name="share_count" value="<?php echo htmlspecialchars($revenue['share_count']); ?>" required>
        
        <label for="comment_count">Số lượt bình luận:</label>
        <input type="number" id="comment_count" name="comment_count" value="<?php echo htmlspecialchars($revenue['comment_count']); ?>" required>
        
        <label for="like_count">Số lượt thích:</label>
        <input type="number" id="like_count" name="like_count" value="<?php echo htmlspecialchars($revenue['like_count']); ?>" required>
        
        <label for="reach_count">Số lượt tiếp cận:</label>
        <input type="number" id="reach_count" name="reach_count" value="<?php echo htmlspecialchars($revenue['reach_count']); ?>" required>
        
        <button type="submit">Cập nhật</button>
      </form>
    </div>
  </div>
</body>
</html>
