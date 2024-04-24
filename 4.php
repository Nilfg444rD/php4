<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $question1 = isset($_POST['question1']) ? $_POST['question1'] : '';
    $question2 = isset($_POST['question2']) ? $_POST['question2'] : '';
    $question3 = isset($_POST['question3']) ? $_POST['question3'] : [];

    // Process and display the form data
    echo "<h2>Test Results:</h2>";
    echo "<p>Name: " . htmlspecialchars($name) . "</p>";
    echo "<p>Question 1: " . htmlspecialchars($question1) . "</p>";
    echo "<p>Question 2: " . htmlspecialchars($question2) . "</p>";
    echo "<p>Question 3: </p><ul>";
    foreach ($question3 as $answer) {
        echo "<li>" . htmlspecialchars($answer) . "</li>";
    }
    echo "</ul>";
} else {
    // Form not submitted, display the form
?>
    <form action="" method="post">
        <p>Name: <input type="text" name="name" required></p>
        <p>Question 1: <input type="radio" name="question1" value="Option 1"> Option 1
                        <input type="radio" name="question1" value="Option 2"> Option 2</p>
        <p>Question 2: <input type="radio" name="question2" value="Option 1"> Option 1
                        <input type="radio" name="question2" value="Option 2"> Option 2</p>
        <p>Question 3: <input type="checkbox" name="question3[]" value="Option 1"> Option 1
                        <input type="checkbox" name="question3[]" value="Option 2"> Option 2
                        <input type="checkbox" name="question3[]" value="Option 3"> Option 3</p>
        <input type="submit" value="Submit">
    </form>
<?php
}
?>
