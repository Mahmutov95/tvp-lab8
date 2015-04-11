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
				use Facebook\event;
				$token ='CAAJR23rjU6MBABWn4kbgNyc1gKrUAOqM2ZBZCLcWlhmpb5GUGqdxgjfAhqMiSeNdhvwm5K5gTxFOsnDUZAc8AM4DZArg7YeYMGpCOIxbF0utwIhoEfiOaGBNL3PWWmZBAG2MeJUOB1EXqBPsvU2ZAfZBVXwEZBT81jKoU2tN4xBO0toBywh0Re0OGBlzWqIaCOzSnmFibkFypINo31N1Di5bPzViJpmV9B4ZD';
				$no = $_GET['f'];
				$event = new event($token,$no);
				echo "<br>";
				?>
				<div id="left">
				<div id="photo">
					<? echo "<img src=".$event->photo()." width='160px' height='160px'>";?>
				</div>
				</div>
				<div id="right"><?
				echo "<br>";
				?><div class = "title">Информация о мероприятии</div><?
				echo "Название: ".$event->name();
				echo "<br>";
				echo "Начало: ".$event->start_time();
				echo "<br>";
				echo "Окончание: ".$event->end_time();
				echo "<br>";
				echo "Организатор: ".$event->owner();
				echo "<br>";
				echo "Доступность: ".$event->privacy();
				?></div><??>
				
				
	</body>

</html>