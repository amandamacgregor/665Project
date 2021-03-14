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
           </head>
           <body>
           <div id="pageContainer">
              <div id = "contentWrap">
              <header>
                    <div class="headerContainer">
                        <div class="headerText">
                             <h1 id="pink">Ha</h1>
                             <h1 id="red">pp</h1>
                             <h1 id="yellow">y E</h1>
                             <h1 id="green">ar</h1>
                             <h1 id="blue">th</h1>
                        </div>
                        <div class="headerImage">
                            <img id="globe" src="PastelGlobe.png" width ='250px' height="230px">
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
            </div>
            <footer>
               <div class = "footer">
                     <div class="mission">
                        <a href="about.php"><span>Learn More About Our Mission</span></a>
                     </div>
                    <div class = "copyright">
                        &copy; $year MacGregor/Schoenherr Incorporated
                    </div>
               </div>
            </footer>
           </div>   
          </body>
         </html>
         ABC;
        echo $output;
    }

    function displaySearchForm()
    {
        $output = <<<ABC
                    <form action="searchResults.php" method="post" name="searchform" id="searchform" class="form">
                    <section>
                        <label for="category">Category:</label>
                        <select name="productcategoryid" id="productcategoryid">
                            <option value="">Select</option>
                ABC;

        // instantiate a RWSModel object

        $aModel = new HappyEarthModel();

        // call the get methods

        $categoriesList = $aModel->getCategories(); // get the categories to populate the list box
        
        foreach ($categoriesList as $aCategory)
        {
            extract($aCategory);
            $output .= <<<HTML
                            <option value="$productcategoryid">$name</option>
                        HTML;
        }

        $output .= <<<HTML
                        </select>
                        </section>
                        <section>
                        <label for="condition">Condition:</label>
                        <select name="condition" id="condition">
                            <option value="">Select</option>
                    HTML;

        $conditionsList = $aModel->getConditions(); // get the conditions to populate the list box

        foreach ($conditionsList as $aCondition)
        {
            extract($aCondition);
            $output .= <<<HTML
                            <option value="$condition">$condition</option>
                        HTML;
        }

        $output .= <<<HTML
                        </select>
                        </section>
                        <section>
                        <label for="gender">Gender:</label><br>
                        <div class="radiodiv">
                            <div>
                            <input type="radio" id="male" name="gender" value="M">
                            <label for="male">Male</label><br>
                            <input type="radio" id="female" name="gender" value="F">
                            <label for="female">Female</label><br>
                            </div>
                            <div>
                            <input type="radio" id="nonbinary" name="gender" value="N">
                            <label for="nonbinary">Non-Binary</label><br>
                            <input type="radio" id="allgenders" name="gender" value="A" checked="true">
                            <label for="allgenders">All Genders</label>
                             </div>
                        </div>
                        </section>
                        <section>
                        <label for="size">Size:</label>
                            <select name="size" id="size">
                                <option value="">Select</option>
                                <option value="S">Small</option>
                                <option value="M">Medium</option>
                                <option value="L">Large</option>
                                <option value="XL">Extra Large</option>
                                <option value="1x">1x</option>
                                <option value="2x">2x</option>
                                <option value="3x">3x</option>
                            </select>
                        </section>
                        <section>
                        <label for="listedbetween">Listed Between:</label><br>
                            <input type="date" id="startlisted" name="startlisted"
                            value="" min="2021-01-01" max="2021-12-31">
                            <input type="date" id="endlisted" name="endlisted"
                            value="" min="2021-01-01" max="2021-12-31">
                        </section>
                        <section>
                        <label for="pricerange">Priced Between:</label><br>
                            <label for="minprice">Minimum</label>
                            <input type="number" id="minprice" name="minprice"
                            value="" min="0" max="500" step="5">
                            <label for="maxprice">Maximum</label>
                            <input type="number" id="maxprice" name="maxprice"
                            value="" min="0" max="500" step="5">
                        </section>
                        <p>
                            <input type="submit" value="Find It!" />
                            <a href="index.php">Cancel</a>
                        </p>        
                        </form>
                HTML;
        echo $output;
    }

    //method to display a list of products in a table
    
    function displayProducts (array $aList, string $linkPage) : void
    {
        // get a count of the number of products returned by the method
        
        $numProducts = count($aList);

        if ($numProducts == 0)
        {
            echo "<h3 id='nomatch'>No matching products found</h3>";
        }
        else
        {   
            $output = <<<ABC
            <h3 id='resultnum'>$numProducts matching product(s) found</h3>
                <section id="results">
            ABC;

            $productNum = 0;

            foreach ($aList as $product)
            {
                extract($product);
                $productNum++;
                $price = number_format($price,2,'.',',');

                $output .= <<<ABC
                            <div class="productcard">
                        ABC;
                           
                        if ($photo != null) 
                            {
                                $output .= <<<HTML
                                            <img src="$photo"></a> <br />
                                        HTML;
                            }

                            $output .= <<<ABC

                            $productNum: $name<br />
                            $description
                             <br />
                        <i> \$$price </i> <br /><br />
                        <a href="productPage.php?productid=$productid" class="viewproduct">View</a>
                ABC;

                $output .= <<<ABC
                </div>
            ABC;

            }
            $output .= '</section>';
        }
        $output .= <<<ABC
                    <p style="text-align: center">
                    <a href="$linkPage">[Back to Search Page]</a>
                    </p></section>
                ABC;
        echo $output;
    }

    function displayhomePage(){
        $output = <<<ABC
                <section>
                    <div id ="welcome">
                    <img src="fire.png" id="welcomeImage" alt="Friends enjoying time in nature">
                    <h2 id="tagline">Your affordable, sustainable fashion destination</h2>
                    </div>
                    
                    <div id="browse">
                    <button id="browseButton"><a href="Search.php">Browse Hundreds of Unique Items</a></button>
                    </div>

                    <div id="launch">
                    <button id="create"><a href="SignIn.php">Create Account</a></button>
                    <button id="login"><a href="SignIn.php">Sign In</a></button>
                    <button id="learn"><a href="About.php">Learn More</a></button>
                    </div>
                    <div id="bluespace">
                    </div>
                </section>
            ABC;

        echo $output;
    }

    function displayProductDetails(array $aList) : void
    {
        // extract the elements of the array

        extract($aList[0]);

        // format the price field

        $formattedPrice = number_format((float)$Price, 2,'.',',');
        $formattedDate = date("F j, Y", strtotime($Created));

        // include img tag if an image exists for the product
        $output .= <<<HTML
                    <div class="productpagecont">
                HTML;
        if ($Photo !='')
        {
            $output .= <<<HTML
                        <div style="text-align:center">
                            <img src = "$Photo" />
                        </div>
                    HTML;
        }

        $output .= <<<HTML
                        <div class="details">
                        <dl>
                            <dt>Name:</dt>
                            <dt>Description:</dt>
                            <dt>Brand:</dt>
                            <dt>Condition:</dt>
                            <dt>Gender:</dt>
                            <dt>Size:</dt>
                            <dt>Price:</dt>
                            <dt>Listed:</dt>
                        </dl>
                        <dl>
                            <dd>$Name</dd>
                            <dd>$Description</dd>
                            <dd>$Brand</dd>
                            <dd>$Condition</dd> 
                            <dd>$Gender</dd>
                            <dd>$Size</dd>
                            <dd>\$$formattedPrice</dd>
                            <dd>$formattedDate</dd><br />
                        </dl>
                        </div>
                        </div>
                            <form class="productpage" action="updateCart.php" method = "post">
                            <input type="hidden" name="productid" value =$productid />
                            <dt><input name = "submit" type="submit" value="Add to Cart" /></dt></form>
                        
                        <p id="productadd">
                            <a href="Search.php">[Back to Search Page]</a>
                        </p>
                        
                        
               HTML;

        echo $output;
    }


}
