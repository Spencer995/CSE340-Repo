<?php

//This is the "accounts" controller for the site. 
//It will not interfare with the main index.php file
//as they are stored in different folders
//********************************************
//Create or access a session.
session_start();
// Get the DB connection file
require_once '../library/connections.php';
//Get the PHP main model for use when needed
require_once '../model/main-model.php';
//Get the accounts-model.php file
require_once '../model/accounts-model.php';
//Get custom function Library
require_once '../library/functions.php';

//Get the array of classifications
$classifications = getClassifications();
//********Test code pieces***************
// var_dump($classifications);
//     exit;
//Build the nav bar
$navList = createNavlist();  
//***********Test code pieces**************
// echo $navList;
// exit;
$action = filter_input(INPUT_GET, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_POST, 'action');
}

//Switch statement to perform action depending on the name/value pair
switch ($action){
    //Case statement to accept information from the registration form on the registration view
    case 'register':
        //Variables to hold values coming from the registration form
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        //Variable to check for the return value from the function to check for unique emails
        $emailUnique = checkUniqueEmail($clientEmail);
        //Condtion to check if an existing email was returned
        if($emailUnique == 1){
            $message = "<p class='errorMsg'>This Email already exists. Do you want to Login instead.</p>";
            include '../view/login.php';
            exit;

        }

        //Code block to check if the the user sent any empty form inputs
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = "<p class='errorMsg'>Please provide infromation for all empty form fields.</p>";
            include '../view/registration.php';
            exit;
        }
        //Code to hash the password before sending it to the DB
        $hashedPassword = password_hash($clientPassword,PASSWORD_DEFAULT);


        //calls the function in the accounts-model and passes in values
        $regOutCome = regClient($clientFirstname,$clientLastname,$clientEmail,$hashedPassword);

        //checks if the right value was returend, and gives a congratulatory message
        //gives a failure message if not
        if ($regOutCome === 1) {
            //Set Cookie
            setcookie('firstname', $clientFirstname, strtotime('+ 1 year'), '/');
            $_SESSION['message'] = "<p class='successMsg'>Thanks for registering, $clientFirstname. Please sign in with your Email and Password.</p>";
            header('Location: /phpmotors/accounts/?action=Login');
            exit;
        }
        else{
            $message = "<p class='errorMsg'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        if ( empty($clientEmail) || empty($checkPassword)) {
            $message = "<p class='errorMsg'>Please provide information for all empty form fields.</p>";
            include '../view/login.php';
            exit;
        }

        //Since a valid password exists, continue with the login process
        //call the getClient function to get the users details with a matching email address
        $clientInfo = getClient($clientEmail);
        
        //check that the password matches with the hashed one from the DB
        $hashCheck = password_verify($clientPassword, $clientInfo['clientPassword']);
       
        if(!$hashCheck){
            $message = '<p class="errorMsg">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        //All the details are correct and the user info is valid
        $_SESSION['loggedin'] = TRUE;
        //Remove the password from the array, the function removes the last item in an array
        array_pop($clientInfo);
        //Store the array in a session
        $_SESSION['clientData'] = $clientInfo;
        //Send users to the admin.php page
        include '../view/admin.php';
        exit;

        break;
    case 'logout':
        SESSION_UNSET();
        session_destroy();
        setcookie('firstname', $clientFirstname, strtotime('-1 Year'),'/');
        header("Location: /phpmotors/");
        
        break;

    //Case Statement to deliver the login view when the "My Account" link is clicked
    case 'Login':
      include '../view/login.php';
        break;
    //Case Statement to deliver the registration view when the "Sign Up now" link is clicked
    case 'Registration':
        include '../view/registration.php';
        break;
    
    //Case to deliver the account update view to the user
    case 'accountUpdateView':
        include "../view/client-update.php";
        break;

    //Case to change the client's password
    case 'changePassword':
        //get the password input and sanitize it
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        //Check for the password pattern to make sure it is a match
        $checkPassword = checkPassword($clientPassword);

        if (empty($checkPassword)) {
            $message = '<p class="errorMsg">Please, check the required password pattern.</p>';
            include '../view/client-update.php';
            exit;
        }
        //Hash the password to make sure it is secure
        $hashedPassword = password_hash($clientPassword,PASSWORD_DEFAULT);
        //Call the function that updates the clients table with the new password
        $passwordStatus = changePassword($clientId, $hashedPassword);
        if ($passwordStatus === 1) {
            $_SESSION['message'] = "<p class='successMsg'>Your password was updated successfully.</p>";
            header("Location: /phpmotors/accounts/");
            exit;
        }
        else {
            $_SESSION['message'] = "<p class='errorMsg'>Your password could not be updated.</p>";
            header("Location: /phpmotors/accounts/");
            exit;
        }

    //Case to update user information
    case 'updateClientInfo':
        //Get the user details and sanitize the values
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        //Check the email to ensure it is valid
        $clientEmail = checkEmail($clientEmail);
        //Get the current client Email address that is stored in the Session Variable
        $curEmail = $_SESSION['clientData']['clientEmail'];

        //Code block to check if the the user sent any empty form inputs
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = "<p class='errorMsg'>Please provide infromation for all empty form fields.</p>";
            include '../view/client-update.php';
            exit;
        }
        elseif ($curEmail != $clientEmail){
            $emailUnique = checkUniqueEmail($clientEmail);
            if ($emailUnique == 1) {
                $message = "<p class='errorMsg'>Email not available. Try a different one</p>";
                include '../view/client-update.php';
                exit;
            }
        }
        //call the function in the model that inserts the update in the table
        $updateStatus = updateClientInfo($clientId, $clientFirstname, $clientLastname, $clientEmail);
        if ($updateStatus === 1) {
            $clientUpdate = getClientUpdate($clientId);
            //Remove the password from the array, the function removes the last item in an array
            array_pop($clientUpdate);
            //Store the array in a session
            $_SESSION['clientData'] = $clientUpdate;
            $_SESSION['message'] = "<p class='successMsg'>$clientFirstname, Your information was updated successfully.</p>";
            header("Location: /phpmotors/accounts/");
            exit;
        }
        else{
            $_SESSION['message'] = "<p class='errorMsg'>$clientFirstname, Your information was not updated.</p>";
            header("Location: /phpmotors/accounts/");
            exit;
        }

        break;

    //The default case to deliver the admin view
    default:
    include '../view/admin.php';        
}
?>