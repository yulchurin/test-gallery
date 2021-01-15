<?php
require 'config.php';
require 'header.php';
foreach ($gallery as $key => $image) {
    $filename = substr($image, 0 , (strrpos($image, '.')));
    echo '<a href="generator.php?name=',$image ,'">', '<img src="', $cache_folder, $filename, '-min.jpg" />', '</a><br>';
}
require 'menu.php';
require 'footer.php';