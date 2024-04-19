<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/scoreboard.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>Scoreboard</title>
</head>

<body>
    <h1>Scoreboard</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php
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

            // Query to retrieve player names and scores in ascending order
            $sql = "SELECT p.fName, p.lName, s.score
                    FROM player p
                    JOIN score s ON p.registrationOrder = s.registrationOrder
                    ORDER BY s.score ASC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                // Fetch and display each row of the result
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row["fName"] . " " . $row["lName"] . "</td>";
                    echo "<td>" . $row["score"] . "</td>";
                    echo "</tr>";
                }
            } 
            else 
            {
                echo "<tr><td colspan='2'>No records found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>