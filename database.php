<?php
	try{
		$conn = new PDO('mysql:host=sql.freedb.tech;dbname=freedb_mydatabase-lucasywamoto','freedb_lucasywamoto','8#z%zs8m!@NXYB!');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
?>
