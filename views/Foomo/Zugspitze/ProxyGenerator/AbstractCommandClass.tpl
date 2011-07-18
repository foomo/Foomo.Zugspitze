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
package <?= $model->myPackage; ?>.commands
{
	import <?= $model->myPackage; ?>.<?= PHPUtils::getASType($model->proxyClassName) ?>;
	import <?= $model->myPackage; ?>.calls.<?= ViewHelper::toClassName($operation->name, 'Call') ?>;
<? if (count($operation->parameters) > 0): ?>
<? foreach($operation->parameters as $name => $type): ?>
	<? if (!PHPUtils::isASStandardType($type)) echo $model->getClientAsClassImport($type); ?>
<? endforeach; ?>
<? endif; ?>

	import org.foomo.zugspitze.commands.Command;
	import org.foomo.zugspitze.commands.ICommand;
	import org.foomo.zugspitze.rpc.events.ProxyMethodCallEvent;
	import org.foomo.core.IUnload;

	/**
	 * Create your own command instance and override the protected event handlers
	 *
	 * @link    http://www.foomo.org
	 * @license http://www.gnu.org/licenses/lgpl.txt
	 * @author  franklin <franklin@weareinteractive.com>
	 */
	public class <?= ViewHelper::toClassName($operation->name, 'Command', 'Abstract') ?> extends Command implements ICommand, IUnload
	{
		//-----------------------------------------------------------------------------------------
		// ~ Variables
		//-----------------------------------------------------------------------------------------

		/**
		 * Service proxy
		 */
		public var proxy:<?= PHPUtils::getASType($model->proxyClassName) ?>;
<? foreach ($operation->parameters as $name => $type): ?>
<?= $view->indent(ViewHelper::renderComment(isset($operation->parameterDocs[$name]) ? $operation->parameterDocs[$name]->comment : ''), 2) . PHP_EOL ?>
		public var <?= $name ?>:<?= PHPUtils::getASType($type) ?>;
<? endforeach; ?>
		/**
		 * Returned call from the proxy
		 */
		protected var _methodCall:<?= ViewHelper::toClassName($operation->name, 'Call') ?>;

		//-----------------------------------------------------------------------------------------
		// ~ Constructor
		//-----------------------------------------------------------------------------------------

		/**
<? foreach ($operation->parameters as $name => $type): ?>
		 * @param <?= $name ?> <?= isset($operation->parameterDocs[$name]) && !empty($operation->parameterDocs[$name]->comment) ? $operation->parameterDocs[$name]->comment : '' ?>;
<? endforeach; ?>
		 * @param proxy Service proxy
		 * @param setBusyStatus Set busy status while pending
		 */
		public function <?= ViewHelper::toClassName($operation->name, 'Command', 'Abstract') ?>(<?= ViewHelper::renderParameters($operation->parameters) ?><? echo (count($operation->parameters) > 0) ? ', ' : ''; ?>proxy:<?= PHPUtils::getASType($model->proxyClassName) ?>, setBusyStatus:Boolean=false)
		{
<? if (count($operation->parameters) > 0): ?>
<? foreach($operation->parameters as $name => $type): ?>
			this.<?= $name ?> = <?= $name ?>;
<? endforeach; ?>
<? endif; ?>
			this.proxy = proxy;
			super(setBusyStatus);
		}

		//-----------------------------------------------------------------------------------------
		// ~ Public methods
		//-----------------------------------------------------------------------------------------

		/**
		 * @see org.foomo.zugspitze.commands.ICommand
		 */
		public function execute():void
		{
			this._methodCall = this.proxy.<?= $operation->name ?>(<?= ViewHelper::renderParameters($operation->parameters, false, true) ?>);
			this._methodCall.addEventListener(ProxyMethodCallEvent.PROXY_METHOD_CALL_RESULT, this.methodCall_proxyMethodCallResultHandler);
			this._methodCall.addEventListener(ProxyMethodCallEvent.PROXY_METHOD_CALL_PROGRESS, this.methodCall_proxyMethodCallProgressHandler);
			this._methodCall.addEventListener(ProxyMethodCallEvent.PROXY_METHOD_CALL_EXCEPTION, this.methodCall_proxyMethodCallExceptionHandler);
		}

		/**
		 * @see org.foomo.flash.core.IUnload
		 */
		public function unload():void
		{
			this.proxy = null;
<? if (count($operation->parameters) > 0): ?>
<? foreach ($operation->parameters as $name => $type): ?>
			this.<?= $name ?> = <?= PHPUtils::getASTypeDefaultValue($type); ?>;
<? endforeach; ?>
<? endif; ?>
			if (this._methodCall) {
				this._methodCall.removeEventListener(ProxyMethodCallEvent.PROXY_METHOD_CALL_RESULT, this.methodCall_proxyMethodCallResultHandler);
				this._methodCall.removeEventListener(ProxyMethodCallEvent.PROXY_METHOD_CALL_PROGRESS, this.methodCall_proxyMethodCallProgressHandler);
				this._methodCall.removeEventListener(ProxyMethodCallEvent.PROXY_METHOD_CALL_EXCEPTION, this.methodCall_proxyMethodCallExceptionHandler);
				this._methodCall = null;
			}
		}

		//-----------------------------------------------------------------------------------------
		// ~ Protected eventhandler
		//-----------------------------------------------------------------------------------------

		/**
		 * Handle method call result
		 *
		 * @param event Method call event
		 */
		protected function methodCall_proxyMethodCallResultHandler(event:ProxyMethodCallEvent):void
		{
			// Overwrite this method in your implementation class
			this.dispatchCommandCompleteEvent();
		}

		/**
		 * Handle method call progress
		 *
		 * @param event Method call event
		 */
		protected function methodCall_proxyMethodCallProgressHandler(event:ProxyMethodCallEvent):void
		{
			// Overwrite this method in your implementation class
		}

		/**
		 * Handle method call error
		 *
		 * @param event Method call event
		 */
		protected function methodCall_proxyMethodCallExceptionHandler(event:ProxyMethodCallEvent):void
		{
			// Overwrite this method in your implementation class
			this.dispatchCommandErrorEvent();
		}
	}
}