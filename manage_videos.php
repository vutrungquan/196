<?php include 'config.php'; 
require 'vendor/autoload.php';



function importVideos($connection) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $file = $_FILES['file']['tmp_name'];
        
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestDataRow();
            $highestColumn = $sheet->getHighestDataColumn();
            
            $stmt = $connection->prepare("INSERT INTO videos (id_video, title_video, published_date) VALUES (:id_video, :title_video, :published_date)");
            
            for ($row = 2; $row <= $highestRow; $row++) {
                $id_video = $sheet->getCell('B'.$row)->getValue();
                $title_video = $sheet->getCell('C'.$row)->getValue();
                $published_date = $sheet->getCell('E'.$row)->getValue();
                
                $stmt->bindParam(':id_video', $id_video);
                $stmt->bindParam(':title_video', $title_video);
                $stmt->bindParam(':published_date', $published_date);
                $stmt->execute();
            }
            
            header('Location: manage_videos.php');
            exit();
        } catch (Exception $e) {
            echo "Lỗi khi nhập dữ liệu: " . $e->getMessage();
        }
    }
}


function exportVideos($connection) {
  try {
      $filePath = 'C:/Users/Quan/Downloads/Copy of [Tháng 5][VTVxBHMedia] Thống kê các video đăng lên Facebook.xlsx';

      if (!file_exists($filePath)) {
          throw new Exception("File không tồn tại tại đường dẫn $filePath");
      }
      
      $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
      $sheet = $spreadsheet->getActiveSheet();
      $highestRow = $sheet->getHighestRow();
      
      $stmt = $connection->prepare("
          SELECT id_video, title_video, id_page, published_date
          FROM videos
      ");
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $rowNumber = $highestRow + 1;
      foreach ($rows as $row) {
          $sheet->setCellValue('B'.$rowNumber, $row['id_video']);
          $sheet->setCellValue('C'.$rowNumber, $row['title_video']);
          $sheet->setCellValue('E'.$rowNumber, $row['published_date']);
          $rowNumber++;
      }

      $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save($filePath);
      
      header('Location: manage_pages.php');
  } catch (Exception $e) {
      echo "Lỗi khi xuất dữ liệu: " . $e->getMessage();
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['import'])) {
        importVideos($connection);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['export']) && $_GET['export'] == 'true') {
        exportVideos($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Video</title>
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
      <h1>Quản lý Video</h1>
    </div>
    <div class="content">
      <div class="table-controls">
        <button class="cach" onclick="location.href='add_video.php'">Thêm mới</button>
        <form method="POST" enctype="multipart/form-data" id="importForm">
          <input type="file" name="file" id="fileInput" accept=".xlsx,.xls" style="display: none;">
          <button class="cach" type="button" onclick="document.getElementById('fileInput').click();">Nhập</button>
          <input type="submit" name="import" style="display: none;">
        </form>
        <a href="?export=true"><button class="cach" >Xuất</button></a>
      </div>
      <table>
        <tr>
          <th>Video</th>
          <th>ID</th>
          <th>Page</th>
          <th>Ngày xuất bản</th>
          <th>Hành động</th>
        </tr>
        <?php
        try {
            $sql = "
                SELECT videos.id_video, videos.title_video, pages.page_title, videos.published_date
                FROM videos 
                JOIN pages ON videos.id_page = pages.id_page
            ";
            $stmt = $connection->prepare($sql);
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
        ?>
        <tr>
          <td><?php echo htmlspecialchars($row['title_video']); ?></td>
          <td><?php echo htmlspecialchars($row['id_video']); ?></td>
          <td><?php echo htmlspecialchars($row['page_title']); ?></td>
          <td><?php echo htmlspecialchars($row['published_date']); ?></td>
          <td>
            <a href="view_video.php?id=<?php echo htmlspecialchars($row['id_video']); ?>">Xem</a> |
            <a href="edit_video.php?id=<?php echo htmlspecialchars($row['id_video']); ?>">Chỉnh sửa</a> |
            <a href="delete_video.php?id=<?php echo htmlspecialchars($row['id_video']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa video này?')">Xóa</a>
          </td>
        </tr>
        <?php 
            endwhile; 
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
        ?>
      </table>
    </div>
  </div>
  
  <script>
    document.getElementById('fileInput').addEventListener('change', function() {
        document.getElementById('importForm').submit();
    });
  </script>
</body>
</html>
