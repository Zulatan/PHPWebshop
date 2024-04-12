<?php

class product {
    public $name;
    public $image;
    public $price;
    public $description;

    public function __construct($newName, $newImage, $newPrice, $newDescription){
        $this->name = $newName;
        $this->image = $newImage;
        $this->price = $newPrice;
        $this->description = $newDescription;
    }

    #Getters
    public function getName() {
        return $this->name;
    }
    public function getImage() {
        return $this->image;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getDescription() {
        return $this->description;
    }

    #Setters
    public function setName($newName) {
        $this->image = $newName;
    }
    public function setImage($newImage) {
        $this->image = $newImage;
    }
    public function setPrice($newPrice) {
        $this->image = $newPrice;
    }
}


