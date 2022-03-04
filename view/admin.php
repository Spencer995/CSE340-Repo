<?php  
    if(!isset($_SESSION['loggedin'])){
        header("Location: /phpmotors/");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>PHP Motors | Admin Page</title>
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
            <?php 
            $clientFName = $_SESSION['clientData']['clientFirstname'];
            $clientLName = $_SESSION['clientData']['clientLastname'];
            $clientLevel = $_SESSION['clientData']['clientLevel'];
            $clientMail = $_SESSION['clientData']['clientEmail'];
            echo "<h1 class='loginUser'>$clientFName $clientLName</h1>";
            if (isset($_SESSION['message'])){
                echo $_SESSION['message'];
            }
            elseif (isset($message)) {
                echo $message;
            }
            echo "<h2 class='loginUser'>You are logged in:</h2>";
            echo "<ol class='loginUser'>
                    <li>First Name: $clientFName </li>
                    <li>Last Name: $clientLName </li>
                    <li>Email: $clientMail</li>
                </ol>";
                echo "<br><h3 class='loginUser'>Use this link to update account information</h3>";
                echo "<a href='/phpmotors/accounts?action=accountUpdateView' class='loginUser' id='updateUserInfo'>Update Information</a>";
            if ($clientLevel > 1) {
                echo "<br><br><h3 class='loginUser'>Use this link to manage vehicle inventory</h3>";
                echo "<a href='/phpmotors/vehicles/' class='loginUser' id='vehicle_mgnt'>Vehicle Management</a>";
            }
            ?>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>