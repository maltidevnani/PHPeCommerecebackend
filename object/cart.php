<?php
class Cart
{
    // database connection and table name
    private $conn;
    private $table_name = "sales";

    // object properties
    public $salesId;
    public $fk_userid;
    public $fk_productid;
    public $quantity;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    //insert user data into databse 
    function addProductToCart()
    {
        $this->fk_userid = $_POST["userId"];
        $this->fk_productid = $_POST["productId"];
        $this->quantity = $_POST["quantity"];

        $query = "INSERT INTO sales (fk_userid, fk_productid, quantity) VALUES(:userId, :productId, :quantity)";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindParam(":userId", $this->fk_userid);
        $stmt->bindParam(":productId", $this->fk_productid);
        $stmt->bindParam(":quantity", $this->quantity);
        // execute query
        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }

    
   
	
	function getCartProducts()
    {
        $this->fk_userid = $_POST["userId"];
	
        $query = "select sales.fk_userid, sales.fk_productid, sales.quantity, products.product_title, products.product_price
				from sales left join products 
				on sales.fk_productid = products.product_id 
				WHERE sales.fk_userid = '$this->fk_userid'";

        // prepare query statement\
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();	
		
		$products_arr["products"] = array();
	
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$product_item=array(
				"product_id" => (int)$fk_productid,
				"product_title" => $product_title,
				"userid" => (int)$fk_userid,
				"quantity" => (int)$quantity,
				"product_price" => (int)$product_price
			);
	
			array_push($products_arr["products"], $product_item);
		}
		
        return $products_arr;
    }
	
	
}
?>