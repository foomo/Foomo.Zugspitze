<?
/* @var $model Foomo\Services\ProxyGenerator\ActionScript\AbstractGenerator */
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
package <?= $dataClass->getRemotePackage() . PHP_EOL ?>
{
<? if (count($dataClass->props) > 0): ?>
<? foreach($dataClass->props as $name => $type): ?>
	<? if (!PHPUtils::isASStandardType($type->type)) echo $model->getClientAsClassImport($type->type); ?>
<? endforeach; ?>
<?php endif; ?>

	[Bindable]
<? if ('' != $remoteClass = $dataClass->getRemoteClass()):?>
	// this class is "abstract" - use  <?= $remoteClass ?>

	// and copy this to <?= $remoteClass ?> [RemoteClass(alias="<?= $dataClass->type ?>")]
<? else: ?>
	[RemoteClass(alias='<?= $model->getVORemoteAliasName($dataClass) ?>')]
<? endif; ?>

	/**
	 * @link    http://www.foomo.org
	 * @license http://www.gnu.org/licenses/lgpl.txt
	 * @author  franklin <franklin@weareinteractive.com>
	 */
	public class <?= $model->getVOClassName($dataClass) ?>
	{
<?php if (count($dataClass->constants) > 0): ?>
		//-----------------------------------------------------------------------------------------
		// ~ Constants
		//-----------------------------------------------------------------------------------------

<?= $view->intend(ViewHelper::renderConstants($dataClass->constants), 2) . PHP_EOL ?>

<?php endif; ?>
<? if (count($dataClass->props) > 0): ?>
		//-----------------------------------------------------------------------------------------
		// ~ Variables
		//-----------------------------------------------------------------------------------------
<? foreach($dataClass->props as $name => $type): ?>

<?= $view->indent(ViewHelper::renderComment((isset($type->phpDocEntry) && !empty($type->phpDocEntry->comment)) ? $type->phpDocEntry->comment : ''), 2) . PHP_EOL; ?>
<? if ($type->isArrayOf): ?>
		[ArrayElementType("<?= PHPUtils::getASType($type->type); ?>")]
		public var <?= $name ?>:Array;
<? else: ?>
		public var <?= $name ?>:<?= PHPUtils::getASType($type->type); ?>;
<? endif; ?>
<? endforeach; ?>
<?php endif; ?>
	}
}