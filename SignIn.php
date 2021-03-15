<?php declare(strict_types=1);
    //create or resume session        
    session_start();

    // automatically load required Class files

    spl_autoload_register(function ($class_name){
    include $class_name . '.php';
    });

    // Set local variables to $_POST array elements (username and userpassword) or empty strings
    $userName = (isset($_POST['username'])) ? trim($_POST['username']) : '';
    $userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';

    //if the "redirect" is set, assign it's value to $redirect, 
    // else, assign "Index.php to $redirect

    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'index.php';

    if (isset($_POST['username'])) {
    // instantiate a Model object

        $aModel = new HappyEarthModel();

        // call getUserData method

        $userList = $aModel->getUserData($userName, $userPassword, $redirect);

        if (count($userList)==1) //If credentials check out
        {
            extract($userList[0]);

            // assign user info to an array

            $userInfo = array('firstname'=>$firstname, 'lastname'=>$lastname, 'username'=>$username);

            // assign the array to a session array element

            $_SESSION['userInfo'] = $userInfo;
            session_write_close(); //typically not required; ensures that the session data is stored

            //redirect the user
            header('location:' . $redirect);
            die();
        }

        else // Otherwise, assign error message to $error
        {
            $error = 'Invalid credentials<br />Please try again';
        }
    }
    
    $aDisplay = new HappyEarthDisplay();
    
    $aDisplay->displayPageHeader("Sign In");

    // if error variable was set, display it

    if (isset($error))
    {
    echo '<div id="loginerror">' . $error . '</div>';
    }

    $aDisplay->displaySignInForm($userName, $userPassword, $redirect);

    
    $aDisplay->displayPageFooter();
?>