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

use ChatWork\Api;

/**
 * Base object for Fuel-ChatWork
 *
 * @package chatwork
 */
class Object
{
	/**
	 * Get API class
	 *
	 * @return ChatWork\Api
	 */
	protected static function get_api()
	{
		$auth_params = \Session::get('chatwork');

		return Api::forge($auth_params);
	}


	/**
	 * Object data
	 *
	 * @var array
	 */
	protected $origin = array();

	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct(array $data = array())
	{
		$this->origin = $data;

		$this->set_properties($data);
	}

	/**
	 * Set a property
	 *
	 * @param  string
	 * @param  mixed
	 * @throws LogicException
	 */
	public function __set($name, $value)
	{
		if(!property_exists($this, $name))
		{
			$error = sprintf('Undefined property: %s', $name);
			throw new \LogicException($error);
		}

		$this->{$name} = $value;
	}

	/**
	 * Get a property
	 *
	 * @param  string
	 * @throws LogicException
	 */
	public function __get($name)
	{
		if(!property_exists($this, $name))
		{
			$error = sprintf('Undefined property: %s', $name);
			throw new \LogicException($error);
		}

		return $this->{$name};
	}

	/**
	 * Set properties
	 *
	 * @param array
	 */
	protected function set_properties($properties)
	{
		foreach ($properties as $property => $value)
		{
			if (!property_exists($this, $property))
			{
				continue;
			}

			$this->{$property} = $value;
		}
	}
}
