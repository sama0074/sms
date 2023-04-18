<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header("Location: auth-login.php");
	}
	include "includes/head.php";
	include "includes/sidebar.php";

	include 'database/config2.php';

	$get_id = $_GET['id'];
	$cat_query_select = "SELECT * FROM contacts WHERE id = $get_id";
	$cat_stm_select = $conn->prepare($cat_query_select);
	$cat_stm_select->execute();
	$select = $cat_stm_select->fetch(PDO::FETCH_ASSOC);

	$get_gpID = $select['group_id']; 

	$cat_query_group_edit = "SELECT * FROM groups WHERE id = $get_gpID";
	$cat_stm_group_edit = $conn->prepare($cat_query_group_edit);
	$cat_stm_group_edit->execute();
	$edit_gp = $cat_stm_group_edit->fetch(PDO::FETCH_ASSOC);

?> 
	
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Editing <b><?php echo $select['name']?>'s</b> Contact</h1>

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
											<div class="card-header"><h5><i class="fas fa-list"></i> Edit Contact</h5></div>
											<div class="card-body">
												<form action="includes/server.php" method="POST">
													<div class="row">
														<div class="col col-sm-4">
															<input type="text" name="name" value="<?php echo htmlspecialchars($select['name'], ENT_QUOTES);  ?>" placeholder="Contact Name" required class="form-control">
															<input type="number" name="id"  value="<?php echo $_GET['id']?>" required class="form-control" style="display:none">
														</div>
														<div class="col col-sm-4">
															<input type="text" name="number" value="<?php echo htmlspecialchars($select['number'], ENT_QUOTES);  ?>" placeholder="Contact Name" required class="form-control">
														</div>
														<div class="col col-sm-4">
															<select type="text" name="group_id" placeholder="" class="form-control">
																<option value="<?php echo $edit_gp['id']; ?>" ><?php echo $edit_gp['name']; ?></option>
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
															<input type="text" name="age" value="<?php echo htmlspecialchars($select['age'], ENT_QUOTES);  ?>" placeholder="Contact Age" required class="form-control">
														</div>
														<div class="col col-sm-6">
															<select type="text" name="gender" placeholder="" class="form-control">
																<option value="<?php echo $select['gender']; ?>" ><?php echo $select['gender']; ?></option>
																<option value="Male" >Male</option>
																<option value="Female" >Female</option>
															</select>
														</div>
													</div>
													<div class="text-center">
														<button name="edit_contact" type="submit" class="btn btn-success">Update</button>
													</div>
												</form>
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
