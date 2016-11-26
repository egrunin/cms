<?php ob_start();
$page_title = 'Saving your page..';
require('header.php');
?>
<?php

 try {
     // initialize variables
    $page_title = null;
    $page_info = null;
    $page_id = null;
    
    // store the form inputs in variables
    $page_title = $_POST['page_title'];
    $page_info = $_POST['page_info'];
    $page_id = $_POST['page_id'];
    
    // validate our inputs
    $ok = true;
     
    if (empty($page_title)) {
        echo 'Title must be added!<br />';
        $ok = false;
    }
    if (empty($page_info)) {
        echo 'Info must be added!<br />';
        $ok = false;
    }

    // check if the form is ok to save or not
    if ($ok == true) {
        // connect to the db
        require('db.php');
        // set up the SQL command to save the data
        if (empty($page_id)) {
            $sql = "INSERT INTO page (page_title, page_info) VALUES (:page_title, :page_info)";
        } else {
            $sql = "UPDATE page SET page_title = :page_title, page_info = :page_info WHERE page_id = :page_id";
        }
        
        // create a command object
        $cmd = $conn->prepare($sql);
        
        // input each value into the proper field 
        $cmd->bindParam(':page_title', $page_title, PDO::PARAM_STR);
        $cmd->bindParam(':page_info', $page_info, PDO::PARAM_STR);
        
        // add the page_id if available
         if (!empty($page_id)) {
            $cmd -> bindParam(':page_id', $page_id, PDO::PARAM_INT);
        }
        
        //save
        $cmd->execute();
        
        //disconnect
        $conn = null;
        
        // redirect
        header('location:pages.php');
    }
 }
  catch (Exception $e) {
      mail('jack.grunin@gmail.com', 'Error', $e);
      header('location:error.php');
  }
?>
<?php require('footer.php');
ob_flush(); ?>
