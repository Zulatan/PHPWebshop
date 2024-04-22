<?php
require_once "product.php";

class iphone extends product
{
    public $image;

    public function __construct($newImage) {
        parent::__construct($newImage);
        $this->image = $newImage;
    }
}