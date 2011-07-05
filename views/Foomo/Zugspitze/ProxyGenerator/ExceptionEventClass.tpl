<?
/* @var $model Foomo\Zugspitze\ProxyGenerator\PRC */
/* @var $dataClass ServiceObjectType */
/* @var $type ServiceObjectType */
/* @var $view Foomo\MVC\View */
use Foomo\Flash\ActionScript\PHPUtils;
use Foomo\Flash\ActionScript\ViewHelper;
$dataClass = $model->currentDataClass;

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
	import flash.events.Event;

	/**
	 * @link    http://www.foomo.org
	 * @license http://www.gnu.org/licenses/lgpl.txt
	 * @author  franklin <franklin@weareinteractive.com>
	 */
	public class <?= ViewHelper::toClassName($model->getVOClassName($dataClass), 'Event') ?> extends Event
	{
		//-----------------------------------------------------------------------------------------
		// ~ Constants
		//-----------------------------------------------------------------------------------------

		public static const <?= ViewHelper::toConstantName($model->getVOClassName($dataClass)) ?>:String = "<?= lcfirst($model->getVOClassName($dataClass)) ?>";

<? if (count($dataClass->props) > 0): ?>
		//-----------------------------------------------------------------------------------------
		// ~ Variables
		//-----------------------------------------------------------------------------------------
<? foreach($dataClass->props as $name => $type): ?>

<?= $view->indent(ViewHelper::renderComment((isset($type->phpDocEntry) && !empty($type->phpDocEntry->comment)) ? $type->phpDocEntry->comment : ''), 2) . PHP_EOL; ?>
<? if ($type->isArrayOf): ?>
		[ArrayElementType("<?= PHPUtils::getASType($type->type); ?>")]
		private var _<?= $name ?>:Array;
<? else: ?>
		private var _<?= $name ?>:<?= PHPUtils::getASType($type->type); ?>;
<? endif; ?>
<? endforeach; ?>
<?php endif; ?>

		//-----------------------------------------------------------------------------------------
		// ~ Constructor
		//-----------------------------------------------------------------------------------------

		public function <?= ViewHelper::toClassName($model->getVOClassName($dataClass), 'Event') ?>(type:String, <?= $model->renderProperties($dataClass->props) ?>)
		{
<? if (count($dataClass->props) > 0): ?>
<? foreach($dataClass->props as $name => $type): ?>
			this._<?= $name ?> = <?= $name ?>;
<? endforeach; ?>
			super(type);
		}
<?php endif; ?>

<? if (count($dataClass->props) > 0): ?>
		//-----------------------------------------------------------------------------------------
		// ~ Public methods
		//-----------------------------------------------------------------------------------------
<? foreach($dataClass->props as $name => $type): ?>

<?= $view->indent(ViewHelper::renderComment((isset($type->phpDocEntry) && !empty($type->phpDocEntry->comment)) ? $type->phpDocEntry->comment : ''), 2) . PHP_EOL; ?>
		public function get <?= $name ?>():<?= (($type->isArrayOf) ? 'Array' : PHPUtils::getASType($type->type)) . PHP_EOL ?>
		{
			return this._<?= $name ?>;
		}
<? endforeach; ?>
<?php endif; ?>

		//-----------------------------------------------------------------------------------------
		// ~ Overriden methods
		//-----------------------------------------------------------------------------------------

		/**
		 * @inherit
		 */
		override public function clone():Event
		{
			return new <?= ViewHelper::toClassName($model->getVOClassName($dataClass), 'Event') ?>(this.type, <?= $model->renderProperties($dataClass->props, false, true) ?>);
		}

		/**
		 * @inherit
		 */
		override public function toString():String
		{
			return formatToString("<?= ViewHelper::toClassName($model->getVOClassName($dataClass), 'Event') ?>");
		}
	}
}