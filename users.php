<?php

    session_start();

        if (!isset($_SESSION['username'])) {
            header("Location: auth-login.php");
        }
	include "includes/head.php";
	include "includes/sidebar.php";

    
    include 'database/config2.php';
        
    $query5 = "SELECT * FROM users ORDER BY id DESC";
    $stmt5 = $conn->prepare($query5);
    $stmt5->execute();
        
    // this is how to get number of rows returned
    $num5 = $stmt5->rowCount();
    
    $memquery = "SELECT * FROM users ORDER BY id DESC";
    $memstmt = $conn->prepare($memquery);
    $memstmt->execute();
    $memnum = $memstmt->rowCount();


    if (isset($_POST['create_user'])) {
        // include database connection
        include 'database/config2.php';
     
        try{
     
            // insert query
            $query2 = "INSERT INTO users SET member_name=:member_name, position=:position, dob=:dob, country=:country, gender=:gender, address=:address, 
            hobbies=:hobbies, id_no=:id_no, start_date=:start_date, code=:code, phone=:phone, image=:image, surety_name=:surety_name, surety_occupation=:surety_occupation, 
            surety_phone=:surety_phone, surety_relationship=:surety_relationship, surety_address=:surety_address, surety_id=:surety_id, username=:username, password=:password, isUser=1 ";
            
            // prepare query for execution
            $stmt = $conn->prepare($query2);
            
            // posted values
            $member_name=htmlspecialchars(strip_tags($_POST['member_name']));
            $position=htmlspecialchars(strip_tags($_POST['position']));
            $dob=htmlspecialchars(strip_tags($_POST['dob']));
            $country=htmlspecialchars(strip_tags($_POST['country']));
            $gender=htmlspecialchars(strip_tags($_POST['gender']));
            $address=htmlspecialchars(strip_tags($_POST['address']));
            $hobbies=htmlspecialchars(strip_tags($_POST['hobbies']));
            $id_no=htmlspecialchars(strip_tags($_POST['id_no']));
            $start_date=date("Y-m-d");
            $code=htmlspecialchars(strip_tags($_POST['code']));
            $phone=htmlspecialchars(strip_tags($_POST['phone']));

            $image=!empty($_FILES["image"]["name"])
            ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"])
            : "";

            $image=htmlspecialchars(strip_tags($image));

            $surety_name=htmlspecialchars(strip_tags($_POST['surety_name']));
            $surety_occupation=htmlspecialchars(strip_tags($_POST['surety_occupation']));
            $surety_phone=htmlspecialchars(strip_tags($_POST['surety_phone']));
            $surety_relationship=htmlspecialchars(strip_tags($_POST['surety_relationship']));
            $surety_address=htmlspecialchars(strip_tags($_POST['surety_address']));
            $surety_id=htmlspecialchars(strip_tags($_POST['surety_id']));
            $username=htmlspecialchars(strip_tags($_POST['username']));
            $password=md5(htmlspecialchars(strip_tags($_POST['password'])));
            $repeat_assword=md5(htmlspecialchars(strip_tags($_POST['repeat_assword'])));
     
            // bind the parameters
            $stmt->bindParam(':member_name', $member_name);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':hobbies', $hobbies);
            $stmt->bindParam(':id_no', $id_no);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':surety_name', $surety_name);
            $stmt->bindParam(':surety_occupation', $surety_occupation);
            $stmt->bindParam(':surety_phone', $surety_phone);
            $stmt->bindParam(':surety_relationship', $surety_relationship);
            $stmt->bindParam(':surety_address', $surety_address);
            $stmt->bindParam(':surety_id', $surety_id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            


            // now, if image is not empty, try to upload the image
            if($stmt->execute()){
            if($image){
            
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
            }
        }
            
            
        if($password == $repeat_assword) //this block is to check if the password and confirm password matches
        {
            
            if ( preg_match('/\s/',$username) ) // this is to ensure that the username does not concern space
            {
                //echo '<p class="alert alert-light-danger color-danger">Username must not contain space</p>';
                echo "<div class='alert alert-warning text-center'>Username must not contain space</div>";
                            
            } else {
                    
                if($num5 > 0) // this block is to see if the username already exists
                {
                    //echo '<p class="alert alert-light-danger color-danger">Username Already Existing</p>';
                    echo "<div class='alert alert-success text-center'>Registration was successful. 
                                <a href='users.php'>
                                    <div class='position-relative btn btn-success'>
                                        <i class='align-middle' data-feather='rotate-cw'></i>
                                    </div>
                                </a>
                            </div>";
                    
                }else{
                    
                    if($num5 > 0) // this block is to see if the telephone number already exists
                    {
                        //echo '<p class="alert alert-light-danger color-danger">Phone Number already exist</p>';
                        echo "<div class='alert alert-warning text-center'>Phone Number already exist</div>";
                    }else{
                        // Execute the query
                        if($stmt->execute()){
                            
                            echo "<div class='alert alert-success text-center'>Registration was successful. 
                                        <a href='users.php'>
                                            <div class='position-relative btn btn-success'>
                                                <i class='align-middle' data-feather='rotate-cw'></i>
                                            </div>
                                        </a>
                                    </div>";
                            
                        }else{
                            echo "<div class='alert alert-warning text-center'>Registration Failed.</div>";
                        }
                    }
                    
                }    
            }
        
        }else{
            header("Location: ../password_mismatch.php");
        }
    
        }
    
        // show error
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
    }
