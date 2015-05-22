<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'fp',
			// 'enableAjaxValidation'=>true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo CHtml::activeTextArea($model,'content',array('rows'=>10, 'cols'=>70)); ?>
		<p class="hint">You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.</p>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'tags',
			'url'=>array('suggestTags'),
			'multiple'=>true,
			'htmlOptions'=>array('size'=>50),
		)); ?>
		<p class="hint">Please separate different tags with commas.</p>
		<?php echo $form->error($model,'tags'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',Lookup::items('PostStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'file') ?>
		<?php echo $form->fileField($model, 'file'); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'link') ?>
		<?php echo $form->textField($model, 'link'); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<label for="share">Share to Facebook</label>
		<input type="checkbox" id="share" name="share" value="facebook">
	</div>
	
	<div class="row">
		<label for="share">Chose your group</label>
		<?php
			require_once('Facebook/SDK/autoload.php');
			use Facebook\FacebookSession;	
			use Facebook\FacebookRequest;
			$token = 'CAAT8KhHwuYEBAA0wnNyVWrk4Rt5ufPftnSZBndG7awbQ1kfPbL8vrVAV82hA3ybXn75Ls4PIZBZCYu8nhszQCjGFgfZBWuQ6l1rgD5pvCDIe1le1ZBk72HEa3k6dsGcuoQSfiKNkERumigsCou6dG4Cyvkj64E0kKlZCGT06ijQxnKw2MHUnSWLORiyx22kCzEnGjp3ZCK0jc0NvIcpwL9ZAgnA4zdTLsd4ZD';

			FacebookSession::setDefaultApplication('1403157526657409','6e79d4d81541378d2dfbb7b90225b2d5');
			$session = new FacebookSession($token);

			$getGroups = (new FacebookRequest(
				$session,
				'GET',
				'/me/groups'
			))->execute()->getGraphObject()->asArray();
	
			$index = 0;
			echo "<select id='group' name='group'>";
			while($index<count($getGroups['data'])){
				if($getGroups['data'][$index]->administrator=='1') {
				
					echo "<option value=".$getGroups['data'][$index]->id.">".$getGroups['data'][$index]->name."</option>";
				}
				$index++;
			}
			echo "</select>";
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->