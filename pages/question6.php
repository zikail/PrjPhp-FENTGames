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
        session_start();

        $message = "";

        // Set the lives and score counter
        if (!isset($_SESSION["livesCounter"])) {
            $_SESSION["livesCounter"] = 6;
        } else {
            $livesCounter = $_SESSION["livesCounter"];
        }

        if (!isset($_SESSION["scoreCounter"])) {
            $_SESSION["scoreCounter"] = $scoreCounter = 0;
        } else {
            $scoreCounter = $_SESSION["scoreCounter"];
        }
        $username = $_SESSION["username"];
        // Check if the user has submitted an answer and compares it to the correct answer
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $input = $_POST["answer"];
            $inputNums = array_map('intval', explode(' ', $input));

            // Find the smallest and largest nums
            $nums = $_SESSION["nums_q6"];
            $smallestNum = min($nums);
            $largestNum = max($nums);

            // Check if the user's input is correct, if it is, increment the score counter
            if ($inputNums[0] === $smallestNum && $inputNums[1] === $largestNum) 
            {
                $scoreCounter += 10;
                $_SESSION["scoreCounter"] = $scoreCounter;
                header("Location: gameWin.php");

            } 
            else 
            {
                $message = "<p style=\"color: red\">Sorry, that's not correct. Try again.</p>";
                $_SESSION["livesCounter"]--;
                if ($scoreCounter > 0) {
                    $scoreCounter -= 2;
                }
                $_SESSION["scoreCounter"] = $scoreCounter;
                unset($_SESSION["nums_q6"]); // Unset the numbers in the session
                if ($_SESSION["livesCounter"] <= 0) 
                {
                    header("Location: gameOverFail.php");
                    exit();
                }
            }
        }

        // Generate 6 unique random numbers for question 6
        if (!isset($_SESSION["nums_q6"])) 
        {
            $nums_q6 = range(1, 100);
            shuffle($nums_q6);
            $nums_q6 = array_slice($nums_q6, 0, 6);

            $_SESSION["nums_q6"] = $nums_q6;
        }

        echo "<h1 class=\"rainbow\">Question 6</h1><br>";
        echo "<u><h2>Identify the smallest and the largest number in the set of 6 numbers</h2></u>";
        echo "<h2>Numbers: " . implode(", ", $_SESSION["nums_q6"]) . "</h2>";

        echo "<p>Your score: $scoreCounter</p>";
        echo "<p>Lives left: " . $_SESSION["livesCounter"] . "</p>";
        ?>

        <div class="options">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="answer">Your Answer:</label>
                <input type="text" id="answer" name="answer">
                <button>Submit</button>

                <?php
                echo "<br><br>" . $message;
                ?>
            </form>
            <button onclick="endGame()">End Game</button>
            <script>
                function endGame() 
                {
                    if (confirm("Are you sure you want to end the game? Your progress will be lost!")) 
                    {
                        window.location.href = "gameOverFail.php";
                        exit();
                    }
                }
            </script>
        </div>
    </div>
</body>

</html>