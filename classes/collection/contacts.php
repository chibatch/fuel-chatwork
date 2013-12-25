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
use ChatWork\Model\Contact;

/**
 * Contact collection
 *
 * @package chatwork
 * @extends Collection
 */
class Contacts extends Collection
{
    /**
     * Get contact list
     *
     * @return ChatWork\Collection\Contacts
     */
    public static function find()
    {
        $api = static::get_api();

        $result = $api->get_contacts();

        return new static($result);
    }

	/**
	 * Data to Model
	 *
	 * @return ChatWork\Contact
	 */
	protected function to_model($data)
	{
		return new Contact($data);
	}
}
