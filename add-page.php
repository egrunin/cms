<?php ob_start();

 // set title and show header
$page_title = 'Add Page';
require('header.php'); 
?>
<?php
//initialize empty variable
$page_id = null;
$page_title = null;
$page_info = null;

//check for ID in the querystring
if ((!empty($_GET['page_id'])) && (is_numeric($_GET['page_id']))) {

// select page_id and store in variable
$page_id = $_GET['page_id'];

//connect
require('db.php'); 

    //select all the data for the appropriate id
    $sql = "SELECT * FROM page WHERE page_id = :page_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
    $cmd->execute();
    $page = $cmd->fetchAll();

    //store each value from the database into a variable
    foreach ($page as $data) {
        $page_title = $data['page_title'];
        $page_info = $data['page_info'];
    }
    
    //disconnect
    $conn = null;
}
?>

<h1>Add Page</h1>

<form method="post" action="save-addpage.php" enctype="multipart/form-data" class="form-horizontal">
    <div class="form-group">
        <label>Page Title:
            <input name="page_title" class="form-control" value="<?php echo $page_title; ?>">
        </label>
    </div>
    <div class="form-group">
        <label for="page_info">Page Info:</label>
        <textarea name="page_info" class="form-control" rows="10"><?php echo $page_info; ?>
        </textarea>
    </div>
    <input type="hidden" name="page_id" value="<?php echo $page_id; ?>" />
    <input type="submit" value="save" class="btn btn-primary">
</form>

<?php require('footer.php');
ob_flush(); ?>