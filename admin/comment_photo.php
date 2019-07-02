<?php include("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
redirect("login.php");
}?>



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
                            Comments
                            <small></small>
                        </h1>
                        
<?php 
$comments = Comment::find_the_comments($_GET['id']);


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