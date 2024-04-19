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
    include('../includes/header.php');
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

            <button id="playBtn" class="playBtn" onclick="openLoginPage()">Play Now</button>
            <script>
                function openLoginPage() {
                window.location = 'loginPage.php';
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
    </div>

    <?php include('../includes/footer.php'); ?>


</body>

</html>