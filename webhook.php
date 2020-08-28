<?php
try {
	$data = file_get_contents('php://input'));
	file_put_contents("./webhook.txt", $data);	
}catch(Exception $e) {
	echo '<b>ERROR:</b> ', $e->getMessage(), '<br/>';
}
