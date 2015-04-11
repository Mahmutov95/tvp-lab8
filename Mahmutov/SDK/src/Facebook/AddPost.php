<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('1403157526657409','6e79d4d81541378d2dfbb7b90225b2d5');

class User {

private $me;
private $photo;
private $session;

public function __construct($token)
  {
   $this->session = new FacebookSession($token);
	try {
			$this->me =( new FacebookRequest($this->session, 'GET', '/me'))->execute()->getGraphObject();
			
			
			//$me->getName().'<br>';
			//$me->getId().'<br>';
			//date('d.m.Y', $me->getBirthday()->getTimestamp());
			//$me->getEmail().'<br>';
		} catch (FacebookRequestException $e) {
			echo $e;
		} catch (Exception $e) {
			echo $e;
		}
   }

}
?>