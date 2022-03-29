<?php
//This is will be the VEHICLES Model

//This new function will be used to add vehicles to the inventory table
function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId){
// Create a connection object using the phpmotors coonection function
$db = phpmotorsConnect();
//The sql INSERT statement to add new vehicles to the inventory table
$sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
        VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
// create the prepared statement using the phpmotors connection
$stmt = $db->prepare($sql);
//The four lines replace the sql statement with the actual values in the variables
//The also tell the database the type of data they are.
$stmt->bindValue(':invMake',$invMake, PDO::PARAM_STR);
$stmt->bindValue(':invModel',$invModel, PDO::PARAM_STR);
$stmt->bindValue(':invDescription',$invDescription, PDO::PARAM_STR);
$stmt->bindValue(':invImage',$invImage, PDO::PARAM_STR);
$stmt->bindValue(':invThumbnail',$invThumbnail, PDO::PARAM_STR);
$stmt->bindValue(':invPrice',$invPrice, PDO::PARAM_STR);
$stmt->bindValue(':invStock',$invStock, PDO::PARAM_INT);
$stmt->bindValue(':invColor',$invColor, PDO::PARAM_STR);
$stmt->bindValue(':classificationId',$classificationId, PDO::PARAM_INT);
//Insert the data
$stmt->execute();
//Ask how many rows changed as result of the insert
$rowsChanged = $stmt->rowCount();
//closet the database interaction
$stmt->closeCursor();
//Return the indication of success(rows changed)
return $rowsChanged;
}


//This is the function to add new car classifications into the 
//'classificationName' column in the 'carclassification' table

function addClassification($classificationName){
    //This calls the phpmotors connection function from main model
    $db = phpmotorsConnect();
    //SQL used to insert new classification into the 'carclassification' table
    $sql = 'INSERT INTO carclassification (classificationName)
            VALUES (:classificationName)';
    //A prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //The next line replaces the placeholder value with the 
    //actual value from the variables
    $stmt->bindValue(':classificationName',$classificationName, PDO::PARAM_STR);
    //Thie next line is to run the prepared statement
    $stmt->execute();
    //Gets the data from the DB and store it in an array
    $rowsChanged = $stmt->rowCount();
    // Close the interactions with the DB
    $stmt->closeCursor();
    //The next line sends the number of rows changed to the controller
    //where the function will be called and used
    return $rowsChanged;
}

//Get all the vehicles specific to a given classificationId
function getInventoryByClassification($classificationId){
    $db = phpmotorsConnect();
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}
//Fucnction to query the table and get vehicle information form the inventory table
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = "SELECT * 
            FROM inventory JOIN images ON inventory.invId = images.invId
            WHERE inventory.invId = :invId 
                AND images.imgPrimary = 1 
                AND NOT images.imgPath LIKE '%-tn%'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invinfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invinfo;
}

//Function for updating the vehicle with a new/updated info
function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId){
    // Create a connection object using the phpmotors coonection function
    $db = phpmotorsConnect();
    //The sql INSERT statement to update the vehicle in the inventory table
    $sql = 'UPDATE inventory
            SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, 
            invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId
            WHERE invId = :invId';
    // create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //The next lines replace the sql placeholders with the actual values in the variables
    //The also tell the database the type of data they are.
    $stmt->bindValue(':invMake',$invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel',$invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription',$invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage',$invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail',$invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice',$invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock',$invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor',$invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId',$classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invId',$invId, PDO::PARAM_INT);
    //Insert the data
    $stmt->execute();
    //Ask how many rows changed as result of the insert
    $rowsChanged = $stmt->rowCount();
    //close the database interaction
    $stmt->closeCursor();
    //Return the indication of success(rows changed)
    return $rowsChanged;
}
//function to delete the vehicle from the DB
function deleteVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
//Gets a list of vehicles based on their classification name
function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    $sql = "SELECT *
            FROM inventory JOIN images ON images.invId = inventory.invId
            WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
            AND images.imgPath LIKE '%-tn%' AND images.imgPrimary = 1";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}

// Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}
?>