<?php
/**
 * FuelPHP ChatWork Packages
 *
 * @author    Kotaro Chiba
 * @copyright Kotaro Chiba
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * @package   Fuel
 */
namespace ChatWork\Collection;

use ChatWork\Collection;
use ChatWork\Model\File;

/**
 * File collection
 *
 * @package chatwork
 * @extends ChatWork\Collection
 */
class Files extends Collection
{
	/**
	 * Find files
	 *
	 * @param  int|string
	 * @return ChatWork\Collection\Files
	 */
	public static function find($room_id, $conditions = array())
	{
		$api = parent::get_api();

		$result = $api->get_room_files($room_id, $conditions);

		return new static($result, $room_id);
	}

	/** @var string|int Room ID */
	protected $room_id;

	/**
	 * Constructor
	 *
	 * @param array
	 * @param int
	 */
	public function __construct(array $data = array(), $room_id = null)
	{
		$this->room_id = $room_id;

		parent::__construct($data);
	}

	/**
	 * Data to Model
	 *
	 * @return ChatWork\Model\File
	 */
	protected function to_model($data)
	{
		return new File($data, $this->room_id);
	}
}
