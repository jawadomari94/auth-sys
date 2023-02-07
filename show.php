<?php require "includes/header.php"; ?>
<?php require "Config.php"; ?>
<?php 

if(isset($_GET['Id'])){

    $id = $_GET['Id'];

    $sql = "SELECT * FROM posts WHERE Id='$id'";
    $Post = $conn->query($sql);
    $Post->execute();

    $onepost = $Post->fetch(PDO::FETCH_OBJ);
}

    $sql2 = "SELECT * FROM comments WHERE post_id='$id'";
    $comment = $conn->query($sql2);
    $comment->execute();

    $comments = $comment->fetchAll(PDO::FETCH_OBJ);


    $sql3 = "SELECT * FROM rates WHERE post_id='$id' AND user_id='$_SESSION[user_id]'";
    $ratings = $conn->query($sql3);
    $ratings->execute();

    $rating = $ratings->fetch(PDO::FETCH_OBJ);

?>
<main class="form-signin w-50 m-auto mt-5">
    <div class="card">
        <div class="card-body">
                    <h5 class="card-title"><?php echo $onepost->title;  ?></h5>
                    <p class="card-text"><?php echo $onepost->body;  ?></p>
            <form id="form-data" method="POST">
                    <div class="my-rating"></div>
                    <input id="rating" type="hidden" name="rating">
                    <input id="post_id" type="hidden" name="post_id" value="<?php echo $onepost->Id;  ?>">
                    <input id="user_id" type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];  ?>">
            </form>
                </div>
        </div>
    </div>
</main>

<div class="row form-signin w-50 m-auto">
  <div class="col-sm">
    <form method="post" id="comment_data">
    
        <h1 class="h3 mt-5 fw-normal text-center">Create Post</h1>

        <div class="form-floating">
        <input name="username" type="hidden" value="<?php echo $_SESSION['username']; ?>" class="form-control" id="username">
        </div>

        <div class="form-floating">
        <input name="post_id" type="hidden" value="<?php echo $onepost->Id; ?>" class="form-control" id="post_id">
        </div>

        <div class="form-floating mt-3">
            <textarea  name="comment" class="form-control" id="comment"></textarea>
        <label for="comment">Comment</label>
        </div>

        <button name="submit" class="w-100 btn btn-lg btn-primary mt-3" type="submit" id="submit">Create Post</button>

    </form>
        <div id="msg" class ="nothing"></div>
   </div>
</div>


<main class="form-signin w-50 m-auto mt-5">
    <?php foreach($comments as $singlecomment) : ?>
    <div class="card">
        <div class="card-body">
            
                    <h5 class="card-title"><?php echo $singlecomment->username;  ?></h5>
                    <p class="card-text"><?php echo $singlecomment->comment;  ?></p>
                    <?php if(($_SESSION['username'])==$singlecomment->username): ?>
                    <a href="delete.php?Id=<?php echo $singlecomment->Id; ?>" id="delete" class="w-70 btn btn-lg btn-danger mt-3">Delete</a>
                    <?php endif; ?>
                </div>
        </div>
    </div>
    <?php endforeach; ?>
</main>
<?php require "includes/footer.php"; ?>

<script>
        $(document).ready(function() {
           $(document).on('submit', function(e){
            e.preventDefault();
            //alert('form submitted');

            var formdata = $("#comment_data").serialize()+'&submit=submit';

            $.ajax({
                type: 'post',
                url: 'insert-comments.php',
                data: formdata,

                success: function() {
                   // alert('sucess');
                   $("#comment").val(null);
                   $("#username").val(null);
                   $("#post_id").val(null);

                   $("#msg").html("Added Successfully").toggleClass("alert alert-danger text-white");

                }


            });

            
           });

           function fetch() {
            setInterval(function ()  {
                $("body").load("show.php?Id=<?php echo $_GET['Id']; ?>")
                
            }, 4000);

           }

           $(".my-rating").starRating({
                starSize: 25,

                initialRating: "<?php
                
                if(isset($rating->rating) AND isset($rating->user_id) AND $rating->user_id==$_SESSION['user_id']){
                    echo $rating->rating;
                }else{
                    echo '0';
                }
                
                ?>",
                callback: function(currentRating, $el){
                    // make a server call here
                    $("#rating").val(currentRating);


                    $(".my-rating").click(function(e) {
                        e.preventDefault();

                        var formdata = $("#form-data").serialize()+'&insert=insert';

                        $.ajax({
                            type: "post",
                            url: 'insert-rating.php',
                            data: formdata,

                            success: function() {
                             //   alert(formdata);
                            }
                        })
                    })
                }
        });

    });
</script>