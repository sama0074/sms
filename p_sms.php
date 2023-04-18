<?php

    session_start();

        if (!isset($_SESSION['username'])) {
            header("Location: auth-login.php");
        }
	include "includes/head.php";
	include "includes/sidebar.php";

    
    include 'database/config2.php';
    
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(-1);

?> 
	
<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
            <div class="col-4"></div>
			<div class="col-4">
                <h1 class="h3 mb-3 text-center">Compose a private random message</h1>
                    <?php 
                    
                        if($_GET['result'] == 'success'){
                            echo "<div class='alert alert-success'>Message saved as draft</div> <br>";
                        }else{
                            if($_GET['result'] == 'failed'){
                                echo "<div class='alert alert-danger'>Sorry!! An Error occured</div> <br>";
                            }
                        }

                        if($_GET['result'] == ''){
                            echo "<div></div>";
                        }
                    
                    
                    ?>
				<div class="homeCard">
					<div class="card-header">
						<h5 class="card-title mb-0"></h5>
					</div>
					<div class="card-body">
                        <div class="">
                            <div class="email-app">
                                <main>
                                    <form action="includes/server.php" method="POST">
                                        <div class="form-row mb-3">
                                            <div class="col col-sm-11">
                                                <label for="numbers">Number <span class="reqired">*</span></label>
                                                <input class="form-control" type="text" id="" placeholder="Enter phone number" name="numbers" list="contact" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <label for="subject">Subject<span class="reqired"> *</span></label>
                                            <div class="col-10 col-sm-11">
                                                <input type="text" class="form-control" name="subject" placeholder="Reason for sending message" required>
                                                <input type="text" class="form-control" style="display:none" value="<?php echo date("l d M Y"); ?>" name="date_sent" placeholder="Reason for sending message" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-11 ml-auto">
                                                <div class="form-group mt-4">
                                                    <textarea class="form-control" id="message" name="content" rows="5" placeholder="Message body" required></textarea>
                                                </div>
                                                <br>
                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-success" name="send_priv_sms">Send</button>
                                                    <button type="submit" class="btn btn-warning" name="draft_psms">Draft</button>
                                                    <button type="reset" class="btn btn-danger">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </main>
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
