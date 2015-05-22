<?php
namespace Facebook;

require __DIR__ .'\..\..\autoload.php';//ссылка на автолоад

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('1403157526657409','6e79d4d81541378d2dfbb7b90225b2d5');

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
class mePage {//информация о странице

private $pages;
private $session;
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