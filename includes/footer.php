</div>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="" crossorigin=""></script>
<script src="Rating-Plugin/dist/jquery.star-rating-svg.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js
"></script>

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
                $("body").load("show.php?Id=<?php if(isset($_GET['Id'])){
                    echo $_GET['Id'];
                }else{
                    echo "nothing";
                }
                 
                ?>")
                
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

        //live search.

        $("#search-data").keyup(function(){

            var search = $(this).val();
            //alert(search);

            if(search !== ''){
                $(".card").css("display", "none");
                $(".row").css("display", "none");
                $("main").css("display", "none");

                $.ajax({
                    type: "post",
                    url: "search.php",
                    data: {
                        search : search
                    },

                    success: function(data){
                        $("#search_data").html(data);
                    }
                })

                }else{
                    $("#search_data").css('display', 'none');
                    $(".card").css("display", "block");
                    $(".row").css("display", "block");
                    $("main").css("display", "block");
                }


        })

    });
</script>
</body>
</html>