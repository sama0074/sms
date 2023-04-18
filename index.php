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
		<h1>Dashboard</h1>
		<br>
		<button class="button" id="modal" onclick="fetch();" style="display:none">Load Data</button>
		<br><br><br>

		<div class="row">
			<div class="col col-md-4">
				<div class="homeCard" style="color:white; font-weight:700; background: linear-gradient(52deg, rgba(34,46,60,1) 17%, rgba(34,60,43,1) 62%, rgba(58,57,66,1) 100%);">
					<p>From 1 to 1 000 SMS, it will cost <b> 15FCFA / SMS</b></p>
					<p>From 1 001 to 10 000 SMS, it will cost <b> 12.5FCFA / SMS</b></p>
					<p>From 10 001 + SMS, it will cost <b> 12 FCFA / SMS</b></p>
				</div>
			</div>
			<div class="col col-md-4">
				<div class="homeCard">
					<div class="text-center">
						<a href="https://wa.me/237652137960?text=Hello%20please%20I%20want%20to%20recharge%20my%20account" target="_blank"><button class="btn btn-success">Recharge your Account</button></a>
					</div>
				</div>
			</div>
			<div class="col col-md-4">
				<div class="homeCard">
					<div class="text-center">
						<a href="https://wa.me/message/4EES7TRFXDDPE1" target="_blank"><button class="btn btn-primary">Chat with us</button></a>
					</div>
				</div>
			</div>
		</div>
		


		<div class="row">
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h2 class="">Number of SMS Left</h2>
					</div>
					<div class="card-body">
						<!--Displaying these contents only if purchase history is empty-->
						<div class="balance-sms">
							
						</div>
					</div>
				</div>
			</div>

			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h2 class="">SMS Name</h2>
					</div>
					<div class="card-body">
						<!--Displaying these contents only if purchase history is empty-->
						<div class="sms_name">
							
						</div>
					</div>
				</div>
			</div>

			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h2 class="">Company </h2>
					</div>
					<div class="card-body">
						<!--Displaying these contents only if purchase history is empty-->
						<div class="company_name">
							
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
			url: "http://api.foseintsms.com/info.php?username=<?php echo $sms_username; ?>&password=<?php echo $sms_password; ?>",
			type: "GET",
			dataType: "JSON",
			data: JSON.stringify({}),
			success:function(data){
				$('.balance-sms').append("<p style='font-size:100px; font-weight: 700;' class=''>"+JSON.stringify(data.credit.nombre)+"</p>")
			}
		});


		$.ajax({
			url: "http://api.foseintsms.com/info.php?username=<?php echo $sms_username; ?>&password=<?php echo $sms_password; ?>",
			type: "GET",
			dataType: "JSON",
			data: JSON.stringify({}),
			success:function(data){
				$('.sms_name').append("<p style='font-size:50px; font-weight: 700;' class=''>"+JSON.stringify(data.account.nompoursms)+"</p>")
			}
		});


		$.ajax({
			url: "http://api.foseintsms.com/info.php?username=<?php echo $sms_username; ?>&password=<?php echo $sms_password; ?>",
			type: "GET",
			dataType: "JSON",
			data: JSON.stringify({}),
			success:function(data){
				$('.company_name').append("<p style='font-size:30px; font-weight: 600;' class=''>"+JSON.stringify(data.account.nomentreprise)+"</p>")
			}
		});



	}
</script>



<script>
jQuery(function(){
   jQuery('#modal').click();
});
</script>

<?php
	include "includes/footer.php";
?> 
