<?php
//This new function will control site visitors registration
function searchVehicle($searchValue){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    //The sql INSERT statement to register the user in the database
    $sql = "SELECT * 
    FROM inventory 
    WHERE invDescription 
        LIKE :searchValue OR 
        invColor LIKE :searchValue OR 
        invMake LIKE :searchValue OR 
        invModel LIKE :searchValue";
    // create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':searchValue','%' . $searchValue . '%', PDO::PARAM_STR);
    //Execute the query on the DB
    $stmt->execute();
    //Retrieve the data
    $searchResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $searchResult;
}

function searchVehiclePagination($searchValue, $offset, $endValue){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    //The sql INSERT statement to register the user in the database
    $sql = "SELECT * 
    FROM inventory 
    WHERE invDescription 
        LIKE :searchValue OR 
        invColor LIKE :searchValue OR 
        invMake LIKE :searchValue OR 
        invModel LIKE :searchValue LIMIT :offsetVal,:endVal ";
    // create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':searchValue','%' . $searchValue . '%', PDO::PARAM_STR);
    $stmt->bindValue(':offsetVal', $offset , PDO::PARAM_INT);
    $stmt->bindValue(':endVal', $endValue , PDO::PARAM_INT);
    //Execute the query on the DB
    $stmt->execute();
    //Retrieve the data
    $searchResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $searchResult;
}
?>