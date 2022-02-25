<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>PHP Motors | Login</title>
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
            <h1>Sign in to your account!!</h1>
            <!--Checks if the $message variable is set to a value -->
            <?php
            if (isset($_SESSION['message'])){
                echo $_SESSION['message'];
            }
            ?>
            <form action="/phpmotors/accounts/index.php" method="POST"  class="form login">
                <fieldset>
                    <legend>Sign In to your Account</legend>

                    <p>
                        <label for="clientEmail">Email:</label> 
                        <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
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
            <button type="submit">LOGIN</button>
            <input type="hidden" name="action" value="login">
            </form>
            <p class="reglink">Not a member yet?<a href="../accounts/index.php?action=Registration"> Sign Up Now!</a></p>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>