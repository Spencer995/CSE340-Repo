<?php
//Code to check if a user is logged in has a user level greater then 1
//If conditions are met, user is given the vehicle management view
//Else, they are redirected to the home view
if(isset($_SESSION['loggedin']) && $_SESSION['clientData']['clientLevel'] > 1){
    header("../view/vehicle-management.php");
}
else{
    header("Location: /phpmotors/");
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	    ?> | PHP Motors
    </title>
</head>
<body>
    <div id="cover_div">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav id="nav_bar">
            <?php echo $navList; ?>
            <!-- <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php'; ?> -->
        </nav>
        <main>
            <h1>
                <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
                ?>
            </h1>
            <?php 
                if(isset($message)){
                    echo $message;
                }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="POST"  class="form add-vehicles">
                <fieldset>
                    <legend>Delete vehicle</legend>
                    <p class="required">Confirm deletion. This deletion is permanent.</p>

                    <p>
                        <label for="invMake">Make:</label> 
                        <input type="text" name="invMake" id="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> readonly>
                    </p>
                    <p>
                        <label for="invModel">Model:</label> 
                        <input type="text" name="invModel" id="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> readonly>
                    </p>
                    <p>
                        <label for="invDescription">Description:</label> <br>
                        <textarea name="invDescription" id="invDescription" rows="3" cols="39" readonly><?php if(isset($invInfo['invDescription'])) {echo "$invInfo[invDescription]";}?></textarea>
                    </p>
                    
                </fieldset>
             <input type="submit" name="submit" id="addvehiclebtn" value="Delete Vehicle">
             <input type="hidden" name="action" value="deleteVehicle">
             <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
            </form>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>