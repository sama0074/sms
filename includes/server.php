<?php
include '../database/config2.php';





if(isset($_POST['create_group'])){

    try{

        $query = "INSERT INTO groups SET name=:name, date_created=:date_created";

        // prepare query for execution
         $stmt = $conn->prepare($query);


          // posted values
        $group_name=htmlspecialchars(strip_tags($_POST['group_name']));
        $date_created=htmlspecialchars(strip_tags($_POST['date_created']));


        // bind the parameters
        $stmt->bindParam(':name', $group_name);
        $stmt->bindParam(':date_created', $date_created);

        // Execute the query
        if($stmt->execute()){

            //echo "<div class='alert alert-danger'>Successful!!!</div>";
            header("Location: ../add_groups.php?result=success");


        }else{
            header("Location: ../add_groups.php?result=failed");
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}





if(isset($_POST['edit_group'])){

    $group_id=htmlspecialchars(strip_tags($_POST['group_id']));

    try{

        $query = "UPDATE groups SET name=:name WHERE id = $group_id";

        // prepare query for execution
         $stmt = $conn->prepare($query);


          // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));


        // bind the parameters
        $stmt->bindParam(':name', $name);

        // Execute the query
        if($stmt->execute()){

            //echo "<div class='alert alert-danger'>Successful!!!</div>";
            header("Location: ../add_groups.php?result=success");


        }else{
            header("Location: ../add_groups.php?result=failed");
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}




if(isset($_POST['create_contacts'])){

    try{

        $query = "INSERT INTO contacts SET name=:name, number=:number, group_id=:group_id, age=:age, gender=:gender";

        // prepare query for execution
         $stmt = $conn->prepare($query);


          // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $group_id=htmlspecialchars(strip_tags($_POST['group_id']));
        $number=htmlspecialchars(strip_tags($_POST['number']));
        $age=htmlspecialchars(strip_tags($_POST['age']));
        $gender=htmlspecialchars(strip_tags($_POST['gender']));


        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':group_id', $group_id);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':gender', $gender);

        // Execute the query
        if($stmt->execute()){

            //echo "<div class='alert alert-danger'>Successful!!!</div>";
            header("Location: ../add_contacts.php?result=success");


        }else{
            header("Location: ../add_contacts.php?result=failed");
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}




if(isset($_POST['edit_contact'])){

    $_id=htmlspecialchars(strip_tags($_POST['id']));

    try{

        $query = "UPDATE contacts SET name=:name, number=:number, group_id=:group_id, age=:age, gender=:gender WHERE id = $_id";

        // prepare query for execution
         $stmt = $conn->prepare($query);


          // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $number=htmlspecialchars(strip_tags($_POST['number']));
        $group_id=htmlspecialchars(strip_tags($_POST['group_id']));
        $age=htmlspecialchars(strip_tags($_POST['age']));
        $gender=htmlspecialchars(strip_tags($_POST['gender']));


        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':group_id', $group_id);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':gender', $gender);

        // Execute the query
        if($stmt->execute()){

            //echo "<div class='alert alert-danger'>Successful!!!</div>";
            header("Location: ../add_contacts.php?result=success");


        }else{
            header("Location: ../add_contacts.php?result=failed");
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}





if(isset($_POST['send'])){

    $c_name=htmlspecialchars(strip_tags($_POST['name']));

    $cat_query_group = "SELECT * FROM contacts WHERE name = '$c_name'";
    $cat_stm_group = $conn->prepare($cat_query_group);
    $cat_stm_group->execute();
    $group = $cat_stm_group->fetch(PDO::FETCH_ASSOC);

    $info = $group['id'];
    $info_c = $group['number'];

    try{

        $query = "INSERT INTO messages SET content=:content, subject=:subject, date_sent=:date_sent, is_contact=1, group_id=0, contact_id=:contact_id, 
        is_sent=1, is_draft=0";

        // prepare query for execution
         $stmt = $conn->prepare($query);


          // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $subject=htmlspecialchars(strip_tags($_POST['subject']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
        $date_sent=htmlspecialchars(strip_tags($_POST['date_sent']));


        // bind the parameters
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':contact_id', $info);
        $stmt->bindParam(':date_sent', $date_sent);

        // Execute the query
        if($stmt->execute()){

            //echo "<div class='alert alert-danger'>Successful!!!</div>";
            header("Location: ../send_message.php?number=$info_c&name=$c_name&contactID=$info&subject=$subject&content=$content");


        }else{
            header("Location: ../send_message.php?result=failed");
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}



if(isset($_POST['draft'])){

    $c_name=htmlspecialchars(strip_tags($_POST['name']));

    $cat_query_group = "SELECT * FROM contacts WHERE name = '$c_name'";
    $cat_stm_group = $conn->prepare($cat_query_group);
    $cat_stm_group->execute();
    $group = $cat_stm_group->fetch(PDO::FETCH_ASSOC);

    $info = $group['id'];
    $info_c = $group['number'];

    try{

        $query = "INSERT INTO messages SET content=:content, subject=:subject, date_sent=:date_sent, is_contact=1, group_id=0, contact_id=:contact_id, 
        is_sent=0, is_draft=1";

        // prepare query for execution
         $stmt = $conn->prepare($query);


          // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $subject=htmlspecialchars(strip_tags($_POST['subject']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
        $date_sent=htmlspecialchars(strip_tags($_POST['date_sent']));


        // bind the parameters
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':contact_id', $info);
        $stmt->bindParam(':date_sent', $date_sent);

        // Execute the query
        if($stmt->execute()){

            //echo "<div class='alert alert-danger'>Successful!!!</div>";
            header("Location: ../message.php?result=success");


        }else{
            header("Location: ../message.php?result=failed");
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}





if(isset($_POST['draft_psms'])){

    try{

        $query = "INSERT INTO messages SET content=:content, subject=:subject, date_sent=:date_sent, is_contact=0, group_id=0, contact_id=:contact_id, 
        is_sent=0, is_draft=1";

        // prepare query for execution
         $stmt = $conn->prepare($query);


          // posted values
        $numbers=htmlspecialchars(strip_tags($_POST['numbers']));
        $subject=htmlspecialchars(strip_tags($_POST['subject']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
        $date_sent=htmlspecialchars(strip_tags($_POST['date_sent']));


        // bind the parameters
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':contact_id', $numbers);
        $stmt->bindParam(':date_sent', $date_sent);

        // Execute the query
        if($stmt->execute()){

            //echo "<div class='alert alert-danger'>Successful!!!</div>";
            header("Location: ../message.php?result=success");


        }else{
            header("Location: ../message.php?result=failed");
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}







if(isset($_POST['draft_grp'])){

    $c_name=htmlspecialchars(strip_tags($_POST['name']));

    try{

        $query = "INSERT INTO messages SET content=:content, subject=:subject, date_sent=:date_sent, is_contact=0, group_id=:group_id, contact_id=0, 
        is_sent=0, is_draft=1, is_group=1";

        // prepare query for execution
         $stmt = $conn->prepare($query);


          // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $subject=htmlspecialchars(strip_tags($_POST['subject']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
        $date_sent=htmlspecialchars(strip_tags($_POST['date_sent']));


        // bind the parameters
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':group_id', $c_name);
        $stmt->bindParam(':date_sent', $date_sent);

        // Execute the query
        if($stmt->execute()){

            //echo "<div class='alert alert-danger'>Successful!!!</div>";
            header("Location: ../message.php?result=success");


        }else{
            header("Location: ../message.php?result=failed");
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}








if(isset($_POST['send_grp'])){

    $group_contacts_id=htmlspecialchars(strip_tags($_POST['name']));

    $grp_query_group = "SELECT * FROM contacts WHERE group_id = '$group_contacts_id'";
    $grp_stm_group = $conn->prepare($grp_query_group);
    $grp_stm_group->execute();
    $ftsmsquerynum = $grp_stm_group->rowCount();


    try{

        $query = "INSERT INTO messages SET content=:content, subject=:subject, date_sent=:date_sent, is_contact=0, group_id=:contact_id, contact_id=0, 
        is_sent=1, is_draft=0, is_group=1";

        // prepare query for execution
         $stmt = $conn->prepare($query);


        // posted values
        $subject=htmlspecialchars(strip_tags($_POST['subject']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
        $date_sent=htmlspecialchars(strip_tags($_POST['date_sent']));


        // bind the parameters
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':contact_id', $group_contacts_id);
        $stmt->bindParam(':date_sent', $date_sent);

        // Execute the query
        if($stmt->execute()){

            if($ftsmsquerynum > 0){
                $count = 0;
                while($group_contacts = $grp_stm_group->fetch(PDO::FETCH_ASSOC)){
                    
                    $leaderTelarray[$count] = strval($group_contacts['number']);
                    $count++;
                    
                }

                $mystring = implode(";",$leaderTelarray);

            header("Location: ../send_group_message.php?number=$mystring&content=$content&subject=$subject&grpid=$group_contacts_id");
           

        }else{
            //header("Location: ../send_message.php?result=failed");
            echo "failed";
        }
    }
}

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}








if(isset($_POST['send_bulk'])){

    /*
    $group_contacts_id=htmlspecialchars(strip_tags($_POST['group_contacts']));

    $grp_query_group = "SELECT * FROM contacts WHERE group_id = '$group_contacts_id'";
    $grp_stm_group = $conn->prepare($grp_query_group);
    $grp_stm_group->execute();
    $ftsmsquerynum = $grp_stm_group->rowCount();
    */


    try{

        $query = "INSERT INTO messages SET content=:content, subject=:subject, date_sent=:date_sent, is_contact=0, group_id=0, contact_id=0, 
        is_sent=1, is_draft=0, is_bulk=1";

        // prepare query for execution
         $stmt = $conn->prepare($query);


        // posted values
        $subject=htmlspecialchars(strip_tags($_POST['subject']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
        $numbers=htmlspecialchars(strip_tags($_POST['numbers']));
        $date_sent=htmlspecialchars(strip_tags($_POST['date_sent']));


        // bind the parameters
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':date_sent', $date_sent);

        // Execute the query
        if($stmt->execute()){


            header("Location: ../send_bulk_message.php?number=$numbers&content=$content&subject=$subject");
           

        }else{
            //header("Location: ../send_message.php?result=failed");
            echo "failed";
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}








if(isset($_POST['send_priv_sms'])){

    /*
    $group_contacts_id=htmlspecialchars(strip_tags($_POST['group_contacts']));

    $grp_query_group = "SELECT * FROM contacts WHERE group_id = '$group_contacts_id'";
    $grp_stm_group = $conn->prepare($grp_query_group);
    $grp_stm_group->execute();
    $ftsmsquerynum = $grp_stm_group->rowCount();
    */


    try{

        $query = "INSERT INTO messages SET content=:content, subject=:subject, date_sent=:date_sent, is_contact=0, group_id=0, contact_id=0, 
        is_sent=1, is_draft=0, is_bulk=:is_bulk";

        // prepare query for execution
         $stmt = $conn->prepare($query);


        // posted values
        $subject=htmlspecialchars(strip_tags($_POST['subject']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
        $numbers=htmlspecialchars(strip_tags($_POST['numbers']));
        $date_sent=htmlspecialchars(strip_tags($_POST['date_sent']));


        // bind the parameters
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':is_bulk', $numbers);
        $stmt->bindParam(':date_sent', $date_sent);

        // Execute the query
        if($stmt->execute()){


            header("Location: ../send_bulk_message.php?number=$numbers&content=$content&subject=$subject");
           

        }else{
            //header("Location: ../send_message.php?result=failed");
            echo "failed";
        }
    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }	
}





