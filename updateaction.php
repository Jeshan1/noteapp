<?php

if (isset($_POST['submit_update'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $id = $_POST['id'];
    $qry = "update tbnote set title='".$title."',description='".$desc."' where id='".$id."'";   
    include 'includes/dbconnect.php';
    $con->query($qry);
    // $con->execute_query($qry);
    include 'includes/dbclose.php';

    echo '<script>window.location = "index.php";</script>';
}



function update(){
    $id = $_GET['id'];
    $qry="select * from tbnote where id = '".$id."'";
    include 'includes/dbconnect.php';
    $result = $con->query($qry);
    if ($result->num_rows>0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
    exit;
    include 'includes/dbclose.php';
    
    
}
update();



?>