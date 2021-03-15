<?php declare(strict_types=1);
    //create or resume session        
    session_start();

    // automatically load required Class files
   
    spl_autoload_register(function ($class_name){
    include $class_name . '.php';
    });
    
    $aDisplay = new HappyEarthDisplay();
    
    $aDisplay->displayPageHeader("Welcome");
    
    $aDisplay->displayPageFooter();
?>