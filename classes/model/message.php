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
	public function __construct(array $data = array(), $room_id = null)
	{
		$this->room_id = $room_id;

		parent::__construct($data);
	}
}
