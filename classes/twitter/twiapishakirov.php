<?
	require "TwitterOAuth/autoload.php";
	
	use Abraham\TwitterOAuth\TwitterOAuth;

	define(consumer, 'ZbxMUdovmuoOCgXiX2ibOfbJ4');
	define(consumersecret, 'PpuceVRmc5nIQz7sk1sv0AtB3p3nqcSnRaQvclWV5kBoJxXphk');
	define(accestoken, '3146897553-XQPi8cBClRIOExenxqfw1RP0qa9hF8FPPL42YOH');
	define(accestokensecret, 'RMRDVt1lCdkcwaDrU8viaS5u2KhVejMI7AYm9pwvIJnSv');
	
	class TwiApi
	{
		public $connection;
		function FindTweetsbyHashtag($hash)
		{
			$this->connection = new TwitterOAuth(consumer, consumersecret, accestoken, accestokensecret);
			$tweetss = $this->connection ->get("search/tweets", array("q" => "#".$hash, "result_type"=>"recent", "count"=>"50"));
			foreach($tweetss as $tweet){
				foreach($tweet as $t){
					echo '<tr>';
					echo '<td> <img src="'.$t->user->profile_image_url.'" /> </td>';
					echo "<td>".$t->text."</td>";
					echo '</tr>';
				}
			}
		}
		
		function FindTweetsbyKeyword($keyword)
		{
			$this->connection = new TwitterOAuth(consumer, consumersecret, accestoken, accestokensecret);
			$tweetss = $this->connection ->get("search/tweets", array("q" => $keyword, "result_type"=>"recent", "lang"=>"ru", "count"=>"50"));
			foreach($tweetss as $tweet){
				foreach($tweet as $t){
					echo '<tr>';
					echo '<td> <img src="'.$t->user->profile_image_url.'" /> </td>';
					echo "<td>".preg_replace("/({$keyword})/iu", '<strong>$1</strong>', $t->text)."</td>";
					echo '</tr>';
				}
			}
		}
	}
?>