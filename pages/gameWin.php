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

    // Get registrationOrder based on username
    $sql = "SELECT registrationOrder FROM player WHERE userName = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $registrationOrder = $row['registrationOrder'];

    $sql = "INSERT INTO score (scoreTime, result, score, livesUsed, registrationOrder) VALUES (now(), 'win', $scoreCounter, $livesCounter, $registrationOrder)";
    if ($conn->query($sql) === TRUE) 
    {
        echo "<h1 class=\"rainbow\">You Win!</h1>" . "<br>";
        echo "<p>Your score was: $scoreCounter</p>" . "<br>";
        echo "<p>You had $livesCounter lives remaining.</p>" . "<br>";
        echo "<br>";
        echo "<button onclick=\"window.location.href = 'index.php';\">Quit</button>";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    unset($_SESSION["scoreCounter"]);
    unset($_SESSION["livesCounter"]);
    unset($_SESSION["letters"]);
    unset($_SESSION["letters_q2"]);
    unset($_SESSION["nums_q3"]);
    unset($_SESSION["nums_q4"]);
    unset($_SESSION["letters_q5"]);
    unset($_SESSION["nums_q6"]);
    ?>
</body>
</html>