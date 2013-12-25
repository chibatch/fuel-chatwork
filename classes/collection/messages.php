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
use ChatWork\Model\Message;

/**
 * Message collection
 *
 * @package chatwork
 * @extends ChatWOrk\Collection
 */
class Messages extends Collection
{
	/**
	 * Find messages
	 *
	 * @param  int|string
	 * @return ChatWork\Collection\Messages
	 */
	public static function find($room_id)
	{
		return array();
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
	public function __construct($data = array(), $room_id = null)
	{
		$this->room_id = $room_id;

		parent::__construct($data, $api);
	}

	/**
	 * Data to Model
	 *
	 * @param  array
	 * @return ChatWork\Model\Message
	 */
	protected function to_model($data)
	{
		return new Message($data, $this->room_id);
	}
}
