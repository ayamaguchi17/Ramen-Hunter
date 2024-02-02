<?php

    include ('config/db_connect.php');


////write query for all ramen (Construct a query)
    $sql = 'SELECT ramen_name,restaurant_name,images, id FROM ramen ORDER BY created_at';
    
////make query & get result (make a query)
    $result = mysqli_query($conn, $sql);

////fetch the all resulting rows as an array (Fetch the results from the query)
    $ramen = mysqli_fetch_all($result, MYSQLI_ASSOC);
//// The above 2 lines in one step is also possible
//$ramen = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

////free result from memory
    mysqli_free_result($result);

////close connection
    mysqli_close($conn);
    

?>




    <?php include ('templates/header.php'); ?>

   
        <h3 class="center brand-text1">Ramen Collection</h3>

        <div class="container brown-text2">
            <div class="row">

                <?php foreach($ramen as $ramen_each)  :?>

                    <div class="col s12 m6 l4">
                        <div class="card z-depth-0">
                            <div class="card-content brand-text1 center"> 
                            
                                <h6 class="flow-text"><?php echo htmlspecialchars($ramen_each['ramen_name']); ?></h6>
                                <div class="brand-text2"><?php echo htmlspecialchars($ramen_each['restaurant_name']); ?></div>
                                
                                <div class="photos"><a href="details.php?id=<?php echo $ramen_each['id'] ?>"><img src="images/<?php echo ($ramen_each['images']) ?>" ></a></div>
                                
                                <div><a class="brand-text2 right" href="details.php?id=<?php echo $ramen_each['id'] ?>">more info</a></div>
                            </div>
                            <!-- <div class="card-action right-align">
                                <a class="brand-text" href="details.php?id=<?php //echo $ramen_each['id'] ?>">more info</a>
                            </div> -->
                        </div>
                    </div>
                    
 
                <?php endforeach; ?>
            </div>    
        </div>
        
    
        
    <?php include ('templates/footer.php'); ?>
 
 