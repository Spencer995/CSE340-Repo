<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP Motors | Home</title>
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
            <h1>Welcome to PHP Motors!</h1>
            <div class="banner_image">
                <div id="delorean-features">
                    <h2>DMC Deloran</h2>
                    <p>3 Cup holders</p>
                    <p>Superman Doors</p>
                    <p>Fuzzy Dice!</p>
                </div>
                <a href="#" class="own_today_button"><img src="images/site/own_today.png" alt="click the button to own the car"></a>
                <img src="images/delorean.jpg" alt="banner image of a DMC Deloran car">
                
            </div>
            <div class="review_upgrade">
                <section class="review_area">
                    <h2>DMC Deloran Reviews</h2>
                    <ul id="review_list">
                        <li>"So fast, it's almost like travelling in time" (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"88's livin and love it!" (5/5)</li>
                    </ul>
                </section>
                <div class="upgrade_wrapper">
                    <h2>Deloran Upgrades</h2>
                    <div class="upgrade_parts">
                        <figure>
                            <div class="image_div">
                                <img src="images/upgrades/flux-cap.png" alt="flux capcitor upgrade">
                            </div>
                            <figcaption><a href="#">Flux Capacitor</a></figcaption>
                        </figure>
                        <figure>
                            <div class="image_div">
                                <img src="images/upgrades/flame.jpg" alt="flame upgrade">
                            </div>                            
                           <figcaption> <a href="#">Flame Decals</a></figcaption>
                        </figure>
                        <figure>
                            <div class="image_div">
                                <img src="images/upgrades/bumper_sticker.jpg" alt="bumper sticker upgrade">
                            </div>                            
                           <figcaption> <a href="#">Bumper Stickers</a></figcaption>
                        </figure>
                        <figure>
                            <div class="image_div">
                                <img src="images/upgrades/hub-cap.jpg" alt="hub cap upgrade">
                            </div>
                            <figcaption><a href="#">Hub Caps</a></figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>