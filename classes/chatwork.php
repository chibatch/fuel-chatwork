<?php
/**
 * FuelPHP ChatWork Packages
 *
 * @author	Kotaro Chiba
 * @copyright Kotaro Chiba
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * @package   Fuel
 */
namespace ChatWork;

use ChatWork\Api;
use ChatWork\Object;
use ChatWork\Model\CurrentUser;
use ChatWork\Model\Room;

/**
 * ChatWork base class
 */
class ChatWork extends Object
{
	/**
	 * API
	 *
	 * @var ChatWork\Api
	 */
	private $api;

	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct($data = array())
	{
		$auth_param = array(
			'token' => \Arr::get($data, 'token')
		);
		$this->api = new Api($auth_param);
	}

	/**
	 * Get current user
	 *
	 * @return ChatWork\Model\User\CurrentUser
	 */
	public function get_current_user()
	{
		$data = $this->api->get_my_profile();

		return new CurrentUser($data, $this->api);
	}

	/**
	 * Get room
	 *
	 * @param  int
	 * @return ChatWork\Model\Room
	 */
	public function get_room($room_id)
	{
		$result = $this->api->get_room($room_id);

		return new Room($result, $this->api);
	}

	/**
	 * Create room
	 *
	 * @param  array
	 * @return ChatWork\Room
	 */
	public function create_room($params)
	{
		$result = $this->api->create_room($params);

		$room_id = \Arr::get($result, 'room_id');

		$room_data = $this->api->get_room($room_id);

		return new Room($room_data, $this->api);
	}
}
