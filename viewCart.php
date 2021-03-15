<?php declare(strict_types=1);
/*
    Purpose: View Cart
    Author: AM & TS
    Date: March 2021
    Uses: Display, Model, ShoppingCart
 */
// automatically load required Class files

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

session_start();
// session_unset();

// instantiate a HappyEarthDisplay object

$aDisplay = new HappyEarthDisplay();

// if the session variable is not set or is empty display appropriate message; otherwise display the items

if (!isset($_SESSION['aCart']) || count($_SESSION['aCart']->getCartItems()) === 0)
{
    $aDisplay->displayPageHeader("Shopping Cart");
    $aDisplay->emptyCart();
    $aDisplay->displayPageFooter();
    die();
}

// get a list of productIDs for the cart items; string them together delimiting with a comma

$productIDs = implode(',', array_keys($_SESSION['aCart']->getCartItems()));

// instantiate a HappyEarthModel object

$aModel = new HappyEarthModel();

//get merchandise details for the items in the cart

$cartList = $aModel->getProductsInCart($productIDs);

// instantiate a HappyEarthDisplay object

$aDisplay = new HappyEarthDisplay();

// call the displayPageHeader method

$aDisplay->displayPageHeader("Shopping Cart");

// // call the displayShopCart method

$aDisplay->displayShopCart($cartList);

// call the displayPageFooter method 

$aDisplay->displayPageFooter();


?>