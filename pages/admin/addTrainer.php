<?php 
  include_once '../includes/dbh.inc.php';  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/Trainer/editVideo.css" />
    
    <title>Add Trainer</title>
  </head>
  <body>
  
  <?php 
    require('../../components/basic/header.php')
  ?>

    <div class="container">
      <div class="left profile">
        <form class="profileForm">
          <input
            type="submit"
            class="profileButton"
            name="upload"
            value="Your Upload"
          />
          <input
            type="submit"+
            class="profileButton"
            name="logout"
            value="Logout"
          />
        </form>
        <?php 
          $admin_id = $_SESSION['admin_userid'];
          $sql = "Select * from gymAdmin WHERE Admin_id = $admin_id"; 
          $result = mysqli_query($conn,$sql);
          $resultCheck = mysqli_num_rows($result);
        
          if ($resultCheck > 0) {
            $row = mysqli_fetch_assoc($result);
          }
        ?>
        <div class="profileDetail">
            <?php echo "<p><span>Name:</span> ". $row['Admin_Name'] ."</p>" ?>
            <?php echo "<p><span>Email:</span> ". $row['Admin_Email']." </p>"?>
            <!-- <p><span>Phone Number:</span> 9967025541</p>
            <p><span>Video Count</span> 45</p> -->
        </div>
        
        <div class="profileImage">
            <img class="roundImage" src="../../img/img_avatar.png" alt="Avatar" >
        </div>
        
      </div>

      <div class="right">
        <div class="top">
          <p>Add Trainer Details</p>
          <input
            style="margin-right: 20px"
            type="submit"
            value="Cancel"
            name="cancel"
          />
          <input type="submit" value="Save" name="save" />
        </div>
        <hr style="margin: 0 20px 0 20px" />
        <div class="bottom">
          <form class="editForm" action="../includes/admin/addTrainer.inc.php" method="post">
            <div class="row">
              <div class="col group">
                <label for="Workout Video">Trainer Image</label>
                <button class="profileButton fill">Upload Image</button>
              </div>
              <div class="col group">
                <label for="title name">Name</label>
                <input type="text" name="uname" placeholder="Name" />
              </div>
            </div>

            <div class="row">
              <div class="group col">
                <label for="title name">Phone Number</label>
                <input type="number" name="number" placeholder="Phone Number" />
              </div>
              <div class="group col">
                <label for="subtitle name">Admin Id</label>
                <input type="number" name="admin_id" placeholder="Admin Id" />
              </div>
            </div>
            <div class="group">
              <label for="tag name">Trainer Email</label>
              <input type="text" name="email" placeholder="Email" />
            </div>
            <div class="group">
              <label for="description">Trainer Password</label>
              <input type="password" name="pwd" placeholder="Password" />
            </div>
            <div class="group">
              <label for="description">Confirm Trainer Password</label>
              <input type="password" name="confirm-pwd" placeholder="Confirm Password"/>
            </div>
            <button type="submit" name="submit">Add Trainer</button>
          </form>
          <?php 
                if(isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo "<p> Fill all the fields</p>";
                    }
                    else if ($_GET["error"] == "invalidusername") {
                        echo "<p> Invalid Name </p>";
                    }
                    else if ($_GET["error"] == "invalidemail") {
                        echo "<p> Invalid Email </p>";
                    }
                    else if ($_GET["error"] == "passworddontmatch") {
                        echo "<p> Passwords do not match </p>";
                    }
                    else if ($_GET["error"] == "emailExists") {
                        echo "<p> Email already exists. Try logging in </p>";
                    }
                    else if ($_GET["error"] == "stmtFailed") {
                        echo "<p> Something went wrong </p>";
                    }
                    else if ($_GET["error"] == "none") {
                        echo "<p> Congratulations you have successfully added the trainer</p>";
                    }  
                    
                 }
            ?>
        </div>
      </div>
    </div>

    <?php 
        require('../../components/basic/footer.php')
    ?>
  </body>
</html>
