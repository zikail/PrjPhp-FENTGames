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
    session_start();
    if (isset($_SESSION["username"])) {
        include('../includes/signedinheader.php');
    } else {
        include('../includes/header.php');
        echo "<script>
        window.onload = function() {
            var playButton = document.getElementById('playBtn');
            playButton.style.backgroundColor = \"grey\";
            playButton.onclick = function() 
            {
                alert('You must be signed in to play!');
            }
        }
        </script>";
    }
    ?>
    <div class="container">
        <div class="char section">
            <br>
            <img src="../assets/images/char3.png" alt="games">
            <br>
        </div>

        <div class="intro section" style="margin-top: 40px;">
            <br>
            <h1 class="title">Welcome</h1>
            <h1 class="title"> To Fent Games</h1>
            <br><br><br>
            <h2 class="subtitle">Where you can find</h2>

            <h2 class="subtitle"> the best games</h2>
            <br><br><br>

            <button id="playBtn" class="playBtn" onclick="playGame();">Play Now</button>
            <script>
                function playGame() {
                    var playButton = document.getElementById("playBtn");
                    if (!playButton.disabled) 
                    {
                        window.location.href = 'question1.php';
                    }
                }
            </script>
            <br><br><br>
            <h2 class="subtitle">Unleash</h2>
            <h2 class="subtitle">Your Potential</h2>
        </div>
        <div class="char section">
            <br>
            <img src="../assets/images/char1.png" alt="games">
            <br>
        </div>

        <?php include('../includes/footer.php'); ?>


</body>

</html>