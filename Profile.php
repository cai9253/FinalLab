<?php
// Set the title and include the header
$title = 'View Page';
include './view/header.php';
?>

<div class="team" style="grid-template-columns: auto;">
    <div class="team-container">
    <?php
    // Check if form data is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['about']) && isset($_FILES['image'])) {
        $name = htmlspecialchars($_POST['name']);
        $about = htmlspecialchars($_POST['about']);
        
        // Validate name
        if (!(preg_match("/^[a-zA-Z\s]+$/", $name))) {
            header('Location: Create.php'); 
            exit();
        } 

        // File upload setup
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Validate file size
        if ($_FILES['image']['size'] > 2000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if upload is allowed
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // Move file to target location
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Prepare and execute the query to insert data into tblprofile
                $query = "INSERT INTO tblprofile VALUES ('','$name', '$about', '$target_file')";

                if (mysqli_query($conn, $query)) {
                    echo '<div class="profile">';
                    echo '<div class="magicpattern"><img onmouseover="bigImgRei(this)" onmouseout="normalImgRei(this)" src="' . $target_file . '" alt="' . $name . '" class="profile-img"></div></div>';
                    echo '<p class="profile-name ">' . htmlspecialchars($name) . '</p>';
                    echo '<div class="profile-info">' . htmlspecialchars($about) . '</div>';
                    echo '</div>';
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                // Close the connection
                mysqli_close($conn);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo 'No profile data submitted.';
    }
    ?>
    </div>
</div>

<?php include('./view/footer.php'); ?>
