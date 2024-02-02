<?php
////include connect to database script 
include ('config/db_connect.php');

//// Check POST request id parameter
// if (isset($_POST['delete'])){
//     $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

//     $sql = "DELETE FROM ramen WHERE id = $id_to_delete";
    

//     if (mysqli_query($conn, $sql)) {
//         // Fetch the record before deleting it
//         $sql_fetch = "SELECT * FROM ramen WHERE id = $id_to_delete";
//         $result_fetch = mysqli_query($conn, $sql_fetch);
//         $ramen = mysqli_fetch_assoc($result_fetch);
//         // Delete image from the folder
//         $image_path = 'images/' . $ramen; // Assuming 'images' is the folder name
//         unlink($image_path); // This line deletes the image file from the folder

//         header('Location: index.php');
//     }else{
//         echo 'query error'. mysqli_error($conn);
//     };

// };

if (isset($_POST['delete'])){
    $id_to_delete = $_POST['id_to_delete'];

    // Fetch the record before deleting it
    $sql_fetch = "SELECT * FROM ramen WHERE id = $id_to_delete";
    $result_fetch = mysqli_query($conn, $sql_fetch);
    $ramen = mysqli_fetch_assoc($result_fetch);

    $sql = "DELETE FROM ramen WHERE id = $id_to_delete";
    
    if (mysqli_query($conn, $sql)) {
        // Delete image from the folder
        $image_path = "images/" . $ramen['images']; // Assuming 'images' is the folder name
        unlink($image_path); // This line deletes the image file from the folder

        header('Location: index.php');
    } else {
        echo 'query error'. mysqli_error($conn);
    }
}

//// Check GET request id parameter
if (isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    ////make sql
    ////Select only one individual record (id) in the database that matches the $id. Refer to index.php line 46
    $sql = "SELECT * FROM ramen WHERE id = $id";

    ////get the query result
    $result = mysqli_query($conn, $sql);

    ////fetch one row only result in assoc. array format
    $ramen = mysqli_fetch_assoc($result);

    ////free result from memory
    mysqli_free_result($result);

    ////close connection
    mysqli_close($conn);

}



?>


<?php 
include('templates/header.php');
?>

<div class="container center section photosdetail ">
    <?php if($ramen): ?>
    
        <h5 class="brand-text1"><?php echo htmlspecialchars($ramen['ramen_name'])  ?></h5></br>
        <img src="images/<?php echo ($ramen['images']) ?>"></br>
        <p class="brand-text2">Restaurant: <?php echo htmlspecialchars($ramen['restaurant_name']) ?></p></br>
        <p class="brand-text2">Rating: <?php echo htmlspecialchars($ramen['rating']) ?></p></br>
        <p class="brand-text2">Comment: <?php echo htmlspecialchars($ramen['comment']) ?></p></br>
        
        <p class="brand-text2">Uploaded on: <?php echo htmlspecialchars($ramen['created_at'])  ?></p></br>
        
        <!-- DELETE FORM -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $ramen["id"]?>">
            <input type="submit" name="delete" value="Delete" class="btn brand-color1 z-depth-0">
        </form>


    <?php else: ?>
        <h5> No record!</h5>

    <?php endif; ?>
</div>
<?php
include ('templates/footer.php');
?>

