<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('652953054827427','b49af51fa67281d56221cbf693a079db');

class page {

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
			$this->pages =(new FacebookRequest($this->session, 'GET', '/'.$no.'?locale=ru_RU'))->execute()->getGraphObject();
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
  public function about(){
		return $this->pages->getProperty('about'); 
   }
    public function awards(){
		return $this->pages->getProperty('awards'); 
   }
    public function category(){
		return $this->pages->getProperty('category'); 
   }
    public function founded(){
		return $this->pages->getProperty('founded'); 
   }
    public function name(){
		return $this->pages->getProperty('name'); 
   }
    public function phone(){
		return $this->pages->getProperty('phone'); 
		
   }
   public function likes(){
		return $this->pages->getProperty(';ikes');
	}
    public function website(){
		return $this->pages->getProperty('website'); 
   }
   public function city(){
		return $this->pages->getProperty('location')->backingData['city']; 
   }
   public function country(){
		return $this->pages->getProperty('location')->backingData['country'];	
   }
   public function street(){
		return $this->pages->getProperty('location')->backingData['street'];	
   }
   public function zip(){
		return $this->pages->getProperty('location')->backingData['zip'];	
   }
}
?>