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
 * Collection class
 *
 * @package chatwork
 * @extends ChatWork\Object
 */
abstract class Collection extends Object implements \IteratorAggregate, \ArrayAccess, \Countable
{
	/**
	 * ChatWork API token
	 *
	 * @var ChatWork\Api
	 */
	protected $api;

	/**
	 * Constructor
	 *
	 * @param array
	 * @param ChatWork\Api
	 */
	public function __construct($data = array())
	{
		$this->api = parent::get_api();

		$this->set_data($data);
	}

	abstract protected function to_model($data);

	/**
	 * Set object
	 *
	 * @param array
	 */
	public function set_data($data)
	{
		if (empty($data)) {
			return;
		}

		foreach ($data as $raw_data)
		{
			$this->origin[] = $this->to_model($raw_data);
		}
	}

	/**
	 * IteratorAggregate
	 *
	 * @return ArrayIterator
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->origin);
	}

	/**
	 * ArrayAccess::offsetExists
	 */
	public function offsetExists($offset)
	{
		return isset($this->data[$offset]);
	}

	/**
	 * ArrayAccess::offsetGet
	 */
	public function offsetGet($offset)
	{
		return $this->data[$offset];
	}

	/**
	 * ArrayAccess::offsetSet
	 */
	public function offsetSet($offset, $value)
	{
		trigger_error('You can\'t set collection data');
	}

	/**
	 * ArrayAccess::iffsetUnset
	 */
	public function offsetUnset($offset)
	{
		trigger_error('You can\'t set collection data');
	}

	/**
	 * Countable
	 */
	public function count()
	{
		return count($this->origin);
	}
}
