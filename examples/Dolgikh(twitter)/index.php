<?php
	require ('../../classes/twitter/twiapi.php');
	require "TwitterOAuth/autoload.php";//загрузка библиотеки
	use Abraham\TwitterOAuth\TwitterOAuth;
	$TwiApi = new TwiApi();
?>
<html>
	<Head>
		<meta charset="UTF-8" />
		<title>Twitter</title>
		<style>
			body{ 
				background-image: url(fon.jpg);
				background-size: cover;
			}
			.background {
				padding: 0px;
				background: #00B0ED;
				padding-left: 10px;
				margin-left: 55px;
				padding-right: 10px;
				margin-right: 55px;
			}
			.form{
				font-size: 32px;
				padding-top:0px;
				line-height: 0px;
				padding-left: 10px;
				margin-left: 55px;
				}
			.forms{	
				background: #00B0ED;
				height: 50px;
				line-height: 32px;
				color: #fff;
				text-shadow: 9px 0 0 rgb(63, 60, 60);
				font-size: 72px;
				font-weight: bold;
				padding-top:24px;
				padding-left: 10px;
				margin-left: 55px;
				padding-right: 10px;
				margin-right: 55px;
			}
		</style>
	</Head>
	<Body>
			<form class="forms" action="" method="post">
				<label>TWITTER LAB TVP</label>
			</form>
			<form class="form" action="" method="post">
				<label>Искать по хештэгу #: <input type="text" size="" name="search_hash" placeholder="              Search"> </label>
			</form>
			<form class="form" action="" method="post">
				<label>Искать по ключевому слову : <input type="text" name="search" placeholder="              Search"></label>
			</form>
	<div class="background">
	<table>
	
	<?php
	if ( isset($_POST['search_hash'])){
		$TwiApi->SearchByHashTags($_POST['search_hash']);
		}
	
	if ( isset($_POST['search'])){
		$TwiApi->SearchByKeyWord($_POST['search']);
		}
	?>
	
	</table>
	</div>
	</Body>
</html>