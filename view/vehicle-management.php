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

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>PHP Motors | Vehicle Management</title>
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
            <h1>Vehicle Management</h1>
            <ol class="vehicleMgnt">
                <li><a href="../vehicles/index.php?action=add_class">Add Classifications</a></li>
                <li><a href="../vehicles/index.php?action=add_vehicles">Add Vehicles</a></li>
            </ol>

            <?php  
            if (isset($message)) {
                echo $message;
            }
            if (isset($classificationList)) {
                echo "<div class='tableDiv'><h2>Vehicles By Classification</h2>'
                <p>Choose a classification to see the vehicles</p>
                $classificationList
                </div>";
            }
            
            ?>
            <noscript>
                <p><strong>Javascript must be enabled to view this Page</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>