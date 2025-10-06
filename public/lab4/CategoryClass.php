<?php
class Category {
    public string $category_name;
    public array $list_of_products;

    public function __construct(string $name) {
        $this->category_name = $name;
        $this->list_of_products = [];
    }

    public function add_product_to_category(object $product): void {
        $this->list_of_products[] = $product;
    }

    public function render_category_html(): string {
        $html = "<div style='margin-bottom: 15px;'>";
        $html .= "<strong>Категорія:</strong> " . htmlspecialchars($this->category_name) . "<br>";
        $html .= "<strong>Товари:</strong><br>";

        if (!empty($this->list_of_products)) {
            foreach ($this->list_of_products as $product) {
                $html .= "- " . htmlspecialchars($product->name) . "<br>";
            }
        } else {
            $html .= "<em>Немає товарів</em><br>";
        }

        $html .= "</div>";
        return $html;
    }

    public static function render_all_categories(array $categories): string {
        if (empty($categories)) {
            return "<p>Жодної категорії не збережено 📝</p>";
        }

        $output = "";
        foreach ($categories as $category) {
            $output .= $category->render_category_html();
        }
        return $output;
    }
}
