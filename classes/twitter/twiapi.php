<?
	require "TwitterOAuth/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;

	define(CONSUMER_KEY, 'Jky813XwbmOXCiE3barLsq5QT');
	define(CONSUMER_SECRET, 'AtgwEFXAblqEccb3WlKM1tINz8aqF8TZP3T2UZ0kH9UQBhCDDY');
	define(OAUTH_CALLBACK, 'oob');

	class TwiApi
	{
		public $connection;

		function __construct()
		{
			session_start();
			$this->connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
			$requestToken = $this->connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
			$_SESSION['oauthToken'] = $requestToken['oauth_token'];
			$_SESSION['oauthTokenSecret'] = $requestToken['oauth_token_secret'];
		}

		function GetFollowersIds($param, $val)
		{
			return $this->connection->get("followers/ids", array($param => $val))->ids;
		}

		function GetFollowersList($param, $val)
		{
			return $this->connection->get("followers/list", array($param => $val));
		}

		function GetAccountSettings()
		{
			$response = $this->connection->get("account/settings");
			$result = $response;
			return $result;
		}

		function GetUsersLookup($param, $val)
		{
			return $this->connection->get("users/lookup", array($param => $val));
		}

		function GetFriendsIdsByScreenName($sn)
		{
			$response = $this->connection->get("friends/ids", array("screen_name" => $sn));
			$correct = $response->ids;
			$result = $correct;
			return $result;
		}

		function GetFriendsListByScreenName($sn)
		{
			$response = $this->connection->get("friends/list", array("screen_name" => $sn));
			$correct = $response->users;
			$result = $correct;
			return $result;
		}
		
		function FindTweetsbyHashtag ($hash)
		{
			$tweetss = $this->connection->get("search/tweets", array("q" => "#"$hash, "result_type"=>"recent", "count"=>"50"));
			foreach($tweetss as $tweet){
				foreach($tweet as $t){
					echo '<tr>';
					echo '<td> <img src="'.$t->user->profile_image_url.'" /> </td>';
					echo "<td>".$t->text."</td>";
					echo '</tr>';
				}
			}
		}
		
		function FindTweetsbyKeyword ($keyword)
		{
		$tweetss = $this->connection->get("search/tweets", array("q" => $keyword, "result_type"=>"recent", "lang"=>"ru", "count"=>"50"));
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