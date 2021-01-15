<?php
require 'config.php';
require 'Image.php';
if (isset($_FILES['image']) && isset($_POST['submit'])) {
    $image = new \winestyle\Image($_FILES['image']);
    $image->upload();
}
require 'header.php';
?>
<form method="post" action="upload.php" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" name="submit">
</form>
<?php
require 'menu.php';
require 'footer.php';