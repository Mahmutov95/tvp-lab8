<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('652953054827427','b49af51fa67281d56221cbf693a079db');

class music {

private $music;
private $session;
	function prnt($arr){
				echo '<pre>';
				print_r($arr);
				echo '</pre>';	
			}
   public function __construct($token)
  {
   $this->session = new FacebookSession($token);
	try {
			$this->music =(new FacebookRequest($this->session, 'GET', '/me/music'))->execute()->getGraphObject();
		} catch (FacebookRequestException $e) {
			echo $e;
		} catch (Exception $e) {
			echo $e;
		}
   }
   
   public function GetMusic() {
		$temp = $this->music->getProperty('data')->backingData;
		$array;
		$i=0;
		$index = 0;
		while($index<count($temp)){
			
				$array[$i]['name'] = $temp[$index]->name;
				$array[$i]['id'] = $temp[$index]->id;
					$req = '/'.$temp[$index]->id.'/picture?redirect=false';
					$photo = (new FacebookRequest($this->session, 'GET', $req))->execute()->getGraphObject();
				$array[$i]['photo'] = $photo->getProperty('url'); 
					$req = '/'.$temp[$index]->id;
					$info = (new FacebookRequest($this->session, 'GET', $req))->execute()->getGraphObject()->backingData;
				$array[$i]['category'] = $temp[$index]->category;
				$array[$i]['created_time'] = $temp[$index]->created_time;
				$i++;
			
			$index++;
		}
		return $array;
   }
   

}
?>