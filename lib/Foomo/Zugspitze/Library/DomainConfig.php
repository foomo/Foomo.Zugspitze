<?php

namespace Foomo\Zugspitze\Library;

class DomainConfig extends \Foomo\Config\AbstractConfig
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const NAME = 'Foomo.Zugspitze.Library.presets';

	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	public $entries = array(
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
	 * @param string $id
	 * @return Foomo\Zugspitze\Library\DomainConfigEntry
	 */
	public function getEntry($id)
	{
		if (!isset($this->entries[$id])) throw new \Exception('Config ' . $id . ' does not exist! Check your Foomo.Flash.flex config!');
		$entry = new DomainConfig\Entry();
		$entry->id = $id;
		$entry->name = $this->entries[$id]['name'];
		$entry->description = $this->entries[$id]['description'];
		$entry->projectLibraryIds = $this->entries[$id]['projectLibraryIds'];
		return $entry;
	}
}
