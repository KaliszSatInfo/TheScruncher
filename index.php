<?php
$paging_data = include('pager.php');
$images_to_display = $paging_data['images_to_display'];
$total_pages = $paging_data['total_pages'];
$current_page = $paging_data['current_page'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Scrolls</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="icon.png" type="image/png">
</head>
<body class="d-flex flex-column min-vh-100">

  <div class="container py-4 text-center">
    <h1 class="mb-4">Go on, save your precious memories</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data" class="mx-auto mb-5" style="max-width:500px;">
      <input type="file" name="images[]" accept="image/*" multiple class="form-control mb-3" required>
      <button type="submit" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm">✉️ Send mail</button>
    </form>
    <div class="row g-2 justify-content-center gallery">
      <?php foreach ($images_to_display as $image): ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <a href="#" class="d-block ratio ratio-1x1">
            <img src="uploads/<?php echo $image; ?>" class="img-fluid rounded" alt="">
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <footer class="mt-auto py-3" style="background:#e6e4d9 url('https://www.transparenttextures.com/patterns/natural-paper.png');">
    <div class="container text-center">
      <?php if ($total_pages>1): ?>
        <nav class="d-inline-flex flex-wrap justify-content-center">
          <?php if ($current_page>1): ?>
            <a class="btn btn-outline-secondary mx-1" href="?page=<?php echo $current_page-1 ?>">Prev</a>
          <?php endif; ?>
          <?php for($i=1;$i<=$total_pages;$i++): ?>
            <a class="btn mx-1 <?php echo $i==$current_page?'btn-dark':'btn-outline-secondary' ?>" href="?page=<?php echo $i ?>"><?php echo $i ?></a>
          <?php endfor; ?>
          <?php if ($current_page<$total_pages): ?>
            <a class="btn btn-outline-secondary mx-1" href="?page=<?php echo $current_page+1 ?>">Next</a>
          <?php endif; ?>
        </nav>
      <?php endif; ?>
    </div>
  </footer>

  <script src="zoomer.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>