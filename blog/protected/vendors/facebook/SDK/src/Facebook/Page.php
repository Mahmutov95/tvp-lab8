<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('1122289907787189','f46ab637962fb1491b956ccc2154a7d5');

class Page {

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
			$this->pages =(new FacebookRequest($this->session, 'GET', '/me/accounts?locale=ru_RU'))->execute()->getGraphObject();
		} catch (FacebookRequestException $e) {
			echo $e;
		} catch (Exception $e) {
			echo $e;
		}
   }
   
   public function GetPages() {
		$temp = $this->pages->getProperty('data')->backingData;
		$array;
		$i=0;
		while($i<count($temp)){
			$array[$i]['name'] = $temp[$i]->name;
			$array[$i]['id'] = $temp[$i]->id;
			$array[$i]['category'] = $temp[$i]->category;
				$req = '/'.$temp[$i]->id.'/picture?redirect=false';
				$photo = (new FacebookRequest($this->session, 'GET', $req))->execute()->getGraphObject();
			$array[$i]['photo'] = $photo->getProperty('url'); 
				$req = '/'.$temp[$i]->id.'?locale=ru_RU';
				$info = (new FacebookRequest($this->session, 'GET', $req))->execute()->getGraphObject()->backingData;
			$array[$i]['likes'] = $info['likes'];
			$array[$i]['link'] = $info['link'];
			$i++;
		}
		return $array;
   }
   

}
?>