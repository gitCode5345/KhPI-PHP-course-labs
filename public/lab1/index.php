<?php
# Завдання 1: тут ми викликаємо функцію echo яка буде виводити на сторінку наш рядок
echo "Hello, world!";

# Завдання 2: ми створюємо змінні та виводимо їх типи даних, у нашому випадку це string, int, float, bool
$string_variable = 'Hello!)';
$int_variable = 10;
$float_variable = 10.5;
$boolean_variable = true;

var_dump($string_variable, $int_variable, $float_variable, $boolean_variable);


# Завдання 3: реалізуємо конкатенацію двох рядків
$first_part_str = "PHP";
$second_part_str = "_labs";
$concatenate_str = $first_part_str.$second_part_str;

echo $concatenate_str;

# Завдання 4: використовуємо конструкцію if-else для того щоб перевірити число на парність
$num = 20;
if ($num % 2 == 0) {
    echo "This num is even";
} else {
    echo "This num is odd";
}

# Завдання 5: використовуємо цикли та оператор while для виводу чисел: 
for ($i = 1; $i < 10; $i++) { 
    echo $i;
}

$iterations = 10;
$stop_num = 0;

while ($iterations != $stop_num) {
    echo $iterations;
    $iterations--;
}

# Завдання 6: створюємо асоціативний масив виводимо його зміст, потім додаємо ще одну пару ключ:значення
$student = array("name" => "Ivan", "surname" => "Ivanov", "age" => 19, "specialization" => "Computer science");

foreach ($student as $key => $value) {
   echo $key;
   echo " ";
   echo $value;
   echo " ";
}

$student["avg_assessment"] = 98.8;

foreach ($student as $key => $value) {
   echo $key;
   echo " ";
   echo $value;
   echo " ";
}
