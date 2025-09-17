<?php
# Завдання 7: ми створюємо index.html, додаємо туди форму, у цій формі необхідно вказати на .php файл і в цьому файлі
#             приймаємо імʼя та прізвище, яке потім виводимо на сторінку
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];

if (($firstname == null or $lastname == null) or (!is_string($firstname) or !is_string($lastname))) {
    echo "Error";
    return 1;
}

echo "<p>Hello ".$firstname." ".$lastname."!</p>";