?> 
	
<main class="content">
	<div class="container-fluid p-0">
        <div class="row">
			<div class="col col-md-4">
                <h1 class="h3 mb-3">System Users</h1>
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
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <h5 style="margin-bottom:15px">User Details</h5>
                                        
                                    <div class="col col-md-2">
                                        <label for="member_name">Member Name<span style="color:red"> *</span></label>
                                        <input type="text" name="member_name" class="form-control" placeholder="Name of Customer" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="position">Possition<span style="color:red"> *</span></label>
                                        <select id="Region" name="position" class="form-control" placeholder="Select Zone" list="Region" >
                                            <option value="Sales Person">Sales</option>
                                            <option value="Owner">Owner</option>
                                            <option value="Manager" disabled>Manager</option>
                                            <option value="Accountant" disabled>Accountant</option>
                                        </select>
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="dob">Date of Birth (Optional)<span style="color:red"> </span></label>
                                        <input type="date" name="dob" class="form-control" value="" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="country">Country<span style="color:red"> *</span></label>
                                        <select type="text" id="apphascars" name="country" class="form-control" placeholder="apphascars" >
                                            <?php include 'includes/countryList.php'?>
                                        </select>
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="gender">Gender<span style="color:red"> *</span></label>
                                        <select id="Region" name="gender" class="form-control" placeholder="Select Zone" list="Region" >
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="address">User Address<span style="color:red"> *</span></label>
                                        <textarea  name="address" id="" cols="30" rows="3" class="form-control" placeholder="Detailed description of where they stay"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-md-4">
                                        <label for="hobbies">Hobbies<span style="color:red"> *</span></label>
                                        <input type="text" name="hobbies" class="form-control" placeholder="Name of Customer" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="id_no">ID No.<span style="color:red"> *</span></label>
                                        <input type="text" name="id_no" placeholder="ID number" class="form-control" value="" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="start_date">Start Date<span style="color:red"> *</span></label>
                                        <input type="date" id="apphascars" name="start_date" class="form-control" placeholder="apphascars" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="code">Code<span style="color:red"> *</span></label>
                                        <input type="text" id="apphascars" name="code" class="form-control" value="#U<?php echo (rand(1000, 10000)) ;?>" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="phone">Phone<span style="color:red"> *</span></label>
                                        <input type="number" id="apphascars" name="phone" class="form-control" placeholder="e.g 653 799 669" >
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-md-4">
                                        <label for="image">Upload Employee's Picture<span style="color:red"></span></label>
                                        <input class="form-control" type="file" id="wizards" placeholder="e.g +237 653 766 939" name="image" list="wizards-list">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <h5 style="margin-bottom:15px">Surety Details<span class="reqired"> </span></h5>
                                        
                                    <div class="col col-md-3">
                                        <label for="surety_name">Name<span style="color:red"> *</span></label>
                                        <input class="form-control" type="text" id="wizards" placeholder="Name" name="surety_name" list="wizards-list" >
                                    </div>
                                    <div class="col col-md-3">
                                        <label for="surety_occupation">Occupation<span style="color:red"> *</span></label>
                                        <input class="form-control" type="text" id="wizards" placeholder="Occupation" name="surety_occupation" list="wizards-list" >							
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="surety_phone">Number<span style="color:red"> *</span></label>
                                        <input class="form-control" type="number" id="wizards" placeholder="telephone" name="surety_phone" list="wizards-list" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="surety_relationship">Relationship<span style="color:red"> *</span></label>
                                        <input class="form-control" type="text" id="wizards" placeholder="e.g Father" name="surety_relationship" list="wizards-list" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="surety_address">Address<span style="color:red"> *</span></label>
                                        <input class="form-control" type="text" id="wizards" placeholder="e.g Mokundange Limbe" name="surety_address" list="wizards-list" >
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-md-4">
                                        <label for="surety_id">ID Card<span style="color:red"> *</span></label>
                                        <input class="form-control" type="text" id="wizards"  name="surety_id" list="wizards-list">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <h5 style="margin-bottom:15px">User Logins<span class="reqired"> </span></h5>
                                        
                                    <div class="col col-md-4">
                                        <label for="username">Username<span style="color:red"> *</span></label>
                                        <input class="form-control" type="text" id="wizards" placeholder="Name" name="username" list="wizards-list" >
                                    </div>
                                    <div class="col col-md-4">
                                        <label for="password">Password<span style="color:red"> *</span></label>
                                        <input class="form-control" type="password" id="wizards" placeholder="Password" name="password" list="wizards-list" >							
                                    </div>
                                    <div class="col col-md-4">
                                        <label for="repeat_assword">Password<span style="color:red"> *</span></label>
                                        <input class="form-control" type="password" id="wizards" placeholder="Repeat Password" name="repeat_assword" list="wizards-list" >
                                    </div>
                                </div>
                                <br>
                                <div class="">
                                    <button name="create_user" type="submit" class="btn btn-success">Create</button>
                                </div>
                            </form>
                        </div>
                        <br><br>

                      
                        <div class="row">
                            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header">
                                    </div>
                                <?php
                                if($memnum > 0){
                                    echo "
                                    <table class='table table-hover my-0'>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Profile</th>
                                                <th>Age</th>
                                                <th>Sex</th>
                                                <th>Phone</th>
                                                <th>ID No</th>
                                                <th>Country</th>
                                                <th>Home</th>
                                                <th>Username</th>
                                                <th>Position</th>
                                                <th>Surety Details</th>
                                                <th class='d-none d-xl-table-cell'>Start Date</th>
                                                <th class='d-none d-xl-table-cell'>Show</th>
                                                <th class='d-none d-xl-table-cell'>Edit</th>
                                                <th class='d-none d-xl-table-cell'>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>";

                                        while($memrow = $memstmt->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $date1 = $memrow['dob'];
                                            $date2 = date('Y-m-d');

                                            $diff = abs(strtotime($date2) - strtotime($date1));

                                            $years = floor($diff / (365*60*60*24));

                                            $id = $memrow['id'];
                                        echo "
                                                <tr>
                                                    <td>{$memrow['id']}</td>
                                                    <td class='d-none d-xl-table-cell'>{$memrow['member_name']}</td>
                                                    <td class='d-none d-xl-table-cell'>
                                                        <div class=''>
                                                            <img src='img/employee/{$memrow['image']}' class='avatar img-fluid rounded-circle' alt='Vanessa Tucker'>
                                                        </div>
                                                    </td>";?>
                                                    <td class='d-none d-xl-table-cell'>  <?php echo $years; ?> <?php echo "</td>
                                                    <td class='d-none d-xl-table-cell'>{$memrow['gender']}</td>
                                                    <td class='d-none d-xl-table-cell'>{$memrow['phone']}</td>
                                                    <td class='d-none d-xl-table-cell'><span class='badge bg-warning'>{$memrow['id_no']}</span></td>
                                                    <td class='d-none d-md-table-cell'>{$memrow['country']}</td>
                                                    <td class='d-none d-md-table-cell'><span class='badge bg-success'>{$memrow['address']}</span></td>
                                                    <td class='d-none d-md-table-cell'>{$memrow['username']}</td>
                                                    <td class='d-none d-md-table-cell'>{$memrow['position']}</td>
                                                    <td class='d-none d-md-table-cell'>{$memrow['surety_name']}<br> 
                                                        <small style=''>
                                                            <b>Relation:</b> {$memrow['surety_relationship']} <br>
                                                            <b>Tel:</b> {$memrow['surety_phone']} <br>
                                                            <b>Address:</b> {$memrow['surety_address']} <br>
                                                            <b>Occupation:</b> {$memrow['surety_occupation']} <br>
                                                        </small>
                                                    </td>
                                                    <td class='d-none d-md-table-cell'>{$memrow['start_date']}</td>
                                                    <td class='d-none d-md-table-cell'>
                                                        <a href='view_user.php?id={$id}'>
                                                            <div class='position-relative btn btn-primary'>
                                                                <i class='align-middle' data-feather='eye'></i>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class='d-none d-md-table-cell'>
                                                        <a href='edit_user.php?id={$id}' id=''>
                                                            <div class='position-relative btn btn-warning'>
                                                                <i class='align-middle' data-feather='edit'></i>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class='d-none d-md-table-cell'>
                                                        <button onclick='delete_user({$id});' class='position-relative btn btn-danger'>
                                                            <i class='align-middle' data-feather='trash'></i>
                                                        </button>
                                                    </td>
                                                </tr> ";
                                             } echo "
                                        </tbody>
                                    </table> 
                                    "; } ?>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>



<script type='text/javascript'>
// confirm record deletion
function delete_user( id ){
 
			swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = 'deletebadge.php?id=' + id;
            } else {
                swal("Your data is safe!");
            }
            });

		
}
</script>

<?php
	include "includes/footer.php";
?> 
