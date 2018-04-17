<?php 

header("Content-Type:application/json");
require_once "Database.php";

if(!empty($_GET['first-var'])) {
	$first = $_GET['first-var'];

	if($first == 'select') {
        $id = $_GET['second-var'];
        $conn = new Database();
        $result = $conn->selectItemById($id);

        echo json_encode($result);

    } else if($first == 'insert') {
        $name = $_GET['second-var'];
        $quantity = $_GET['third-var'];

        $conn = new Database();
        $result = $conn->insertItem($name, $quantity);

        echo json_encode($result);
    }
    else if($first == 'update') {
        $id = $_GET['second-var'];
        $cur = $_GET['third-var'];

        $conn = new Database();
        $result = $conn->updateItem($id, $cur);

        echo json_encode($result);

    } else if($first == 'delete') {
        $id = $_GET['second-var'];

        $conn = new Database();
        $result = $conn->deleteItemById($id);

        echo json_encode($result);

    } else {
	    echo 'wrong bro';
    }

} else {
	response(400, "Invalid Request", NULL);
}