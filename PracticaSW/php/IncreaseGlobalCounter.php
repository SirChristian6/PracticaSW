<?php 
	
	if(isset($_GET['email'])){
		$xml = simplexml_load_file('../xml/Counter.xml');
		$enc=false;

		foreach ($xml->xpath('//user') as $user) {
			if(strcmp($user['email'],$_GET['email'])==0){
				$enc=true;
				break;
			}
		}
		if(!$enc){
			$user = $xml->addChild('user');
			$user->addAttribute('email', $_GET['email']);
		}
		$xml->asXML('../xml/Counter.xml');
		echo("<script>location.href='Layout.php?email=".$_GET['email']."';</script>");
	}
?>
