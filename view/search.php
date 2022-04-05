<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>PHP Motors | Search</title>
</head>
<body>
    <div id="cover_div">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav id="nav_bar">
            <?php echo $navList; ?>
        </nav>
        <main>
            <h1>Search</h1>
            <?php if(isset($message)){echo($message);} ?>
            
            <form class='search-form' action="/phpmotors/search/" method="POST">
                <label for="searchKey">What are you looking for today?</label>
                <input type="search" name="searchKey" id="searchKey" <?php if(isset($searchKey)){echo("value ='$searchKey'");} ?> required>
                <input type="submit" value="Search">
                <input type="hidden" name="action" value="Search-Key">
            </form>
            
            <?php if(isset($resultCountDisplay)){echo($resultCountDisplay);}?>
            <?php if(isset($searchList)){echo($searchList);}?>
            <?php if(isset($pageNumberLink)&&$resultCount>10){echo($pageNumberLink);}?>

        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>