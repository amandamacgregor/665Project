<?php declare(strict_types=1);
/*
    Purpose: Demo8 - Class to check if a user has been authenticated
    Author: AM + TS
    Date: March 2021
 */

session_start();

class AuthCheck
{
    // this method checks if the user is signed into their account
    // if the session array element, "userInfo" is not set,
    // the user is redirected to the sign in page (SignIn.php)
    
    static function isAuthenticated(string $aRedirect) : void
    {

        if (!isset($_SESSION['userInfo']))
        { 
               // uses a URL parameter (redirect) is tagged on to the URL.
               // the redirect URL parameter is used in "SignIn.php" to redirect the user
               // to the originally requested page (after authentication).
            $msg = <<<HTML
                       <div id="ridirect"> 
                        <h2>You must be signed in to access this page.</h2>
                        <h2>Redirecting to log in page.</h2>
                    </div>
                    HTML;
            echo $msg;
            header('Refresh:2; url=SignIn.php?redirect=' . $aRedirect);
            die();
        }
    }
}

    


?>
