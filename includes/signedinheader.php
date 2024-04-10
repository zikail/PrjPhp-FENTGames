<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>
<body>
    <header class="top">
        <!-- NAVIGATION BAR | MENU -->
        <h2 class="logo">TEAM 3</h2> 
        <nav class="navigation">
            <a href="../pages/index.php">Home</a> 
            <a href="../about_page/index_about_page.html">About</a>  
            <button class="btnSignUp" onclick="window.location.href = '../includes/logout.php';">Sign Out</button>&nbsp;&nbsp;
            Welcome, <?php echo $_SESSION["username"]; ?>
        </nav>
    </header>
</body>
</html>