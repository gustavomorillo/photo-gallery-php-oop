<?php include("includes/header.php"); ?>

<?php
if(!$session->is_signed_in()){
redirect("login.php");
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

            <?php include("includes/admin_content.php"); ?>

            
             <?php 
             // $create_user = new User();  

             //    $create_user->username = "tavitox1";
             //    $create_user->password = "123";
             //    $create_user->first_name = "Gusxtavo";
             //    $create_user->last_name = "Morillo";
            

             //    if($create_user->create()){
             //        echo "User created successfully";    
                //                    }



                // $user = User::find_user_by_id(1);
                // print_r($user);
                // $user->username = "Williams";

                // $user->update();
                


                // $user = USER::find_user_by_id(6);
                // $user->password = "hola baby";
                // $user->save();

             // $user = new User();

             // $user->username= "GUSTAV";
             // $user->create();

             // $user = User::find_user_by_id(9);
             // $user->first_name = "Gustavo";
             // $user->update();

             // $user = new User();

             // $user->username = "Gustavin";
             // $user->create();

             // $users = User::find_all();

             // foreach ($users as $user) {
             //     echo $user->username;
             // }

             // $user = new User();
             // $user->username = "Dani boy";
             // $user->create();


             $photo = new Photo();
             $photo->description = "Yeah baby";
             $photo->save();




             ?>
            <?php //echo $session->user_id; ?>


            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>