<?php declare(strict_types=1);
/*
    Purpose: Search Page
    Author: AM & TS
    Date: March 2021
    Uses: HappyEarthDisplay, HappyEarthModel
    Action: searchResults.php
 */

    // required Class files

    require_once ("HappyEarthDisplay.php");
    require_once ("HappyEarthModel.php");
    
    // instantiate model and display objects

    $aDisplay = new HappyEarthDisplay();
    $aModel = new HappyEarthModel();
    
    // call various section display methods

    $aDisplay->displayPageHeader("<br /> Search inventory by Category, Gender, Size, Listed Date and/or Price Rage <br />");
    
    // call Search form

    $aDisplay->displaySearchForm();

    $aDisplay->displayPageFooter();
?>