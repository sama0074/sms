<?php

include 'database/config.php';
$user = $_SESSION['username'];
$query = "SELECT * from users WHERE username = '$user' LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$user_role = $row['position'];
$full_name = $row['member_name'];


?>
<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
					<span class="align-middle"><?php echo $row['member_name']?></span>
				</a>
				<a class="sidebar-brand" href="p_sms.php">
					<button type="delete" class="btn btn-warning">
						Compose
					</button>
				</a>
				
				<ul class="sidebar-nav">

					


					<li class="sidebar-item">
						<a class="sidebar-link" href="index.php">
							<i class="align-middle" data-feather="layers"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-header">
						Send Messages
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="message.php">
							<i class="align-middle" data-feather="edit"></i> <span class="align-middle">SMS Contact</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="grp_sms.php">
							<i class="align-middle" data-feather="mail"></i> <span class="align-middle">SMS Group</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="bulk_sms.php">
							<i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Bulk SMS</span>
						</a>
					</li>
				

					<!------------------- STOCK MANAGEMENT VIEW STARTS----------------------------------------------------->
					<li class="sidebar-header">
						Manage Contacts & Groups
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="add_groups.php?result=">
							<i class="align-middle" data-feather="users"></i> 
							<span class="align-middle">
							<?php

								include 'database/config2.php';
								$grp = "SELECT * FROM groups WHERE others = 0";
								$grp_stm = $conn->prepare($grp);
								$grp_stm->execute();
								$grp_row = $grp_stm->rowCount();
							
							
							?>
								Groups <small class="badge bg-warning"><?php echo $grp_row ;?></small>
							</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="add_contacts.php?result=">
							<i class="align-middle" data-feather="book"></i> 
							<span class="align-middle">
							<?php
							include 'database/config2.php';
							$mm = "SELECT * FROM contacts WHERE others = 0";
							$aa = $conn->prepare($mm);
							$aa->execute();
							$aacount = $aa->rowCount();
							
							
							?>
							Contacts <small class="badge bg-primary"><?php echo $aacount; ?></small>
							</span>
						</a>
					</li>



					<!------------------- STOCK MANAGEMENT VIEW STARTS----------------------------------------------------->
					<li class="sidebar-header">
						Mass Upload
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="upload_contacts.php">
							<i class="align-middle" data-feather="share"></i> <span class="align-middle">Upload Contact</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="add_contacts.php?result=">
							<i class="align-middle" data-feather="cloud-rain"></i> <span class="align-middle">Upload Groups</span>
						</a>
					</li>





					<!------------------- USER MANAGEMENT VIEW STARTS----------------------------------------------------->
					<li class="sidebar-header">
						SMS Archives
					</li>

					<li class="sidebar-item">
					<?php 

						include 'database/config2.php';
						$sms = "SELECT * FROM messages WHERE is_sent = 1";
						$sms_stm = $conn->prepare($sms);
						$sms_stm->execute();
						$sms_row = $sms_stm->rowCount();



						$draft = "SELECT * FROM messages WHERE is_draft = 1";
						$draft_stm = $conn->prepare($draft);
						$draft_stm->execute();
						$draft_row = $draft_stm->rowCount();
					
					?>
						<div class="form-group text-center">
							<a href="sent_sms.php">
								<button type="submit" class="btn btn-success" name="">Sent (<?php echo $sms_row;?>)</button>
							</a>
							<a href="draft_sms.php">
								<button type="submit" class="btn btn-danger" name="">Draft (<?php echo $draft_row;?>)</button>
							</a>
						</div>
					</li>

					<!------------------- USER MANAGEMENT VIEW ENDS----------------------------------------------------->
					

					
				</ul>

				<div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Log Out</strong>
						<div class="mb-3 text-sm">
							Please make sure you exit when not infront of your computer.
						</div>
						<div class="d-grid">
							<a href="logout.php" class="btn btn-danger">Exit</a>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="img/employee/<?php echo $row['image']?>" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"><?php echo $row['member_name']?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="edit_user.php?id=40"><i class="align-middle me-1" data-feather="user"></i>Edit Logins</a>	
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="https://wa.me/message/4EES7TRFXDDPE1" target="_blank"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
				
			</nav>