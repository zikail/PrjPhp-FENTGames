<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/question.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>Game Over!</title>
</head>
<body>
    <?php
    session_start();
    $scoreCounter = $_SESSION["scoreCounter"];
    $livesCounter = $_SESSION["livesCounter"] = 6;

    echo "<h2>Game over!<br></h2>" . "<br>";
    echo "Your score was: $scoreCounter" . "<br>";
    $_SESSION["scoreCounter"] = 0;
    echo "<br>";
    echo "<button onclick=\"window.location.href = 'question1.php';\">Try again</button>&nbsp&nbsp";
    echo "<button onclick=\"window.location.href = 'userDashboard.php';\">Quit</button>";
    ?>
</body>
</html>