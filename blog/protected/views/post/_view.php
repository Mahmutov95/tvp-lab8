<div class="post">
	<div class="title">
		<?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
	</div>
	<div class="author">
		posted by <?php echo $data->author->username . ' on ' . date('F j, Y',$data->create_time); ?>
	</div>
	<div class="content">
		<div class="post-text">
			<?php
				$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
					echo $data->content;
				$this->endWidget();
			?>
		</div>
		<?php if (isset($data->link)): ?>
			<div class="post-link">
				<a href="<?php echo $data->link ?>"><?php echo $data->link ?></a>
			</div>
		<?php endif ?>
		<div class="post-file">
			<?php
				$file = $data->file;
				$expl = explode('.', $file);
				$format = $expl[count($expl)-1];
			?>
			<?php if ($format == 'mp4'): ?>
				<video width="400" height="300" controls="controls" poster="/poster.png">
				  	<source src="/upload/<? echo $file ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
				  	Тег video не поддерживается вашим браузером. 
				</video>	
			<?php elseif(preg_match('/ogg|mp3|wav/'	, $format)): ?>
				<audio controls>
				    <source src="/upload/<? echo $file ?>" type="audio/mpeg">
				    Тег audio не поддерживается вашим браузером. 
				</audio>
			<?php elseif(preg_match('/jpg|png|jpeg|gif/', strtolower($format))): ?>
				<img src="/upload/<? echo $file ?>" alt="">
			<?php endif ?>
		</div>
	</div>
	<div class="nav">
		<b>Tags:</b>
		<?php echo implode(', ', $data->tagLinks); ?>
		<br/>
		<?php echo CHtml::link('Permalink', $data->url); ?> |
		<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
		Last updated on <?php echo date('F j, Y',$data->update_time); ?>
	</div>
</div>
