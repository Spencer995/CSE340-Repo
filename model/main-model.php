<?php
//This is the MAIN PHP MOTOTS MODEL!!!

function getClassifications(){
    //This calls the phpmotors connection function
    $db = phpmotorsConnect();
    //SQL statement used to query a table in the DB and used for the dynamic navigation
    $sql = 'SELECT classificationName, classificationId FROM carclassification 
    ORDER BY classificationName ASC';
    //A prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //Thie next line is to run the prepared statement
    $stmt->execute();
    //Gets the data from the DB and store it in an array
    $classifications = $stmt->fetchAll();
    // Close the interactions with the DB
    $stmt->closeCursor();
    //The next line sends the array of data back to where the function
    //was called (the is supposed to be the controller)
    return $classifications;
}
?>