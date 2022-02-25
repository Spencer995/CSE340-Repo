<?php

//This is the main controller for the site. Naming it
//"index.php" will made the server always examine this file first.
//******************************************************************** */
//Create or sccess a session.
session_start();
// Get the DB connection file
require_once 'library/connections.php';
//Get the PHP motors model for use when needed
require_once 'model/main-model.php';
//Include the functions.php file in the library
require_once 'library/functions.php';

//Get the array of classifications
$classifications = getClassifications();
//********Test code pieces***************
// var_dump($classifications);
//     exit;
//Calls the function to create a dynamic nav bar in the functions.php file
$navList = createNavlist();
//***********Test code pieces**************
// echo $navList;
// exit;

//Checks if the coockie is set, and assigns it to a variable
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

//Switch statement to perform action depending on the name/value pair
switch ($action){
    case 'template':
        include 'view/template.php';
        break;
        
    default:
        include 'view/home.php';
}

?>