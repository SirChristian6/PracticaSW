<?php include '../php/Security.php' ?>
<?php
	if($encontrado!=0){
		$xml = simplexml_load_file("../xml/Counter.xml");

		foreach($xml->children() as $user){
		    if($user['email']==$_SESSION['email']){
		        unset($user[0]);
		        break;
		    }
		}
		$xml->asXML("../xml/Counter.xml") ;
		
	}
	echo("<script>location.href='LogOut.php';</script>");
?>