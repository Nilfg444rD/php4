<?php
$name = $email = $review = $comment = "";
$form_is_submitted = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_is_submitted = true;
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $review = test_input($_POST["review"]);
    $comment = test_input($_POST["comment"]);

    // Проверка и валидация данных здесь
    if (empty($name)) {
        $errors['name'] = "Имя не может быть пустым";
    }
    // Подобные проверки можно добавить для других полей...
}

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
    <title>Форма обратной связи</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset>
        <legend>Оставьте отзыв:</legend>
        <div id="main_info" style="display: flex; flex-direction: column; gap: 10px;">
            <div>
                <label for="name">Имя:</label>
                <input type="text" name="name" value="<?php echo $name; ?>"/>
                <?php if (!empty($errors['name'])) echo $errors['name']; ?>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $email; ?>"/>
                <!-- Здесь можно выводить ошибки для email -->
            </div>
        </div>
        <div id="extra_info">
            <p><label for="review">Оцените нас сервис:</label></p>
            <div style="display: flex; flex-direction: column;">
                <p>
                    <input id="review" type="radio" name="review" value="10" <?php if($review=="10") echo "checked"; ?>>Отлично</p>
                <p>
                    <input id="review" type="radio" name="review" value="8" <?php if($review=="8") echo "checked"; ?>>Хорошо</p>
                <p>
                    <input id="review" type="radio" name="review" value="5" <?php if($review=="5") echo "checked"; ?>>Удовлетворительно</p>
                <!-- Здесь можно выводить ошибки для оценки -->
            </div>
        </div>
        <div id="message_info">
            <p><label for="comment">Ваш комментарий: </label></p>
            <textarea id="comment" name="comment" cols="30" rows="10"><?php echo $comment; ?></textarea>
            <!-- Здесь можно выводить ошибки для комментария -->
        </div>
        <div id="buttons" style="display: flex; flex-direction: row; gap: 10px; margin-top: 10px;">
            <input type="submit" value="Отправить"/>
            <input type="reset" value="Очистить"/>
        </div>
    </fieldset>
</form>

<?php if ($form_is_submitted && empty($errors)): ?>
    <div>
        <p>Ваше имя: <?php echo $name; ?></p>
        <p>Ваш e-mail: <?php echo $email; ?></p>
        <p>Ваша оценка: <?php echo $review; ?></p>
        <p>Ваше сообщение: <?php echo $comment; ?></p>
    </div>
<?php endif; ?>

</body>
</html>
