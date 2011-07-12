<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\Zugspitze\ProxyGenerator\Frontend\Model */
?>
<div class="rightBox">
	<?= $view->link('Back', 'default', array(), array('class' => 'linkButtonYellow')) ?>
</div>
<pre><?= $model->report->report ?></pre>

