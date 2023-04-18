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
            <div class="col-8">
                <h1 class="h3 mb-3">Draft message</h1>
                <?php 
		
                    if($_GET['result'] == 'success'){
                        echo "<div class='alert alert-success'>Message Deleted</div> <br>";
                    }else{
                        if($_GET['result'] == 'failed'){
                            echo "<div class='alert alert-danger'>Sorry!! An Error occured</div> <br>";
                        }
                    }

                    if($_GET['result'] == ''){
                        echo "<div></div>";
                    }
                
                
                ?>

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sent to</th>
                            <th>Subject</th>
                            <th>Messages</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    
                    <?php
                    
                        $cat_query_select = "SELECT * FROM messages WHERE is_draft = 1";
                        $cat_stm_select = $conn->prepare($cat_query_select);
                        $cat_stm_select->execute();

                        while($select = $cat_stm_select->fetch(PDO::FETCH_ASSOC)){

                            echo"
                            
                                    <tr>
                                        <td>";
                                        
                                        if($select['is_group'] == 0){
                                            $get_contact = $select['is_contact'];
                                            $grp_query_select = "SELECT * FROM contacts WHERE id = $get_contact";
                                            $grp_stm_select = $conn->prepare($grp_query_select);
                                            $grp_stm_select->execute();
                                            $select_grp = $grp_stm_select->fetch(PDO::FETCH_ASSOC);

                                            echo $select_grp['name'];

                                        }else{

                                            $contact = $select['group_id'];
                                            $grps_query_select = "SELECT * FROM groups WHERE id = $contact";
                                            $grps_stm_select = $conn->prepare($grps_query_select);
                                            $grps_stm_select->execute();
                                            $select_grps = $grps_stm_select->fetch(PDO::FETCH_ASSOC);

                                            echo $select_grps['name'];

                                        }



                                        if($select['is_bulk'] == 1){
                                            echo "<span class='badge bg-primary'>Bulk SMS</span>";
                                        }

                                        if($select['is_bulk'] > 1){
                                            echo "<span class='badge bg-success'>Personal SMS</span>";
                                        }

                                        if($select['contact_id'] > 1){
                                            echo $select['contact_id'];
                                        }

                                    
                                
                                
                            echo"   </td>
                                    <td>{$select['subject']}</td>
                                    <td>{$select['content']}</td>
                                    <td>{$select['date_sent']}</td>
                                    <td><span class='badge bg-warning'>Draft</span></td>
                                    <td>
                                        <a href='delete_message.php?id={$select['id']}' class='btn btn-danger'>
                                            <i class='align-middle' data-feather='trash-2'></i>
                                        </a>
                                    </td>
                                </tr>
                            
                            
                            ";

                            
                        }
                    
                    
                    ?>
                        
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Messages</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>    
            </div>
		</div>
	</div>
</main>



<?php
	include "includes/footer.php";
?> 