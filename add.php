<?php
////include connect to database script 
include ('config/db_connect.php');


$ramen_name = $restaurant_name = $rating = $comment = $image =''; //// all variables = blank
$errors = array('ramen_name' => '','restaurant_name' => '','rating' => '','comment' => '','no_image' =>''); //// create an associative array called $errors for storing each error message string. We begin with an empty string for each asso. index. If error is detected, => '' blank will be returned with a string value with the corresponding error message 

if (isset($_POST['submit'])):
    // echo htmlspecialchars($_POST['email']);
    ////checks if the form has been submitted by checking if the 'submit' button has been clicked. If the 'submit' button has been clicked, the code inside the block will be executed.
    


    ////check if empty field submitted, else save $_POST['']submitted as $variable
    if (empty($_POST['ramen_name'])){
        $errors['ramen_name']= "Please enter ramen name<br/>"; //// store entered 'ramen_name' into assoc. array index 
    // } else {
    //     $ramen_name = $_POST['ramen_name'];//// var - store entered 'ramen_name'into $ramen_name
    //     if(!preg_match('/^[a-zA-Z\s]+$/', $ramen_name)){
    //         $errors['ramen_name']= "Please re-enter with valid name characters";
    //     }
    // }
    }else{
            $ramen_name = $_POST['ramen_name'];//// var - store entered 'ramen_name'into $ramen_name
    }
    ////Alternative method from below 2. preg_match check is placed outside the block
    if (!preg_match('/^[a-zA-Z\s]+$/', $ramen_name)){
        $errors['ramen_name']= "Please re-enter with valid name characters";
    }
    

    
    if (empty($_POST['restaurant_name'])){
        $errors['restaurant_name']= "Please enter restaurant name";
    } else {
        $restaurant_name = $_POST['restaurant_name'];////var
    }

    if (empty($_POST['rating'])){
        $errors['rating']= "Please rate from 1 to 10 stars";
    } else {
        $rating = $_POST['rating'];////var
    }

    if (empty($_POST['comment'])){
        $errors['comment']= "Please enter your comment";
    } else {
        $comment = $_POST['comment'];////var
    }

    // if (empty($_POST['email'])){
    //     $errors['email']= "Please enter your email address";
    // } else {
    //     $email = $_POST['email'];////var
       
    //     if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ //// if !/not valid email address
    //         $errors['email']= "Please re-enter a valid email address<br/>";
    //     }
    // }
    // Get reference to uploaded image

    
    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

// Image not defined, let's prompt error message
if (!isset($_FILES['image'])) {
    $errors['no_image'] = "Upload an image<br/>";
    
} else { 
    // Move the temp image file to the images/ directory
    move_uploaded_file($tmp_name, 'images/' . $image_name);
    
}



    

    
    ////check if there was an error, then echo error message
    if (array_filter($errors)){
    //// if there is an error, do nothng and display the error message html below
    }else{

            //// mysqli_real_escape_string function used to protect from harmful injections to the database
            $ramen_name = mysqli_real_escape_string($conn, $_POST['ramen_name']);
            $restaurant_name = mysqli_real_escape_string($conn, $_POST['restaurant_name']);
            $rating = mysqli_real_escape_string($conn, $_POST['rating']);
            $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        

            ////create sql
            $sql = "INSERT INTO ramen(ramen_name,restaurant_name,rating,comment,images)VALUES('$ramen_name','$restaurant_name','$rating','$comment','$image_name')";

            ////save to db and check
            // if(mysqli_query($conn, $sql)){
            //     header("Location:index.php"); // redirect to another page
            // } else {
            //     echo 'query error: '. mysqli_error($conn);
            
                
            // }
            
            if(mysqli_query($conn, $sql)){
                header("Location:index.php"); // redirect to another page
            } else {
                http_response_code(500); // Set HTTP response code to 500
                echo 'query error: '. mysqli_error($conn);
            }
        }   
 

endif;
?>



   

    <?php include ('templates/header.php'); ?>

    <section class="container grey-text">
        <h3 class="center brand-text1">Upload</h3>
        <form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
            <label>Ramen Name: </label>
            <input type="text" name="ramen_name" value="<?php echo htmlspecialchars($ramen_name)?>"> 
            <div class="red-text"><?php echo $errors['ramen_name']; ?></div> 
        </br> 
            <!-- display error message from $errors assoc. array -->
            <label>Restaurant name: </label>
            <input type="text" name="restaurant_name" value="<?php echo htmlspecialchars($restaurant_name)?>">
            <div class="red-text"><?php echo $errors['restaurant_name']; ?></div>
        </br>
            <label for="rating">Ramen rating (1-10): </label>
<div>
    <?php
    for ($i = 1; $i <= 10; $i++) {
        echo '<input type="radio" id="rating' . $i . '" name="rating" value="' . $i . '"';

        // Check if the rating value matches the submitted value or if it's the default value (when the form is loaded initially)
        if (($rating == $i) || ($rating === null && $i === 5)) {
            echo ' checked';
        }

        echo '>';
        echo '<label for="rating' . $i . '">' . $i . ' &nbsp;&nbsp;</label>'; // Display the numerical value
    }
    ?>
</div>
        <div class="red-text"><?php echo $errors['rating']; ?></div>
        </br>
        
            <label>Comment: </label>
            <textarea name="comment" style="height: 200px"><?php echo htmlspecialchars($comment)?></textarea>
            <div class="red-text"><?php echo $errors['comment']; ?></div>
        </br>    
            
            <input type="file" name="image" accept="image/*" />
            <div class="red-text"><?php echo $errors['no_image']; ?></div>
            <div class="center section">
                <input type="submit" name="submit" value="submit" class="btn brand-color1 z-depth-0 ">
            </div>


        </form>
    </section>
    
    

    <?php include ('templates/footer.php'); ?>
    
