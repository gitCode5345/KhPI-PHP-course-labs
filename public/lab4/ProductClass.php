<?php
class Product
{
    public string $name;
    protected float $price;
    public string $description;

    public function __construct(string $name, float $price, string $description) {
        $price = $this->validate_price($price);

        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    protected function validate_price(float $price) {
        if ($price < 0) {
            $price = $price * -1;
        }

        return $price;
    }

    public function get_info() {
        echo "<p>Назва: ".$this->name."</p>\n
              <p>Ціна: ".$this->price."</p>\n
              <p>Опис: ".$this->description."</p>";
    }
}
