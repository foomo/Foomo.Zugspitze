<?php
/* @var $model Foomo\Services\ProxyGenerator\ActionScript\AbstractGenerator */
/* @var $operation ServiceOperation */
/* @var $view Foomo\MVC\View */
use Foomo\Flash\ActionScript\PHPUtils;
use Foomo\Flash\ActionScript\ViewHelper;
$operation = $model->currentOperation;
?>/*
 * This file is part of the foomo Opensource Framework.
 *
 * The foomo Opensource Framework is free software: you can redistribute it
 * and/or modify it under the terms of the GNU Lesser General Public License as
 * published  by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * The foomo Opensource Framework is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along with
 * the foomo Opensource Framework. If not, see <http://www.gnu.org/licenses/>.
 */
package <?= $model->myPackage; ?>.operations
{
	import <?= $model->myPackage; ?>.<?= PHPUtils::getASType($model->proxyClassName) ?>;
<? if (count($operation->parameters) > 0): ?>
<? foreach($operation->parameters as $name => $type): ?>
	<? if (!PHPUtils::isASStandardType($type)) echo $model->getClientAsClassImport($type); ?>
<? endforeach; ?>
<? endif; ?>

	import org.foomo.zugspitze.rpc.operations.ProxyMethodOperation;

	/**
	 * @link    http://www.foomo.org
	 * @license http://www.gnu.org/licenses/lgpl.txt
	 * @author  franklin <franklin@weareinteractive.com>
	 */
	public class <?= ViewHelper::toClassName($operation->name, 'Operation') ?> extends ProxyMethodOperation
	{
		//-----------------------------------------------------------------------------------------
		// ~ Constructor
		//-----------------------------------------------------------------------------------------

		/**
		 *
		 */
		public function <?= ViewHelper::toClassName($operation->name, 'Operation') ?>(<?= ViewHelper::renderParameters($operation->parameters); ?><?= (count($operation->parameters) > 0) ? ', ' : ''; ?>proxy:<?= PHPUtils::getASType($model->proxyClassName) ?>)
		{
			super(proxy, '<?= $operation->name ?>', [<?= ViewHelper::renderParameters($operation->parameters, false); ?>]);
		}
	}
}