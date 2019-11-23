<?php include 'Security.php' ?>
<?php 
	if($encontrado!=0){
		$xml = simplexml_load_file('../xml/Counter.xml');
		$enc=false;

		foreach ($xml->xpath('//user') as $user) {
			if(strcmp($user['email'],$_SESSION['email'])==0){
				$enc=true;
				break;
			}
		}
		if(!$enc){
			$user = $xml->addChild('user');
			$user->addAttribute('email', $_SESSION['email']);
		}
		$xml->asXML('../xml/Counter.xml');
	}
	echo("<script>location.href='Layout.php';</script>");
?>
