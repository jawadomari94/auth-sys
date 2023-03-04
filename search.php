<?php
 require "Config.php";
echo "searching for data.....";

if(isset($_POST['search'])) {
    $search = $_POST['search'];

    $sql = "SELECT * FROM posts WHERE title LIKE '{$search}%'";

    $select = $conn->query($sql);

    $select->execute();

    $rows = $select->fetchAll(PDO::FETCH_OBJ);

    // foreach($rows as $row){
    //     echo "<h2>$row->title</h2>";
    //     echo "<h2>$row->body</h2>";

    // }

    
       
    


}
?>

    <?php foreach($rows as $row) : ?>
                <div class="card">
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row->title; ?></h5>
                        <p class="card-text"><?php echo substr($row->body, 0, 90).'...........'; ?></p>
                        <a href="show.php?Id=<?php echo $row->Id; ?>" class="btn btn-primary">More</a>
                    </div>
                </div>
                <br>
   <?php endforeach; ?>