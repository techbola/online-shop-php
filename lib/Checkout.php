<?php


class Checkout
{

    public function __construct()
    {
        $this->db = new Database();
    }

    // Create checkout
    public function createOrder($data, $cart)
    {
        foreach ($cart as $item) {
            // insert query
            $this->db->query("INSERT INTO orders (user_id, product_id, qty, 
                    shipping_method)
                    VALUES (:user_id, :product_id, :qty, 
                    :shipping_method)");

            // bnd data
            $this->db->bind(':user_id',$item->user_id);
            $this->db->bind(':product_id', $item->product_id);
            $this->db->bind(':qty', $item->qty);
            $this->db->bind(':shipping_method', $data['shipping_method']);

            $this->db->execute();
        }
        return true;
    }

}