
<?php
    $login = false;
    $showerror = false;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include '_conn.php';
        $email=$_POST["email"];
        $pass=$_POST["password"];

        $sql="SELECT * FROM `users` WHERE email='$email'";

        $result=mysqli_query($conn,$sql);

        $num=mysqli_num_rows($result);

        if($num==1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass, $row['password'])){
                //echo"loggedin";
                $login=true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['email']=$email;            
   
                header("Location:/PHP-FORUM/index.php");
                
               
            } else{
                $showerror="invalid username or password";
            }

        }header("Location:/PHP-FORUM/index.php");
    }
    
?>

<?php
    // if ($login) {
    // echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //     <strong>Login Successful!</strong> You are logged in successfully!
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>';
    // }
    // // alert message for not succesful signup
    // if ($showerror) {
    // echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //     <strong>Error!</strong> ' . $showerror . '
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>';
    // }
?>