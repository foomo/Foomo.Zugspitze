<?php
/* @var $model Foomo\Services\ProxyGenerator\ActionScript\AbstractGenerator */
/* @var $operation ServiceOperation */
/* @var $view Foomo\MVC\View */
use Foomo\Flash\ActionScript\PHPUtils;
use Foomo\Flash\ActionScript\ViewHelper;
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
package <?= $model->myPackage . PHP_EOL; ?>
{
	import org.foomo.zugspitze.zugspitze_internal;
	import org.foomo.zugspitze.rpc.Proxy;
<? foreach($model->operations as $operation): ?>
	import <?= $model->myPackage ?>.calls.<?=ViewHelper::toClassName($operation->name, 'Call') ?>;
<? endforeach; ?>
<?= $view->indent($model->getAllClientClassImports(), 1) . PHP_EOL; ?>

	/**
	 * @link    http://www.foomo.org
	 * @license http://www.gnu.org/licenses/lgpl.txt
	 * @author  franklin <franklin@weareinteractive.com>
	 */
	public class <?= PHPUtils::getASType($model->proxyClassName) ?> extends Proxy
	{
		//-----------------------------------------------------------------------------------------
		// ~ Constants
		//-----------------------------------------------------------------------------------------

		public static const VERSION:Number 		= <?= constant($model->serviceName.'::VERSION') ?>;
		public static const CLASS_NAME:String 	= '<?= str_replace('\\', '\\\\', $model->serviceName); ?>';

		//-----------------------------------------------------------------------------------------
		// ~ Constructor
		//-----------------------------------------------------------------------------------------

		public function <?= PHPUtils::getASType($model->proxyClassName) ?>(endPoint:String)
		{
			super(endPoint, CLASS_NAME, VERSION);
		}

		//-----------------------------------------------------------------------------------------
		// ~ Public methods
		//-----------------------------------------------------------------------------------------
<?php foreach($model->operations as $operation): ?>

		/**
		 *
		 */
		public function <?= $operation->name; ?>(<?= ViewHelper::renderParameters($operation->parameters) ?>):<?= ViewHelper::toClassName($operation->name, 'Call') . PHP_EOL ?>
		{
			return zugspitze_internal::sendMethodCall(new <?= ViewHelper::toClassName($operation->name, 'Call') ?>(<?= ViewHelper::renderParameters($operation->parameters, false) ?>));
		}
<?php endforeach; ?>
	}
}
