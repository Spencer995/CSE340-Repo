<?php 
/*
* A PDO connection script to connect to a MySQL database
* This requires some in formation to be able to access the local server
* And present everything as it should be
*/
function phpmotorsConnect()
{
    $dbName = "phpmotors";
    $userName = "iClient";
    $serverName = "localhost";
    $password = "ikBMy3seHegqPTXV";
    $dsn = "mysql:host=$serverName;dbname=$dbName";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $link = new PDO($dsn, $userName, $password, $options);
        // if(is_object($link));
        //   echo "It worked";
        return $link;
        
    } catch (PDOException $e) {
        //echo "It didn't work, error: ". $e->getMessage();
        header('Location: /phpmotors/view/500.php');
        exit;
    }
}

 //phpmotorsConnect();

?>