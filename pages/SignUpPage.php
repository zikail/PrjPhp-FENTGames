<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/signup.css">
        <link rel="icon" type="image/png" href="../assets/images/logo.png">
        <title>Sign Up</title>

        <?php
        // Start session and redirect to dashboard or home page
        session_start();
        ?>
        <script>
            function passwordStrength(str) {
                let span = document.getElementById("passwordSuggestion");
                

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
                                    //submit.disabled = false;
                                    span.style.color = 'green';
                                    break;
                                case 'Intermidiate password':
                                    //submit.disabled = true;
                                    span.style.color = 'orange';
                                    break;    
                                case 'Weak password, comply the conditions':
                                    //submit.disabled = true;
                                    span.style.color = 'red';
                                    break;    
                            }

                            EnableSubmitButton();

                        }
                    };
                    xmlhttp.open("GET", "passwordAJAX.php?q=" + str, true);
                    xmlhttp.send();
                }
            }

            function confirmationPasswordCheck(str) {
                let span = document.getElementById("notIdenticalPasswordAlert");
                
                let password = document.querySelector("#passwordInput").value;

                
                if (str.length == 0) {
                    span.innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {                      
                           if(str === password){
                                span.innerHTML = "";    
                            } 
                            else {
                                
                                span.innerHTML = "Password do not coincide";
                            }

                            EnableSubmitButton();

                        }
                    };
                    xmlhttp.open("GET", "confirmationAJAX.php?q=" + str, true);
                    xmlhttp.send();
                }

            }

            function EnableSubmitButton(){
                let span1 = document.getElementById("passwordSuggestion");
                let span2 = document.getElementById("notIdenticalPasswordAlert");
                let submit = document.getElementById("sub");

                let firstName = document.querySelector('input[name="fnameInput"]').value;
                let lastName = document.querySelector('input[name="lnameInput"]').value;

                if(span1.innerHTML === "Strong password" && span2.innerHTML === ""){
                    submit.disabled = false;
                } 
                else
                {
                    submit.disabled = true;
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
                    <label for="fname">Enter first name: </label>
                    <input type="text" required name="fnameInput">

                    <br><br>

                    <label for="lname">Enter last name: </label>
                    <input type="text" required name="lnameInput">

                    <br><br>

                    <label for="uname">Enter username: </label>
                    <input type="text" required name="usernameInput">

                    <br><br>

                    <label for="pword">Enter password: </label>
                    <input type="text" id="passwordInput" required name="passwordInput" onkeyup="passwordStrength(this.value)">

                    <br><br>

                    <label for="cpword">Confirm password: </label>
                    <input type="text" required name="confirmationPasswordInput" onkeyup="confirmationPasswordCheck(this.value)">
                    <p><span id="notIdenticalPasswordAlert"></span></p>

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
                    <div class="back-button">
                <a href="index.php"><button type="button">Go Back</button></a>
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

            // Get username and password from form
            $username = $_POST['usernameInput'];
            $password = $_POST['passwordInput'];
            //$confirmationPassword = $_POST['confirmationPasswordInput'];
            $firstName = $_POST['fnameInput'];
            $lastName = $_POST['lnameInput'];

            // SQL query to check if username already exists
            $sql = "SELECT * FROM player WHERE userName = '$username'";
            $result = $conn->query($sql);
            if (preg_match('/\d/', $firstName) || preg_match('/\d/', $lastName)) {
                echo "<p style=\"text-align:center;\">First name and last name cannot contain numbers. Please try again.</p>";
            } else {
            if ($result->num_rows > 0) 
            {
                echo "<br>";
                echo "<p style=\"text-align:center;\">Username already exists. Please try again with a different username.</p>" ;
            }
            else 
            {
                // SQL query to insert new user into the player table
                $sql = "INSERT INTO player (fName, lName, userName, registrationTime) 
                VALUES ('$firstName', '$lastName', '$username', NOW())";

                if ($conn->query($sql) === TRUE) 
                {
                    // Get the registrationOrder of the newly inserted user
                    $registrationOrder = $conn->insert_id;

                    // SQL query to insert password into the authenticator table
                    $sql = "INSERT INTO authenticator (passCode, registrationOrder) 
                    VALUES ('$password', $registrationOrder)";

                    if ($conn->query($sql) === TRUE) 
                    {
                        $_SESSION['username'] = $username;
                        echo "New record created successfully";
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
            }

            $conn->close();
        }
    }
        ?>
                </form>
            </div>
            
            
        </div>

        
    </body>
</html>