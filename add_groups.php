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

		<h1 class="h3 mb-3">Create Messaging Groups</h1>
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
											<div class="card-header"><h5><i class="fas fa-list"></i> Add Groups</h5></div>
											<div class="card-body">
												<form action="includes/server.php" method="POST">
													<div class="row">
														<div class="col col-sm-12">
															<input type="text" name="group_name" placeholder="Group Name" required class="form-control">
															<input type="text" name="date_created" value="<?php echo date("l d M Y");?>"  required style="display:none">
														</div>
													</div>
													<br>
													<div class="text-center">
														<button name="create_group" type="submit" class="btn btn-success">Add</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="col col-md-7">
									<div class="homeCard">
										<div class="card-content">
											<div class="card-header"><h5><i class="fas fa-list"></i> All Groups</h5></div>
											<div class="card-body">
												<table id="table" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th scope="col">#</th>
															<th scope="col">Name</th>
															<th scope="col">Contacts</th>
															<th scope="col" class="text-center">Action</th>
														</tr>
													</thead> 
													<tbody>
													<?php

														$cat_query_select = "SELECT * FROM groups ";
														$cat_stm_select = $conn->prepare($cat_query_select);
														$cat_stm_select->execute();

														


														while($select = $cat_stm_select->fetch(PDO::FETCH_ASSOC)){

															$verify = $select['id'];

															

															$cat_query_counting = "SELECT * FROM contacts WHERE group_id = '$verify'";
															$cat_stm_counting = $conn->prepare($cat_query_counting);
															$cat_stm_counting->execute();
															$counting = $cat_stm_counting->rowCount();

															echo "
															
															<tr>
																<td>{$select['id']}</td>
																<td>{$select['name']}</td>
																<td>{$counting}</td>
																<td class='text-center'>
																	<a href='edit_groups.php?id={$select['id']}'>
																		<button type='' class='btn btn-primary'>
																			<i class='align-middle' data-feather='edit'></i>
																		</button>
																	</a>
																	<a href='delete_group.php?id={$select['id']}'>
																		<button type='delete' class='btn btn-danger'>
																			<i class='align-middle' data-feather='trash-2'></i>
																		</button>
																	</a>
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
