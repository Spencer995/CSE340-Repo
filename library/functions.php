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
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
    $navList .= "</ul>";
    return $navList;
}

function checkClassInput($newClassification){
    $pattern = '(^[a-zA-Z0-9\s]{2,30}$)';
    return preg_match($pattern, $newClassification);
}
//Function to build the classification drop down menu
function buildClassificationList($classification){
    //Get the classification for the DB
    $classifications = getClassifications();
    //Create the dynamic select list
    $classificationList = "<select name='classificationId' id='classificationList'>";
    $classificationList .= "<option> Choose a Classification </option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'> $classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

//Function to wrap the vehicles returend in HTML and place in a view
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $vehiclePrice = '$'.number_format($vehicle['invPrice'],2);
     $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/?action=getVehicleDetail&valueId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '<hr>';
     $dv .= "<h2><a href='/phpmotors/vehicles/?action=getVehicleDetail&valueId=$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
     $dv .= "<span>$vehiclePrice</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
   }
//function to display vehicle info in the 'vehicle-detail.php' view
function displayVehicleDetail($vehicleDetail){
    $invPrice = '$'.number_format($vehicleDetail['invPrice'],2);
    $div = "<section class='vehicleDetails'>
                <div class='imgDiv'>
                    <figure>
                        <img src='$vehicleDetail[invImage]' alt='Image of $vehicleDetail[invMake] $vehicleDetail[invModel] on PHPMotors.com'>
                        <figcaption>Price: $invPrice</figcaption>
                    </figure>
                </div>
                <div class='infoDiv'>
                    <h2>$vehicleDetail[invMake] $vehicleDetail[invModel] Details</h2>
                    <p>$vehicleDetail[invDescription]</p>
                    <p>Color: $vehicleDetail[invColor]</p>
                    <p>Number in Stock: $vehicleDetail[invStock]</p>
                </div>
            </section>";
    return $div;
}  
?>