<?php include("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
redirect("login.php");
}?>

<?php 

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $delete_comment = Comment::find_by_id($id);
    
     // Find Comment in Photo table
    $photo_id = $delete_comment->photo_id;
    $query = Photo::find_by_id($photo_id);
    $count = $query->comments;
    $query->comments = $count - 1; 
    $query->update();
////
    $delete_comment->delete();
    $session->message("The photo has been deleted");

    header("location: comments.php");
}



?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
           <?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>


            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            comments
                            
                        </h1>
                        <div class="bg-danger"><?php echo $message; ?></div>   
<?php 
$comments = Comment::find_all();


?>


                        <div class="col-md-12">
                            
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Photo Id</th>
                                    <th>Author</th>
                                    <th>Body</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                

                        <?php 
                                foreach ($comments as $comment) : ?>

                            <tr>
                            <td><?php echo $comment->id; ?></td>
                            <td><?php echo $comment->photo_id; ?>
                            <div class="action_links">
                                <a href="">View</a>
                                <a href="edit_comment.php?id=<?php echo $comment->id; ?>">Edit</a>
                                <a href="comments.php?id=<?php echo $comment->id; ?>">Delete</a>
                            </div></td>
                            <td><?php echo $comment->author; ?></td>
                            <td><?php echo $comment->body; ?></td>
                            </tr>
                                   
                            <?php endforeach; ?>                           
    
                        

                                
                                    
                                   
                                
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>