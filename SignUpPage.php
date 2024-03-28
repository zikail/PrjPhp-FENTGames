<!DOCTYPE html>
<html>
    <head>
        <script>
            function passwordStrength(str) {
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

                <input id="sub" type="submit" name="signUpSumbit" value="SIGNUP">
            </fieldset>
            
        </form>

        <?php
        if (isset($_POST["signUpSumbit"]))
        {
            $username = $_POST["usernameInput"];
            $password = $_POST["passwordInput"];   
            
            //save it in the db
        }
        ?>
    </body>
</html>