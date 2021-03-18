<?php declare(strict_types=1);

/*
    Purpose: Checkout Page
    Author: TS & AM
    Date: March 2021
    Uses: HappyEarthDisplay, HappyEarthModel
 */
    // automatically load required Class files
    spl_autoload_register(function ($class_name){
    include $class_name . '.php';
    });

    //create or resume session        
    session_start();

    //call isAuthenticated method in the AuthCheck class - if the user is not logged in they will be redirected to the sign in page
    AuthCheck::isAuthenticated('Checkout.php');

    // if the session cart array variable is not set or is empty display appropriate message and redirect user
    if (!isset($_SESSION['aCart']) || count($_SESSION['aCart']->getCartItems()) === 0)
        {
            header('Refresh: 3; URL=Search.php');
            echo '<h2>You shopping cart is empty <br /> You will be redirected to our store in 5 seconds.</h2>';
            echo '<h2>If you are not redirected, please <a href="Search.php">Click here to visit our Store</a>.</h2>';
            die();
        }

    //after user is authenticated and we have ensured that the cart has items in it, display checkout page

    require_once ("HappyEarthDisplay.php");
    require_once ("HappyEarthModel.php");
    
    //instantiate Display and Model Objects
    $aDisplay = new HappyEarthDisplay();
    $aModel = new HappyEarthModel();
    
    $aDisplay->displayPageHeader("checkout");

    // get a list of productIDs for the cart items; string them together delimiting with a comma

    $productIDs = implode(',', array_keys($_SESSION['aCart']->getCartItems()));

    //get merchandise details for the items in the cart

    $cartList = $aModel->getProductsInCart($productIDs);

    //call displayCheckout function passing cart items and their details as a parameter

    $aDisplay->displayCheckout($cartList);
    
    $aDisplay->displayPageFooter();
?>