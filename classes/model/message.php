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

/**
 * Message model
 *
 * @package chatwork
 * @extends Model
 */
class Message extends Model
{
	/**
	 * Find message
	 *
	 * @param  int|string
	 * @param  int|string
	 * @return ChatWork\Model\Message
	 */
	public static function find($room_id, $message_id)
	{
		$api = parent::get_api();

		$result = $api->get_room_message($room_id, $message_id);

		return new static($result, $room_id);
	}

	protected $message_id  = 0;
	protected $account     = array();
	protected $body        = '';
	protected $send_time   = 0;
	protected $update_time = 0;

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

	/**
	 * Get send time
	 *
	 * @param  string
	 * @return string
	 */
	public function get_send_time($format = 'Y-m-d H:i:s')
	{
		return $this->get_datetime($this->send_time, $format);
	}

	/**
	 * Get update time
	 *
	 * @param  string
	 * @return string
	 */
	public function get_update_time($format = 'Y-m-d H:i:s')
	{
		return $this->get_datetime($this->update_time, $format);
	}
}
