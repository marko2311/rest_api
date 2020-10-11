<?php

namespace Api\TableGateways;

use Api\CartRepo\Cart;

class CartGateway
{

    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createCart(){
        $cart = new Cart(array(
            'cartMaxItem'      => 3,
            'itemMaxQuantity'  => 10,
            'useCookie'        => false
        ));
        $_SESSION['cart'] = serialize($cart);
        return "Cart created!";
    }
    public function addItemToCart($item)
    {
        $data = json_decode($item, true);
        $cart = unserialize($_SESSION['cart']);
        $cart->add($data[0]['id'], 1, array("name" => $data[0]['name'], "price" => $data[0]['price']));
        $_SESSION['cart'] = serialize($cart);
        return true;
    }

    public function getItemsOfCart()
    {
        if(!isset($_SESSION['cart'])){
            exit("First create cart!");
        }
        $cart = unserialize($_SESSION['cart']);
        if($cart->isEmpty()){
            exit("Cart is empty!");
        }
        $result = $cart->getItems();
        $result['total_price'] = number_format($cart->getAttributeTotal('price'), 2, '.', ',');
        return $result;
    }

   public function removeItemFromCart($id)
   {
       $cart = unserialize($_SESSION['cart']);
       if($cart->remove($id)){
           $_SESSION['cart'] = serialize($cart);
           return true;
       }
       return false;
   }

}
