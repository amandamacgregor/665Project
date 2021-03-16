<?php declare(strict_types=1);
    //create or resume session        
    session_start();

    // automatically load required Class files
    spl_autoload_register(function ($class_name){
    include $class_name . '.php';
    }); 

    //if $_POST array is not populated with values the user has reached this page by mistake, redirect to the home page
    if (!(isset($_POST['customerid']))){
        header('Refresh: 2; URL=Index.php');

        echo '<h2>You have reached this page in error. Redirecting to our home page...</h2>';

        die();
    }//end if
    else { //if $_POST array does have values proceed to run page
        //instantiate a HappyEarthModel() object
        $aModel = new HappyEarthModel();

        // Call the updateCustomerAccount method
        $aModel->updateCustomerAccount((int)$_POST['customerid'],$_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'],
            $_POST['streetaddress'], $_POST['email']);
        
        
        $aDisplay = new HappyEarthDisplay();
        
        $aDisplay->displayPageHeader("Update Your Account");

        //display Update Succesful message
        $msg = <<<HTML
            <div id="updateSucceeded">
            <h3>Account Update Successful</h3>
            <button id="return"><a href="index.php">Return to Home Page</a></button>
            </div>
        HTML;
        echo $msg;
        
        $aDisplay->displayPageFooter();
    }//end else


?>