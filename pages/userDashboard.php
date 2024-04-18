<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>Fent-Games Dashboard</title>
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
            }
        }
        </script>";          
    }
    ?>
    <div class="dashboard">
        <h1>Welcome to the Game Dashboard</h1>
        <br>
            <img src="../assets/images/dchar.png" alt="games">
        <br>
        <div class="options">
            <a href="scoreboard.php" class="btnOption">Scoreboard</a>
            <a href="question1.php" class="btnOption">Game</a>
            <a href="history.php" class="btnOption">History</a>
        </div>

    </div>
    

    <?php include('../includes/footer.php'); ?>
</body>
</html>