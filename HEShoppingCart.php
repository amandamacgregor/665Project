<?php declare(strict_types=1);
/* 
    Purpose: Class for shopping cart
    Author: AM & TS
    Date: March 2021
 */

class HEShoppingCart
{
   //Properties

    private array $cartItems;

   // Constructor. Cart is made up of one element/object - an array. Fairly simple.

    public function __construct()
    {
        $this->cartItems = array();
    }

   // add an item to the $cartItems array

    public function addCartItem(int $aProductID) : void
    {
        // if the item is not already in the array, add the item to the array. key value; key is ID, value is quantity

        if (!array_key_exists($aProductID, $this->cartItems))
        {
            $this->cartItems[$aProductID] = 1;
        }

        // else, increase the quantity for the item by one
        else
        {
            $this->cartItems[$aProductID] ++;
        }
    }

    // return the $cartItems array

    public function getCartItems() : array
    {
        return $this->cartItems;
    }

    // return the quantity for a specific item

    public function getQtyByProductID(int $aProductID) : int
    {
        return $this->cartItems[$aProductID];
    }

    // update the quantity for a specific item

    public function updateCartItem(int $aProductID, int $aOrderQty) : void
    {
        if ($aOrderQty === 0)
        {
            $this->deleteCartItem($aProductID);
        }
        else
        {
            $this->cartItems[$aProductID] = $aOrderQty;
        }
    }

    // delete a specific item from the array

    public function deleteCartItem(int $aProductID) : void
    {
        unset($this->cartItems[$aProductID]);
    }
}
?>
