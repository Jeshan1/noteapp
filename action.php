<?php
if (isset($_POST['submit_add'])) {
    $title = $_POST['title'];
    $desc  = $_POST['description'];

    $qry = "insert into tbnote(title,description) values('".$title."','".$desc."')";

    include 'includes/dbconnect.php';
    $con->query($qry);
    include 'includes/dbclose.php';

    echo '<script>window.location = "index.php";</script>';
}

if (isset($_POST['submit_delete'])) {
    $id = $_POST['id'];
    $qry = "delete from tbnote where id ='".$id."'";
    include 'includes/dbconnect.php';
    $con->query($qry);
    include 'includes/dbclose.php';
    echo '<script>window.location = "index.php";</script>';
}

  
    


    // $id = $_GET['id'];
    // $qry = "select * from tbnote where id = '".$id."'";
    // include 'includes/dbconnect.php';
    // $delete = $con->query($qry);
    // if($delete->num_rows>0){
    //     $data = array();
    //     while ($row = $delete->fetch_assoc()) {
    //         $data[] = $row;
    //     }
    // }
    // include 'includes/dbclose.php';
    // echo json_encode($record);
    // exit;


?>