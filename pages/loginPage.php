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
            if (isset($_POST['sbmt']))
            {

                //This part will be changed for the db

                $users_and_passwords = array(
                    "username1"=>"PASSWORD",
                    "username2"=>"PASSWORD1",
                    "username3"=>"PASSWORD2",
                );
                
                $username = trim($_POST['usernameInput']);
                $password = trim($_POST['passwordInput']);

                if (!key_exists($username, $users_and_passwords)) { //Check is the username exist or not
                    echo '<p>Incorrect username<!p>';
                    return;
                } 

                if (!($users_and_passwords[$username] === $password)){ //Check if the password corresponds to the username
                    echo '<p>Incorrect password<!p>';
                    return;
                }

                echo '<p>Login succesful!</p>';
            }
        ?>
    </body>
</html>