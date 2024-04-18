<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/signup.css">
        <link rel="icon" type="image/png" href="../assets/images/logo.png">
        <title>Change password</title>


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
                <h1>Modify Password</h1>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    </br>
                
                    <label for="uname">Enter username: </label>
                    <input type="text" required name="usernameInput">

                    <br><br>

                    <label for="pword">Enter new password: </label>
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

                    <input id="sub" type="submit" name="signUpSumbit" value="Change Password" disabled>
                    
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

            // Get username and password from form
            $username = $_POST['usernameInput'];
            $password = $_POST['passwordInput'];
            

            //modify the players password
            $sql = "UPDATE authenticator SET passCode = '$password' WHERE registrationOrder = (
                SELECT registrationOrder
                FROM player
                WHERE userName = '$username'
                )";

            if($conn->query($sql) === TRUE)
            {
                // Start session and redirect to login
                //session_start();
                //$_SESSION['username'] = $username;
                echo "New password changed succesfully!";
                echo "<button onclick=\"window.location.href = 'loginPage.php';\">Go to login</button>";
                //exit();
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