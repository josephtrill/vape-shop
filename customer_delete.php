<?php



if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {




?>

<?php

if(isset($_GET['customer_delete'])){

$delete_id = $_GET['customer_delete'];



try {
    // Delete from pending_orders
    $delete_pending_orders = "DELETE FROM pending_orders WHERE customer_id = ?";
    $stmt_pending_orders = $mysqli->prepare($delete_pending_orders);
    $stmt_pending_orders->bind_param('i', $delete_id);
    $stmt_pending_orders->execute();
    $stmt_pending_orders->close();

    // Delete from customers
    $delete_customers = "DELETE FROM customers WHERE customer_id = ?";
    $stmt_customers = $mysqli->prepare($delete_customers);
    $stmt_customers->bind_param('i', $delete_id);
    $stmt_customers->execute();
    $stmt_customers->close();

    // Commit transaction
    $mysqli->commit();

    echo "Customer and their pending orders deleted successfully.";
} catch (mysqli_sql_exception $exception) {
    // Rollback transaction if any error occurs
    $mysqli->rollback();
    
    // Display error message
    echo "Failed to delete customer and their pending orders: " . $exception->getMessage();
}

// Close connection
$mysqli->close();


}






?>




<?php } ?>