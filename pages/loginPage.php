<!--Login page
by Leonardo Dueñas-->
<!DOCTYPE html>
<html lang="EN">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/login.css">

        <link rel="icon" type="image/png" href="../assets/images/logo.png">
        <title>Log In</title>
    </head>

    <body>
        <div class="outer-container">
        
            <div class="loginContainer">
                <h1>Log In</h1>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div>
                        <label>Username:
                        <input type="text" placeholder="username" name="usernameInput" required></label>
                        </br></br>
                        <label>Password:
                        <input type="password" placeholder="********" name="passwordInput" required></label>
                        </br></br>
                    </div>

                    <div class="login-buttons">
                    <input type="submit" name="sbmt" value="SEND">

                    <a href="SignUpPage.php"><button type="button">Sign Up</button></a>

                    <a href="*">Don't remember your password?</a>
                    </div>
                </form>
            </div>

            <div class="back-button">
                    <a href="index.php"><button type="button">Go Back</button></a>
            </div>
        </div>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
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

                $username = $_POST['usernameInput'];
                $password = $_POST['passwordInput'];

                // SQL query to check if username and password match
                $sql = "SELECT * FROM player p JOIN authenticator a ON p.registrationOrder = a.registrationOrder WHERE p.userName='$username' AND a.passCode='$password'";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) 
                {
                    // Start session and redirect to dashboard or home page
                    session_start();
                    $_SESSION['username'] = $username;
                    header("Location: index.php");
                    exit();
                } 
                else 
                {
                    echo '<p>Incorrect username or password</p>';
                }

                $conn->close();
            }
    ?>
    </body>
</html>