<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // object properties
    public $product_id;
    public $product_title;
    public $product_description;
    public $product_rating;
    public $product_price;
    public $product_quantity;
    public $product_image;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read(){ 
    // select all query
    $query = "SELECT * 
            FROM products"; 
    // prepare query statement
    $stmt = $this->conn->prepare($query); 
    // execute query
    $stmt->execute(); 
    return $stmt;
    }
}
