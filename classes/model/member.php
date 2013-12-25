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
 * Members collection
 *
 * @package chatwork
 * @extends Model
 */
class Member extends Model
{
	protected $account_id        = '';
	protected $role              = '';
	protected $name              = '';
	protected $chatwork_id       = '';
	protected $organization_id   = 0;
	protected $organization_name = '';
	protected $department        = '';
	protected $avatar_image_url  = '';

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
	 * @param ChatWork\Api
	 */
	public function __construct($data = array(), $room_id = null)
	{
		$this->room_id = $room_id;

		parent::__construct($data);
	}

}
