<?php declare(strict_types=1);
/*
    Purpose: Update Cart (no display)
    Author: AM & TS
    Date: March 2021
    Uses: ShoppingCart
 */

// automatically load required Class files

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

session_start();

// if the form element productid is set

if (isset($_POST['productid']))
{
    // if the session element aCart is not set

    if (!isset($_SESSION['aCart']))
    {
        // instantiate a HEShoppingCart object and store it in $_SESSION

        $_SESSION['aCart'] = new HEShoppingCart();
    }
    
    // if the form element productqty is set (if the user updates the quantity for a product in their shopping cart)

    if (isset($_POST['productqty']))
    {
        // call the updateCartItem method

       $_SESSION['aCart']->updateCartItem((int)$_POST['productid'],(int)$_POST['productqty']);
    }
    else
    {
        // call the addCartItem method
        
        $_SESSION['aCart']->addCartItem((int)$_POST['productid']);
    }
}

// echo "post productid:" . $_POST['productid'];
header('location:viewCart.php');
exit();
?>
