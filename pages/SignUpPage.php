<!DOCTYPE html>
<html>
    <head>
        <script>
            function passwordStrength(str)
             {
                if (str.length == 0) 
                {
                    document.getElementById("passwordSuggestion").innerHTML = "";
                    return;
                } 
                else 
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("passwordSuggestion").innerHTML = this.responseText;
                            if (this.responseText == "Strong password"){
                                document.getElementById("sub").disabled = false;
                            } else {
                                document.getElementById("sub").disabled = true;
                            }
                        }
                    };
                    xmlhttp.open("GET", "passwordAJAX.php?q=" + str, true);
                    xmlhttp.send();
                }
            }

        </script>
    </head>
    <body>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <fieldset>
                <legend>Sign up</legend>
                </br>
                <label for="uname">Enter username: </label>
                <input type="text" required name="usernameInput">

                <br><br>

                <label for="pword">Enter password: </label>
                <input type="text" required name="passwordInput" onkeyup="passwordStrength(this.value)">

                <br>

                <p><span id="passwordSuggestion"></span></p>

                <br>

                <input id="sub" type="submit" name="signUpSumbit" value="SIGNUP" disabled>
            </fieldset>
            
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
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

                // Get username and password from form
                $username = $_POST['usernameInput'];
                $password = $_POST['passwordInput'];

                // SQL query to insert username and password into the authenticator table
                $sql = "INSERT INTO authenticator (passCode, registrationOrder) 
                        SELECT '$password', registrationOrder 
                        FROM player 
                        WHERE userName='$username'";

                if ($conn->query($sql) === TRUE) 
                {
                    // Start session and redirect to dashboard or home page
                    session_start();
                    $_SESSION['username'] = $username;
                    header("Location: dashboard.php");
                    exit();
                } 
                else 
                {
                    $error = "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            }
    ?>
    </body>
</html>