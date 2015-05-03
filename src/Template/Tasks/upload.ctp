<?php echo $this -> Form -> create('Arqivo', array('enctype' => 'multipart/form-data')); ?>
<fieldset>
	<?php echo $this -> Form -> file('uploadfile', array('multiple')); ?>
</fieldset>
<?= $this->Form->button(__('Submit'))
?>
<?= $this -> Form -> end() ?>