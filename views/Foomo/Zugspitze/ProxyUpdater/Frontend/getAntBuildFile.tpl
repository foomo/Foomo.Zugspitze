<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\Zugspitze\ProxyUpdater\Frontend\Model */
?>
<? if ($model->filename): ?>
	Success: <?= $model->filename . PHP_EOL; ?>
<? else: ?>
	Failure!
<? endif; ?>
