<?php
 session_start();

 if (!isset($_SESSION['username'])) {
     header("Location: auth-login.php");
 }
 include "includes/head.php";
 include "includes/sidebar.php";

 include 'database/config2.php';

 $id = $_GET['id'];

 $query = "SELECT * FROM customers WHERE id = $id ";
 $stmt = $conn->prepare( $query );
 $stmt->execute();
 $row = $stmt->fetch(PDO::FETCH_ASSOC);

?> 
	
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Customer Database</h1>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0"></h5>
					</div>
					<div class="card-body">
                        <div>
                            <form action="includes/server.php" method="POST">
                                <div class="row">
                                    <h5 style="margin-bottom:15px">Customer Details </h5>
                                    <input type="text" name="id" value="<?php echo $row['id'];?>" style="display:none">
                                    <div class="col col-md-4">
                                        <label for="c_name">Customer Name<span style="color:red"> *</span></label>
                                        <input type="text" value="<?php echo htmlspecialchars($row['c_name'], ENT_QUOTES);  ?>" name="c_name" class="form-control" placeholder="Name of Customer" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="c_dob">Date of Birth (Optional)<span style="color:red"> </span></label>
                                        <input type="date" <?php echo htmlspecialchars($row['c_dob'], ENT_QUOTES);  ?> name="c_dob" class="form-control" value="" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="c_country">Country<span style="color:red"> *</span></label>
                                        <input type="text" value="<?php echo htmlspecialchars($row['c_country'], ENT_QUOTES);  ?>" id="apphascars" name="c_country" class="form-control" placeholder="apphascars" >
                                        
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="c_gender">Gender<span style="color:red"> *</span></label>
                                        <select id="Region" value="<?php echo htmlspecialchars($row['c_gender'], ENT_QUOTES);  ?>" name="c_gender" class="form-control" placeholder="Select Zone" list="Region" >
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="c_address">Customer Address<span style="color:red"> *</span></label>
                                        <textarea tyep="text" value="<?php echo htmlspecialchars($row['c_address'], ENT_QUOTES);  ?>"  name="c_address" cols="30" rows="3" class="form-control" placeholder="Detailed description of where they stay"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <h5 style="margin-bottom:15px">Other Details<span class="reqired"> </span></h5>
                                        
                                    <div class="col col-md-3">
                                        <label for="c_telephone">Customer Phone<span style="color:red"> *</span></label>
                                        <input value="<?php echo htmlspecialchars($row['c_telephone'], ENT_QUOTES);  ?>" class="form-control" type="text" id="wizards" placeholder="Phone" name="c_telephone" list="wizards-list" >
                                    </div>
                                    <div class="col col-md-3">
                                        <label for="c_occupation">Occupation<span style="color:red"> *</span></label>
                                        <input class="form-control" value="<?php echo htmlspecialchars($row['c_occupation'], ENT_QUOTES);  ?>" type="text" id="wizards" placeholder="Occupation" name="c_occupation" list="wizards-list" >							
                                    </div>
                                    <div class="col col-md-4">
                                        <label for="c_picture">Upload Customer's Picture<span style="color:red"> </span></label>
                                        <input class="form-control" type="file" id="wizards" placeholder="e.g +237 653 766 939" name="c_picture" list="wizards-list">
                                    </div>
                                </div>
                                <br>
                                <div class="">
                                    <button name="update_customer" type="submit" class="btn btn-success">Update</button>
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
