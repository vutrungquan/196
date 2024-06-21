<?php
include 'config.php';

$id = $_GET['id'];

try {

    $sql = "SELECT * FROM pages WHERE id_page = :id_page";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id_page', $id);
    $stmt->execute();
    $page = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chỉnh sửa Page</title>
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
      <h1>Chỉnh sửa Page</h1>
    </div>
    <div class="content">
      <form action="update_page.php" method="POST">
        <input type="hidden" name="id_page" value="<?php echo $page['id_page']; ?>">
        
        <label for="page_title">Tên Page:</label>
        <input type="text" id="page_title" name="page_title" value="<?php echo htmlspecialchars($page['page_title']); ?>" required>
        
        <button type="submit">Cập nhật</button>
      </form>
    </div>
  </div>
</body>
</html>
