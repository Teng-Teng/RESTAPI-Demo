<?php 

header("Content-Type:application/json");
require_once "Database.php";

function response($status, $status_message, $data) {
	header("HTTP/1.1" . $status);

	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;
	$response['time'] = "18.04.16";

	$json_response = json_encode($response);
	echo $json_response;

}

if(!empty($_GET['first-var'])) {
	$first = $_GET['first-var'];

	if($first == 'select') {
        $id = $_GET['second-var'];
        $conn = new Database();
        $result = $conn->selectItemById($id);

        return json_encode($result);

    } else if($first == 'insert') {
        $name = $_GET['second-var'];
        $quantity = $_GET['third-var'];

        $conn = new Database();
        $result = $conn->insertItem($name, $quantity);

        return json_encode($result);

    } else if($first == 'update') {
        $id = $_GET['second-var'];
        $cur = $_GET['third-var'];

        $conn = new Database();
        $result = $conn->updateItem($id, $cur);

        return json_encode($result);

    } else if($first == 'delete') {
        $id = $_GET['second-var'];

        $conn = new Database();
        $result = $conn->deleteItemById($id);

        return json_encode($result);

    } else {
	    echo 'wrong bro';
    }

} else {
	response(400, "Invalid Request", NULL);
}