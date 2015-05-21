<?php
	require "TwitterOAuth/autoload.php";//загрузка библиотеки
	use Abraham\TwitterOAuth\TwitterOAuth;
?>
<?php
	define("CONSUMER_KEY", "OK62r0UsSIZgcReixxgjQG9bj");
	define("CONSUMER_SECRET", "YwmvamiM2sHmrGIwvcOr6Ls6vXYUVh3fJFLUpnCKdwuYYsGBj3");
	define("OAUTH_TOKEN", "2362321468-U90WvkudGKmmdvFMDBXtYar6pIDVmwj4i2TkmlL");
	define("OAUTH_SECRET", "dXfTr2IVy2wX7d6kWwqRS2SOUY2WaNqmofg36V9VrMWA5");
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_SECRET);
	$count = 10;
?>
<html>
	<Head>
		<meta charset="UTF-8"/>
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
		//TwitterOAuth
		$statuses = $connection->get("search/tweets", array("q" => "#".$_POST['search_hash'], "count" => $count));
		foreach($statuses as $twit){
			foreach($twit as $tweet){
				echo '<tr>';
				echo '<td> <img src="'.$tweet->user->profile_image_url.'" /> </td>';
				echo "<td>".$tweet->user->name."</td>";
				echo "<td>".$tweet->text."</td>";
				echo '</tr>';
			}
		}
	}
	
	if ( isset($_POST['search'])){
		//TwitterOAuth
		$statuses = $connection->get("search/tweets", array("q" => $_POST['search'], "count" => $count));
		foreach($statuses as $twit){
			foreach($twit as $tweet){
				echo '<tr>';
				echo '<td> <img src="'.$tweet->user->profile_image_url.'" /> </td>';
				echo "<td>".$tweet->user->name."</td>";
				echo "<td>".$tweet->text."</td>";
				echo '</tr>';
			}
		}
	}
	
	?>
			</table>
			</div>
	</Body>
</html>