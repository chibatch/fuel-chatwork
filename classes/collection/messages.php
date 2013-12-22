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
	 * @param \ChatWork\Api
	 */
	public function __construct(array $data = array(), $room_id = null, \ChatWork\Api $api)
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
		return new Message($data, $this->room_id, $this->api);
	}
}
