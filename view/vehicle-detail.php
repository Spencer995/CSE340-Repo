<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo "$vehicleDetail[invMake] $vehicleDetail[invModel]"?> | PHP Motors</title>
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
            <!-- Displays a header to identify the vehicle being displayed -->
            <h1><?php echo "$vehicleDetail[invMake] $vehicleDetail[invModel]"?></h1>
            <!-- Display a message if one is set show an error message -->
            <?php if(isset($message)){
                  echo $message; }
            ?>
            <?php 
            //PHP block to echo the vehicle information form the function call in the controller
                if (isset($vehicleDetailDisplay)) {
                    echo $vehicleDetailDisplay;
                }
            ?>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>