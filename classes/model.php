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
	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct(array $data = array())
	{
		parent::__construct($data);
	}

	/**
	 * Get datetime
	 *
	 * @param  int
	 * @param  string
	 * @return string
	 */
	protected function get_datetime($timestamp, $format='Y-m-d')
	{
		if ($timestamp === 0)
		{
			return 'none';
		}

		$datetime = new \DateTime();
		$datetime->setTimestamp($timestamp);

		return $datetime->format($format);

	}
}
