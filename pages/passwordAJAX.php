<?php
/*password security levels:
            Weak: no numbers, no special char (!#@$%&?¡¿), less than 7 char
            Intermidiate: 2 out of the 3 conditions are met
            Strong the 3 conditions are met
            
            For the AJAX, this part of the code should go outside the isset*/ 
$password = $_GET['q'];

$anyNumbers = preg_match("/\d/", $password); //There are any numbers in the password
$SpecialChars = preg_match("/\W/", $password); //There are any special chars
$lessThanSevenChars = count(str_split($password)) < 7; //Less than 7 chars

$numberOfOffenses = 0;

if (!$anyNumbers)
{
    //echo 'There are no numbers in the password';
    $numberOfOffenses++;
}

if (!$SpecialChars) {
    //echo 'There are no special characters in the password';
    $numberOfOffenses++;
}

if ($lessThanSevenChars) 
{
    //echo 'Password length is too short. (should be more than 7 chars)';
    $numberOfOffenses++;
}

//This part will be the AJAX shi
switch($numberOfOffenses){
    case 0:
        echo 'Strong password';
        //Include the user in the database
        //go back to login
        break;
    case 1:
        echo 'Intermidiate password'; 
        break;  
    case 2:
        echo 'Intermidiate password';
        break;
    case 3:
        echo 'Weak password, comply the conditions';
        break;
}
