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
              <title>$pageTitle</title>
              <meta name="viewport" content="width=device-width, initial-scale=1" />  
              <link rel="stylesheet" href="NavbarStyles.css" type="text/css" />
              <link rel="stylesheet" href="MainStyles.css" type="text/css" />
              <script src="https://kit.fontawesome.com/6db76b0f22.js" crossorigin="anonymous"></script>
           </head>
           <body>
              <header>
                <div id="headerBox">
                    <div class="headerContainer">
                             <h1 id="pink">Ha</h1>
                             <h1 id="red">pp</h1>
                             <h1 id="yellow1">y</h1>
                             <img src="PastelGlobe.png" alt="Colorful Globe" height="200px" width="200px">
                             <h1 id="yellow2">E</h1>
                             <h1 id="green">ar</h1>
                             <h1 id="blue">th</h1>

                    </div>
                </div>
                    <div class="navbar">
                          <a href="Index.php" id="nav1"><i class="fas fa-igloo"></i> Home</a>                     
        ABC;
        // the session array element "userInfo" will be set if the user has been authenticated

        $authStatus = (isset($_SESSION['userInfo']));   

        // checks if the user status is authenticated, if so display "Sign Out", else Sign In/Register"

        if ($authStatus)
        {
            $output .= '<a href="SignOut.php" id="nav2"><i class="fas fa-user-check"></i> Sign Out</a>';
        }
        else
        {
            $output .= '<a href="SignIn.php" id="nav2"><i class="fas fa-user-check"></i> Sign In/Sign Up</a>';
        }

        $output .= <<<ABC
                          <a href="ManageAccount.php" id="nav3"><i class="fas fa-hand-holding-usd"></i> Manage Account</a>
                          <a href="Search.php" id="nav4"><i class="fas fa-search"></i> Search Inventory</a>
                          <a href="viewCart.php" id="nav5"><i class="fas fa-shopping-cart"></i> View Cart</a>
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
                            <option value="$productcategoryid">Select</option>
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
                            <option value="$condition">Select</option>
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
                        <div value="$gender" class="radiodiv">
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
                                <option value="$size">Select</option>
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
                        <label for="listedbetween">Listed Betwestartlisteden:</label><br>
                            <input type="date" id="startlisted" name="startlisted"
                            value="$startlisted" min="2021-01-01" max="2021-12-31">
                            <input type="date" id="endlisted" name="endlisted"
                            value="$endlisted" min="2021-01-01" max="2021-12-31">
                        </section>
                        <section>
                        <label for="pricerange">Priced Between:</label><br>
                            <label for="minprice">Minimum</label>
                            <input type="number" id="minprice" name="minprice"
                            value="$minprice" min="0" max="500" step="5">
                            <label for="maxprice">Maximum</label>
                            <input type="number" id="maxprice" name="maxprice"
                            value="$maxprice" min="0" max="500" step="5">
                        </section>
                        <p>
                            <input type="submit" value="Find It!" name="search" />
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
                    <button id="create"><a href="Register.php">Create Account</a></button>
                    <button id="login"><a href="SignIn.php">Sign In</a></button>
                    <button id="learn"><a href="About.php">Learn More</a></button>
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

    
    function displaySignInForm (string $aUserName, string $aUserPassword, string $aRedirect) : void
    {
        $output = <<<HTML
                    <form action="SignIn.php" name="signInForm" id="signinform" method="post">
                    <!-- Store the redirect file name in a hidden field  -->
                    <input type="hidden" name ="redirect" value = "$aRedirect" />
                    <label for="username">Username:</label>
                    <input type="text" name="username" id ="userlogin" value= "$aUserLogin" 
                        maxlength="10" autofocus="autofocus" required="true" 
                        pattern="^[\w@\.]+$" title="User Name has invalid characters" />
                    <label for="userpassword">Password:</label> 
                    <input type="password" name="userpassword" id="userpassword" value="$aUserPassword" 
                        maxlength="10" required="true" pattern="^[\w@\.]+$" 
                        title="Password has invalid characters" />
                    <p>
                        <input type="submit" value="Sign In" name="signin" id="signinbutton" /> <br />
                        Not a Member?  <a href="Register.php">Register Here</a>
                    </p>
                    </form>
                HTML;
                
        echo $output;
    }

    function displayRegisterForm (array $aMemberData) : void
    {
        // extract array data
        
        extract($aMemberData);

        $output = <<<HTML
                    <form name ="registerForm" id="registerForm" action="Register.php" method="post">
                        <!-- Store the customer ID in a hidden field  -->
                        <input type="hidden" name ="customerid" value = "$customerid" />   
                        <label for="username">Username:</label>
                        <input type="text" name="username" id ="username" value="$username" 
                            maxlength="50" autofocus="true" required="true" 
                            pattern="^[\w@\.]+$" title="Valid characters are a-z 0-9 _ . @" />
                        <label for="userpassword">Password:</label> 
                        <input type="password" name="userpassword" id="userpassword" value="$userpassword" 
                            maxlength="20" required="true" 
                            pattern="^[\w@\.]+$" title="Valid characters are a-z 0-9 _ . @" />
                        <label for="firstname">First Name:</label>
                        <input type="text" name="firstname" id ="firstname" value="$firstname" 
                            maxlength="50" required="true" pattern="^[a-zA-Z\-]+$" 
                            title="Valid characters are a-z" />
                        <label for="lastname">Last Name:</label>
                        <input type="text" name="lastname" id ="lastname" value="$lastname" 
                            maxlength="50" required="true" pattern="^[a-zA-Z\-]+$" 
                            title="Valid characters are a-z" />
                        <label for="streetaddress">Shipping Address:</label>
                        <input type="text" name="streetaddress" id ="streetaddress" value="$streetaddress" 
                            maxlength="255" required="true" 
                            pattern="^[a-zA-Z0-9][\w\s\.]*[a-zA-Z0-9\.]$" title="Please enter a valid street address" />      
                        <label for="email">Email:</label>
                        <input type="text" name="email" id ="email" value="$email" maxlength="255" 
                            required="true" pattern="^[\w\-\.]+@[\w]+\.[a-zA-Z]{2,4}$" 
                            title="Enter a valid email" /> 
                        <p>
                            <input type="submit" value="Register" name="register" id=registerbutton /> <br />
                        </p>
                    </form>
                HTML;
        
        echo $output; 
    }

    //method to display user's current account info as well as links to edit account info or delete their account
    //function to display user's current account info as well as links to edit account info or delete their account
    function displayAccountInfoEditForm (string $aUserName) : void
    {

        // instantiate a Model object
        $aModel = new HappyEarthModel();

        //call getAccountInfo function and store results in $accountInfo array
        $accountInfo = $aModel->getAccountInfo($aUserName);

        //extract data from $accountInfo and store into variables
        extract($accountInfo[0]);
        
        //display form with current account info data prepopulated 
        $output = <<<HTML
            <h3>Edit Your Account Info</h3>
            <form action="EditAccount.php" name="editaccountform" id="editaccountform" method="post">

            <label for="username">Username:</label>
                        <input type="text" name="username" id ="username" value="$username" 
                            maxlength="50" autofocus="true" required="true" 
                            pattern="^[\w@\.]+$" title="Valid characters are a-z 0-9 _ . @" />
                        <label for="userpassword">Password:</label> 
                        <input type="password" name="password" id="password" value="$password" 
                            maxlength="20" required="true" 
                            pattern="^[\w@\.]+$" title="Valid characters are a-z 0-9 _ . @" />
                        <label for="firstname">First Name:</label>
                        <input type="text" name="firstname" id ="firstname" value="$firstname" 
                            maxlength="50" required="true" pattern="^[a-zA-Z\-]+$" 
                            title="Valid characters are a-z" />
                        <label for="lastname">Last Name:</label>
                        <input type="text" name="lastname" id ="lastname" value="$lastname" 
                            maxlength="50" required="true" pattern="^[a-zA-Z\-]+$" 
                            title="Valid characters are a-z" />
                        <label for="streetaddress">Shipping Address:</label>
                        <input type="text" name="streetaddress" id ="streetaddress" value="$streetaddress" 
                            maxlength="255" required="true" 
                            pattern="^[a-zA-Z0-9][\w\s\.]*[a-zA-Z0-9\.]$" title="Please enter a valid street address" />      
                        <label for="email">Email:</label>
                        <input type="text" name="email" id ="email" value="$email" maxlength="255" 
                            required="true" pattern="^[\w\-\.]+@[\w]+\.[a-zA-Z]{2,4}$" 
                            title="Enter a valid email" /> 
                    <p>
                        <input type="submit" value="Update Account" name="updateaccount" id="updateaccountbutton" /> <br /><br />
                        <button id="deleteaccountbutton"><a href="DeleteAccount.php">Delete Account</a></button>
                    </p>
            </form>
        HTML;
        echo $output;
        
    }

    function displayShopCart(array $aList) : void
    {
        // get a count of the number of items in the cart

        $cartItems = count($aList);

        // prepare the output using heredoc syntax

        $output = <<<HTML
                    <h2 style="text-align: center">You have $cartItems product(s) in your cart</h2>
                    <div class="shopping-cart">
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Unit Price</th>
                        </tr>
                HTML;

        foreach ($aList as $aItem)
        {
            extract($aItem);
            $totalPrice += $price;
            $formattedPrice = number_format((float)$price, 2);
            $formattedTotalPrice = number_format((float)$totalPrice, 2);
            $output .= <<<HTML
                        <tr>
                            <td>
                                $name
                            </td>
                            <td>
                                <form action="updateCart.php" method="post">
                                    <input type="hidden" name="productid" value="$productid" />
                                    <input type="number" name="productqty" 
                                        value="1" size="2" maxlength="2" 
                                        required="required" min="0" max="20" />
                                    <input type="submit" name="submit" value="Update Quantity" />
                                </form>
                            </td>
                            <td style="text-align: right">
                                $$formattedPrice
                            </td>
                        </tr>
                    HTML;
        }
        $output .= <<<HTML
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <b>Your order total is: $$formattedTotalPrice</b>
                            </td>
                        </div>
                            <td colspan="2" style="text-align: center">
                                <form action="Checkout.php" method="post">
                                    <input type="submit" name="submit" id="proceed" value = "Proceed to Checkout" />
                                </form>
                            </td>
                        </tr>
                    </table>
                    <p style="text-align: center">
                        <a href="Search.php">[Continue shopping]</a>
                    </p>
                    
                HTML;

        // display the output

        echo $output;
    }


}
