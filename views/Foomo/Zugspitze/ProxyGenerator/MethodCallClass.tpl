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
	import org.foomo.utils.CompilerUtil;
	import org.foomo.zugspitze.rpc.calls.ProxyMethodCall;
<? if (count($operation->throwsTypes) > 0): ?>
<? foreach ($operation->throwsTypes as $throwType): ?>
<? $dataClass = $model->complexTypes[$throwType->type]; ?>
	<?= $model->getClientAsClassImport($throwType->type) .PHP_EOL ?>
<? endforeach; ?>
<? endif; ?>
<?	if ((PHPUtils::isArray($operation->returnType->type) && !PHPUtils::isASArrayStandardType($operation->returnType->type)) || !PHPUtils::isASStandardType($operation->returnType->type)): ?>
	<?= $model->getClientAsClassImport($operation->returnType->type) . PHP_EOL ?>
<? endif ?>
<? if (count($operation->parameters) > 0): ?>
<? foreach($operation->parameters as $name => $type): ?>
<? if (!PHPUtils::isASStandardType($type)): ?>
	<?= $model->getClientAsClassImport($type) . PHP_EOL; ?>
<? endif; ?>
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
			super(METHOD_NAME, [<?= ViewHelper::renderParameters($operation->parameters, false) ?>]);
<?	if (PHPUtils::isArray($operation->returnType->type) && !PHPUtils::isASArrayStandardType($operation->returnType->type)): ?>
			CompilerUtil.force(<?= PHPUtils::getASArrayType($operation->returnType->type) ?>);
<? endif ?>
<? if (count($operation->throwsTypes) > 0): ?>
<? foreach ($operation->throwsTypes as $throwType): ?>
<? $dataClass = $model->complexTypes[$throwType->type]; ?>
			CompilerUtil.force(<?= PHPUtils::getASType($throwType->type) ?>);
<? endforeach; ?>
<? endif; ?>
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
	}
}