<?php
require_once "./ProductClass.php";

class DiscoundtedProductClass extends Product
{
    public int $discount;

    public function __construct(string $name, float $price, string $description, int $discount)
    {
        parent::__construct($name, $price, $description);
        $this->discount = $discount;
    }

    public function calculate_discount_price() {
        $discount_price = $this->price * (1 - $this->discount / 100);
        return "<p> Нова ціна зі знижкою у ".$this->discount."%: ".$discount_price."</p>";
    }

    public function get_info()
    {
        echo parent::get_info()."\n".$this->calculate_discount_price();
    }
}
