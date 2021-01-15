<?php
//require 'db.php';
//$query = $pdo->prepare("SELECT `size` FROM `sizes_table` WHERE `code`=:size");
//$query->execute(['size' => $size]);
//$sizes = $query->fetch();
//$secret_key = $db_data['password']; //TODO: DATABASE CONNECTION
$name = $_GET['name'];
$size = $_GET['size'];
require 'config.php';
/*
 * MySQL:
-----------------------------------
CREATE TABLE  IF NOT EXISTS `sizes`
(
    `size` VARCHAR(3) NOT NULL,
    `width` MEDIUMINT UNSIGNED NOT NULL ,
    `height` MEDIUMINT UNSIGNED NOT NULL ,
    PRIMARY KEY (`size`)
)
ENGINE = MyISAM;
-----------------------------------
 * require 'pdo.php';
 * $query = $pdo->prepare("SELECT password FROM users WHERE size=:size");
 * $query->execute(['size' => $size]);
 * $img_size = $query->fetch();
 * $img_h = $img_size['height'];
 * $img_w = $img_size['width'];
 * */

$filename = substr($name, 0 , (strrpos($name, '.')));
foreach ($imgSize as $key => $size) {
    echo '<p><img src="', $cache_folder, $filename, '-', $key, '.jpg" /></p>';
}
foreach ($imgSize as $key => $size) {
    echo '<a href="', $cache_folder, $filename, '-', $key, '.jpg">open ', $key, ' image</a></p>';
}
echo '<a href="', $gallery_folder, $name, '">open original file</a>';

require 'menu.php';
require 'footer.php';

/*
 * В ТЗ указано что этот файл должен изменять размер изображения.
 * Для этого можно вызвать функцию класса Image reduce($_GET['size']) сделав её public
 * */