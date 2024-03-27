<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/question.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>Fent Games</title>
</head>

<body>
    <div class="question">
        <?php
            $livesCounter = 6;
            $scoreCounter = 0;
        
            // Generate 6 unique random letters
            $letters = range('a', 'z');
            shuffle($letters);
            $letters = array_slice($letters, 0, 6);
        

            // Randomly decide if the letters should be uppercase or lowercase
            if (rand(0, 1) == 0) 
            {
                $letters = array_map('strtoupper', $letters);
            }
        
            if ($livesCounter == 0) 
            {
                die("Game over." . "<br>");
            }

            echo "<h2>Letters: " . implode(" ", $letters) . "</h2>";

            echo "<p>Your score: $scoreCounter</p>";
            echo "<p>Lives left: $livesCounter</p>";
        ?>
        <div class="options">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <label for="answer">Your Answer:</label>
                <input type="text" id="answer" name="answer">
                <button>Submit</button>
            </form>
        </div>
    </div>
</body>
</html>