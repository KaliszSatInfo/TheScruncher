<?php
session_start();
$uploadDir = '../uploads/';
$all_images = array_values(array_diff(scandir($uploadDir), ['.', '..']));

if (!isset($_SESSION['seen'])) $_SESSION['seen'] = [];
if (!isset($_SESSION['liked'])) $_SESSION['liked'] = [];
if (!isset($_SESSION['disliked'])) $_SESSION['disliked'] = [];

$unseen = array_values(array_diff($all_images, $_SESSION['seen']));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['liked_image'])) {
        $_SESSION['liked'][] = $_POST['liked_image'];
    } elseif (isset($_POST['disliked_image'])) {
        $_SESSION['disliked'][] = $_POST['disliked_image'];
    }
    $_SESSION['seen'][] = $_POST['liked_image'] ?? $_POST['disliked_image'];
    header('Location: tinder.php');
    exit;
}

$current = $unseen ? $unseen[array_rand($unseen)] : null;

include(__DIR__ . '/../layout/layout.php'); 
?>

<div class="container py-4 text-center">
    <?php if (!$current): ?>
        <h1 class="text-danger">You went through them all</h1>
    <?php else: ?>
    <div class="card card-box text-center mx-auto tinder-card" style="max-width:600px;">
        <img src="../uploads/<?= htmlspecialchars($current) ?>" class="card-img-top" alt="Scroll Image">
        <form action="tinder.php" method="POST" class="tinder-form d-flex justify-content-center mt-3">
            <button type="submit" name="disliked_image" value="<?= htmlspecialchars($current) ?>" class="btn btn-outline-danger mx-2">❌</button>
            <button type="submit" name="liked_image" value="<?= htmlspecialchars($current) ?>" class="btn btn-outline-success mx-2">✅</button>
        </form>
    </div>
    <?php endif; ?>
  </div>
</body>
</html>