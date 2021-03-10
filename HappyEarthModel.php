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

    private static function executeQuery(string $query) : array
    {
        // call the dbConnect function

        $conn = self::dbConnect();

        try
        {
            // execute query and assign results to a PDOStatement object

            $stmt = $conn->query($query);

            if ($stmt->columnCount() > 0)  // if rows with columns are returned
            {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //retreive the rows as an associative array
            }

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
                    Select name, description, gender, brand, size, price, created
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

    

}
?>