<?php


class Product
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all products
    public function getAllProducts()
    {
        $this->db->query("SELECT * FROM products");

        // Assign result set
        $results = $this->db->resultSet();
        return $results;
    }

    // Get single product
    public function getProduct($id)
    {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        // Assign result set
        $row = $this->db->single();
        return $row;
    }

}