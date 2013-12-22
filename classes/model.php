<?php
/**
 * FuelPHP ChatWork Packages
 *
 * @author    Kotaro Chiba
 * @copyright Kotaro Chiba
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * @package   Fuel
 */
namespace ChatWork;

use ChatWork\Object;

/**
 * Base model model
 *
 * @package chatwork
 * @extends ChatWork\Object
 */
class Model extends Object
{
	/** @bar ChatWork\Api */
	protected $api;

	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct(array $data = array(), \ChatWork\Api $api)
	{
		$this->api  = $api;

		parent::__construct($data);
	}
}
