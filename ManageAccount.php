<?php declare(strict_types=1);
    //create or resume session        
    session_start();

    // automatically load required Class files
    spl_autoload_register(function ($class_name){
    include $class_name . '.php';
    });

    //call isAuthenticated method in the AuthCheck class - if the user is not logged in they will be redirected to the sign in page
    AuthCheck::isAuthenticated('ManageAccount.php');

    //after user is authenticated display page
    $aDisplay = new HappyEarthDisplay();
    
    $aDisplay->displayPageHeader("Manage Your Account");

    //call the displayAccountInfo function passing the username of the currently logged in user as paramter
    $userName = $_SESSION['userInfo']['username'];

    $aDisplay->displayAccountInfoEditForm($userName);
    
    $aDisplay->displayPageFooter();
?>