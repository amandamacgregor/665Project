<?php declare(strict_types=1);

/*
    Purpose: Cancels user's order upon their request
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

    //get order id number from url parameter and as local variable for clarity
    $orderID = (int)$_GET['orderid'];

    //if the order id url is not holding a valid id, user likely arrived at page in error, redirect to homepage
    if (!($orderID > 0))
    {
        header('Refresh: 3; URL=Index.php');
        echo '<h2>You have reached this page in error <br /> You will be redirected to our home page in 3 seconds.</h2>';
        echo '<h2>If you are not redirected, please <a href="Index.php">Click here to return to the home page</a>.</h2>';
        die();
   }

    //verify that user is logged into their account, if they are not logged in they should not be at this page, redirect to homepage
    AuthCheck::isAuthenticated('Index.php');

    //instantiate model object
    $aModel = new HappyEarthModel();

    //delete order 
    $aModel->deleteOrder($orderID);

    //instantiate display object
    $aDisplay = new HappyEarthDisplay();

    //display page header
    $aDisplay->displayPageHeader("Order Deleted");
    
    //display order deleted confirmation to user
    $aDisplay->displayOrderCanceled($orderID);
    
    //display pagefooter
    $aDisplay->displayPageFooter();
