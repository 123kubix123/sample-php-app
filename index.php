<?php

require_once 'config.php';
$hostname = gethostname();
$dsn= "mysql:host=$host;dbname=$db";

echo 'Application host: <b>'.$hostname.'</b><br/>';

try {
	$conn = new PDO($dsn, $username, $password);
	
	if($conn) {
		if($percona_xtradb_cluster) {
			$mysql_server = $conn->query("select @@wsrep_node_address")->fetch();
			echo 'Database connection succesfull, node IP: '.$mysql_server[0].'<br/>';
		}
		else {
			echo 'Database connection succesfull.<br/>';
		}
		
		$info = $conn->query("SELECT * FROM example LIMIT 1")->fetch();
		echo $info[0].'<br/>';
		phpinfo();
		
	}
} catch (PDOException $e) {
	
	echo $e->getMessage();

}

?>