<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header("Location: auth-login.php");
	}
	include "includes/head.php";
	include "includes/sidebar.php";

	include 'database/config2.php';

	$get_id = $_GET['id'];
	$cat_query_select = "SELECT * FROM groups WHERE id = $get_id";
	$cat_stm_select = $conn->prepare($cat_query_select);
	$cat_stm_select->execute();
	$select = $cat_stm_select->fetch(PDO::FETCH_ASSOC);


?> 
	
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Edit</h1>

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
											<div class="card-header"><h5><i class="fas fa-list"></i> Edit Group</h5></div>
											<div class="card-body">
												<form action="includes/server.php?id=" method="POST">
													<div class="row">
														<div class="col col-sm-12">
															<input type="text" name="name" value="<?php echo htmlspecialchars($select['name'], ENT_QUOTES);  ?>" placeholder="Category Name" required class="form-control">
															<input type="text" name="group_id" value="<?php echo $_GET['id'];?>" placeholder="Group Name" style="display:none" class="form-control">
														</div>
													</div>
													<br>
													<div class="text-center">
														<button name="edit_group" type="submit" class="btn btn-success">Update</button>
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
