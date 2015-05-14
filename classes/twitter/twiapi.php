<?
	require "TwitterOAuth/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;

	define(CONSUMER_KEY, 'Jky813XwbmOXCiE3barLsq5QT');
	define(CONSUMER_SECRET, 'AtgwEFXAblqEccb3WlKM1tINz8aqF8TZP3T2UZ0kH9UQBhCDDY');
	define(OAUTH_CALLBACK, 'oob');
	
	
	define("CONSUMER_KEY_1", "OK62r0UsSIZgcReixxgjQG9bj");
	define("CONSUMER_SECRET_1", "YwmvamiM2sHmrGIwvcOr6Ls6vXYUVh3fJFLUpnCKdwuYYsGBj3");
	define("OAUTH_TOKEN", "2362321468-U90WvkudGKmmdvFMDBXtYar6pIDVmwj4i2TkmlL");
	define("OAUTH_SECRET", "dXfTr2IVy2wX7d6kWwqRS2SOUY2WaNqmofg36V9VrMWA5");
	$count = 10;

	class TwiApi
	{
		public $connection;

		
		function SearchByHashTags($ht)
		{
			$this->connection = new TwitterOAuth(CONSUMER_KEY_1, CONSUMER_SECRET_1, OAUTH_TOKEN, OAUTH_SECRET);
			$statuses = $this->connection ->get("search/tweets", array("q" => "#".$ht, "count" => $count));
			foreach($statuses as $twit){
				foreach($twit as $tweet){
					echo '<tr>';
					echo '<td> <img src="'.$tweet->user->profile_image_url.'" /> </td>';
					echo "<td>".$tweet->user->name."</td>";
					echo "<td>".preg_replace("/({$ht})/iu", '<strong>$1</strong>', $tweet->text)."</td>";
					echo '</tr>';
				}
			}
		}
		
		function SearchByKeyWord($word)
		{
			$this->connection = new TwitterOAuth(CONSUMER_KEY_1, CONSUMER_SECRET_1, OAUTH_TOKEN, OAUTH_SECRET);
			$statuses = $this->connection ->get("search/tweets", array("q" => $word, "count" => $count));
			foreach($statuses as $twit){
				foreach($twit as $tweet){
					echo '<tr>';
					echo '<td> <img src="'.$tweet->user->profile_image_url.'" /> </td>';
					echo "<td>".$tweet->user->name."</td>";
					echo "<td>".preg_replace("/({$word})/iu", '<strong>$1</strong>', $tweet->text)."</td>";
					echo '</tr>';
				}
			}
		}
		
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
	}
?>