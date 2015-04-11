<html>
	<head>
		<title>theFacebook</title>
		<link rel="stylesheet" type="text/css" href="style1.css">
	</head>
	<body>
		<div id ="id1">
			<div id="header">
				theFacebook
			</div>
			<?
				require __DIR__ .'/SDK/autoload.php';
				use Facebook\User;
				use Facebook\Group;
				use Facebook\Page;
				$token ='CAAJR23rjU6MBABWn4kbgNyc1gKrUAOqM2ZBZCLcWlhmpb5GUGqdxgjfAhqMiSeNdhvwm5K5gTxFOsnDUZAc8AM4DZArg7YeYMGpCOIxbF0utwIhoEfiOaGBNL3PWWmZBAG2MeJUOB1EXqBPsvU2ZAfZBVXwEZBT81jKoU2tN4xBO0toBywh0Re0OGBlzWqIaCOzSnmFibkFypINo31N1Di5bPzViJpmV9B4ZD';
				$me = new User($token);
				$no = $_GET['f'];
				$page = new Page($token,$no);
				//echo "123";
				//$page_photo = new page_photo($token,$no);
				//var_dump ($page_photo);
				echo "<br>";
				?>
				<div id="left">
				<div id="photo">
					<? echo "<img src=".$page->photo()." width='160px' height='160px'>";?>
				</div>
				</div>
				<div id="right"><?
				//print_r($_FILES);
				echo "<br>";
				?><div class = "title">Информация о странице</div>"<?
				echo "Название: ".$page->name();
				echo "<br>";
				echo "О чем: ".$page->about();
				echo "<br>";
				echo "Награды: ".$page->awards();
				echo "<br>";
				echo "Категории: ".$page->category();
				echo "<br>";
				echo "Основано: ".$page->founded();
				echo "<br>";				
				echo "Телефон: ".$page->phone();
				echo "<br>";
				echo "Сайт: <a href=".$page->website()."> ".$page->website()." </a>";
				echo "<br>";
				echo "Количество лайков: ".$page->likes();
				echo "<br>";
				echo "Город: ".$page->city();
				echo "<br>";
				echo "Страна: ".$page->country();
				echo "<br>";
				echo "Улица: ".$page->street();
				echo "<br>";
				echo "Индекс: ".$page->zip();
				
				?></div><??>
				
				
	</body>

</html>