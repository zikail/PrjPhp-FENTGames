<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/history.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>Player History</title>
</head>

<body>
<?php
    if (isset($_SESSION["username"])) 
    {
        include('../includes/signedinheader.php');
    } 
    else 
    {
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
    <div class="intro">
    <h1 class="title">Player History</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Result</th>
                <th>Lives Used</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
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

            // Query to retrieve the player's history
            $sql = "SELECT s.scoreTime, s.result, s.livesUsed
                    FROM score s
                    WHERE s.registrationOrder = $registrationOrder
                    ORDER BY s.scoreTime DESC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0)
             {
                // Fetch and display each row of the result
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row["scoreTime"] . "</td>";
                    echo "<td>" . $row["result"] . "</td>";
                    echo "<td>" . $row["livesUsed"] . "</td>";
                    echo "</tr>";
                }
            } 
            else 
            {
                echo "<tr><td colspan='3'>No records found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
    </div>
</body>

</html>