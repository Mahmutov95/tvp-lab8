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
		<label for="share">Share to VK Wall Video</label>
		<input type="radio" id="shareVkWallVideo" name="shareVkWallVideo" value="share">
	</div>
	

	<div class="row">
		<label for="share">Share to VK Wall Photo</label>
		<input type="radio" id="shareVkWallPhoto" name="shareVkWallPhoto" value="share">
		</label>
	</div>

	<?php if (!empty($facebookPages)): ?>
		<div class="row">
			<label for="share">Share to Facebook Page</label>
			<input type="radio" id="shareFacebookPage" name="shareFacebookPage" value="share">
			<select name="page">
				<?php foreach ($facebookPages['data'] as $key => $page): ?>
					<option value="<?=$page->id?>">
						<?=$page->name?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
	<?php endif; ?>


	<?php if (!empty($facebookGroups)): ?>
		<div class="row">
			<label for="share-facebook-group">Share to Facebook Group</label>
			<input type="radio" id="shareFacebookGroup" name="shareFacebookGroup" value="share">
			<select name="group">
				<?php foreach ($facebookGroups['data'] as $key => $group): ?>
					<?php if ($group->administrator == 1): ?>
						<option value="<?=$group->id?>">
							<?=$group->name?>
						</option>
					<?php endif ?>
				<?php endforeach ?>
			</select>
		</div>
	<?php endif; ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->