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
		<div class="row">
            <div class="col-4"></div>
			<div class="col-4">
                <h1 class="h3 mb-3 text-center">Compose a message</h1>
				<div class="homeCard">
					<div class="card-header">
						<h5 class="card-title mb-0"></h5>
					</div>
					<div class="card-body">
                        <div class="">
                            <div class="email-app">
                                <main>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
                                        <div class="form-row mb-3">
                                            <label for="to" class="col-2 col-sm-1 col-form-label"></label>
                                            <div class="col-10 col-sm-11">
                                                <input type="text" class="form-control" id="to" placeholder="Name" name="leaderName" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <label for="cc" class="col-2 col-sm-1 col-form-label"></label>
                                            <div class="col-10 col-sm-11">
                                                <input type="number" class="form-control" id="cc" placeholder="Phone" name="leaderTel" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <label for="bcc" class="col-2 col-sm-1 col-form-label"></label>
                                            <div class="col-10 col-sm-11">
                                                <input type="text" class="form-control" id="bcc" name="leaderSubject" placeholder="Reason for sending message" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-11 ml-auto">
                                                <div class="form-group mt-4">
                                                    <textarea class="form-control" id="message" name="body" rows="5" placeholder="Message body" required></textarea>
                                                </div>
                                                <br>
                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-success" name="send">Send</button>
                                                    <button type="submit" class="btn btn-info" name="draft">Draft</button>
                                                    <button type="reset" class="btn btn-warning">Reset</button>
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
