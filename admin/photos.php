<?php include("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
redirect("login.php");
}?>

<?php 

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $delete_photo = Photo::find_by_id($id);

    $delete_photo->delete();
    unlink('../images/' . $delete_photo->filename);
    $session->message("The photo has been deleted");

    header("location: photos.php");
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
                            Photos
                            <small>Subheading</small>
                        </h1>

                        <div class="bg-danger"><?php echo $message; ?></div>                        
<?php 
$photos = Photo::find_all();


?>


                        <div class="col-md-12">
                            
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Id</th>
                                    <th>File Name</th>
                                    <th>Tittle</th>
                                    <th>size</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                

                        <?php 
                                foreach ($photos as $photo) : ?>

                            <tr>
                            <td><img src='../images/<?php echo $photo->filename ?>' width = '150px' >
                            <div class="pictures">
                                <a href="../photo_front.php?id=<?php echo $photo->id; ?>">View</a>
                                <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                <a class="delete_button" href="photos.php?id=<?php echo $photo->id; ?>">Delete</a>
                            </div>    
            

                            </td>
                            <td><?php echo $photo->id ?></td>
                            <td><?php echo $photo->filename ?></td>
                            <td><?php echo $photo->title ?></td>
                            <td><?php echo $photo->size ?></td>
                            <td><a href="comment_photo.php?id=<?php echo $photo->id; ?>"><?php echo $photo->comments; ?></a></td>


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