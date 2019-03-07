<?php
include_once '../config/database.php';
include_once '../object/review.php';

// initialize database
$database = new Database();
$db = $database ->getConnection();
//initialize product object
$review = new Review($db);
// query products
$stmt = $review-> getReviewListbyId();
$num = $stmt ->rowCount();
// check if more than 0 record found
if($num>0){
   // product array
   $review_arr = array();
   $review_arr["records"] = array();
   
   // retrieve data from database
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);
    $reviewData=array(
        "review_id" => $review_id,
        "reviewer_name" => $review_reviewer_name,
        "review_image" => $review_image,
        "review_comment" => $review_comment,
        "review_productId" => $review_productId
    );

    array_push($review_arr["records"], $reviewData);
}

// set response code - 200 OK
http_response_code(200);

// show products data in json format
echo json_encode($review_arr);
}
else{ 
    // set response code - 404 Not found
    http_response_code(404); 
    // tell the user no products found
    echo json_encode(
        array("message" => "No record found.")
    );
}