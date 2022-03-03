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

//code to build the dynamic select drop down list in the view
$selectList = "<select id='classificationId' name='classificationId'>";
$selectList .= "<option value='none'>Choose a Car Classification</option>";
foreach($classifications as $classification){
    $selectList .= "<option value='$classification[classificationId]'";
        if(isset($classificationId)){
            if($classification['classificationId'] === $classificationId){
                $selectList .= ' selected ';
            }
        }
        elseif(isset($invInfo['classificationId'])){
            if($classification['classificationId'] === $invInfo['classificationId']){
             $selectList .= ' selected ';
            }
           }
    $selectList .=">$classification[classificationName]</option>";
}
$selectList .= "</select>";

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	    elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors
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
                echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) { 
                echo "Modify $invMake $invModel"; }?>
            </h1>
            <?php 
                if(isset($message)){
                    echo $message;
                }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="POST"  class="form add-vehicles">
                <fieldset>
                    <legend>Modify vehicle</legend>
                    <p class="required">* All form feilds are required</p>
    
                    <p>
                        <label for="classificationId">Classification:</label><br>
                        <?php echo $selectList; ?>
                    </p>
                    <p>
                        <label for="invMake">Make:</label> 
                        <input type="text" name="invMake" id="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> required>
                    </p>
                    <p>
                        <label for="invModel">Model:</label> 
                        <input type="text" name="invModel" id="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> required>
                    </p>
                    <p>
                        <label for="invDescription">Description:</label> <br>
                        <textarea name="invDescription" id="invDescription" rows="3" cols="39" required><?php if(isset($invDescription)){echo "$invDescription";} elseif(isset($invInfo['invDescription'])) {echo "$invInfo[invDescription]";}?></textarea>
                    </p>
                    <p>
                        <label for="invImage">Image</label> 
                        <input type="text" name="invImage" id="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?> required >
                    </p>
                    <p>
                        <label for="invThumbnail">Thumbnail</label> 
                        <input type="text" name="invThumbnail" id="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?> required >
                    </p>
                    <p>
                        <label for="invPrice">Price:</label> 
                        <input type="number" name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'";} ?> required>
                    </p>
                    <p>
                        <label for="invStock">In Stock:</label> 
                        <input type="number" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'";} ?> required>
                    </p>
                    <p>
                        <label for="invColor">Color:</label> 
                        <input type="text" name="invColor" id="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'";} ?> required>
                    </p>
                    
                </fieldset>
             <input type="submit" name="submit" id="addvehiclebtn" value="Update Vehicle">
             <input type="hidden" name="action" value="updateVehicles">
             </form>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>