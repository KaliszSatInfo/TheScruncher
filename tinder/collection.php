<?php
session_start();

$liked_images = isset($_SESSION['liked']) ? $_SESSION['liked'] : [];
$liked_images = array_reverse($liked_images);

$images_per_page = 12;
$total_images = count($liked_images);
$total_pages = ceil($total_images / $images_per_page);

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, min($current_page, $total_pages));

$offset = ($current_page - 1) * $images_per_page;

$images_to_display = array_slice($liked_images, $offset, $images_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include(__DIR__ . '/../layout/layout.php'); ?>
</head>
<body>
  
  <div class="container py-4 text-center flex-grow-1">
    <h1 class="mb-4">Look at your collection, splendid</h1>
    <div class="row g-2 justify-content-center gallery">
      <?php foreach ($images_to_display as $image): ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <a href="#" class="d-block ratio ratio-1x1">
            <img src="../uploads/<?php echo $image; ?>" class="img-fluid rounded" alt="Liked Image">
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php include(__DIR__ . '/../layout/footer.php'); ?>
</body>
</html>