<?php
$uploadDir = 'uploads/';
$images = array_diff(scandir($uploadDir), array('..', '.'));
$images = array_values($images);

$images = array_reverse($images);

$images_per_page = 12;

$total_images = count($images);
$total_pages = ceil($total_images / $images_per_page);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

$start = ($page - 1) * $images_per_page;

$images_to_display = array_slice($images, $start, $images_per_page);

return [
    'images_to_display' => $images_to_display,
    'total_pages' => $total_pages,
    'current_page' => $page
];