<?php

$_SESSION['username'] = "johndoe" // Must be already set
?>


<style>
body {
	background-color: #eeeeee;
	padding:0;
	margin:0 auto;
	font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
	font-size:11px;
}
</style>

<?= $this->Html->css('chat.css') ?>
<?= $this->Html->css('screen.css') ?>
<script src="/chat/js/jquery.js"></script>
<script src="/chat/js/chat.js"></script>





<a href="javascript:void(0)" onclick="javascript:chatWith('janedoe')">Chat With Jane Doe</a>
<a href="javascript:void(0)" onclick="javascript:chatWith('babydoe')">Chat With Baby Doe</a>



