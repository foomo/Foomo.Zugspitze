<?php
/* @var $model Foomo\Services\ProxyGenerator\ActionScript\AbstractGenerator */
/* @var $dataClass ServiceObjectType */
/* @var $operation ServiceOperation */
/* @var $view Foomo\MVC\View */
use Foomo\Flash\ActionScript\PHPUtils;
use Foomo\Flash\ActionScript\ViewHelper;
$operation = $model->currentOperation;


/**
 * name => ServiceObjectType
 *
 * @param $props[] $params
 * @return string
 */
function renderMethodProperties($props)
{
	$output = array();
	if (count($props) == 0) return '';
	foreach($props as $name => $type) {
		$output[] = 'this._methodReply.exception.' . $name;
	}
	return ', ' . implode(', ', $output);
}
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
package <?= $model->myPackage; ?>.calls
{
<? if (count($operation->throwsTypes) > 0): ?>
	import org.foomo.rpc.events.RPCMethodCallEvent;
<? foreach ($operation->throwsTypes as $throwType): ?>
<? $dataClass = $model->complexTypes[$throwType->type]; ?>
	<?= $model->getClientAsClassImport($throwType->type) .PHP_EOL ?>
	import <?= $model->myPackage; ?>.events.<?= ViewHelper::toClassName($model->getVOClassName($dataClass), 'Event') ?>;
<? endforeach; ?>

<? endif; ?>
	import <?= $model->myPackage; ?>.events.<?= ViewHelper::toClassName($operation->name, 'CallEvent') ?>;
	import org.foomo.zugspitze.rpc.calls.ProxyMethodCall;
<?	if (!PHPUtils::isASStandardType($operation->returnType->type)): ?>
	<?= $model->getClientAsClassImport($operation->returnType->type) . PHP_EOL ?>
<? endif ?>
<? if (count($operation->parameters) > 0): ?>
<? foreach($operation->parameters as $name => $type): ?>
	<? if (!PHPUtils::isASStandardType($type)) echo $model->getClientAsClassImport($type); ?>
<? endforeach; ?>
<? endif; ?>

	[Event(name="<?= $operation->name ?>CallComplete", type="<?= $model->myPackage; ?>.events.<?= ViewHelper::toClassName($operation->name, 'CallEvent') ?>")]
	[Event(name="<?= $operation->name ?>CallProgress", type="<?= $model->myPackage; ?>.events.<?= ViewHelper::toClassName($operation->name, 'CallEvent') ?>")]
	[Event(name="<?= $operation->name ?>CallError", type="<?= $model->myPackage; ?>.events.<?= ViewHelper::toClassName($operation->name, 'CallEvent') ?>")]
<? if (count($operation->throwsTypes) > 0): ?>
<? foreach ($operation->throwsTypes as $throwType): ?>
<? $dataClass = $model->complexTypes[$throwType->type]; ?>
	[Event(name="<?= lcfirst($model->getVOClassName($dataClass)) ?>", type="<?= $model->myPackage; ?>.events.<?= ViewHelper::toClassName($model->getVOClassName($dataClass), 'Event') ?>")]
<? endforeach; ?>
<? endif; ?>

	/**
	 * @link    http://www.foomo.org
	 * @license http://www.gnu.org/licenses/lgpl.txt
	 * @author  franklin <franklin@weareinteractive.com>
	 */
	public class <?= ViewHelper::toClassName($operation->name, 'Call') ?> extends ProxyMethodCall
	{
		//-----------------------------------------------------------------------------------------
		// ~ Constants
		//-----------------------------------------------------------------------------------------

		public static const METHOD_NAME:String = '<?= $operation->name ?>';

		//-----------------------------------------------------------------------------------------
		// ~ Constructor
		//-----------------------------------------------------------------------------------------

		public function <?= ViewHelper::toClassName($operation->name, 'Call') ?>(<?= ViewHelper::renderParameters($operation->parameters) ?>)
		{
			super(METHOD_NAME, [<?= ViewHelper::renderParameters($operation->parameters, false) ?>], <?= ViewHelper::toClassName($operation->name, 'CallEvent') ?>);
		}

		//-----------------------------------------------------------------------------------------
		// ~ Public methods
		//-----------------------------------------------------------------------------------------

		/**
		 * Method call result
		 */
		public function get result():<?= PHPUtils::getASType($operation->returnType->type) . PHP_EOL ?>
		{
			return this.methodReply.value;
		}
<? if (count($operation->throwsTypes) > 0): ?>

		//-----------------------------------------------------------------------------------------
		// ~ Overriden methods
		//-----------------------------------------------------------------------------------------

		/**
		 * Complete handler
		 *
		 * @private
		 */
		override protected function token_methodCallTokenCompleteHandler(event:RPCMethodCallEvent):void
		{
			this._methodReply = event.methodReply;
			if (this._methodReply.exception != null) {
				switch (true) {
<? foreach ($operation->throwsTypes as $throwType): ?>
<? $dataClass = $model->complexTypes[$throwType->type]; ?>
					case (this._methodReply.exception is <?= $model->getVOClassName($dataClass) ?>):
						this.dispatchEvent(new <?= ViewHelper::toClassName($model->getVOClassName($dataClass), 'Event') ?>(<?= ViewHelper::toClassName($model->getVOClassName($dataClass), 'Event') ?>.<?= ViewHelper::toConstantName($model->getVOClassName($dataClass)) ?><?= renderMethodProperties($dataClass->props) ?>));
						break;
<? endforeach; ?>
					default:
						throw new Error('Unhandled exception type');
						break;
				}
			} else {
				this.dispatchEvent(new <?= ViewHelper::toClassName($operation->name, 'CallEvent') ?>(<?= ViewHelper::toClassName($operation->name, 'CallEvent') ?>.<?= ViewHelper::toConstantName($operation->name) ?>_CALL_COMPLETE, this));
			}
		}
<? endif; ?>
	}
}