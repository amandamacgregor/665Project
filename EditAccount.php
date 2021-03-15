<?php declare(strict_types=1);
    //create or resume session        
    session_start();

    // automatically load required Class files
    spl_autoload_register(function ($class_name){
    include $class_name . '.php';
    });

    //instantiate a HappyEarthModel() object
    $aModel = new HappyEarthModel();

    // Call the updateFilm method
    $aModel->updateCustomerAccount((int)$_POST['customerid'],$_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'],
            $_POST['streetaddress'], $_POST['email']);
    
    $aDisplay = new HappyEarthDisplay();
    
    $aDisplay->displayPageHeader("Update Your Account");

    echo "Account Update was Successful";
    
    $aDisplay->displayPageFooter();
?>