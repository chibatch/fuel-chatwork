<?php
/**
 * FuelPHP ChatWork Packages
 *
 * @author    Kotaro Chiba
 * @copyright Kotaro Chiba
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * @package   Fuel
 */
namespace ChatWork\Model;

use ChatWork\Model;
use ChatWork\Model\Room;

/**
 * Task model
 *
 * @package chatwork
 * @extends ChatWork\Model
 */
class Task extends Model
{
	/**
	 * Find task
	 *
	 * @param  int|string
	 * @param  int|string
	 * @param  array
	 * @return ChatWork\Model\Task
	 */
	public static function find($room_id, $task_id, $conditions = array())
	{
		$api = parent::get_api();

		$result = $api->get_room_task($room_id, $task_id, $conditions);

		return new static($result, $room_id);
	}

	protected $task_id             = 0;
	protected $account             = array();
	protected $assigned_by_account = array();
	protected $room                = array();
	protected $message_id          = 0;
	protected $body                = '';
	protected $limit               = 0;
	protected $satus               = 'open';

	/**
	 * Room id that task belongs
	 *
	 * @param int
	 */
	protected $room_id = null;

	/**
	 * Constructor
	 *
	 * @param array
	 * @param int|string
	 */
	public function __construct($data = array(), $room_id = null)
	{
		$this->room_id = $room_id;

		parent::__construct($data);
	}

	/**
	 * Get room
	 *
	 * @return ChatWork\Model\Room
	 */
	public function get_room()
	{
		if (empty($this->room_id))
		{
			return null;
		}

		return Room::find($this->room_id);
	}
}
