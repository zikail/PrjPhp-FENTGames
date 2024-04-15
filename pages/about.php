<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>About Fent Games</title>
</head>

<body>
    <?php
     session_start();
     if (isset($_SESSION["username"])) 
     {
         include('../includes/signedinheader.php');
     } 
     else 
     {
         include('../includes/header.php');
     }
    ?>
    <u><h1>About Fent Games</h1></u>
    <p style="font-size: 20px;">
        Fent Games is a platform dedicated to bringing you the best online gaming experience. <br> 
        Our team is passionate about gaming and we work tirelessly to create fun, engaging games for people of all ages.
    </p>
    <br>
    <p>
        Created by: Abdelraouf, Ariel, Leonardo and Shehreyaar
    </p>
</body>

</html>