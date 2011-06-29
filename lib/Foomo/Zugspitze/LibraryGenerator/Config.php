<?php

namespace Foomo\Zugspitze\LibraryGenerator;

class Config extends \Foomo\Config\AbstractConfig
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const NAME = 'Foomo.Zugspitze.libraryGeneratorConfig';

	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	public $presets = array(
		'flex4' => array(
			'name' => 'Flex 4 (Spark)',
			'description' => '',
			'projectLibraryIds' => array('org.foomo.zugspitze.core', 'org.foomo.zugspitze.flex4')
		),
		'flex3' => array(
			'name' => 'Flex 3 (MX)',
			'description' => '',
			'projectLibraryIds' => array('org.foomo.zugspitze.core', 'org.foomo.zugspitze.flex3')
		),
		'air4' => array(
			'name' => 'Air Flex 4 (Spark)',
			'description' => '',
			'projectLibraryIds' => array('org.foomo.zugspitze.core', 'org.foomo.zugspitze.flex4', 'org.foomo.zugspitze.air4')
		),
		'air3' => array(
			'name' => 'Air Flex 3 (MX)',
			'description' => '',
			'projectLibraryIds' => array('org.foomo.zugspitze.core', 'org.foomo.zugspitze.flex3', 'org.foomo.zugspitze.air3')
		),
		'as3' => array(
			'name' => 'ActionScript',
			'description' => '',
			'projectLibraryIds' => array('org.foomo.zugspitze.core', 'org.foomo.zugspitze.as3')
		)
	);

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @return Foomo\Zugspitze\LibraryGenerator\Config\Preset[]
	 */
	public function getPresets()
	{
		$presets = array();
		foreach ($this->presets as $id => $preset) $presets[] = $this->getPreset($id);
		return $presets;
	}

	/**
	 * @param string $id
	 * @return Foomo\Zugspitze\LibraryGenerator\Config\Preset
	 */
	public function getPreset($id)
	{
		if (null == $preset = $this->presets[$id]) throw new \Exception('Preset ' . $id . ' does not exist! Check your ' . self::NAME . ' config!');
		return Config\Preset::create($id, $preset['name'], $preset['description'], $preset['projectLibraryIds']);
	}
}
