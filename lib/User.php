<?php


class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Login user
    public function loginUser($email, $password)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email AND password = :password");
        $this->db->bind(':email', $email);
        $this->db->bind(':password', md5($password));
        // Assign result set
        $row = $this->db->single();
        return $row;
    }

    // deduct order from balance
    public function chargeOrder($shipping_method)
    {
        $this->db->query("SELECT * FROM cart WHERE user_id = :user_id");
        $this->db->bind(':user_id', $_SESSION['user_id']);
        // Assign result set
        $results = $this->db->resultSet();

        $sum = 0;
        foreach ($results as $item) {
            $product = getProduct($item->product_id);
            $sum += $product->price * $item->qty;
        }

        $user = $this->getUser();

        $userBalance = $user->balance;

        if ($shipping_method == 'UPS') {
            $deduction = $sum + 5;
            $userNewBalance = $userBalance - $deduction;
        }
        else {
            $userNewBalance = $userBalance - $sum;
        }

        if ($this->updateUserBalance($userNewBalance)){
            return true;
        } else {
            return false;
        }
    }

    public function getUser()
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $_SESSION['user_id']);
        // Assign result set
        $row = $this->db->single();
        return $row;
    }

    public function updateUserBalance($amount)
    {
        $user_id = $_SESSION['user_id'];

        // update user balance
        $this->db->query("UPDATE users SET balance = :amount WHERE id = :user_id");

        // bnd data
        $this->db->bind(':amount', $amount);
        $this->db->bind(':user_id', $user_id);

        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

}