<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('1122289907787189','f46ab637962fb1491b956ccc2154a7d5');

class User {

private $me;
private $photo;
private $session;

public function __construct($token)
  {
   $this->session = new FacebookSession($token);
	try {
			$this->me =( new FacebookRequest($this->session, 'GET', '/me?locale=ru_RU'))->execute()->getGraphObject();
		} catch (FacebookRequestException $e) {
			echo $e;
		} catch (Exception $e) {
			echo $e;
		}
   }
   
   public function Name(){//
		return $this->me->getProperty('name');
   }
   
   public function Photo(){//
		$this->photo = (new FacebookRequest($this->session, 'GET', '/me/picture?type=large&redirect=false'))->execute()->getGraphObject();
		return $this->photo->getProperty('url'); 
   }
   
   public function Educations() {//
		$temp = $this->me->getProperty('education')->backingData;
		$array;
		$i=0;
		while($i<count($temp)){
			$array[$i]['name'] = $temp[$i]->school->name;
			$array[$i]['type'] = $temp[$i]->type;
			$array[$i]['year'] = $temp[$i]->year->name;
			$i++;
		}
		return $array;
   }
   
   public function Birthday(){
		return $this->me->getProperty('birthday');
   }
   
   public function Email(){
		return $this->me->getProperty('email');
   }
   public function Gender(){
		return $this->me->getProperty('gender');
   }
   
   public function HomeSweetHome(){
		return $this->me->getProperty('hometown')->backingData['name'];
   }
   
   public function Location(){
		return $this->me->getProperty('location')->backingData['name'];
   }
}
?>