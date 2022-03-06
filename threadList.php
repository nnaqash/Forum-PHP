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
    $sql ="SELECT * FROM `categories` WHERE category_id=$id";
    $result= mysqli_query($conn,$sql);
    while($row =mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_description'];
    }
    ?>

    <!-- Custom jumbotorn container -->
    <div class="container my-3 bg-light">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Welcome to <?php echo $catname ?> forums</h1>
            <p class="lead"> <?php echo $catdesc ?></p>
            <hr class = "my-4">
            <p>This forum is for sharing knowledge with each other and helping each other solve problems.</p>
             <ul>
                <li>No Spam / Advertising / Self-promote in the forums.</li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not cross post questions.</li>
                <li>Do not post “offensive” posts, links or images.</li>
                <li>Remain respectful of other members at all times.</li>                
            </ul>
            <a class ="btn btn-primary btn-lg"href="#" role="button"> Learn More</a>
        </div>
    </div>

    <div class="container">
        <h1 >Browse Questions</h1>
        <div class="d-flex flex-column">
            <div class="flex-column">
                <img  class="rounded-circle "src="images/676-6764065_default-profile-picture-transparent-hd-png-download.png " alt="user default image" width="40px" height="35px">      
            </div>
            <h5>Unable to install pycharm</h5>
            <div class="flex-column">
            This is some content from a media component. You can replace this with any content and adjust it as needed.
            </div>
            
        </div>
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