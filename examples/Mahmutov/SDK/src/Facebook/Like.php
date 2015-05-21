<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('652953054827427','b49af51fa67281d56221cbf693a079db');

class Like {

private $pages;
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
			$this->likes =(new FacebookRequest($this->session, 'GET', '/me/likes?locale=ru_RU'))->execute()->getGraphObject();
		} catch (FacebookRequestException $e) {
			echo $e;
		} catch (Exception $e) {
			echo $e;
		}
   }
   
   public function GetLikes() {
		$temp = $this->likes->getProperty('data')->backingData;
		$array;
		$i=0;
		while($i<count($temp)){
			$array[$i]['name'] = $temp[$i]->name;
			$array[$i]['id'] = $temp[$i]->id;
			$array[$i]['category'] = $temp[$i]->category;
			$array[$i]['created_time'] = $info['created_time'];
			$i++;
		}
		return $array;
   }
   

}
?>