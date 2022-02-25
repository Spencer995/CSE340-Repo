<?php  
//Function to make sure that the inputted email follows the right format.
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

//function to make sure that the password meets the specified pattern
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

//Function to create a dynamic navList
function createNavlist(){
    $classifications = getClassifications();
    $navList = "<ul id='nav_items_list'>";
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
    $navList .= "</ul>";
    return $navList;
}

function checkClassInput($newClassification){
    $pattern = '(^[a-zA-Z0-9\s]{2,30}$)';
    return preg_match($pattern, $newClassification);
}

?>