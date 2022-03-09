<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
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
            <h1><?php echo $classificationName; ?> vehicles</h1>
            <!-- Display the message if it is set -->
            <?php if(isset($message)){
                  echo $message; }
            ?>
            <!-- Displays the lists of vehicles based on classifications from the controller -->
            <?php if(isset($vehicleDisplay)){
                  echo $vehicleDisplay;
                  
            } ?>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>