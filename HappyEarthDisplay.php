<?php

/**
 * Description of HappyEarthDisplay
 *
 * @author TaraDani
 */
class HappyEarthDisplay {
        
    function displayPageHeader(string $pageTitle)
    {
        $output = <<<ABC
        <!DOCTYPE html>
        <html>
           <head>
              <meta charset="UTF-8" />
              <title>Happy Earth Styles</title>
              <meta name="viewport" content="width=device-width, initial-scale=1" />  
              <link rel="stylesheet" href="NavbarStyles.css" type="text/css" />
              <link rel="stylesheet" href="MainStyles.css" type="text/css" />
              <script src="https://kit.fontawesome.com/6db76b0f22.js" crossorigin="anonymous"></script>
              <script src="PageStyles.js"></script>
           </head>
           <body>
              <header>
                    <div class="headerContainer">
                        <div class="headerText">
                            <h1 data-heading="Happy Earth"><span data-heading="Happy Earth">Happy Earth
                                </span></h1>
                        </div>
                        <div class="headerImage">
                            <img id="globe" src="PastelGlobe.png" width ='200px' height="175px">
                        </div>
      
                    </div>
                    <div class="navbar">
                          <a href="Index.php" id="nav1"><i class="fas fa-igloo"></i> Home</a>
                          <a href="SignIn.php" id="nav2"><i class="fas fa-user-check"></i> Sign In/Sign Up</a>
                          <a href="Search.php" id="nav3"><i class="fas fa-search"></i> Search Inventory</a>
                          <a href="Sell.php" id="nav4"><i class="fas fa-hand-holding-usd"></i> Sell Goods</a>
                          <a href="Cart.php" id="nav5"><i class="fas fa-shopping-cart"></i> View Cart</a>
                    </div>
              </header>
        ABC;
        echo $output;
    }
 
        function displayPageFooter()
    {
       $year = date('Y');
       $output = <<<ABC
            <footer>
               <div class = "footer">
                     <div class="mission">
                        <a href="about.php"><span>Learn More About Our Mission</span></a>
                    <div class = "copyright">
                        &copy; $year MacGregor/Schoenherr Incorporated
                    </div>
               </div>
            </footer>   
          </body>
         </html>
         ABC;
        echo $output;
    }
}
