<?PHP declare(strict_types=1);

//create or resume session        
session_start();

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

// assign form values to an array

$newMember = array();

$newMember['username'] = (isset($_POST['username'])) ? trim($_POST['username']) : '';
$newMember['userpassword'] = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';
$newMember['firstname'] = (isset($_POST['firstname'])) ? trim($_POST['firstname']) : '';
$newMember['lastname'] = (isset($_POST['lastname'])) ? trim($_POST['lastname']) : '';
$newMember['streetaddress'] = (isset($_POST['streetaddress'])) ? trim($_POST['streetaddress']) : '';
$newMember['email'] = (isset($_POST['email'])) ? trim($_POST['email']) : '';

// if the form was submitted

if (isset($_POST['register']))
{
    // instantiate a Model object

    $aModel = new HappyEarthModel();

    // call checkUserName method

    $result = $aModel->checkUserName($newMember['username']);
    
    if (count($result) > 0)
    {
        $error = 'Please choose a different Username';
    }
    else
    {
        // call addNewCustomer method

        $aModel->addNewCustomer($newMember);
        
        //redirect user to Sign In page

        header('Refresh: 2; URL=SignIn.php');
        echo '<h2>Thank you for creating an account.  Redirecting to Sign In Page...<h2>';
        die();
    }
}

// instantiate a HappyEarthDisplay object

$aDisplay = new HappyEarthDisplay();

// call the displayPageHeader method

$aDisplay->displayPageHeader("Create An Account");

// if the user chose a duplicate username, display error

if (!empty($error))
{
    echo '<div id="error">' . $error . '</div>';
}

// call the displayRegisterForm method

$aDisplay->displayRegisterForm($newMember);

// call the displayPageFooter method 

$aDisplay->displayPageFooter();
?>


?>
