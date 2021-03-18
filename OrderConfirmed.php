<?php declare(strict_types=1);

/*
    Purpose: Order confirmation page - inserts order record into table and notifies user 
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

    // if the session cart object variable is not set or is empty display appropriate message; otherwise display the page
    if (!isset($_SESSION['aCart']) || count($_SESSION['aCart']->getCartItems()) === 0)
    {
        header('Refresh: 3; URL=Index.php');
        echo '<h2>You have reached this page in error <br /> You will be redirected to our home page in 3 seconds.</h2>';
        echo '<h2>If you are not redirected, please <a href="Index.php">Click here to return to the home page</a>.</h2>';
        die();
    }

    //verify that user is logged into their account, if not function will redirect to sign in page
    AuthCheck::isAuthenticated('OrderConfirmed.php');

    //instantiate model object
    $aModel = new HappyEarthModel();

    //get customer id and assign to local variable
    $customerAccount = $aModel->getAccountInfo(($_SESSION["userInfo"]["username"]));
    $customerid = $customerAccount[0]["customerid"];

    //store order total in local variable
    $orderTotal = (float)$_POST["ordertotal"];

    //call the insertOrder function; get the orderPK of the newly added order
    $orderIDResult = $aModel->insertOrder((int)$customerid, $orderTotal);
    $newOrderID = $orderIDResult[0]['orderID'];

    // for each item in the shopping cart, 
    // insert a row into the merchandiseorderitems table

    foreach($_SESSION['aCart']->getCartItems() as $aKey => $aValue)
    {
        $aModel->insertOrderItem((int)$newOrderID, $aKey);

        //mark each ordered item as unavailabe
        $aModel->markItemUnavaiable($aKey);

        // delete the item from the cart
        
        $_SESSION['aCart']->deleteCartItem($aKey);
    }

    //instantiate a display object
    $aDisplay = new HappyEarthDisplay();
    
    //display page header
    $aDisplay->displayPageHeader("Your Order is Confirmed");
    
    //display order confirmation
    $aDisplay->displayOrderConfirmation((int)$newOrderID);

    //display footer
    $aDisplay->displayPageFooter();



