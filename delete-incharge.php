<?php
include "config/db.php";

$delId = $_GET['id'];


$del = mysqli_query($db_con, "UPDATE incharge SET status=0 where id='" . $_GET['id'] . "'");

if ($del) {


    echo '<script>alert("Deleted Successfully")</script>';
    echo '<script>window.location.href="billings.php"</script>';
} else {
    echo '<script>alert("Failed to Delete")</script>';
}
