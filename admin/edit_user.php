<?php include("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
redirect("login.php");
}?>







<?php

$user_id = $_GET['id'];

if(empty($_GET['id'])){

    redirect('index.php');

}



?>

<?php

if(isset($_POST['update'])){

    $user = User::find_by_id($_GET["id"]);

     $user->username = $_POST['username'];
     $user->first_name = $_POST['first_name'];
     $user->last_name = $_POST['last_name'];
     $file = $_FILES['file_upload'];
     $user->password = $_POST['password'];
     
     
       
     if ($file['size'] == 0){
        $user->update();
        
     } else {
        $user->set_file_image($_FILES['file_upload']);
        $user->save_user();
       
     }
     header("location: users.php");
     $session->message("The user has been updated");


}

if(isset($_POST['delete'])){

    $user = User::find_by_id($_GET["id"]);
    $user->delete();
    if(unlink('../images/' . $user->user_image)){
        echo "delete successfully";
    redirect("users.php");
    $session->message("The user has been updated");
    }
    


}
?>






<?php $user = User::find_by_id($_GET["id"]); ?>



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
                            <small>Subheading</small>
                        </h1>
                        


                        <div class="col-md-8">
                         <form action="" method="post" enctype="multipart/form-data">  
                        <div class="form-group">
                            <label for="caption">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                        </div> 
                        <?php if(($user->user_image) == ""){

                            echo "";
                            } else {
                            echo "<div class='form-group'><a href='#' data-toggle='modal' data-target='#photo-modal' class='thumbnail'> <img src='../images/{$user->user_image}'></a>
                        </div>";
                            }
                                                        
                        ?>


                        <?php require_once("includes/modal.php"); ?>
                        
                        <div class="form-group">
                            <input type="file" name="file_upload" >
                        </div>     
                        
                        <div class="form-group">
                            <label for="caption">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                        </div>  

                        <div class="form-group">
                            <label for="caption">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                        </div>  
                        <div class="form-group">
                            <label for="caption">password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                        </div>  

                        <div>
                        <div id="<?php echo $user->user_image; ?>" class="user_image"></div>
                        <div id="<?php echo $user_id; ?>" class="user_id"></div>

                        <div class="info-box-update ">
                                <input type="submit" name="update" value="Update" class="btn btn-primary ">
                                <input type="submit" name="delete" value="Delete" class="btn btn-danger"  style="margin-left:  30px">
                        </div>
                        
                                
                       
                        </div>

                      <!--    <div class="form-group">
                            <label for="caption">Alternate Text</label>
                            <input type="text" name="alternate_text" class="form-control" value="<?php echo $user->alternate_text; ?>">
                        </div>   

                         <div class="form-group">
                            <label for="caption">Description</label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10" ><?php echo $user->description; ?></textarea>
                        </div>  
                        </div>           -->     

                        

                      

                   
                
                <!-- /.row -->

            </div>

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>