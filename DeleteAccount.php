<?php declare(strict_types=1);
    //create or resume session        
    session_start();

    // automatically load required Class files
    spl_autoload_register(function ($class_name){
    include $class_name . '.php';
    }); 

    //if customer id is not set redirects user
    if (!(isset($_GET['customerid']))){
        header('Refresh: 2; URL=SignIn.php');

        echo '<h2>You must be logged in to view ...</h2>';

        die();
    }//end if
    else { //if user id was successfully passed as a URL parameter run page
        //instantiate a HappyEarthModel() object
        $aModel = new HappyEarthModel();

        // Call the updateCustomerAccount method
        $aModel->deleteCustomerAccount((int)$_GET['customerid']);
              
        $aDisplay = new HappyEarthDisplay();
        
        $aDisplay->displayPageHeader("Account Deleted");

        //display successfully deleted message
        $msg = <<<HTML
            <div id="deleteSucceeded">
            <h3>Your account has successfully been deleted</h3>
            <h3>We are sorry to see you go</h3>
            <button id="return"><a href="index.php">Return to Home Page</a></button>
            </div>
        HTML;
        echo $msg;
        
        $aDisplay->displayPageFooter();
    }//end else


?>