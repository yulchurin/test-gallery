<?php

namespace winestyle;

class Image
{
    private $filename;
    private $name;
    private $tmp_name;
    private $type;
    private $size;
    private $raw_image;
    private $width;
    private $height;
    private $temp_image;
    private $orig;

    public function __construct($image)
    {
        $this->filename = substr($image['name'], 0 , (strrpos($image['name'], '.'))); // здесь мы убрали расширение из имени, так как там мог быть и джипег, и битмап, и пнг
        $this->name = $image['name'];
        $this->tmp_name = $image['tmp_name'];
        $this->size = $image['size'];
        $this->type = $image['type'];

    }
    public function upload()
    {
        global $sizes;
        $max_size = 10000000; // ограничение максимального размера в байтах
        if ($this->size > $max_size) {
            exit("размер файла не должен превышать $max_size байт");
        }
        move_uploaded_file($this->tmp_name, GALLERY . $this->name); //копируем оригинал файла в папку галереи
        $this->orig = GALLERY . $this->name;
        $this->createRawImage();
        $this->reduce('big');
        $this->reduce('med');
        $this->reduce('min');
        $this->reduce('mic');
        $this->deleteImagesFromMemory();
    }
    private function createRawImage()
    {
        if ($this->type === 'image/jpeg') {
            $this->raw_image = imagecreatefromjpeg($this->orig);
        }
        elseif ($this->type === 'image/png') {
            $this->raw_image = imagecreatefrompng($this->orig);
        }
        elseif ($this->type === 'image/gif') {
            $this->raw_image = imagecreatefromgif($this->orig);
        }
        elseif ($this->type === 'image/bmp') {
            $this->raw_image = imagecreatefrombmp($this->orig);
        }
        elseif ($this->type === 'image/webp') {
            $this->raw_image = imagecreatefromwebp($this->orig);
        }
        elseif ($this->type === 'image/gd') {
            $this->raw_image = imagecreatefromgd($this->orig);
        }
        elseif ($this->type === 'image/gd2') {
            $this->raw_image = imagecreatefromgd2($this->orig);
        }
        elseif ($this->type === 'image/wbmp') {
            $this->raw_image = imagecreatefromwbmp($this->orig);
        }
        else {
            echo 'Этот формат не поддерживается...';
            return false;
        }
        $this->width = imagesx($this->raw_image);
        $this->height = imagesy($this->raw_image);
    }
    private function fixPngTransparent($temp)
    {
        imagealphablending($temp, true);
        imageSaveAlpha($temp, true);
        $transparent = imagecolorallocatealpha($temp, 0, 0, 0, 127);
        imagefill($temp, 0, 0, $transparent);
        imagecolortransparent($temp, $transparent);
    }
    private function reduce($size, $quality=80)
    {
        global $imgSize;
        $max_width = $imgSize[$size]['w'];
        $max_height = $imgSize[$size]['h'];
        if ($this->width > $max_width || $this->height > $max_height) {
            $width = ceil($max_height / ($this->height / $this->width));
            $height = ceil($max_width / ($this->width / $this->height));
            if ($width > $max_width) {
                $width = $max_width;
            } else {
                $height = $max_height;
            }
            $this->temp_image = imagecreatetruecolor($width, $height);
            if ($this->type === 'image/png' || $this->type === 'image/gif') {
                $this->fixPngTransparent($this->temp_image);
            }
            imagecopyresampled($this->temp_image, $this->raw_image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
            imagejpeg($this->temp_image, CACHE.$this->filename.'-'.$size.'.jpg', $quality);
        }
    }
    private function deleteImagesFromMemory()
    {
        imagedestroy($this->raw_image);
        imagedestroy($this->temp_image);
    }
}