<?php
require_once('../common/config.php');
require_once('../common/db.php');
//verify with isset if we have customer key and with explode convert  from string to array
if (isset($_POST['customerIds'])) {
    $customerIds = explode(',', $_POST['customerIds']);
    $position = 0;
    $success = true;

//update list in database
    foreach ($customerIds as $customerId) {
        $customerId = (int)$customerId;
        $sql = 'UPDATE customers SET position = ' . $position++ . ' WHERE id = ' . $customerId;
        if (!mysqli_query($DBCONNECTION, $sql)) {
            $success = false;
            break;
        }
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $active = isset($_POST['active']) ? $_POST['active'] : 1;
        $sql = 'UPDATE customers SET `active` = ' . $active . ' WHERE id = ' . $id;
        if (mysqli_query($DBCONNECTION, $sql)) {
            $response = 'Success';
        } else {
            $response = 'Failed';
        }
        echo $response;
    } else {
        echo json_encode(['success' => true, 'message' => 'Positions updated successfully']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating positions']);
}
?>