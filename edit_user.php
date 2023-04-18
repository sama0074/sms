<?php

    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: auth-login.php");
    }
	include "includes/head.php";
	include "includes/sidebar.php";
	include "includes/header.php";

    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(-1);


    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    include 'database/config2.php';
    
    try {
        $query = "SELECT * FROM users WHERE id = ? LIMIT 0,1";
        $stmt = $conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }


    // check if form was submitted
if(isset($_POST['edit_user'])){
 
    try{
 
        $query = "UPDATE users
                    SET username=:username, password=:password, isUser=1 WHERE id = :id";
 
        // prepare query for execution
        $stmt = $conn->prepare($query);
								
        // posted values
        $username=htmlspecialchars(strip_tags($_POST['username']));
        $password=md5(htmlspecialchars(strip_tags($_POST['password'])));
        $repeat_password=md5(htmlspecialchars(strip_tags($_POST['repeat_password'])));
 
        // bind the parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id);
 
        // Execute the query
        if($stmt->execute()){

           /* if($image){
								
                // sha1_file() function is used to make a unique file name
                $target_directory = "img/employee/";
                $target_file = $target_directory . $image;
                $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
            
                $file_upload_error_messages="";
                // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>File already exists. Try to change file name.</div>";
            }
                
                // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['image']['size'] > (5120000)){
                $file_upload_error_messages.="<div>File must be less than 5 MB in size.</div>";
            }
                
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
                
            
            
            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    echo "<div class='alert alert-danger'>
                        <div>Unable to upload file.</div>
                        <div>Update the record to upload file.</div>
                    </div>";
                }
            }
            } */

            echo "<div class='alert alert-success text-center'>Update was successful.</div>";

        }else{
            echo "<div class='alert alert-danger'>Error occured. Update was unsuccessful!!!</div>";
        }
        
 
    }
 
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}

?> 
	
<main class="content">
	<div class="container-fluid p-0">
        <div class="row">
			<div class="col col-md-4">
                <h1 class="h3 mb-3">Edit System User</h1>
			</div>
			
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0"></h5>
					</div>
					<div class="card-body">
                        <div>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="POST" enctype="multipart/form-data">
             
                                <div class="row">
                                    <h5 style="margin-bottom:15px">User Logins<span class="reqired"> </span></h5>
                                        
                                    <div class="col col-md-4">
                                        <label for="username">Username<span style="color:red"> *</span></label>
                                        <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['username'], ENT_QUOTES);  ?>" id="wizards" placeholder="Name" name="username" list="wizards-list">
                                    </div>
                                    <div class="col col-md-4">
                                        <label for="password">Password<span style="color:red"> </span></label>
                                        <input class="form-control" type="password" id="wizards" value="" placeholder="New password" name="password" list="wizards-list" >							
                                    </div>
                                    <div class="col col-md-4">
                                        <label for="repeat_password">Password<span style="color:red"> </span></label>
                                        <input class="form-control" type="password" id="wizards" placeholder="Repeat new password" name="repeat_password" list="wizards-list">
                                    </div>
                                </div>
                                <br>
                                <div class="">
                                    <button name="edit_user" type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                        <br>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>

<?php
	include "includes/footer.php";
?> 
