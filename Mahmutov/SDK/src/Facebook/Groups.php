<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('652953054827427','b49af51fa67281d56221cbf693a079db');

class Groups {

private $groups;
private $session;
public function __construct($token,$no)
  {
   $this->session = new FacebookSession($token);
	try {
			$this->groups =(new FacebookRequest($this->session, 'GET', '/'.$no))->execute()->getGraphObject();
		} catch (FacebookRequestException $e) {
			echo $e;
		} catch (Exception $e) {
			echo $e;
		}
   }
    public function Photo(){//
		
		$no = $_GET['f'];

		$this->photos = (new FacebookRequest($this->session, 'GET', '/'.$no.'/picture?redirect=false'))->execute()->getGraphObject();
		return $this->photos->getProperty('url'); 
   }
   public function Name(){
		return $this->groups->getProperty('name');
   }
   public function email(){
		return $this->groups->getProperty('email');
   }
   public function description(){
		return $this->groups->getProperty('description');
   }
   public function updated_time(){
		return $this->groups->getProperty('updated_time');
   }
   public function owner(){
		return $this->groups->getProperty('owner')->backingData['name'];
   }
   public function privacy(){
		return $this->groups->getProperty('privacy'); 
   }
}
?>