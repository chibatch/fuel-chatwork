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
	 * Find tasks
	 *
	 * @param  array $room_id
	 * @param  array
	 * @return ChatWork\Collection\Tasks
	 */
	public static function find($room_id = null, $conditions = array())
	{
		if (is_null($room_id) or $room_id === 'self')
		{
			return self::find_my_tasks($conditions);
		}

		return self::find_by_room($room_id, $conditions);
	}

	/**
	 * Find my tasks
	 *
	 * @return ChatWork\Collection\Contacts
	 */
	private static function find_my_tasks()
	{
		$api = parent::get_api();

		$result = $api->get_my_tasks();

		return new static($result);
	}

	/**
	 * Find tasks by room
	 *
	 * @param  int|string
	 * @return ChatWork\Collection\Contacts
	 */
	private static function find_by_room($room_id, $conditions = array())
	{
		$api = parent::get_api();

		$result = $api->get_room_tasks($room_id, $conditions);

		return new static($result, $room_id);
	}

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
	 */
	public function __construct($data, $room_id = null)
	{
		$this->room_id = $room_id;

		parent::__construct($data);
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

		return new Task($data, $room_id);
	}
}
