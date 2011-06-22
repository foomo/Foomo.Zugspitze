<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\Zugspitze\Frontend\Model */
?>
<div id="zugspitze" class="module">
	<?= $view->partial('menu') ?>
	<?= \Foomo\MVC::run('Foomo\\Zugspitze\\Scaffold\\Frontend'); ?>
</div>