<?php declare(strict_types=1);
/*
    Purpose: Search Page
    Author: AM & TS
    Date: March 2021
    Uses: HappyEarthDisplay, HappyEarthModel
    Action: searchResults.php
 */
    //create or resume session        
    session_start();

    // required Class files

    require_once ("HappyEarthDisplay.php");
    require_once ("HappyEarthModel.php");
    
    // instantiate model and display objects

    $aDisplay = new HappyEarthDisplay();
    $aModel = new HappyEarthModel();
    
    // call various section display methods

    // cookies


    $aDisplay->displayPageHeader("Search inventory");
    
    // call Search form

    $aDisplay->displaySearchForm($productCategoryId);

    $aDisplay->displayPageFooter();
?>