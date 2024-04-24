<?php
// Инициализируем переменные для хранения данных из формы
$number = "";
$selection = "";

// Проверяем, была ли форма отправлена
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = test_input($_POST["number"]);
    $selection = test_input($_POST["selection"]);
}

// Функция для очистки данных формы
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма с разными контролами</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="number">Введите число:</label>
    <input type="number" id="number" name="number" value="<?php echo $number; ?>"><br><br>
    
    <label for="selection">Выберите опцию:</label>
    <select id="selection" name="selection">
        <option value="option1">Опция 1</option>
        <option value="option2" <?php if ($selection == "option2") echo "selected"; ?>>Опция 2</option>
        <option value="option3" <?php if ($selection == "option3") echo "selected"; ?>>Опция 3</option>
    </select><br><br>
    
    <input type="submit" value="Отправить">
</form>

<?php
// Проверяем, были ли данные отправлены
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Выводим данные
    echo "<h2>Введенные данные:</h2>";
    echo "Число: $number<br>";
    echo "Выбранная опция: $selection<br>";
}
?>

</body>
</html>
