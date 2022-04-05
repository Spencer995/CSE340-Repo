<?php

//This is the search function controller.
//*********************************************** */
//Create or access a session.
session_start();
// Get the DB connection file
require_once '../library/connections.php';
//Get the PHP motors model for use when needed
require_once '../model/main-model.php';
//Include the functions.php file in the library
require_once '../library/functions.php';
//Bring the serch model into view
require_once '../model/search-model.php';

//Get the array of classifications
$classifications = getClassifications();
//Calls the function to create the dynamic NavBar
$navList = createNavlist($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

//Switch statement to perform action depending on the name/value pair
switch ($action){
    case 'Search-Key':
            $searchKey =  trim(filter_input(INPUT_POST, 'searchKey', FILTER_SANITIZE_STRING));
            $searchKey = str_ireplace(array('&lt;b&gt;', '&lt;/b&gt;', '&lt;h2&gt;', '&lt;/h2&gt;', '&QUOT;'), '',htmlspecialchars($searchKey));
            if ( empty($searchKey)) {
                    $message = "<p class='errorMsg'>Please input a search key.</p>";
                    include '../view/search.php';
                    exit;
            }
        
       
        
        $searchResult = searchVehicle($searchKey);
        $resultCount = count($searchResult);
        if ($resultCount < 1) {
            $message = "<p class='errorMsg'>Sorry, no vehicle matched your search for : $searchKey</p> ";
        }
        else{

            $limit = 10;  
            if (isset($_GET["page"])) {
                $page  = $_GET["page"]; 
            } 
            else{ 
                $page=1;
            };  
            $start_from = ($page-1) * $limit; 
            $paginationValue = searchVehiclePagination($searchKey, $start_from, $limit);
            
            //Call the function to build the list
            $searchList = buildSearchResult($paginationValue);
            $pageNumberLink = paginationFunc($resultCount,$limit,$searchKey);
        }
        $resultCountDisplay = "<h2 class='displayResult'> $resultCount results returned for '$searchKey'.</h2>";
        include '../view/search.php';

    break;
        
    default:
    include '../view/search.php';
}

?>