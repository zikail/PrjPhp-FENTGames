<!--Login page
by Leonardo Dueñas-->
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div>
                <label>Username:
                <input type="text" placeholder="username" name="usernameInput" required></label>
                </br>
                <label>Password:
                <input type="password" placeholder="********" name="passwordInput" required></label>
                </br></br>
            </div>
            <input type="submit" name="sbmt" value="SEND">

            <a href="SignUpPage.php"><button type="button">Sign Up</button></a>

            <a href="*">Don't remember your password?</a>
        </form>


        <?php
            if (isset($_POST['loginSubmit']))
            {
                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "fentGames";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }

                $username = $_POST['usernameInput'];
                $password = $_POST['passwordInput'];

                // SQL query to check if username and password match
                $sql = "SELECT * FROM authenticator WHERE userName='$username' AND passCode='$password'";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) 
                {
                    // Start session and redirect to dashboard or home page
                    session_start();
                    $_SESSION['username'] = $username;
                    header("Location: dashboard.php");
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