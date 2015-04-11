<html>
	<head>
		<title>theFacebook</title>
		<link rel="stylesheet" type="text/css" href="style.css">
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
				use Facebook\Like;
				use Facebook\event;
				use Facebook\Music;
				$token ='CAAJR23rjU6MBABWn4kbgNyc1gKrUAOqM2ZBZCLcWlhmpb5GUGqdxgjfAhqMiSeNdhvwm5K5gTxFOsnDUZAc8AM4DZArg7YeYMGpCOIxbF0utwIhoEfiOaGBNL3PWWmZBAG2MeJUOB1EXqBPsvU2ZAfZBVXwEZBT81jKoU2tN4xBO0toBywh0Re0OGBlzWqIaCOzSnmFibkFypINo31N1Di5bPzViJpmV9B4ZD';
				$me = new User($token);
				$groupInfo = new Group($token);	
				$LikeIngo = new like($token);
				$musicInfo = new Music($token);
				//$eventInfo = new event($token);
 				?>
				<div id="left">
				<div id="photo">
					<? echo "<img src=".$me->Photo()." width='300px' height='300px'>";?>
				</div>
				<div id="myPages">
					<div class = "title">Страницы которые вам понравились</div>
					<div id="Page">
						<?
							$pages = $LikeIngo->GetLikes();
							foreach($pages as $elem){
							echo 	"<div class='namePage'>
										<a href=page.php?f=".$elem['id'].">".$elem['name']."</a><br>
									</div><br>";
							echo "<span class='blue'>Категория : </span>", $elem['category'].'<br>';
							echo '<hr>';
							}
						?>
					</div>
					<div class = "title">Мероприятия</div>
					<div id="Page">
						<?
							$pages = $me->event();
							foreach($pages as $elem){
							echo 	"<div class='namePage'>
									Название:	<a href=eve.php?f=".$elem['id'].">".$elem['name']."</a><br>
									</div><br>";
							echo "<span class='blue'>Категория : </span>", $elem['rsvp_status'].'<br>';
							echo '<hr>';
							}
						?>
					</div>
				</div>
			</div>
			<div id="right">
				<div id="aboutMe">
					<div class = "title">Информация о пользователе</div>
					<span class="blue">Вы</span> 						: <? echo $me->Name()?><br>
					<span class="blue">День рождения</span>   			: <? echo $me->Birthday();?><br>
					<span class="blue">Email</span> 					: <?echo  $me->Email();?><br>
					<span class="blue">Пол</span>   					: <?echo $me->Gender();?><br>
					<span class="blue">Родной город</span> 			: <? echo $me->HomeSweetHome();?><br>
					<span class="blue">Текущее местоположение</span>    : <? echo $me->Location();?>
					<div class = "title" style="margin-top:10px;">Образование</div>
					<?
						$educations = $me->Educations();
						foreach($educations as $elem){
							echo "<span class='blue'>Название : </span>".$elem['name'].'<br>';
							$year = $elem['year']==''?'В процессе':$elem['year'];
							echo "<span class='blue'>Тип : </span>".$elem['type'].'<br>';
							echo  "<span class='blue'>Год окончания : </span>", $year.'<br>';
							echo "<hr width='250px'>";
						}
					?>
				</div>
				<div id="Group">
					<div class = "title">Ваши интересы</div>
						<?
							$groups = $musicInfo->GetMusic();
							foreach($groups as $elem){
							echo 	"<div class='photoPage'>
										<img src=".$elem['photo'].">
									</div>";
							echo 	"<div class='namePage'>
										<a><a href=eve.php?f=".$elem['id'].">".$elem['name']."</a><br>
									</div><br>";
							echo "<span class='blue'>Категория : </span>", $elem['category'].'<br>';
							echo "<span class='blue'>Дата основания : </span>", $elem['created_time']==''?'Нету':$elem['created_time'].'<br>';
							echo '<hr>';
							}
						?>
				</div>
				<div id="Group">
					<div class = "title">Ваши группы</div>
						<?
							$groups = $groupInfo->GetGroups();
							foreach($groups as $elem){
							echo 	"<div class='photoPage'>
										<img src=".$elem['photo'].">
									</div>";
							echo 	"<div class='namePage'>
										<a><a href=gro.php?f=".$elem['id'].">".$elem['name']."</a><br>
									</div><br>";
							echo "<span class='blue'>Email : </span>", $elem['email'].'<br>';
							echo "<span class='blue'>Приватность : </span>", $elem['privacy'].'<br>';
							echo "<span class='blue'>Описание : </span>", $elem['description']==''?'Нету':$elem['description'].'<br>';
							echo '<hr>';
							}
						?>
				</div>
			</div>
	</body>

</html>