<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/signup.css">
        <link rel="icon" type="image/png" href="../assets/images/logo.png">
        <title>Sign Up</title>


        <script>
            function passwordStrength(str) {
                let span = document.getElementById("passwordSuggestion");
                let submit = document.getElementById("sub");

                if (str.length == 0) {
                    span.innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            span.innerHTML = this.responseText;
                            /*
                            if (this.responseText == "Strong password") {
                                document.getElementById("sub").disabled = false;
                                document.getElementById("passwordSuggestion").style.color = 'green';
                            } else {
                                document.getElementById("sub").disabled = true;
                            }
                            */
                            switch(this.responseText){
                                case 'Strong password':
                                    submit.disabled = false;
                                    span.style.color = 'green';
                                    break;
                                case 'Intermidiate password':
                                    submit.disabled = true;
                                    span.style.color = 'orange';
                                    break;    
                                case 'Weak password, comply the conditions':
                                    submit.disabled = true;
                                    span.style.color = 'red';
                                    break;    
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
        <div class="outer-container">
            <div class="signUpBox">
                <h1>Sign Up</h1>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    </br>
                    <label for="uname">Enter username: </label>
                    <input type="text" required name="usernameInput">

                    <br><br>

                    <label for="pword">Enter password: </label>
                    <input type="text" required name="passwordInput" onkeyup="passwordStrength(this.value)">

                    <br><br>

                    <div class="passConditions">
                        <p>The password must:</p>
                        <p>1. Contain at least one number</p>
                        <p>2. Contain at least one special character</p>
                        <p>3. Be at least 7 characters long</p>
                    </div>

                    <p><span id="passwordSuggestion"></span></p>

                    <br>

                    <input id="sub" type="submit" name="signUpSumbit" value="SIGNUP" disabled>
                    
                </form>
            </div>

            <div class="back-button">
                <a href="index.php"><button type="button">Go Back</button></a>
            </div>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // Get username and password from form
            $username = $_POST['usernameInput'];
            $password = $_POST['passwordInput'];

            // SQL query to insert new user into the player table
            $sql = "INSERT INTO player (fName, lName, userName, registrationTime) 
            VALUES ('', '', '$username', NOW())";

            if ($conn->query($sql) === TRUE) 
            {
                // Get the registrationOrder of the newly inserted user
                $registrationOrder = $conn->insert_id;

                // SQL query to insert password into the authenticator table
                $sql = "INSERT INTO authenticator (passCode, registrationOrder) 
                VALUES ('$password', $registrationOrder)";

                if ($conn->query($sql) === TRUE) 
                {
                    // Start session and redirect to dashboard or home page
                    session_start();
                    $_SESSION['username'] = $username;
                    echo "New record created successfully";
                    echo "<button onclick=\"window.location.href = 'index.php';\">Go to home page</button>";
                    exit();
                } 
                else 
                {
                    $error = "Error: " . $sql . "<br>" . $conn->error;
                }
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