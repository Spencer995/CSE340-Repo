<div id="top_header">
    
    <a href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png" alt="PHP_Motors_Logo"></a>
    <?php 
    //The next lines checks if the user is logged in, then it echoes
    //the cleints first name stored in the sessiion cookie along with
    //a logout link that directs the user to the admin page.
    //The my account link is echo if the user is not logged in.
    if (isset($_SESSION['loggedin'])){ $clientFName = $_SESSION['clientData']['clientFirstname']; echo "<p><a href='/phpmotors/accounts/'>$clientFName</a> | <a href='/phpmotors/accounts?action=logout'>Log Out</a></p>";}
    else{echo "<a href='/phpmotors/accounts/index.php?action=Login' id='my_account'>My Account</a>";} 
    ?>
</div>