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

<body style="display: flex">
    <div class="question">
        <?php
        $message = "";

        session_start();

        // Set the lives and score counter
        if (!isset($_SESSION["livesCounter"])) 
        {
            $_SESSION["livesCounter"] = 6;
        } 
        else 
        {
            $livesCounter = $_SESSION["livesCounter"];
        }
        if (!isset($_SESSION["scoreCounter"])) 
        {
            $_SESSION["scoreCounter"] = $scoreCounter = 0;
        } 
        else 
        {
            $scoreCounter = $_SESSION["scoreCounter"];
        }

        $username = $_SESSION["username"];
        
        // Check if the user has submitted an answer and compares it to the correct answer
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = $_POST["answer"];
            $inputLetters = str_split(str_replace(' ', '', $input));
        
            // Sort the letters in ascending order for checking the user's input
            $letters = $_SESSION["letters"];
            $sortedLetters = $letters;
            sort($sortedLetters);
        
            // Check if the user's input is correct, if it is, increment the score counter
            if ($inputLetters === $sortedLetters) 
            {
                $scoreCounter+= 10;
                $_SESSION["scoreCounter"] = $scoreCounter;
                header("Location: question2.php");
            } 
            else 
            {
                $message = "<p style=\"color: red\">Sorry, that's not correct. Try again.</p>";
                $_SESSION["livesCounter"]--;
                if ($scoreCounter > 0) 
                {
                    $scoreCounter -= 2;
                }
                $_SESSION["scoreCounter"] = $scoreCounter;
                unset($_SESSION["letters"]); // Unset the letters in the session
                if ($_SESSION["livesCounter"] <= 0) {
                    header("Location: gameOverFail.php");
                    exit();
                }
            }
        }
        
        // Generate 6 unique random letters
        if (!isset($_SESSION["letters"])) {
            $letters = range('a', 'z');
            shuffle($letters);
            $letters = array_slice($letters, 0, 6);
        
            // Randomly decide if the letters should be uppercase or lowercase
            if (rand(0, 1) == 0) {
                $letters = array_map('strtoupper', $letters);
            }
        
            $_SESSION["letters"] = $letters;
        } else {
            $letters = $_SESSION["letters"];
        }
        echo "<h1 class=\"rainbow\">Question 1</h1><br>";
        echo "<u><h2>Sort the letters in ascending order!</h2></u>";
        echo "<h2>Letters: " . implode(" ", $letters) . "</h2>";

        echo "<p>Your score: $scoreCounter</p>";
        echo "<p>Lives left: " . $_SESSION["livesCounter"] . "</p>";
        ?>
        
        <div class="options">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="answer">Your Answer:</label>
                <input type="text" id="answer" name="answer">
                <button>Submit</button>
                <?php
                echo "<br><br>Instructions: Answer structure must look like A A A A A A (Case-sensitive). <br>";
                echo "<br><br>" . $message;
                ?>
            
            </form>
            <button onclick="endGame()">End Game</button>
            <button onclick="signOut()">Sign Out</button>
            <script>
                function endGame() 
                {
                    if (confirm("Are you sure you want to end the game? Your progress will be lost!")) 
                    {
                        window.location.href = "gameOverFail.php";
                    }
                }
                function signOut() 
                {
                    if (confirm("Are you sure you want to sign out?")) 
                    {
                        window.location.href = "../includes/logout.php";
                    }
                }
            </script>
        </div>
    </div>
</body>

</html>