<html>
	<head>
		<title>theFacebook</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="https://fbstatic-a.akamaihd.net/rsrc.php/yl/r/H3nktOa7ZMg.ico" />
		<script type='text/javascript' src='jquery.min.js'></script>
	</head>
	<body>
		<div id="header">
			theFacebook
		</div>
		<div id="Main">
			<p class="title">Публикация на страницу</p>
			<div id="posts">
				<?
				echo "<form enctype='multipart/form-data' action='add.php' method='POST'>
					<span class='blue'>Ваш файл </span>
					<input type='file' name='photo'><br>
					<input type='hidden' name='place' value=".$_POST['where'].">					
					<input type='hidden' name='tok' value=".$_POST['token'].">
					<span class='blue'>Ваши коментарии </span>
					<textarea name='comments'></textarea><br> 
					<input type='submit' value='Загрузить' class='button'>
				</form>";
				
				
					require __DIR__ .'/SDK/autoload.php';
					use Facebook\FacebookSession;
					use Facebook\FacebookRequest;
					use Facebook\GraphUser;
					use Facebook\FacebookRequestException;
					FacebookSession::setDefaultApplication('1403157526657409','6e79d4d81541378d2dfbb7b90225b2d5');
					
					$place = '/'.$_POST['place'].'/photos';
					$session = new FacebookSession($_POST['tok']);
					try{
						$photo = "";
						if (!empty($_FILES)){
							$photo = $_FILES['photo']['tmp_name'];
						}
						if (!empty($photo)){
							$response = (new FacebookRequest(
							$session, 'POST', $place, array(
							'source' => new CURLFile($photo, $_FILES['photo']['type']),
							'message' => $_POST['comments']
							)
						))->execute()->getGraphObject();
						echo "<script type='text/javascript'>
								location.href='http://thefacebook.local';
								alert('Фото добавлено!');
							  </script>";
						}
					} catch (Exception $e) {
						echo "Exception occured, code: " . $e->getCode();
						echo " with message: " . $e->getMessage();

					  }  
				?>
			</div>
		</div>
	</body>

</html>