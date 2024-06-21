<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ</title>
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
      <h1>Trang chủ</h1>
    </div>
    <div class="content">
      <?php
      try {
     
          $page_count_stmt = $connection->prepare("SELECT COUNT(*) as count FROM pages");
          $page_count_stmt->execute();
          $page_count = $page_count_stmt->fetch()['count'];

          $video_count_stmt = $connection->prepare("SELECT COUNT(*) as count FROM videos");
          $video_count_stmt->execute();
          $video_count = $video_count_stmt->fetch()['count'];

   
          $top_revenue_videos_stmt = $connection->prepare("
              SELECT videos.title_video, SUM(statistical.revenue) as total_revenue 
              FROM videos 
              JOIN statistical ON videos.id_video = statistical.id_video 
              GROUP BY videos.id_video 
              ORDER BY total_revenue DESC 
              LIMIT 5
          ");
          $top_revenue_videos_stmt->execute();


          $top_interaction_videos_stmt = $connection->prepare("
              SELECT videos.title_video, 
                     (SUM(statistical.like_count) + SUM(statistical.comment_count) + SUM(statistical.share_count)) as total_interaction 
              FROM videos 
              JOIN statistical ON videos.id_video = statistical.id_video 
              GROUP BY videos.id_video 
              ORDER BY total_interaction DESC 
              LIMIT 5
          ");
          $top_interaction_videos_stmt->execute();
      } catch (PDOException $e) {
          echo 'Lỗi: ' . $e->getMessage();
      }
      ?>

      <h2>Thống kê</h2>
      <p>Số lượng Page: <?php echo $page_count; ?></p>
      <p>Số lượng Video: <?php echo $video_count; ?></p>

      <h2>Top 5 Video theo Doanh Thu</h2>
      <ul>
        <?php while ($row = $top_revenue_videos_stmt->fetch()): ?>
          <li><?php echo $row['title_video']; ?> - <?php echo $row['total_revenue']; ?></li>
        <?php endwhile; ?>
      </ul>

      <h2>Top 5 Video theo Tương Tác</h2>
      <ul>
        <?php while ($row = $top_interaction_videos_stmt->fetch()): ?>
          <li><?php echo $row['title_video']; ?> - <?php echo $row['total_interaction']; ?></li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>
</body>
</html>
