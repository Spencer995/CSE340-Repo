<?php
//This is will be the ACCOUNTS Model

//This new function will control site visitors registration
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    //The sql INSERT statement to register the user in the database
    $sql = 'INSERT INTO clients (clientFirstname,clientLastname, clientEmail, clientPassword)
    VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //The four lines replace the sql statement with the actual values in the variables
    //The also tell the database the type of data they are.
    $stmt->bindValue(':clientFirstname',$clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname',$clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail',$clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword',$clientPassword, PDO::PARAM_STR);
    //Insert the data
    $stmt->execute();
    //Ask how many rows changed as result of the insert
    $rowsChanged = $stmt->rowCount();
    //closet the database interaction
    $stmt->closeCursor();
    //Return the indication of success(rows changed)
    return $rowsChanged;
}

//Function to check for unique email addresses to be stored in the client table
function checkUniqueEmail($clientEmail){
    //Call the connection already made in the library
    $db = phpmotorsConnect();
    //sql to query the DB
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';
    //A prepared statement to prepare the sql code
    $stmt = $db->prepare($sql);
    //Bind the real value to th eplac holder used
    $stmt->bindValue(':clientEmail',$clientEmail,PDO::PARAM_STR);
    //The next line executes the code in the DB
    $stmt->execute();
    //The next line fetches the row of data that matches the email address if any
    $emailMatch = $stmt->fetch(PDO::FETCH_NUM);
    //Close the connection with the server and DB
    $stmt->closeCursor();
    //If statement to determine what to return to the controller
    if(empty($emailMatch)){
        return 0;
    }
    else{
        return 1;      
    }
}

//function to get client info
function getClient($clientEmail){
    //Gets the connection to the sever and DB
    $db = phpmotorsConnect();
    //SQL to get the user info mation from the DB
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients
            WHERE clientEmail = :clientEmail';
    //code to prepare the sql statement
    $stmt = $db->prepare($sql);
    //bind the placeholder to the passed in variable
    $stmt->bindValue(':clientEmail',$clientEmail,PDO::PARAM_STR);
    //Execute the code
    $stmt->execute();
    //fetch the user detail with the the table column name as the associative name value pair
    $clientInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientInfo;
}
//function to change client password
function changePassword ($clientId, $clientPassword) {
            // Create a connection object using the phpmotors coonection function
        $db = phpmotorsConnect();
        //The sql INSERT statement to update the client password in the clients table
        $sql = 'UPDATE clients
                SET clientPassword = :clientPassword
                WHERE clientId = :clientId';
        // create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        //The next lines replace the sql placeholders with the actual values in the variables
        //The also tell the database the type of data they are.
        $stmt->bindValue(':clientId',$clientId, PDO::PARAM_INT);
        $stmt->bindValue(':clientPassword',$clientPassword, PDO::PARAM_STR);
        //Insert the data
        $stmt->execute();
        //Ask how many rows changed as result of the insert
        $rowsChanged = $stmt->rowCount();
        //close the database interaction
        $stmt->closeCursor();
        //Return the indication of success(rows changed)
        return $rowsChanged;
}

//function to update the client information
function updateClientInfo ($clientId, $clientFirstname, $clientLastname, $clientEmail) {
    // Create a connection object using the phpmotors coonection function
$db = phpmotorsConnect();
//The sql INSERT statement to update the client info in the clients table
$sql = 'UPDATE clients
        SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail
        WHERE clientId = :clientId';
// create the prepared statement using the phpmotors connection
$stmt = $db->prepare($sql);
//The next lines replace the sql placeholders with the actual values in the variables
//The also tell the database the type of data they are.
$stmt->bindValue(':clientId',$clientId, PDO::PARAM_INT);
$stmt->bindValue(':clientFirstname',$clientFirstname, PDO::PARAM_STR);
$stmt->bindValue(':clientLastname',$clientLastname, PDO::PARAM_STR);
$stmt->bindValue(':clientEmail',$clientEmail, PDO::PARAM_STR);
//Insert the data
$stmt->execute();
//Ask how many rows changed as result of the insert
$rowsChanged = $stmt->rowCount();
//close the database interaction
$stmt->closeCursor();
//Return the indication of success(rows changed)
return $rowsChanged;
}

function getClientUpdate($clientId){
    //Gets the connection to the sever and DB
    $db = phpmotorsConnect();
    //SQL to get the updated user infomation from the DB
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
            FROM clients
            WHERE clientId = :clientId';
    //code to prepare the sql statement
    $stmt = $db->prepare($sql);
    //bind the placeholder to the passed in variable
    $stmt->bindValue(':clientId',$clientId,PDO::PARAM_STR);
    //Execute the code
    $stmt->execute();
    //fetch the user detail with the the table column name as the associative name value pair
    $clientInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientInfo;
}
?>