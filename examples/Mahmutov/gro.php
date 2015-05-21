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
				use Facebook\groups;
				$token ='CAAJR23rjU6MBABWn4kbgNyc1gKrUAOqM2ZBZCLcWlhmpb5GUGqdxgjfAhqMiSeNdhvwm5K5gTxFOsnDUZAc8AM4DZArg7YeYMGpCOIxbF0utwIhoEfiOaGBNL3PWWmZBAG2MeJUOB1EXqBPsvU2ZAfZBVXwEZBT81jKoU2tN4xBO0toBywh0Re0OGBlzWqIaCOzSnmFibkFypINo31N1Di5bPzViJpmV9B4ZD';
				$no = $_GET['f'];
				$groups = new groups($token,$no);
				echo "<br>";
				?>
				<div id="left">
				<div id="photo">
					<? echo "<img src=".$groups->photo()." width='160px' height='160px'>";?>
				</div>
				</div>
				<div id="right"><?
				echo "<br>";
				?><div class = "title">Информация о мероприятии</div><?
				echo "Название: ".$groups->name();
				echo "<br>";
				echo "Дата обновления: ".$groups->updated_time();
				echo "<br>";
				echo "Описание: ".$groups->description();
				echo "<br>";
				echo "Почта: ".$groups->email();
				echo "<br>";
				echo "основатель: ".$groups->owner();
				echo "<br>";
				echo "Доступность: ".$groups->privacy();
				?></div><??>
				
				
	</body>

</html>