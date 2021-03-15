<?php declare(strict_types=1);
/*
    Purpose: Product Page
    Author: AM & TS
    Date: March 2021
    Uses: HappyEarthDisplay, HappyEarthModel
 */

//create or resume session        
session_start();

 // If productid is not passed with page request, redirect to Search Page
// Else, assign the URL parameter to a variable

if (!isset($_GET['productid']) || !is_numeric($_GET['productid']))
{
    header('Location:' . 'Search.php');
    exit();
}
else
{
    $productID = (int) $_GET['productid'];
}

// required Class files

require_once ("HappyEarthDisplay.php");
require_once ("HappyEarthModel.php");

// instantiate model and display objects

$aDisplay = new HappyEarthDisplay();
$aModel = new HappyEarthModel();

// Call the getMerchandiseDetailsByPK method

$productList = $aModel->getProductDetailsByID($productID);

// If the number of records is not 1, redirect to Store Search Page

if (count($productList) != 1)
{
   header('Location:' . 'Search.php');
   exit();
}

// call various section display methods

$aDisplay->displayPageHeader("Product Details");

// call the displayProductDetails method

$aDisplay->displayProductDetails($productList);

$aDisplay->displayPageFooter();
?>