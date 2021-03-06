<?php 
  include_once '../includes/dbh.inc.php';  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/trainer/trainerList.css" />
    <link rel="stylesheet" href="/css/trainer/editVideo.css" />
    <link rel="stylesheet" href="/css/user/videoList.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/searchmyVideo.js"></script>
    <title>My Video</title>
</head>

<body>
<script>
        $(document).ready(function(  ) {
            $.ajax({
            type: "POST",
            url: "../includes/searchmyVideo.inc.php",
            data: {
                search: "Everything"
            },
            success: function(html) {
                $("#display").html(html).show();
            }
        });
    })
    
    </script>

    <?php 
    require('../../components/basic/header.php');
    include_once '../includes/member_session.php';
  ?>

    <?php
        if(isset($_POST['myVideo'])) {
            header("location: ./myVideo.php");
        }
        if(isset($_POST['myProfile'])) {
            header("location: ./editMember.php");
        }
        if(isset($_POST['videoList'])) {
            header("location: ./videoList.php");
        }
        if(isset($_POST['logout'])) {
            header("location: ../includes/logout.inc.php");
        }
  ?>

    <div class="container">
        <div class="left profile">
            <form class="profileForm" method="post">
                <input type="submit" class="profileButton " name="videoList" value="Video List" />
                <input type="submit" class="profileButton active" name="myVideo" value="My Video" />
                <input type="submit" class="profileButton" name="myProfile" value="My Profile" />
                <input type="submit" + class="profileButton" name="logout" id="bottom-curve" value="Logout" />
            </form>
            <hr>
            <?php 
                $memberid = $_SESSION['memberid'];
                $sql = "Select * from Member WHERE Member_id = $memberid"; 
                $result = mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);
                
                if ($resultCheck > 0) {
                    $row = mysqli_fetch_assoc($result);
                }
            ?>
            <div class="profileDetail">
                <?php echo "<p>". $row['Member_Name'] ."</p>" ?>
                <?php echo "<p>". $row['Member_Email']." </p>"?>
            </div>

            <div class="profileImage">
                <?php echo"<img class='roundImage' src=' ". $row['location'] ."' alt='Avatar' >" ?>
            </div>

        </div>

        <div class="right">
            <div>
                <div>
                    <form class="searchArea">
                        <label>Search</label>
                        <input type="text" id="search" placeholder="  Search Video" name="searchVideo">
                    </form>
                </div>

                <div class="trainerList">
                    <div id="display"></div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        require('../../components/basic/footer.php')
    ?>
</body>

</html>
