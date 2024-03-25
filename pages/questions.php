<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>Fent Games</title>
</head>

<body>
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

        echo "Letters: " . implode(" ", $letters) . "<br>";

        echo "Your score: $scoreCounter<br>";
        echo "Lives left: $livesCounter<br>";
        ?>
    
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            Enter the letters in ascending order: <input type="text" name="input">
            <input type="submit">
        </form>
</body>

</html>