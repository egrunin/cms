<?php ob_start();
// auth check 
require('auth.php');
// set title
$page_title = 'Pages';
require('header.php');
?>
<h1>Pages</h1>
<a href="add-page.php">Add Page</a>
<?php
try {
    // connect
    require('db.php'); 

    // prepare the query
    $sql = "SELECT * FROM page";
    $cmd = $conn -> prepare($sql);

    // run the query and store the results
    $cmd -> execute();
    $page = $cmd -> fetchAll();

    // start the grid with HTML
    echo '<table class="table table-striped"><thead><th>Page Title</th>
        <th>Edit</th><th>Delete</th></thead><tbody>';

    /* loop through the data, displaying each value in a new column
    and each page in a new row */
    foreach($page as $data) {
        echo '<tr>
                <td>' . $data['page_title'] . '</td>
                <td><a href="add-page.php?page_id=' . $data['page_id'] . '" title="Edit">Edit</a></td>
                <td><a href="page-delete.php?page_id=' . $data['page_id'] . '"
                title="Delete" class="confirmation">Delete</a></td>
            </tr>';
    }

    // close the HTML grid
    echo '</tbody></table>';
}
catch (Exception $e) {
    // send ourselves the error 
    mail('jack.grunin@gmail.com', 'Error', $e);
    header('location:404.php');
}
// disconnect
    $conn = null;
?>
<?php require('footer.php');
ob_flush(); ?>

