<?php
class Review
{
    // database connection and table name
    private $conn;
    private $table_name = "customer";

    // object properties
    public $review_reviewerName;
    public $review_image;
    public $review_comment;
    public $review_productId;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //insert review data into databse 
    function addReview()
    {
        $this->review_reviewerName = $_POST["name"];
        $this->review_image = $_FILES['image']['name'];
        //$imgContent = addslashes($this->review_image);


        $this->review_comment = $_POST["comment"];
        $this->review_productId = $_POST["productId"];

        $query = "INSERT INTO product_review (review_reviewer_name,review_image,review_comment,review_product_id)
        VALUES(:name, :image, :comment, :productId)";
        echo $query;


        // prepare query
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindParam(":name", $this->review_reviewerName);
        $stmt->bindParam(":image",$this->review_image);
        $stmt->bindParam(":comment", $this->review_comment);
        $stmt->bindParam(":productId", $this->review_productId);
        
        // execute query
        if ($stmt->execute())
        {
            echo ("Query executed");
            return true;
        }
        return false;
    }
}
?>