<?php
	include "includes/head.php";
	include "includes/sidebar.php";
	include "includes/header.php";

?> 
	
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Create Customer</h1>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0"></h5>
					</div>
					<div class="card-body">
                        <div>
                            <form action="customers.php" method="POST">
                                <div class="row">
                                    <h5 style="margin-bottom:15px">Customer Details</h5>
                                        
                                    <div class="col col-md-4">
                                        <label for="cName">Customer Name<span style="color:red"> *</span></label>
                                        <input type="text" name="cName" class="form-control" placeholder="Name of Customer" required>
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="DOB">Date of Birth (Optional)<span style="color:red"> </span></label>
                                        <input type="date" name="DOB" class="form-control" value="" >
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="country">Country<span style="color:red"> *</span></label>
                                        <select type="text" id="apphascars" name="country" class="form-control" placeholder="apphascars" required>
                                            <?php include 'includes/countryList.php'?>
                                        </select>
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="gender">Gender<span style="color:red"> *</span></label>
                                        <select id="Region" name="gender" class="form-control" placeholder="Select Zone" list="Region" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="address">Customer Address<span style="color:red"> *</span></label>
                                        <textarea required name="address" id="" cols="30" rows="3" class="form-control" placeholder="Detailed description of where they stay"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <h5 style="margin-bottom:15px">Other Details<span class="reqired"> </span></h5>
                                        
                                    <div class="col col-md-3">
                                        <label for="telephone">Customer Phone<span style="color:red"> *</span></label>
                                        <input class="form-control" type="number" id="wizards" placeholder="Phone" name="telephone" list="wizards-list" required>
                                    </div>
                                    <div class="col col-md-3">
                                        <label for="occupation">Occupation<span style="color:red"> *</span></label>
                                        <input class="form-control" type="text" id="wizards" placeholder="Occupation" name="occupation" list="wizards-list" required>							
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="correspondantName">Correspondant Name<span style="color:red"> </span></label>
                                        <input class="form-control" type="test" id="wizards" placeholder="e.g Mr. John" name="correspondantName" list="wizards-list">
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="relationship">Relationship<span style="color:red"> </span></label>
                                        <input class="form-control" type="text" id="wizards" placeholder="e.g Mr. John" name="relationship" list="wizards-list">
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="correspondantphone">Correspondant Phone<span style="color:red"> </span></label>
                                        <input class="form-control" type="number" id="wizards" placeholder="e.g +237 653 766 939" name="correspondantphone" list="wizards-list">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-md-4">
                                        <label for="correspondantphone">Upload Customer's Picture<span style="color:red"> </span></label>
                                        <input class="form-control" type="file" id="wizards" placeholder="e.g +237 653 766 939" name="correspondantphone" list="wizards-list">
                                    </div>
                                </div>
                                <br>
                                <div class="">
                                    <button name="create_branch" type="submit" class="btn btn-success">Create</button>
                                </div>
                            </form>
                        </div>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>

<?php
	include "includes/footer.php";
?> 
