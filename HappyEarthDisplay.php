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

    function displaySearchForm()
    {
        $output = <<<ABC
                    <section>
                    <form action="searchResults.php" method = "post" name="SearchByMultiCriteria" id="SearchByMultiCriteria">
                        <label for="category">Category:</label>
                        <select name="productcategoryid" id="productcategoryid">
                            <option value="">Select</option>
                ABC;

        // instantiate a RWSModel object

        $aModel = new HappyEarthModel();

        // call the getCategories method

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
                        <label for="gender">Gender:</label><br>
                            <input type="radio" id="male" name="gender" value="M">
                            <label for="male">Male</label><br>
                            <input type="radio" id="female" name="gender" value="F">
                            <label for="female">Female</label><br>
                            <input type="radio" id="nonbinary" name="gender" value="N">
                            <label for="nonbinary">Non-Binary</label><br>
                            <input type="radio" id="allgenders" name="gender" value="A" checked="true">
                            <label for="allgenders">All Genders</label>
                            </section>
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
            echo "<h3>No matching products found</h3>";
        }
        else
        {   
            $output = <<<ABC
                <section>
                <table>
                   <caption>$numProducts matching product(s) found</caption>
                   <tbody>
            ABC;

            $productNum = 0;

            foreach ($aList as $product)
            {
                extract($product);
                $productNum++;
                $price = number_format($price, 2);
                // $dateReleased = date_format(new DateTime($dateintheaters), 'F j, Y');
                $output .= <<<ABC
                    <tr>
                        <td>
                            $productNum: $name<br />
                            $description
                        </td>
                        <td>
                            Price: $$price
                        </td>
                    </tr>
                ABC;
            }
            $output .= '</tbody> </table> </section>';
        }
        $output .= <<<ABC
                    <p style="text-align: center">
                    <a href="$linkPage">[Back to Search Page]</a>
                    </p></section>
                ABC;
        echo $output;
    }


}
