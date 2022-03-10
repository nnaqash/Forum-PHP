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
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $noresult = false;
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
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
    <!-- php script to add comments in to the database -->
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        //insert into comment table
        $comment = $_POST['comment']; // value of name attribute from the form

        // sql query, inserting into db
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '0', current_timestamp())";
        //saving the result of sql
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">                
                    <strong>Question Successfully Submitted!</strong> Your comment has been added.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }
    ?>

 


    <!-- Custom jumbotorn container -->
    <div class="container my-3 bg-light">
        <div class="container-fluid py-5">

            <h1 class="display-5 fw-bold"> <?php echo $title ?></h1>
            <p class="lead"> <?php echo $desc ?></p>
            <hr class="my-4">
            <p>This forum is for sharing knowledge with each other and helping each other solve problems.</p>
            <ul>
                <li>No Spam / Advertising / Self-promote in the forums.</li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not cross post questions.</li>
                <li>Do not post “offensive” posts, links or images.</li>
                <li>Remain respectful of other members at all times.</li>
            </ul>
            <hr class="my-4">
            <p class="fw-bold">Posted by:</p>
        </div>
    </div>

    <div class="container">
        <h1>Post a comment</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="Post">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type Your Comment</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" id="comment" name="comment" rows="3"></textarea>
                <small class="form-text text-muted">Give as much detail as possible</small>
            </div>

            <button type="submit" class="btn btn-success mb-3">Post Comment</button>
        </form>
    </div>

    <div></div>

    <!-- displaying the comments -->
    <div class="container">

        <?php
        // getting the thread id to which the comment corresponds to
        $id = $_GET['threadid'];
        // fetching from the db
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        // storing the query results
        $result = mysqli_query($conn, $sql);
        $noresult = true; // if there is no results then

        // getting the results in the form of an assoc array
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $noresult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time= $row['comment_time'];
            //$id = $row['thread_id'];

            echo ' <div class="d-flex flex-row">
            <div class="p-2 bd-highlight"> <img class="rounded-circle " src="images/676-6764065_default-profile-picture-transparent-hd-png-download.png " alt="user default image" width="40px" height="35px"></div>
            <div class="p-2 bd-highlight"><p class="fw-bold text-start"> Anonymus User </p></div>
            <div class="p-2"><small class="text-muted">Posted at: '.$comment_time.'</small></div>

            </div>
            <div class="p-3 mb-2 bg-light text-dark border-success rounded-pill">' . $content . '</div>            
            ';
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

    <div class="container mt-3">
        <h1>Discussion</h1>
        <?php
        // the nema of the cat id that was passed in the url fetching that using get
        /*  $id = $_GET[''];
                $sql ="SELECT * FROM `threads` WHERE thread_cat_id=$id";
                $result= mysqli_query($conn,$sql);
                
                while($row =mysqli_fetch_assoc($result))
                {
                    $title=$row['thread_title'];
                    $desc=$row['thread_desc'];
                    $id=$row['thread_id'];
              
                    echo'<div class="d-flex flex-column">
                            <div class="flex-column">
                                <img  class="rounded-circle "src="images/676-6764065_default-profile-picture-transparent-hd-png-download.png " alt="user default image" width="40px" height="35px">      
                            </div>
                            <h5> <a class ="text-dark text-decoration-none"href ="threadList.php"> '.$title.'</a></h5>
                            <div class="flex-column">
                            '.$desc.'
                            </div>                            
                        </div>';
                } */
        ?>
    </div>


    <?php include 'components/_footer.php' ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</body>

</html>