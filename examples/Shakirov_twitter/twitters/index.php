<?php
	require "TwitterOAuth/autoload.php";
	use Abraham\TwitterOAuth\TwitterOAuth;
?>
<?php
	$consumer = "ZbxMUdovmuoOCgXiX2ibOfbJ4";
	$consumersecret = "PpuceVRmc5nIQz7sk1sv0AtB3p3nqcSnRaQvclWV5kBoJxXphk";
	$accestoken = "3146897553-XQPi8cBClRIOExenxqfw1RP0qa9hF8FPPL42YOH";
	$accestokensecret = "RMRDVt1lCdkcwaDrU8viaS5u2KhVejMI7AYm9pwvIJnSv";
	
	$twitter = new TwitterOAuth($consumer,$consumersecret,$accestoken,$añcestokensecret);
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
		$tweetss = $twitter->get("search/tweets", array("q" => "#".$_POST['keyword_hash'], "result_type"=>"recent", "count"=>"50"));
		foreach($tweetss as $tweet){
			foreach($tweet as $t){
				echo '<tr>';
				echo '<td> <img src="'.$t->user->profile_image_url.'" /> </td>';
				echo "<td>".$t->text."</td>";
				echo '</tr>';
			}
		}
	}
	
	if ( isset($_POST['keyword'])){
		$tweetss = $twitter->get("search/tweets", array("q" => $_POST['keyword'], "result_type"=>"recent", "lang"=>"ru", "count"=>"50"));
		foreach($tweetss as $tweet){
			foreach($tweet as $t){
				echo '<tr>';
				echo '<td> <img src="'.$t->user->profile_image_url.'" /> </td>';
				echo "<td>".preg_replace("/({$_POST['keyword']})/iu", '<strong>$1</strong>', $t->text)."</td>";
				echo '</tr>';
			}
		}
	}
	
	?>
	</table>
	</div>
	</Body>
</html>