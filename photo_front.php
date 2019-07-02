<?php require_once("includes/header.php"); ?>

<?php require_once("admin/includes/photo.php"); ?>


<?php

if(!isset($_GET['id'])){
    redirect("index.php");
}

if(isset($_POST['submit'])){

$photo = Photo::find_by_id($_GET['id']);
$count = $photo->comments;
$photo->comments = $count + 1;


if($photo->update()){
echo "Update successfully";
} else {
    echo "we have a problem houston";
}



    $photo_id = $photo->id;
    $author = $_POST['author'];
    $body   = $_POST['body'];
    $count = $photo->comments;
    

$Object_Comment = Comment::create_comment($photo_id, $author, $body);

$Object_Comment->create();


}

$comments = Comment::find_the_comments($_GET['id']);




?>

        <?php $photo = Photo::find_by_id($_GET['id']); 

       

        ?>



        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img src="images/<?php echo $photo->filename; ?>" alt="" class="img-responsive">

                <hr>

                <!-- Post Content -->
                <p class="lead">
                    
                    
                </p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <label for="author">Author</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="author">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="body" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->


             <?php foreach ($comments as $comment) : ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <small></small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- Comment -->
          


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
              <?php include("includes/sidebar.php"); ?>
        <!-- /.row -->

       <?php include("includes/footer.php"); ?>
