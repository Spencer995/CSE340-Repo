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
    <title>PHP Motors | Add Car Classification</title>
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
            <h1>Vehicle Classification</h1>

            <?php 
            if(isset($classMessage)){
                echo $classMessage;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="POST"  class="form add-class">
                <fieldset>
                    <legend>Add Vehicles Classification</legend>
    
                    <p>
                        <label for="classificationName">Classification Name:<br>
                        <span class="spanInfo">*Classification names must be 30 characters or less.</span>
                        </label> 
                        <input type="text" name="classificationName" id="classificationName" pattern="[a-zA-Z0-9\s]{2,30}" required>
                    </p>
                </fieldset>
             <input type="submit" name="submit" id="regbtn" value="Add New">
             <input type="hidden" name="action" value="Classification">
             </form>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>