<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/lose.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>Game Over!</title>
</head>
<body>
    <div class="container">
        <div class="char section">
            <br>
            <img src="../assets/images/charlose2.png" alt="games">
            <br>
        </div>
        <div class="intro section" style="margin-top: 40px;">
            <br><br><br>
            <?php
            session_start();
            $scoreCounter = $_SESSION["scoreCounter"];
            $livesCounter = $_SESSION["livesCounter"] = 6;

            echo "<h1>Game over!<br></h1>" . "<br>";
            echo "<h1>Your score was: $scoreCounter </h1>" . "<br>";
            $_SESSION["scoreCounter"] = 0;
            
            echo "<br>";
            echo "<button class=\"btnTry\" onclick=\"window.location.href = 'question1.php';\">Try again</button>&nbsp&nbsp";
            echo "<button class=\"btnQu\" onclick=\"window.location.href = 'userDashboard.php';\">Quit</button>";
            ?>
            
            <br><br><br>
            
        </div>
        <div class="char section">
            <br>
            <img src="../assets/images/charlose1.png" alt="games">
            <br>
        </div>
    </div>
    
</body>
</html>