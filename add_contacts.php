<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header("Location: auth-login.php");
	}
	include "includes/head.php";
	include "includes/sidebar.php";

	include 'database/config2.php';

?> 
	
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Add Contacts</h1>
		<?php 
		
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
											<div class="card-header"><h5><i class="fas fa-list"></i> Add Contact</h5></div>
											<div class="card-body">
												<form action="includes/server.php" method="POST">
													<div class="row">
														<div class="col col-sm-4">
															<input type="text" name="name" placeholder="Contact Name" required class="form-control">
														</div>
														<div class="col col-sm-4">
															<input type="number" name="number" placeholder="Contact number" required class="form-control">
														</div>
														<div class="col col-sm-4">
															<select type="text" name="group_id" placeholder="" class="form-control">
																<option selected disabled>Select a Group</option>
																<?php 
																
																	$cat_query_group = "SELECT * FROM groups";
																	$cat_stm_group = $conn->prepare($cat_query_group);
																	$cat_stm_group->execute();
																	
																	while($group = $cat_stm_group->fetch(PDO::FETCH_ASSOC)){
																		echo "<option value='{$group['id']}'>{$group['name']}</option>";
																	}
																
																?>
															</select>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col col-sm-6">
															<input type="number" name="age" placeholder="Age" required class="form-control">
														</div>
														<div class="col col-sm-6">
															<select type="text" name="gender" placeholder="" class="form-control">
																<option selected disabled>Select gender</option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
														</div>
													</div>
													<div class="text-center">
														<button name="create_contacts" type="submit" class="btn btn-success">Add</button>
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

														$cat_query_select = "SELECT * FROM contacts ";
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
																<td>{$select['age']}</td>
																<td>{$select['gender']}</td>
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

<?php
	include "includes/footer.php";
?> 
