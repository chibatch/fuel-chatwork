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
 * File model
 *
 * @package chatwork
 * @extends ChatWork\Model
 */
class File extends Model
{
  protected $file_id      = 0;
  protected $account      = array();
  protected $message_id   = 0;
  protected $filename     = '';
  protected $filesize     = 0;
  protected $upload_time  = 0;
  protected $download_url = '';

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
		parent::__construct($data, $api);

		$this->room_id = $room_id;
	}
}
