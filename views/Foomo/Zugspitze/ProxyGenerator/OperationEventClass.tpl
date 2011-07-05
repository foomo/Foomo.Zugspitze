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
package <?= $model->myPackage; ?>.events
{
<?	if (!PHPUtils::isASStandardType($model->currentOperation->returnType->type)): ?>
	<?= $model->getClientAsClassImport($model->currentOperation->returnType->type) . PHP_EOL ?>

<? endif; ?>
	import org.foomo.zugspitze.rpc.events.ProxyMethodOperationEvent;

	/**
	 * @link    http://www.foomo.org
	 * @license http://www.gnu.org/licenses/lgpl.txt
	 * @author  franklin <franklin@weareinteractive.com>
	 */
	public class <?= ViewHelper::toClassName($model->currentOperation->name, 'OperationEvent') ?> extends ProxyMethodOperationEvent
	{
		//-----------------------------------------------------------------------------------------
		// ~ Constants
		//-----------------------------------------------------------------------------------------

		public static const <?= ViewHelper::toConstantName($model->currentOperation->name) ?>_OPERATION_COMPLETE:String = '<?= lcfirst($model->currentOperation->name) ?>OperationComplete';
		public static const <?= ViewHelper::toConstantName($model->currentOperation->name) ?>_OPERATION_PROGRESS:String = '<?= lcfirst($model->currentOperation->name) ?>OperationProgress';
		public static const <?= ViewHelper::toConstantName($model->currentOperation->name) ?>_OPERATION_ERROR:String = '<?= lcfirst($model->currentOperation->name) ?>OperationError';

		//-----------------------------------------------------------------------------------------
		// ~ Constructor
		//-----------------------------------------------------------------------------------------

		public function <?= ViewHelper::toClassName($model->currentOperation->name, 'OperationEvent') ?>(type:String, result:*=null, error:*=null, messages:Array=null, total:Number=0, progress:Number=0)
		{
			super(type, result, error, messages, total, progress);
		}

		//-----------------------------------------------------------------------------------------
		// ~ Public methods
		//-----------------------------------------------------------------------------------------

		/**
		 *
		 */
		public function get result():<?= PHPUtils::getASType($model->currentOperation->returnType->type) . PHP_EOL ?>
		{
			return this.untypedResult;
		}

		/**
		 *
		 */
		public function get error():*
		{
			return this.untypedError;
		}
	}
}