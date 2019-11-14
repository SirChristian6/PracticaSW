<?php
	if(isset($_GET['email'])){
		$xml = simplexml_load_file("../xml/Counter.xml");

		foreach($xml->children() as $user){
		    if($user['email']==$_GET['email']){
		        unset($user[0]);
		        break;
		    }
		}

		$xml->asXML("../xml/Counter.xml") ;
		echo("<script>alert('Vuelva pronto'); location.href='Layout.php';</script>");
	}
?>