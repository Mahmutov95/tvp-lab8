<html>
<head>
<style>
	.header {
		width: 880px;
		margin-left: 228px;	
	}
	.headere {
		background: rgb(67,96,156);
		width: 100%;
		border-radius: 10px 10px 10px 10px;
		text-align:center;
	}
</style>
</head>
<body>
<div class="header"><div class="headere"><font color="#FFFFFF" face="Times New Roman, Times, serif" size="+4">TheFacebook.Inc</font></div>
<?php
require __DIR__ . '/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('662237537232706','923094cd9a78faf6048c9991dafd5756');

$session = new FacebookSession('CAAJaTTEp50IBAOvmSEZBLAbSBDbDFrcRQ6SYlMZAsmFQJTgB0kDwgkvzfgVZBZBHPbW42uiTepV0YZCuTzUZCxB0fZCbsYudaZCqP4dSwk7oIO1nOukA2DiTaNKOPZBwZACb0J0IwFZBAZB8sce91qWF0JZC1FhqZA3vxZBVUzPIISt2DWCXGzt49fEyTIGJWcnjXkeUGBtzId7PSqhkiBuDdAqy8COChKY5ZCd8Tx8ZD');

if($session) {
  try {
	$me = (new FacebookRequest( $session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
	$photo = (new FacebookRequest($session, 'GET', '/209803312520889/picture?redirect=false'))->execute()->getGraphObject();
	$faki=$photo->getProperty('url');
	echo "<br><img src='$faki'>";
	echo '<div class="head">'.$me->getName().'</div>';
	echo $me->getEmail();
	echo '<br>';
	$photo = "";
	if (!empty($_FILES))
	{
		print_r($_FILES['photo']['type']);
		$photo = $_FILES['photo']['tmp_name'];
	}
	
	$fak = $_POST['comments'];
	
	if (!empty($photo))
	{	
		if (substr_count($_FILES['photo']['type'], 'video')>0)
		{
    		$response = (new FacebookRequest(
    		$session, 'POST', '/me/videos', array(
        	'source' => new CURLFile($photo, $_FILES['photo']['type']),
        	'message' => $fak
      )
    )
		
	)
	->execute()->getGraphObject();
		}	
		if (substr_count($_FILES['photo']['type'], 'image')>0)
		{
    		$response = (new FacebookRequest(
    		$session, 'POST', '/me/photos', array(
        	'source' => new CURLFile($photo, $_FILES['photo']['type']),
        	'message' => $fak
      )
    )
		
	)
	->execute()->getGraphObject();
		}	
		
    //echo "Posted with id: " . $response->getProperty('id');	
	}
  } catch(FacebookRequestException $e) {
    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();
  }  
}
?>
<form enctype="multipart/form-data" action="index.php" method="post">
	<input type="file" name="photo"/>
    <input type="submit" value="Загрузить"/><br><br>
    <input type="text" name="comments"/>
</form>

<?
if($session) {
  try {
	$meF = (new FacebookRequest( $session, 'GET', '/me/posts'))->execute()->getGraphObject();
	echo '<pre>';
	//print_r($meF->backingData['data']);
	echo '</pre>';
	for ($i = 1; $i <= 20; $i++)
	{
		if	(!empty($meF->backingData['data'][$i]->source))
		{
			echo '<video width="300" height="150" controls="controls" poster="video/duel.jpg"><source src="'.$meF->backingData['data'][$i]->source.'"></video><br>';
		}
		else
		{
			if (!empty($meF->backingData['data'][$i]->picture))
			{
			echo '<img src="'.$meF->backingData['data'][$i]->picture.'" width="300" height="150">';
			echo '<br>';
			echo $meF->backingData['data'][$i]->message;
			echo '<br>';
			}
		}
	}
  		} catch(FacebookRequestException $e) {
    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();
  											}  
}
?>
</div>
</body>
</html>