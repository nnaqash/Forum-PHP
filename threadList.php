<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>LetsDiscuss!</title>
</head>

<body>
    <?php include 'components/_header.php' ?>
    <?php include 'components/_conn.php' ?>

    <?php
    // the nema of the cat id that was passed in the url fetching that using get
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php
        $showAlert = false;
        $method =$_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            $th_title= $_POST['title']; // value of name attribute from the form
            $th_desc = $_POST['desc']; // value of name attribute from the form
            // sql query, inserting into db
            $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '0', current_timestamp())";
            //saving the result of sql
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
            if($showAlert){
                echo'<div class="alert alert-success alert-dismissible fade show" role="alert">                
                <strong>Question Successfully Submitted!</strong> Your Question has been added, please wait while someone answers your question
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    ?>

    <!-- Custom jumbotorn container -->
    <div class="container my-3 bg-light">
        <div class="container-fluid py-5">

            <h1 class="display-5 fw-bold">Welcome to <?php echo $catname ?> forums</h1>
            <p class="lead"> <?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>This forum is for sharing knowledge with each other and helping each other solve problems.</p>
            <ul>
                <li>No Spam / Advertising / Self-promote in the forums.</li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not cross post questions.</li>
                <li>Do not post “offensive” posts, links or images.</li>
                <li>Remain respectful of other members at all times.</li>
            </ul>
            <a class="btn btn-success btn-lg" href="#" role="button"> Learn More</a>
        </div>
    </div>

    <!-- form to start discussion -->
    <!-- submitting the form on its self -->
    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo'<div class="container">
            <h1>Ask a Question</h1>
            <form action="'. $_SERVER["REQUEST_URI"] .'>" method="Post">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="Text" class="form-control" id="title" name="title" placeholder="Name of Problem">
                    <small class="form-text text-muted">Keep the title consise</small>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descriptipn of the problem</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" id="desc" name="desc" rows="3"></textarea>
                    <small class="form-text text-muted">Give as much detail as possible</small>
                </div>

                <button type="submit" class="btn btn-success mb-3">Start Discussion +</button>
            </form>
        </div>';
        } else{
            echo'<div class="container">
            <p class="fs-3 fw-bold">Login to start a discussion</p>
            </div>';
        }    
        
    ?>

    
   
    <div class="container">
        
        <?php
        // the nema of the cat id that was passed in the url fetching that using get
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noresult = true;

        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $id = $row['thread_id'];

            echo '<div class="d-flex flex-column">
                            <div class="flex-column">
                                <img  class="rounded-circle "src="images/676-6764065_default-profile-picture-transparent-hd-png-download.png " alt="user default image" width="40px" height="35px">      
                            </div>
                            <h5> <a class ="text-dark text-decoration-none"href ="thread.php?threadid=' . $id . '"> ' . $title . '</a></h5>
                            <div class="flex-column">
                            ' . $desc . '
                            </div>                            
                        </div>';
        }
        if ($noresult) {
            echo '<div class="container my-3 bg-light">
                            <div class="container-fluid py-5">                                
                                <h3 class="fw-bold">No Discussions Found</h3>
                                <p class="lead"> Be the first one to start the discussion</p>                                                                
                            </div>
                </div>';
        }
        ?>

    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</body>
<?php include 'components/_footer.php' ?>

</html>