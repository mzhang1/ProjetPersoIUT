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
        case 'updateProduct':
            $record_id = $_REQUEST['record_id'];
            $product_id = $_REQUEST['product_id'];
            $product_name = $_REQUEST['newProductName'];
            $product_category = $_REQUEST['newProductCategory'];
            $product_price = $_REQUEST['newProductPrice'];
            $product_supplier = $_REQUEST['newProductSupplier'];
            $products = $stockDB->updateFileProduct($record_id,$product_id,$product_name,$product_category,
                $product_price,$product_supplier);
            echo json_encode($products);
            break;
        case 'deleteProduct':
            $product_id = $_REQUEST['product_id'];
            $record_id = $_REQUEST['record_id'];
            $products = $stockDB->deleteFileProduct($product_id,$record_id);
            echo json_encode($products);
            break;
        case 'addNewEntry':
            $qty_product = $_REQUEST['qty'];
            $product_id = $_REQUEST['productId'];
            $record_id = $_REQUEST['record_id'];
            $updatedData = $stockDB->addNewEntry($product_id,$record_id,$qty_product);
            echo json_encode($updatedData);
            break;
        case 'addNewOutput':
            $qty_product = $_REQUEST['qty'];
            $product_id = $_REQUEST['productId'];
            $record_id = $_REQUEST['record_id'];
            $updatedData = $stockDB->addNewOutput($product_id,$record_id,$qty_product);
            echo json_encode($updatedData);
            break;
        default:
            echo "No request found";
            break;
    }
?>
