<html>
	<head>
		<title>theFacebook</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="https://fbstatic-a.akamaihd.net/rsrc.php/yl/r/H3nktOa7ZMg.ico" />
	</head>
	<body>
		<div id="header">
			theFacebook
		</div>
		<?
			function prnt($arr){
				echo '<pre>';
				print_r($arr);
				echo '</pre>';	
			}
			$token ='CAAT8KhHwuYEBAI5ovmuUZBrWiZBtmYg6mu0tavf1QxESjU3w2NKZBu6DpQw7AOc0HeQc1jHs9AlxZAYFqe7ZAztyGY2FzH2cGfw7997CEA9UAqpfQ5Dt0gpi6GvPYhHlhpeymN3SPu3AFbDOsqdSPXUbyIx5UH0hgtbP8dUsgooRfsrdz3BW2i5QPvs0FV0wiZB2ga0kpWRNJJxTPgBTm7ghMNoimVN6kZD';
			require __DIR__ .'/SDK/autoload.php';
			use Facebook\User;		
			use Facebook\Group;
			use Facebook\Page;
			
			$me = new User($token);
			$groupInfo = new Group($token);	
			$pagesIngo = new Page($token);
		?>
			<div id="left">
				<div id="photo">
					<? echo "<img src=".$me->Photo()." width='300px' height='300px'>";?>
				</div>
				<? echo "<form action='add.php' method='post'>
					<input type='submit'  value='Публикация' class='button' style='width:310px'>
					<input type='hidden' name='token' value=".$token.">
					<input type='hidden' name='where' value='me'>
				</form>"?>
				<div id="myPages">
					<div class = "title">Ваши страницы</div>
					<div id="Page">
						<?
							$pages = $pagesIngo->GetPages();
							foreach($pages as $elem){
							echo 	"<div class='photoPage'>
										<img src=".$elem['photo'].">
									</div>";
							echo 	"<div class='namePage'>
										<a href=".$elem['link'].">".$elem['name']."</a><br>
										<form action='add.php' method='post'>
											<input type='submit'  value='Публикация' class='button'>
											<input type='hidden' name='token' value=".$token.">
											<input type='hidden' name='where' value=".$elem['id'].">
										</form>
									</div><br>";
							echo "<span class='blue'>Категория : </span>", $elem['category'].'<br>';
							echo "<span class='blue'>Лайков : </span>", $elem['likes'].'<br>';
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
					<div class = "title">Ваши группы</div>
						<?
							$groups = $groupInfo->GetGroups();
							foreach($groups as $elem){
							echo 	"<div class='photoPage'>
										<img src=".$elem['photo'].">
									</div>";
							echo 	"<div class='namePage'>
										".$elem['name']."<br>
										<form action='add.php' method='post'>
											<input type='submit'  value='Публикация' class='button'>
											<input type='hidden' name='token' value=".$token.">
											<input type='hidden' name='where' value=".$elem['id'].">
										</form>
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