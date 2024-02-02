<?php

class Ramen {

private $ramen_name;
private $restaurant_name;
private $price;
private $rating;
private $location;
private $email;

public function __construct($ramen_name, $restaurant_name, $price, $rating, $location, $email){
$this->ramen_name = $ramen_name;
$this->restaurant_name = $restaurant_name;
$this->price = $price;
$this->rating = $rating;
$this->location = $location;
$this->email = $email;
}

public function theBest(){
 echo $this->restaurant_name . " is the best!"."</br>"."Their ".$this->ramen_name . " is really good!"."</br></br>";
}

public function get_ramen_name(){
    return $this->ramen_name;
}

}

$ramen1 = new Ramen("Shouyu ramen","Shougensui",800,5,"Mukonoso","ayamaguchi@gmail.com");
$ramen2 = new Ramen("Charshiu ramen","Tekkaippin",600,4.5,"Mukonoso","ayamaguchi@gmail.com");

echo $ramen1 -> price ;







