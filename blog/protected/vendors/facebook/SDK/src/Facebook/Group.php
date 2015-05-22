<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('1122289907787189','f46ab637962fb1491b956ccc2154a7d5');

class Group {

private $groups;
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
			$this->groups =(new FacebookRequest($this->session, 'GET', '/me/groups'))->execute()->getGraphObject();
		} catch (FacebookRequestException $e) {
			echo $e;
		} catch (Exception $e) {
			echo $e;
		}
   }
   
   public function GetGroups() {
		$temp = $this->groups->getProperty('data')->backingData;
		$array;
		$i=0;
		$index = 0;
		while($index<count($temp)){
			if($temp[$index]->administrator=='1') {
				$array[$i]['name'] = $temp[$index]->name;
				$array[$i]['id'] = $temp[$index]->id;
					$req = '/'.$temp[$index]->id.'/picture?redirect=false';
					$photo = (new FacebookRequest($this->session, 'GET', $req))->execute()->getGraphObject();
				$array[$i]['photo'] = $photo->getProperty('url'); 
					$req = '/'.$temp[$index]->id;
					$info = (new FacebookRequest($this->session, 'GET', $req))->execute()->getGraphObject()->backingData;
				$array[$i]['description'] = $info['description'];
				$array[$i]['email'] = $info['email'];
				$array[$i]['privacy'] = $info['privacy'];
				$i++;
			}
			$index++;
		}
		return $array;
   }
   

}
?>