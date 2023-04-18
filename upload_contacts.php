<?php 
session_start();

if (!isset($_SESSION['username'])) {
	header("Location: auth-login.php");
}
include "includes/head.php";
include "includes/sidebar.php";

include 'database/config2.php';
include 'database/sms_config.php';



?>






<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Add Contacts</h1>
		<?php 
		/*
			if($_GET['result'] == 'success'){
				echo "<div class='alert alert-success'>Success</div> <br>";
			}else{
				if($_GET['result'] == 'failed'){
					echo "<div class='alert alert-danger'>Sorry!! An Error occured</div> <br>";
				}
			}

			if($_GET['result'] == ''){
				echo "<div></div>";
			}
		*/
		
		?>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0"></h5>
					</div>
					<div class="card-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col col-md-5">
									<div class="homeCard">
										<div class="card-content">
											<div class="card-header"><h5><i class="fas fa-list"></i> Upload Contact</h5></div>
											<div class="card-body">
											<form class="" action="" method="post" enctype="multipart/form-data">
												<input type="file" name="excel" required value="">
												<div class="text-center">
													<button name="import" type="submit" class="btn btn-success">Add</button>
												</div>
											</form>
											</div>
										</div>
									</div>
								</div>
								<div class="col col-md-7">
									<div class="homeCard">
										<div class="card-content">
											<div class="card-header"><h5><i class="fas fa-list"></i> All Brands</h5></div>
											<div class="card-body">
												<table id="table" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th scope="col">#</th>
															<th scope="col">Name</th>
															<th scope="col">Age</th>
															<th scope="col">Gender</th>
															<th scope="col">Number</th>
															<th scope="col">Group</th>
															<th scope="col" class="text-center">Action</th>
														</tr>
													</thead> 
													<tbody>

													<?php

													/*	$cat_query_select = "SELECT * FROM contacts ";
														$cat_stm_select = $conn->prepare($cat_query_select);
														$cat_stm_select->execute();


														while($select = $cat_stm_select->fetch(PDO::FETCH_ASSOC)){

															$verify = $select['group_id'];

															

															$cat_query_counting = "SELECT * FROM groups WHERE id = '$verify'";
															$cat_stm_counting = $conn->prepare($cat_query_counting);
															$cat_stm_counting->execute();
															$group = $cat_stm_counting->fetch(PDO::FETCH_ASSOC);

															echo "
															
															<tr>
																<td>{$select['id']}</td>
																<td>{$select['name']}</td>
																<td>{$select['number']}</td>
																<td>{$group['name']}</td>
																<td class='text-center'>
																	<a href='edit_contacts.php?id={$select['id']}'>
																		<button type='delete' class='btn btn-primary'>
																			<i class='align-middle' data-feather='edit'></i>
																		</button>
																	</a>
																	<a href='delete_contacts.php?id={$select['id']}'>
																		<button type='delete' class='btn btn-danger'>
																			<i class='align-middle' data-feather='trash-2'></i>
																		</button>
																</td>
															</tr>
															
															";
														} 

														*/
													?>
													</tbody> 
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>

		<form class="" action="" method="post" enctype="multipart/form-data">
			<input type="file" name="excel" required value="">
			<button type="submit" name="import">Import</button>
		</form>
		<hr>
		<table border = 1>
			<tr>
				<td>#</td>
				<td>Name</td>
				<td>Age</td>
				<td>Gender</td>
				<td>Number</td>
				<td>Group</td>
			</tr>
			<?php
			include 'database/config.php';
			$i = 1;
			$rows = mysqli_query($conn, "SELECT * FROM contacts");
			foreach($rows as $row) :
			?>
			<tr>
				<td> <?php echo $i++; ?> </td>
				<td> <?php echo $row["name"]; ?> </td>
				<td> <?php echo $row["age"]; ?> </td>
				<td> <?php echo $row["gender"]; ?> </td>
				<td> <?php echo $row["number"]; ?> </td>
				<td> <?php echo $row["group_id"]; ?> </td>
			</tr>
			<?php endforeach; ?>
		</table>


		<?php
		if(isset($_POST["import"])){
			$fileName = $_FILES["excel"]["name"];
			$fileExtension = explode('.', $fileName);
      		$fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			$targetDirectory = "uploads/" . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require "excelReader/excel_reader2.php";
			require "excelReader/SpreadsheetReader.php";
			include "database/config.php";

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $row){
				$name = $row[0];
				$age = $row[1];
				$gender = $row[2];
				$number = $row[3];
				$group_id = $row[4];
				mysqli_query($conn, "INSERT INTO contacts VALUES('', '$name', '$age', '$gender', $number, $group_id)");
				//INSERT INTO `contacts`(`id`, `name`, `number`, `group_id`, `others`) VALUES ( '' ,'$name',$number,$group_id, '')
			}

			echo
			"
			<script>
				alert('Succesfully Imported');
				document.location.href = '';
			</script>
			";
		}
		?>
		



<?php 
	include "includes/footer.php";
?> 