<?php echo $this -> Form -> create('Arqivo', array('enctype' => 'multipart/form-data')); ?>
<fieldset>

	
	<?php  echo $this->Form->input('uploadfile.', array('type' => 'file', 'multiple')); ?>
</fieldset>
<?= $this->Form->button(__('Submit'))
?>
<?= $this -> Form -> end() ?>

