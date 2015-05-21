<?
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('662237537232706','923094cd9a78faf6048c9991dafd5756');

class User {

private $me;
private $photo;
private $session;

public function __construct()
  {
   $this->session = new FacebookSession('CAAJaTTEp50IBAJS6LOdd48eF0IwgLiVsOuVoir81LeACkp0mqrvUZBMCBk1f9ZCTzVxqbEkNcfXhpUHDPtydEP1vqlr8M6m7odCkUJ6oT5g3dCzg9T79IIieZBiEWCpeu8kMukD8G713nsSwb9oPDgL8QtNofPipXacWlUZBIYFPyOn7g0zMpbXqDOqZBSuNuhZABKUQZCMXha1uzZA5BsOT');
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
   
   public function Name(){
		return $this->me->getProperty('name');
   }
   
   public function Photo(){
		$this->photo = (new FacebookRequest($this->session, 'GET', '/105534712912544/picture?redirect=false'))->execute()->getGraphObject();
		return $this->photo->getProperty('url');
		//return str_replace("\r\n","",$this->photo->getProperty('url'));	 
   }
}
?>