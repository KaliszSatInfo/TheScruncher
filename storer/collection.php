<?php
session_start();

$liked_images = isset($_SESSION['liked']) ? $_SESSION['liked'] : [];

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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Potential Lovers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="../styles.css">
  <link rel="icon" href="icon.png" type="image/png">
</head>
<body class="d-flex flex-column min-vh-100">

  <div class="container py-4 text-center">
    <h1 class="mb-4">Look at your collection, splendid</h1>
    <p><a href="/thescruncher/index.php" class="btn btn-outline-dark fw-bold shadow-sm w-100">Gallery</a></p>
    <p><a href="/thescruncher/storer/" class="btn btn-outline-dark fw-bold shadow-sm w-100">Wanna swipe some more?</a></p>

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

  <footer class="mt-auto py-3" style="background:#e6e4d9 url('https://www.transparenttextures.com/patterns/natural-paper.png');">
    <div class="container text-center">
      <?php if ($total_pages > 1): ?>
        <nav class="d-inline-flex flex-wrap justify-content-center">
          <?php
          function page_button($label, $target, $enabled = true, $is_current = false) {
            $class = $is_current ? 'btn-dark' : 'btn-outline-secondary';
            $disabled = !$enabled ? ' disabled' : '';
            if ($enabled) {
              echo "<a class='btn $class mx-1' href='?page=$target'>$label</a>";
            } else {
              echo "<span class='btn $class mx-1$disabled'>$label</span>";
            }
          }

          page_button('«', 1, $current_page > 1);
          page_button('‹', $current_page - 1, $current_page > 1);

          $start = max(1, $current_page - 3);
          $end = min($total_pages, $current_page + 3);
          for ($i = $start; $i <= $end; $i++) {
            page_button($i, $i, true, $i == $current_page);
          }

          page_button('›', $current_page + 1, $current_page < $total_pages);
          page_button('»', $total_pages, $current_page < $total_pages);
          ?>
        </nav>
      <?php endif; ?>
    </div>
  </footer>

  <script src="zoomer.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>