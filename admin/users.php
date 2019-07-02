<?php include("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
redirect("login.php");
}?>

<?php 

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $delete_user = User::find_by_id($id);

    $delete_user->delete();
    unlink('../images/' . $delete_user->user_image);

    header("location: users.php");
    $session->message("The user has been deleted");
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
                            users
                            
                        </h1>
                        <div class="bg-success"><?php echo $message ?></div>
                        
                        <a href="add_user.php" class="btn btn-primary">Add User</a><br><br>
<?php 
$users = User::find_all();


?>


                        <div class="col-md-12">
                            
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Photo</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                

                        <?php 
                                foreach ($users as $user) : ?>

                            <tr>
                            <td><?php echo $user->id ?></td>
                            <td><img src='<?php echo $user->image_path_and_placeholder(); ?>' width = '150px' ></td>
                            <td><?php echo $user->username; ?>
                            <div class="action_links">
                                <a href="">View</a>
                                <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                <a href="users.php?id=<?php echo $user->id; ?>">Delete</a>
                            </div> </td>
                            <td><?php echo $user->first_name; ?></td>
                            <td><?php echo $user->last_name; ?></td></tr>
                                   
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