<?php
	require ('../../classes/twitter/twiapishakirov.php');
	require "TwitterOAuth/autoload.php";
	
	use Abraham\TwitterOAuth\TwitterOAuth;
	$api = new TwiApi();
?>

<html>
	<Head>
		<meta charset="UTF-8" />
		<title>Search tweets</title>
		<style>
			.form {
				text-align: center;
			}
			
			.background {
				background-image: url(bg.png);
				background-position: left 40px;
				background-attachment: fixed;
				background-repeat: repeat;
				background-repeat: no-repeat;
				background-color: #C0DEED;
			}
			
		</style>
	</Head>
	<Body>
	<form class="form" action="" method="post">
	<label>Search # : <input type="text" name="keyword_hash" /></label>
	</form>
	<form class="form" action="" method="post">
	<label>Search keyword : <input type="text" name="keyword" /></label>
	</form>
	<div class="background">
	<table>
	<?php
	if ( isset($_POST['keyword_hash'])){
		$api->FindTweetsbyHashtag($_POST['keyword_hash']);
	}
	
	if ( isset($_POST['keyword'])){
		$api->FindTweetsbyKeyword($_POST['keyword']);
	}
	
	?>
	</table>
	</div>
	</Body>
</html>