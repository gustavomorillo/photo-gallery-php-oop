 <?php include("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
redirect("login.php");
}?>









<?php


if(isset($_POST['submit'])){

     $user = new User();

     $user->username= $_POST['username'];
     $user->password = $_POST['password'];
     $user->first_name = $_POST['first_name'];
     $user->last_name = $_POST['last_name'];
     $file = $_FILES['file_upload'];
     
     
    if ($file['size'] == 0){
        print_r($file);
        $user->create();
        
        
     } else {
        $user->set_file($_FILES['file_upload']);
        $user->save();
     }
     redirect("users.php");



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
                            Add User
                            <small>Subheading</small>
                        </h1>
                        


                        <div class="col-md-6">
                         <form action="" method="post" enctype="multipart/form-data">  
                        <div class="form-group">
                            <label for="caption">Username</label>
                            <input type="text" name="username" class="form-control" value="">
                        </div> 
                        
                        <div class="form-group">
                            <label for="caption">password</label>
                            <input type="text" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="file" name="file_upload" >
                        </div>     
                        
                        

                        <div class="form-group">
                            <label for="caption">First Name</label>
                            <input type="text" name="first_name" class="form-control" >
                        </div>  


                         <div class="form-group">
                            <label for="caption">Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                        
                        <input type="submit" name="submit" value="Create User" class="btn btn-primary  "><br><br>


                        
                        </form> 
                        </div>               

                        

                       
                            
                    
                    

                   
                
                <!-- /.row -->

            </div>

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>