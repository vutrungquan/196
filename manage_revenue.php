<?php include 'config.php';
require 'vendor/autoload.php'; 



function importRevenue($connection) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $file = $_FILES['file']['tmp_name'];
        
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestDataRow();
            $highestColumn = $sheet->getHighestDataColumn();
            
            $stmt = $connection->prepare("INSERT INTO statistical (id_video, check_date, revenue, share_count, comment_count, like_count, reach_count) VALUES (:id_video, :check_date, :revenue, :share_count, :comment_count, :like_count, :reach_count)");
            
            for ($row = 2; $row <= $highestRow; $row++) {
                $id_video = $sheet->getCell('B'.$row)->getValue();
                $check_date = $sheet->getCell('K'.$row)->getValue();
                $revenue = $sheet->getCell('F'.$row)->getValue();
                $share_count = $sheet->getCell('G'.$row)->getValue();
                $comment_count = $sheet->getCell('H'.$row)->getValue();
                $like_count = $sheet->getCell('I'.$row)->getValue();
                $reach_count = $sheet->getCell('J'.$row)->getValue();
                
                $stmt->bindParam(':id_video', $id_video);
                $stmt->bindParam(':check_date', $check_date);
                $stmt->bindParam(':revenue', $revenue);
                $stmt->bindParam(':share_count', $share_count);
                $stmt->bindParam(':comment_count', $comment_count);
                $stmt->bindParam(':like_count', $like_count);
                $stmt->bindParam(':reach_count', $reach_count);
                $stmt->execute();
            }
            
            header('Location: manage_revenue.php');
            exit();
        } catch (Exception $e) {
            echo "Lỗi khi nhập dữ liệu: " . $e->getMessage();
        }
    }
}

function exportRevenue($connection) {
  try {
      $filePath = 'C:/Users/Quan/Downloads/Copy of [Tháng 5][VTVxBHMedia] Thống kê các video đăng lên Facebook.xlsx';

      if (!file_exists($filePath)) {
          throw new Exception("File không tồn tại tại đường dẫn $filePath");
      }
      
      $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
      $sheet = $spreadsheet->getActiveSheet();
      $highestRow = $sheet->getHighestRow();

      // Truy vấn dữ liệu từ bảng statistical
      $stmt = $connection->prepare("
          SELECT id_video, check_date, revenue, share_count, comment_count, like_count, reach_count
          FROM statistical
      ");
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $rowNumber = $highestRow + 1;
      foreach ($rows as $row) {
          $sheet->setCellValue('B'.$rowNumber, $row['id_video']);
          $sheet->setCellValue('K'.$rowNumber, $row['check_date']);
          $sheet->setCellValue('F'.$rowNumber, $row['revenue']);
          $sheet->setCellValue('G'.$rowNumber, $row['share_count']);
          $sheet->setCellValue('H'.$rowNumber, $row['comment_count']);
          $sheet->setCellValue('I'.$rowNumber, $row['like_count']);
          $sheet->setCellValue('J'.$rowNumber, $row['reach_count']);
          $rowNumber++;
      }

      $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save($filePath);
      
      header('Location: manage_revenue.php');
  } catch (Exception $e) {
      echo "Lỗi khi xuất dữ liệu: " . $e->getMessage();
  }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['import'])) {
        importRevenue($connection);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['export']) && $_GET['export'] == 'true') {
        exportRevenue($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Doanh Thu</title>
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
      <h1>Quản lý Doanh Thu</h1>
    </div>
    <div class="content">
      <div class="table-controls">
        <button class="cach" onclick="location.href='add_revenue.php'">Thêm mới</button>
        <form method="POST" enctype="multipart/form-data" id="importForm">
          <input type="file" name="file" id="fileInput" accept=".xlsx,.xls" style="display: none;">
          <button class="cach" type="button" onclick="document.getElementById('fileInput').click();">Nhập</button>
          <input type="submit" name="import" style="display: none;">
        </form>
        <a href="?export=true"><button class="cach"   >Xuất</button></a>
      </div>
      <table>
        <tr>
          <th>ID Video</th>
          <th>Ngày kiểm tra</th>
          <th>Doanh thu</th>
          <th>Số lượt chia sẻ</th>
          <th>Số bình luận</th>
          <th>Số lượt thích</th>
          <th>Số người tiếp cận</th>
          <th>Hành động</th>
        </tr>
        <?php
        try {
            $stmt = $connection->prepare("
                SELECT id_video, check_date, revenue, share_count, comment_count, like_count, reach_count, id_statistical
                FROM statistical
            ");
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
        ?>
        <tr>
          <td><?php echo htmlspecialchars($row['id_video']); ?></td>
          <td><?php echo htmlspecialchars($row['check_date']); ?></td>
          <td><?php echo htmlspecialchars($row['revenue']); ?></td>
          <td><?php echo htmlspecialchars($row['share_count']); ?></td>
          <td><?php echo htmlspecialchars($row['comment_count']); ?></td>
          <td><?php echo htmlspecialchars($row['like_count']); ?></td>
          <td><?php echo htmlspecialchars($row['reach_count']); ?></td>
          <td>
            <a href="view_revenue.php?id=<?php echo htmlspecialchars($row['id_statistical']); ?>">Xem</a> |
            <a href="edit_revenue.php?id=<?php echo htmlspecialchars($row['id_statistical']); ?>">Chỉnh sửa</a> |
            <a href="delete_revenue.php?id=<?php echo htmlspecialchars($row['id_statistical']); ?>" onclick="return
confirm('Bạn có chắc chắn muốn xóa mục này?')">Xóa</a>
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
