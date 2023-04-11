<?php
require_once('config/db_connect.php');
include('config/config.php');
include('includes/header.php');
?>

<div class="container">
    <?php
    // Fetch all categories.
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $sql_items = "SELECT * FROM item WHERE category_id=$id";
        $result_items = mysqli_query($conn, $sql_items);

        if(mysqli_num_rows($result_items) > 0){
            echo '
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Item Id</th>
                    <th>Item Title</th>
                    <th>Serial Number</th>
                    <th>Date of Added</th>
                    <th>Quantity</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>';
    while($row = $result_items->fetch_assoc()) {
        echo '
            <tr>
                <td>' . $row["id"]. '</td>
                <td>' . $row["title"]. '</td>
                <td>' . $row["serial_number"]. '</td>
                <td>' . $row["date_added"]. '</td>
                <td>' . $row["quantity"]. '</td>
                <td>' . $row["type"]. '</td>
            </tr>';
    }
    echo '
            </tbody>
        </table>';
} else {
    echo "No items in this Category";
}
    
   

   

    mysqli_free_result($result_items);
    mysqli_close($conn);
}
    ?>
    <?php include('includes/footer.php'); ?>

</div>
