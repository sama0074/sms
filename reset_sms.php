<?php
// include database connection
include 'database/config2.php';
 
try {
 
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Brands not found.');
 
    // delete query
    $query = "DELETE FROM messages WHERE id = $id";

    $stmt = $conn->prepare($query);
 
    if($stmt->execute()){
        // redirect to read records page and
        // tell the user record was deleted
        header('Location: message.php');
    }else{
        die('Unable to delete record.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>