<?php declare(strict_types=1);

/*
    Purpose: Checkout Page
    Author: TS & AM
    Date: March 2021
    Uses: HappyEarthDisplay, HappyEarthModel
 */

    //create or resume session        
    session_start();

    require_once ("HappyEarthDisplay.php");
    require_once ("HappyEarthModel.php");
    
    $aDisplay = new HappyEarthDisplay();
    $aDisplay = new d9RWSDisplay();
    
    $aDisplay->displayPageHeader("checkout");
    
    $aDisplay->displayPageFooter();
?>