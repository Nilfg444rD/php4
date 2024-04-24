<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Comment Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    #my-shop {
      font-size: 24px;
      margin-bottom: 10px;
    }

    #write-comment {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .form-group {
      margin-bottom: 10px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type=text],
    input[type=email],
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
    }

    input[type=checkbox] {
      margin-right: 5px;
    }

    input[type=submit] {
      padding: 8px 15px;
      cursor: pointer;
    }

    .navbar {
      overflow: hidden;
      background-color: #333;
      padding: 15px;
    }

    .navbar a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

    .navbar a.exit {
      float: right;
    }
  </style>
</head>

<body>
  <?php
  $name = $mail = $comment = "";
  $nameErr = $mailErr = $commentErr = $dataProcessingAgreementErr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Валидация имени
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // Проверка на наличие только букв и пробелов
      if (!preg_match("/^[a-zA-Z ]*$/", $name) || strlen($name) < 3 || strlen($name) > 20) {
        $nameErr = "Only letters and white space allowed, and must be 3-20 characters long";
      }
    }

    // Валидация электронной почты
    if (empty($_POST["mail"])) {
      $mailErr = "Email is required";
    } else {
      $mail = test_input($_POST["mail"]);
      // Проверка формата электронной почты
      if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $mailErr = "Invalid email format";
      }
    }

    // Валидация комментария
    if (empty($_POST["comment"])) {
      $commentErr = "Comment is required";
    } else {
      $comment = test_input($_POST["comment"]);
      // Дополнительные критерии валидации комментария можно добавить здесь
    }

    // Проверка согласия на обработку данных
    if (!isset($_POST["dataProcessingAgreement"])) {
      $dataProcessingAgreementErr = "You must agree to the data processing";
    }

    // Если ошибок нет, выводим комментарий
    if (empty($nameErr) && empty($mailErr) && empty($commentErr) && empty($dataProcessingAgreementErr)) {
      echo "<div id='submitted-comment'>";
      echo "<p><strong>Name:</strong> $name</p>";
      echo "<p><strong>Email:</strong> $mail</p>";
      echo "<p><strong>Comment:</strong> $comment</p>";
      echo "</div>";
    }
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>


  <div class="navbar">
    <a href="#home">Home</a>
    <a href="#comments">Comments</a>
    <a href="#exit" class="exit">Exit</a>
  </div>

  <div id="my-shop">My Shop</div>
  <div id="write-comment">Write a Comment</div>

  <form id="commentForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name">
    </div>
    <div class="form-group">
      <label for="mail">Mail:</label>
      <input type="email" id="mail" name="mail">
    </div>
    <div class="form-group">
      <label for="comment">Comment:</label>
      <textarea id="comment" name="comment"></textarea>
    </div>
    <div class="form-group">
      <input type="checkbox" id="dataProcessingAgreement" name="dataProcessingAgreement">
      <label for="dataProcessingAgreement">Do you agree with data processing?</label>
    </div>
    <input type="submit" value="Send">
  </form>

  <?php
  // PHP валидация и вывод данных здесь
  ?>

</body>

</html>