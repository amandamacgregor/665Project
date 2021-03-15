<?php declare(strict_types=1);
/*
    Purpose: Demo8 - Class to check if a user has been authenticated
    Author: AM + TS
    Date: March 2021
 */

session_start();

class AuthCheck
{
    // this method checks if the user has been authenticated
    // if the session array element, "userInfo" is not set,
    // the user is redirected to the sign in page (SignIn.php)
    
    static function isAuthenticated(string $aRedirect) : void
    {

        if (!isset($_SESSION['userInfo']))
        { 
               // uses a URL parameter (redirect) is tagged on to the URL.
               // the redirect URL parameter is used in "d8SignIn.php" to redirect the user
               // to the originally requested page (after authentication).

            header('location: SignIn.php?redirect=' . $aRedirect);
            die();
        }
    }
}

    


?>
