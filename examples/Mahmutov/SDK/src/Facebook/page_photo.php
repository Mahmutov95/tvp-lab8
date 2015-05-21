<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('652953054827427','b49af51fa67281d56221cbf693a079db');

class page_photo {
private $pages;
private $session;
//$no=0;
	function prnt($arr){
				echo '<pre>';
				print_r($arr);
				echo '</pre>';	
			}
  public function __construct($token,$no)
  {
   $this->session = new FacebookSession($token);
	try {
			$this->page_photo =(new FacebookRequest($this->session, 'GET', '/'.$no.'/photos?locale=ru_RU'))->execute()->getGraphObject();
		} catch (FacebookRequestException $e) {
			echo $e;
		} catch (Exception $e) {
			echo $e;
		}
   }
   public function Photo(){//
		return $this->page_photo->getProperty('picture'); 
   }

}