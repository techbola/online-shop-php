<?php

class ShoppingCart
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Create product
    public function addToCart($data)
    {
        // insert query
        $this->db->query("INSERT INTO cart (product_id, user_id, qty)
                    VALUES (:product_id, :user_id, :qty)");

        // bnd data
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':qty', $data['qty']);

        // Execute
        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function fetchUserCart()
    {
        $this->db->query("SELECT * FROM cart WHERE user_id = :user_id");
        $this->db->bind(':user_id', $_SESSION['user_id']);
        // Assign result set
        $results = $this->db->resultSet();
        return $results;
    }

    // delete job
    public function delete($id)
    {
        // insert query
        $this->db->query("DELETE FROM cart WHERE id = $id");

        // Execute
        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function clearCart()
    {
        $user_id = $_SESSION['user_id'];
        // insert query
        $this->db->query("DELETE FROM cart WHERE user_id = :user_id");

        $this->db->bind(':user_id', $user_id);

        // Execute
        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function updateCart($cart_id, $qty)
    {
        // update user balance
        $this->db->query("UPDATE cart SET qty = :qty WHERE id = :cart_id");

        // bnd data
        $this->db->bind(':qty', $qty);
        $this->db->bind(':cart_id', $cart_id);

        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

}