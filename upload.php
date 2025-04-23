<?php
$uploadDir='uploads/';
if(!is_dir($uploadDir))mkdir($uploadDir,0755,true);
if(empty($_FILES['images']['name'][0]))exit;
$count=count($_FILES['images']['name']);
for($i=0;$i<$count;$i++){
    $tmp=$_FILES['images']['tmp_name'][$i];
    $orig=$_FILES['images']['name'][$i];
    if($_FILES['images']['error'][$i]!==UPLOAD_ERR_OK)continue;
    $info=getimagesize($tmp);
    $mime=$info['mime'];
    if(!in_array($mime,['image/jpeg','image/png']))continue;
    switch($mime){
        case 'image/jpeg':$src=imagecreatefromjpeg($tmp);break;
        case 'image/png':$src=imagecreatefrompng($tmp);break;
    }
    $dst=imagecreatetruecolor(256,256);
    if($mime==='image/png'){
        imagecolortransparent($dst,imagecolorallocatealpha($dst,0,0,0,127));
        imagealphablending($dst,false);
        imagesavealpha($dst,true);
    }
    imagecopyresampled($dst,$src,0,0,0,0,256,256,imagesx($src),imagesy($src));
    $ext=strtolower(pathinfo($orig,PATHINFO_EXTENSION));
    $fn=uniqid('img_').".$ext";
    $path=$uploadDir.$fn;
    if($mime==='image/jpeg')imagejpeg($dst,$path,85);
    if($mime==='image/png')imagepng($dst,$path);
    imagedestroy($src);
    imagedestroy($dst);
}
header('Location: index.php');
exit;