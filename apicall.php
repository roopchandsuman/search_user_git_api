<?php
function curl_get_contents($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	
	$output = curl_exec($ch);	
	curl_close($ch);
	return $output;	
}

$name = $_POST['name'];
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$perpage = isset($_POST['perpage']) ? $_POST['perpage'] : 30;

$result = curl_get_contents('https://api.github.com/search/users?q='.$name.'&per_page='.$perpage.'&page='.$page);
$response = array('page' => $page, 'data' => $result);
header('Content-Type: application/json');
echo json_encode($response);
?>