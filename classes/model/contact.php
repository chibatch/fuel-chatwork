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
 * Contact model
 *
 * @package chatwork
 * @extends ChatWork\Model
 */
class Contact extends Model
{
	protected $account_id        = 0;
	protected $room_id           = 0;
	protected $name              = '';
	protected $chatwork_id       = '';
	protected $organization_id   = 0;
	protected $organization_name = '';
	protected $department        = '';
	protected $avatar_url        = '';

	/**
	 * Get direct chat
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
