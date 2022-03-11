<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Enter your details to SignUp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/PHP-FORUM/index.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="CexampleInputPassword1" class="form-label">Confrim Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword">
                    </div>                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>           
        </div>
    </div>
</div>

<?php 
    $showalert = false;
    $showerror = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '_conn.php';
        $email=$_POST['email'];
        $username =$_POST['username'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];

        //check if the email alredy exist

        $sql= "SELECT * FROM `users` WHERE email='$email'";

        $result=mysqli_query($conn,$sql);
        $numRow = mysqli_num_rows($result);

        if($numRow>0){
            $showerror ="Email already in use";
        }
        else{
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $store = "INSERT INTO `users` (`email`, `username`, `password`, `timestamp`) VALUES ('$email', '$username', '$hash', current_timestamp())";
                $r= mysqli_query($conn,$store);
                if($r){
                    $showalert = true;
                    //header("Location: /index.php?signupsuccess=true");
                }
            }
            else{
                $showerror= "Passwords do not match";
                
            }
        }
        //header("Location: /PHP-FORUM/index.php?signupsuccess=false&error=$showError");

    }

?>

<!-- alert message to showcase successful signup -->
<?php
        if($showalert)
            {    
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>SignUp Successful!</strong> Your account has been created successfully, You can now Login!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            // alert message for not succesful signup
            if($showerror)
            {    
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showerror.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
    ?>