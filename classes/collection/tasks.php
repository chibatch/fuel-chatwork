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
use ChatWork\Model\Task;
use ChatWork\Model\Room;

/**
 * Task collection class
 *
 * @package chatwork
 * @extends ChatWork\Collectiono
 */
class Tasks extends Collection
{
	/**
	 * Room ID
	 *
	 * @var int|string
	 */
	protected $room_id;

	/**
	 * Constructor
	 *
	 * @param array
	 * @param string|int
	 * @param \ChatWork\Api
	 */
	public function __construct($data, $room_id = null, \ChatWork\Api $api)
	{
		$this->room_id = $room_id;

		parent::__construct($data, $api);
	}

	/**
	 * Data to Model
	 *
	 * @param  array
	 * @return ChatWork\Model\Task
	 */
	protected function to_model($data)
	{
		$room_id = \Arr::get($data, 'room.room_id', $this->room_id);

		return new Task($data, $room_id, $this->api);
	}
}
