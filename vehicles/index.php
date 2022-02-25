<?php

//This is the "vehicles" controller for the site. 
//It will not interfare with the main or accounts controllers
//as they are stored in different folders
//  **********************************************************
//Create or sccess a session.
session_start();
// Get the DB connection file
require_once '../library/connections.php';
//Get the PHP main model for use when needed
require_once '../model/main-model.php';
//Get the accounts-model.php file
require_once '../model/vehicles-model.php';
//Brings the functions.php file into scope
require_once '../library/functions.php';

//Get the array of classifications
$classifications = getClassifications();
//********Test code pieces***************
// var_dump($classifications);
//     exit;

//Call the function to create the NavList from the functions.php file and assign the value to the 
//$navList variable
$navList = createNavlist();

//***********Test code pieces**************
// echo $selectList;
// exit;

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_POST, 'action');
}

//Switch statement to perfomr action depending on the name/value pair
switch ($action){
    case 'Vehicles':
        //Variables to hold values coming from the 'add vehicles' form
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription',FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage',FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail',FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice',FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));

        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) 
            || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = "<p class='errorMsg'>Please provide infromation for all empty form fields.</p>";
            include '../view/add-vehicle.php';
            exit;
        }

        //calls the addvehicles function in the vehicles-model and passes in values
        $regOutCome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
        //checks if the right value was returend, and gives a congratulatory message
        //gives a failure message if not
        if ($regOutCome === 1) {
            $message = "<p class='successMsg'>The $invMake $invModel was added successfully</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        else{
            $message = "<p class='errorMsg'>Sorry, the vehicle could not be added to the table</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;
    //This case statement handles data from the add classification form
    case 'Classification':
        //Values to hold the data coming from the add classification form
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));
        //Function call to check the pattern in the function.php library
        $checkedClassificationName = checkClassInput($classificationName);
        if(empty($checkedClassificationName)){
            $classMessage = "<p class='errorMsg'>Please provide classification information.</p>";
            include '../view/add-classification.php';
            exit;
        }
        //Calls the add addClassification function in the vehicle model
        $addclassCount = addClassification($classificationName);
        //Gives a failure message if the clasifiation was added
        if ($addclassCount === 1) {
            header("Location: /phpmotors/vehicles/index.php");
            // include '../view/vehicle-management.php';//This did not work
            exit;
        }
        else{
            $classMessage = "<p class='errorMsg'>Sorry, the car classification could not be added.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
    //deliver the add classification view   
    case 'add_class':
      include '../view/add-classification.php';
        break;
    //deliver the add vehicles view
    case 'add_vehicles':
        include '../view/add-vehicle.php';
        break;
    //default switch case to deliver the vehicle management view
    default:
        include '../view/vehicle-management.php'; 
   
}
?>