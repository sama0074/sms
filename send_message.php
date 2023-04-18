<?php
	    session_start();

        if (!isset($_SESSION['username'])) {
            header("Location: auth-login.php");
        }
        include "includes/head.php";
    
        include 'database/config2.php';
        include 'database/sms_config.php';

        error_reporting(0);
			ini_set('display_errors', 0);

        $to_number = $_GET['number'];
        $to_name = $_GET['name'];
        $message = $_GET['content'];
        $subject = $_GET['subject'];
        $c_id = $_GET['contactID'];


        $cat_query_group = "SELECT * FROM messages WHERE content = '$message' AND subject = '$subject' AND contact_id= $c_id " ;
        $cat_stm_group = $conn->prepare($cat_query_group);
        $cat_stm_group->execute();
        $groupss = $cat_stm_group->fetch(PDO::FETCH_ASSOC);

        $_id = $groupss['id'];

?> 
	
<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						
					</div>
					<div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col col-md-12 acc_header">
                                    <h2 style="margin-bottom:50px"></h2>
                                    <!--Displaying these contents only if purchase history is empty-->
                                    <div class="contents text-center" style="margin-top: -60px">
                                        <img src="img/icons/question_mark_serious_thinker_300_wht.gif" style="width: 200px; margin-bottom: 20px" alt="basket">
                                        <h1 class="text-warning" style="font-size:60px">CONFIRMATION!!!</h1>
                                        <P style="font-size:20px">Are you sure you want to send the message "<b><?php echo $message;?></b>" to <b><?php echo $to_name;?></b>?</P>
                                        <button class="button" onclick="fetch();">Yes</button>
                                        <a href="reset_sms.php?id=<?php echo $_id; ?>">
                                            <button class="button" name="reset">No</button>
                                        </a>
                                        <!--button class="button"onclick="history.back()">Go Back</button-->
                                          
                                        </P>
                                    </div>
                                    <!--Displaying these contents only if purchase history is empty-->
                                    <ul class="messagesoo">
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>





<script>

	function fetch(){
		$.ajax({
			url: "http://api.foseintsms.com/api_bulk.php?username=<?php echo $sms_username; ?>&password=<?php echo $sms_password; ?>&message=<?php echo $message;?>&telephone=<?php echo $to_number; ?>",
			type: "GET",
			dataType: "JSON",
			data: JSON.stringify({}),
			success:function(data){
				$('.messagesoo').append("<li class='alert alert-success'>"+JSON.stringify(data)+"</li>")
			}
		});

	}
</script>
<?php
	include "includes/footer.php";
?> 
