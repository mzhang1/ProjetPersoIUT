<?php
    require_once('stockDB.php');
    $stockDB = new stockDB();

    $user_id = $_REQUEST['user_id'];
    $requestName = $_REQUEST['req'];

    switch ($requestName) {
        case 'getUserRecords':
            $records = $stockDB->getUserStockFiles($user_id);
            echo json_encode($records);
            break;
        case 'addProduct':
            $file_id = $_REQUEST['file_id'];
            $products = $stockDB->addFileProduct($file_id);
            echo json_encode($products);
            break;
        default:
            echo "No request found";
            break;
    }
?>
