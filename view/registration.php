<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>PHP Motors | Registration</title>
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
            <h1>Fill the form to create a new Account.</h1>

            <?php
            if (isset($message)){
                echo $message;
            }
            ?>
            <form action="/phpmotors/accounts/index.php" method="POST"  class="form register">
                <fieldset>
                    <legend>Create a New Account</legend>
    
                    <p>
                        <label for="clientFirstname">First Name:</label> 
                        <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required >
                    </p>
                    <p>
                        <label for="clientLastname">Last Name:</label> 
                        <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required>
                    </p>
                    <p>
                        <label for="clientEmail">Email Address:</label> 
                        <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
                    </p>
                    <p>
                        <label for="clientPassword">Password:<br>
                        <span class="spanInfo">*Passwords must be at least 8 characters long. Contains at least 1 uppercase character,
                            1 number, and 1 special character.
                        </span></label> 
                        <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
                        required>
                    </p>
                    
                </fieldset>
             <input type="submit" name="submit" id="regbtn" value="Register">
             <input type="hidden" name="action" value="register">
             </form>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>