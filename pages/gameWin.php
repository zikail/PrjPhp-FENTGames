<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/question.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>You Win!</title>
</head>
<body>
    <?php
    session_start();
    $scoreCounter = $_SESSION["scoreCounter"];
    $livesCounter = $_SESSION["livesCounter"];
    $username = $_SESSION["username"];

    // Database connection
    $servername = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $dbname = "fentgames";

    // Create connection
    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO score (username, score) VALUES ('$username', $scoreCounter)";
    if ($conn->query($sql) === TRUE) 
    {
        echo "<h1 class=\"rainbow\">You Win!</h1>" . "<br>";
        echo "<p>Your score was: $scoreCounter</p>" . "<br>";
        echo "<p>You had $livesCounter lives remaining.</p>" . "<br>";
        $_SESSION["livesCounter"] = 6;
        $_SESSION["scoreCounter"] = 0;
        session_destroy();
        echo "<br>";
        echo "<button onclick=\"window.location.href = 'index.php';\">Quit</button>";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    ?>
</body>
</html>