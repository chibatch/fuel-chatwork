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
 * Task model
 *
 * @package chatwork
 * @extends ChatWork\Model
 */
class Task extends Model
{
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
	 * @param int
	 * @param ChatWork\Api
	 */
	public function __construct(array $data = array(), $room_id = null, \ChatWork\Api $api)
	{
		$this->room_id = $room_id;

		parent::__construct($data, $api);
	}
}
