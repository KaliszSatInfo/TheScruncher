<?php
$paging_data = include('pager.php');
$images_to_display = $paging_data['images_to_display'];
$total_pages = $paging_data['total_pages'];
$current_page = $paging_data['current_page'];
include(__DIR__ . '/layout/layout.php'); 
?>

  <div class="container py-4 text-center">
    <h1 class="mb-4">Go on, fill the gene pool</h1>
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
<?php include(__DIR__ . '/layout/footer.php'); ?>