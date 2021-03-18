<?php declare(strict_types=1);
/* 
    Purpose: Accessing data from Happy Earth DB for website
    Author: AM & TS
    Date: March 2021
    
 */
    
class HappyEarthModel
{
    // static method to connect to the database

    private static function dbConnect() : object
    {
        $serverName = 'BusCISSQL1901\cisweb';
        $uName = 'wearable';
        $pWord = 'device';
        $db = 'Team104DB';
    
        try
        {
            //instantiate a PDO object and set connection properties
        
            $conn = new PDO("sqlsrv:Server=$serverName; Database=$db", $uName, $pWord, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
           
        }
        // if connection fails
    
        catch (PDOException $e)
        {
            die('Connection failed: ' . $e->getMessage());
        }
    
        //return connection object

        return $conn;
    }

    // static method to execute a query - the SQL statement to be executed, is passed to it

    private static function executeQuery(string $query) 
    {
        // call the dbConnect function

        $conn = self::dbConnect();

        try
        {
            // execute query and assign results to a PDOStatement object

            $stmt = $conn->query($query);

            do
            {
                if ($stmt->columnCount() > 0)  // if rows with columns are returned
                {
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //retreive the rows as an associative array
                }
            } while ($stmt->nextRowset());
            
            // Note: the loop is intended for situations when a nonquery (e.g., Insert, Update) is followed by a query that returns row(s). 
           
            //call dbDisconnect() method to close the connection

            self::dbDisconnect($conn);

            return $results;
        }
        catch (PDOException $e)
        {
            //if execution fails

            self::dbDisconnect($conn);
            die ('Query failed: ' . $e->getMessage());
        }
    }
    
    // static method to close the DB connection
    
    private static function dbDisconnect($conn) : void
    {
        // closes the specified connection and releases associated resources

        $conn = null;
    }

    // various methods begin here

    // method to return categories from ProductCategory table
    
    function getCategories() : array
    {
        $query = <<<STR
                    Select productcategoryid, name
                    From productcategory
                    Order by name
                 STR;
        
        return self::executeQuery($query);
    }

    // method to return conditions from Product table

    function getConditions() : array
    {
        $query = <<<STR
                    Select condition
                    From product
                    Order by condition
                    STR;
        
        return self::executeQuery($query);
    }

    // method to search for products by category, gender, size, listed date and/or price range
    
    function getProductsByMultiCriteria(int $productCategoryID, string $condition, string $gender, string $size, string $startListed, string $endListed, int $minPrice, int $maxPrice) : Array
    {

        // by default, return all the records
        $query = <<<STR
                    Select productid, name, description, gender, brand, size, price, created, photo
                    From product
                    Where 0=0
                    And available = 'Y'
                STR;
        
        // then, limit from there based on information at hand.
        if ($productCategoryID != '')
        {
            $query .= <<<STR
                        And categoryid = $productCategoryID
                    STR;
        }
        
        if ($gender != 'A')
        {
            $query .= <<<STR
                        And gender like '%$gender%'
                    STR;
        }
        
        if ($condition != '')
        {
            $query .= <<<STR
                        And condition like '%$condition%'
                    STR;
        }

        if ($size != '')
        {
            $query .= <<<STR
                        And size like '%$size%'
                    STR;
        }

        if ($startListed != '')
        {
            $query .= <<<STR
                        And convert(varchar,Created,23) >= '$startListed'
                    STR;
        }

        if ($endListed != '')
        {
            $query .= <<<STR
                        And convert(varchar,Created,23) <= '$endListed'
                    STR;
        }

        if ($maxPrice !== 0)
        {
            $query .= <<<STR
                        And price <= $maxPrice
                    STR;
        }
    
        $query .= <<<STR
                    Order by name
                STR;

        // echo $query;
        return self::executeQuery($query);
    }

    function getProductDetailsByID(int $productID) : array
    {
        $query = <<<STR
                    Select *
                    From product
                    Where productid = $productID
            STR;

        return self::executeQuery($query);
    }

    function getUserData(string $aUserName, string $aUserPassword) : array
    {
        $query = <<<STR
                    Select firstname, lastname, username, email, streetaddress, password
                    From customer
                    Where username = '$aUserName'
                    and password = '$aUserPassword'
                STR;
        
        return self::executeQuery($query);
    }

    // method to check if username already exists
    function checkUserName(string $aUserName) : array
    {
        $query = <<<STR
                    Select username
                    From customer
                    Where username = '$aUserName'
                STR;

        return self::executeQuery($query);
    }

        
    private static function executeAddQuery(string $query) 
    {
        // call the dbConnect function

        $conn = self::dbConnect();

        try
        {
            // execute query and assign results to a PDOStatement object

            $stmt = $conn->query($query);

            //call dbDisconnect() method to close the connection

            self::dbDisconnect($conn);

            return $results;
        }
        catch (PDOException $e)
        {
            //if execution fails

            self::dbDisconnect($conn);
            die ('Query failed: ' . $e->getMessage());
        }
    }

        
    function addNewCustomer(array $aMemberData) : void
    {
        // extract array data
        
        extract($aMemberData);
        
        $query = <<<STR
                    Insert Into customer(username, password, firstname, lastname, streetaddress, 
                            email)
                    Values('$username','$userpassword','$firstname','$lastname','$streetaddress','$email')
    STR;
        
        self::executeAddQuery($query);
    }

    function getAccountInfo(string $aUserName) : array
    {
        $query = <<<STR
                    Select customerid, firstname, lastname, username, email, streetaddress, password
                    From customer
                    Where username = '$aUserName'
                STR;
        
        return self::executeQuery($query);
    }

    function updateCustomerAccount(int $customerId, string $username, string $password, string $firstname, string $lastname, string $address, string $email) : void
    {
        $username = str_replace('\'', '\'\'', trim($username));
        $password = str_replace('\'', '\'\'', trim($password));
        $firstname = str_replace('\'', '\'\'',trim($firstname));
        $lastname = str_replace('\'', '\'\'',trim($lastname));
        $address = str_replace('\'', '\'\'',trim($address));
        $email = str_replace('\'', '\'\'',trim($email));


        $query = <<<STR
                    Update customer
                    Set username = '$username', password = '$password', firstname = '$firstname', lastname = '$lastname', streetaddress = '$address', email = '$email'
                    Where customerid = $customerId
                STR;

        self::executeQuery($query);
    }

    //function to deleteCustomerAccount
    function deleteCustomerAccount(int $customerid){
        $query = <<<STR
                Delete
                From customer
                Where customerid = $customerid
            STR;

        self::executeQuery($query);

        //signs user out of current session
        
        // the cookie that holds the session id is destroyed

        if (isset($_COOKIE[session_name()]))
        {
            setcookie(session_name(),"",time()-3600); //destroy the session cookie on the client
        }

        $_SESSION = array(); // unset or remove all data from the $_SESSION array
        session_destroy(); //erase session data from the disk
        session_write_close(); // make sure the changes are committed 
    }

    function getProductsInCart(string $productIDs) : array
    {
        $query = <<<STR
                    Select productid, name, price
                    From product
                    Where productid in ($productIDs)
                STR;

        return self::executeQuery($query);
    }
    
    //inserts new order into the database
    function insertOrder(int $aCustomerID, float $orderTotal)
    {
        $query = <<<STR
                    Insert into orders(customerid, total)
                    Values ($aCustomerID, $orderTotal);
                    Select SCOPE_IDENTITY() As orderID;
                STR;
    
        $orderID = self::executeQuery($query);
        return $orderID;
    }

    //inserts order items into order
    function insertOrderItem(int $aOrderID, int $aProductID) : void
    {
            $query = <<<STR
                        Insert into orderlineitem(orderid, productid)
                        Values ($aOrderID, $aProductID)
                    STR;

        self::executeQuery($query);
    }

    //if an item has been purchased in an order, mark that item as unavailable
    function markItemUnavaiable(int $aProductID) : void {
        $unavailable = "N";
        
        $query = <<<STR
            Update product
            Set available = '$unavailable'
            Where productid = $aProductID
        STR;
        
        self::executeQuery($query);
    }

    //if an item has been purchased in an order, mark that item as unavailable
    function markItemAvailable(int $aProductID) : void {
        $available = "Y";
        
        $query = <<<STR
            Update product
            Set available = '$available'
            Where productid = $aProductID
        STR;
        
        self::executeQuery($query);
    }

    //deletes an order from the database
    function deleteOrder (int $aOrderID) : void {
        //gets the product ids of products on the order
        $query1 = <<<STR
            Select productid
            From orderlineitem
            Where orderid = ($aOrderID)
         STR;
        $productIDs = self::executeQuery($query1);

        //loop through each product on the order using the produce ids
        foreach ($productIDs as $aKey => $aValue){
            foreach ($aValue as $aID){
                //mark item available again
                self::markItemAvailable((int)$aID);

                //delete order line item from order line item table
                $query3 = <<<STR
                    Delete
                    From orderlineitem
                    Where orderid = $aOrderID
                        AND productid = $aID
                STR;
                self::executeQuery($query3); 
            }//end nested foreach
        }//end foreach
        
        //deletes order from order table
        $query4 = <<<STR
            Delete
            From orders
            Where orderid = $aOrderID
        STR;
        self::executeQuery($query4);
    }

}
?>