<?php

header('Content-type: image/jpeg');

require 'connect.inc.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysql_query("SELECT `email` FROM `users_email` WHERE `id`='" . mysql_real_escape_string($id) . "'");
    if ($query) {
        if (mysql_num_rows($query) >= 1) {
            $email = mysql_result($query, 0, 'email');
            if ($email) {
                
            } else {
                $email = 'Error: mysql_result()';
            }
        } else {
            $email = 'ID not found.';
        }
    } else {
        $email = 'Invalid query: ' . $query;
    }
} else {
    $email = 'No ID specified.';
}

$email_length = strlen($email);

$font_size = 4;

$image_height = imagefontheight($font_size);
$image_width = imagefontwidth($font_size) * $email_length;

$image = imagecreate($image_width, $image_height);

// background
imagecolorallocate($image, 255, 255, 255);
$font_color = imagecolorallocate($image, 0, 0, 0);

imagestring($image, $font_size, 0, 0, $email, $font_color);
imagejpeg($image);
?>
