<?php


class Dashboard
{

    public function __construct()
    {
        $this->db = new Database();
    }

    public function fetchUserOrders()
    {
        $this->db->query("SELECT * FROM orders WHERE user_id = :user_id");
        $this->db->bind(':user_id', $_SESSION['user_id']);
        // Assign result set
        $results = $this->db->resultSet();
        return $results;
    }

    public function reviewProduct($order_id, $review)
    {
        $user_id = $_SESSION['user_id'];

        $this->db->query("SELECT * FROM orders WHERE id = :order_id AND user_id = :user_id");
        $this->db->bind(':order_id', $order_id);
        $this->db->bind(':user_id', $user_id);
        // Assign result set
        $order = $this->db->single();

        // insert query
        $this->db->query("INSERT INTO rating (user_id, product_id, rating)
                    VALUES (:user_id, :product_id, :rating)");

        // bnd data
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $order->product_id);
        $this->db->bind(':rating', $review);

        // Execute
        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }

}