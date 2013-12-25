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
use ChatWork\Model\Member;

/**
 * Members collection
 *
 * @package chatwork
 * @extends Collection
 */
class Members extends Collection
{
	/**
	 * Find members
	 *
	 * @param  int|string
	 * @return ChatWork\Collection\Members
	 */
	public static function find($room_id)
	{
		$api = parent::get_api();

		$result = $api->get_room_members($room_id);

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
	public function __construct($data = array(), $room_id = null)
	{
		$this->room_id = $room_id;

		parent::__construct($data);
	}

	/**
	 * Data to Model
	 *
	 * @param array
	 */
	protected function to_model($data)
	{
		return new Member($data, $this->room_id);
	}
}
