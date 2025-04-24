<?php
session_start();
$uploadDir = '../uploads/';
$all_images = array_values(array_diff(scandir($uploadDir), ['.', '..']));

if (!isset($_SESSION['seen'])) $_SESSION['seen'] = [];
if (!isset($_SESSION['liked'])) $_SESSION['liked'] = [];
if (!isset($_SESSION['disliked'])) $_SESSION['disliked'] = [];

$unseen = array_values(array_diff($all_images, $_SESSION['seen']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scroll Storer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<?php
if (empty($unseen)) {
    echo "
        <div class='container py-5 text-center'>
            <h2 class='display-4 text-danger'>You truly went through them all</h2>
            <div class='d-flex justify-content-center'><p><a href='collection.php' class='btn btn-outline-dark fw-bold shadow-sm w-100'>View Your Collection</a></p></div>
            <div class='d-flex justify-content-center'><p><a href='../index.php' class='btn btn-outline-dark fw-bold shadow-sm w-100'>Return back to the gallery</a></p></div>
        </div>
    ";
    exit;
}

$current = $unseen[array_rand($unseen)];
$_SESSION['seen'][] = $current;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['liked_image'])) {
        $_SESSION['liked'][] = $_POST['liked_image'];
    } elseif (isset($_POST['disliked_image'])) {
        $_SESSION['disliked'][] = $_POST['disliked_image'];
    }
    $_SESSION['seen'][] = $_POST['liked_image'] ?? $_POST['disliked_image'];
    header('Location: index.php');
    exit;
}
?>


<body>
    <p><a href="/thescruncher/index.php" class="btn btn-outline-dark fw-bold shadow-sm w-100">Actually, let me browse the photos a bit more</a></p>
    <p><a href="/thescruncher/storer/collection.php" class="btn btn-outline-dark fw-bold shadow-sm w-100">View my Liked Photos</a></p>

    <div class="card card-box text-center">
        <img src="../uploads/<?php echo $current ?>" class="card-img-top" alt="Scroll Image">
        <form action="index.php" method="POST" class="d-flex justify-content-center mt-3">
            <button type="submit" name="liked_image" value="<?php echo $current; ?>" class="btn btn-outline-success mx-2">✅ Like</button>
            <button type="submit" name="disliked_image" value="<?php echo $current; ?>" class="btn btn-outline-danger mx-2">❌ Dislike</button>
        </form>
    </div>
</body>
</html>