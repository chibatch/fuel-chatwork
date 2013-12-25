<?php
/**
 * FuelPHP ChatWork Packages
 *
 * @author	Kotaro Chiba
 * @copyright Kotaro Chiba
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * @package   Fuel
 */
namespace Chatwork;

/**
 * API class
 */
class Api extends \Model
{
	/** @var string Endpoint */
	const CHATWORK_API_ENDPOINT = 'https://api.chatwork.com/';

	/** @var string API version */
	const CHATWORK_API_VERSION = 'v1';

	/**
	 * Create ChatWork API instance
	 *
	 * @param  array
	 * @return ChatWork\Api
	 */
	public static function forge($params = array())
	{
		return new static ($params);
	}

	/** @var string ChatWork API token */
	private $token;

	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct($params = array())
	{
		$token = \Arr::get($params, 'token');

		\Session::set('chatwork.token', $token);
	}

	/**
	 * HTTP Requests
	 *
	 * @param  string Request method
	 * @param  string Uri
	 * @param  array  Parameter
	 * @return array
	 * @throws \Fuel\Core\RequestStatusException
	 * @throws \Fuel\Core\RequestException
	 */
	private function call($method, $url, $params = array())
	{
		$url	= self::CHATWORK_API_ENDPOINT.self::CHATWORK_API_VERSION.$url;
		$params = array_filter($params);

		$request = \Request::forge($url, 'curl');
		$request->set_method($method);
		$request->set_params($params);
		$request->set_header('X-ChatWorkToken', \Session::get('chatwork.token'));

		$request->execute();

		$response = $request->response();

		return json_decode($response->body, true);
	}

	/**
	 *
	 *
	 * @param  string Uri
	 * @param  array  Parameter
	 * @return array
	 */
	private function get($url, $params = array())
	{
		return $this->call('get', $url, $params);
	}

	/**
	 *
	 *
	 * @param  string Uri
	 * @param  array  Parameter
	 * @return array
	 */
	private function post($url, $params = array())
	{
		return $this->call('post', $url, $params);
	}

	/**
	 *
	 *
	 * @param  string Uri
	 * @param  array  Parameter
	 * @return array
	 */
	private function put($url, $params = array())
	{
		return $this->call('put', $url, $params);
	}

	/**
	 *
	 *
	 * @param  string Uri
	 * @param  array  Parameter
	 * @return array
	 */
	private function delete($url, $params = array())
	{
		return $this->call('delete', $url, $params);
	}

	/**
	 * Get my profile
	 *
	 * @return array
	 */
	public function get_my_profile()
	{
		return $this->get('/me');
	}

	/**
	 * Get my status
	 *
	 * @return array
	 */
	public function get_my_status()
	{
		return $this->get('/my/status');
	}

	/**
	 * Get my tasks
	 *
	 * @param  array
	 * @return array
	 */
	public function get_my_tasks($conditions = array())
	{
		return $this->get('/my/tasks', $conditions);
	}

	/**
	 * Get my contact list
	 *
	 * @return array
	 */
	public function get_contacts()
	{
		return $this->get('/contacts');
	}

	/**
	 * Get my room list
	 *
	 * @return array
	 */
	public function get_my_rooms()
	{
		return $this->get('/rooms');
	}

	/**
	 * Create room
	 *
	 * @param  array
	 * @return array
	 */
	public function create_room($params)
	{
		return $this->post('/rooms', $params);
	}

	/**
	 * Get room
	 *
	 * @param  int
	 * @return array
	 */
	public function get_room($room_id)
	{
		$url = sprintf('/rooms/%s', $room_id);

		return $this->get($url);
	}

	/**
	 * Update room
	 *
	 * @param  int
	 * @param  array
	 * @return array
	 */
	public function update_room($room_id, $params)
	{
		$url = sprintf('/rooms/%s', $room_id);
		return $this->put($url, $params);
	}

	/**
	 * Leave room
	 *
	 * @return array
	 */
	public function leave_room($room_id)
	{
		$url	= sprintf('/rooms/%s', $room_id);
		$params = array(
			'action_type' => 'leave',
		);
		return $this->delete($url, $params);
	}

	/**
	 * Delete room
	 *
	 * @return array
	 */
	public function delete_room($room_id)
	{
		$url	= sprintf('/rooms/%s', $room_id);
		$params = array(
			'action_type' => 'delete',
		);
		return $this->delete($url, $params);
	}

	/**
	 * Get room members
	 *
	 * @param  int
	 * @return array
	 */
	public function get_room_members($room_id)
	{
		$url = sprintf('/rooms/%s/members', $room_id);

		return $this->get($url);
	}

	/**
	 * Update room members
	 *
	 * @param  int
	 * @param  array
	 * @return array
	 */
	public function update_room_members($room_id, $params)
	{
		$url = sprintf('/rooms/%s/members', $room_id);

		return $this->put($url, $params);
	}

	/**
	 * Get room messages
	 *
	 * @param  int
	 * @return array
	 */
	public function get_room_messages($room_id)
	{
		return array();
	}

	/**
	 * Send message to room
	 *
	 * @param  int
	 * @param  array
	 * @return array
	 */
	public function create_room_message($room_id, $params)
	{
		$url	= sprintf('/rooms/%s/messages', $room_id);

		return $this->post($url, $params);
	}

	/**
	 * Get room message
	 *
	 * @param  int
	 * @param  int
	 * @return array
	 */
	public function get_room_message($room_id, $message_id)
	{
		$url = sprintf('/rooms/%s/messages/%s', $room_id, $message_id);

		return $this->get($url);
	}

	/**
	 * Get room tasks
	 *
	 * @param  int
	 * @param  array
	 * @return array
	 */
	public function get_room_tasks($room_id, $conditions = array())
	{
		$url = sprintf('/rooms/%s/tasks', $room_id);

		return $this->get($url, $conditions);
	}

	/**
	 * Get room task
	 *
	 * @param  int
	 * @param  int
	 * @return array
	 */
	public function get_room_task($room_id, $task_id)
	{
		$url = sprintf('/rooms/%s/tasks/%s', $room_id, $task_id);

		return $this->get($url);
	}

	/**
	 * Create task
	 *
	 * @param  int
	 * @param  array
	 * @return array
	 */
	public function create_room_task($room_id, $params)
	{
		$url = sprintf('/rooms/%s/tasks', $room_id);

		return $this->post($url, $params);
	}

	/**
	 * Get room files
	 *
	 * @param  int
	 * @param  array
	 * @return array
	 */
	public function get_room_files($room_id, $conditions = array())
	{
		$url = sprintf('/rooms/%s/files', $room_id);

		return $this->get($url, array(
			'account_id' => \Arr::get($conditions, 'account_id'),
		));
	}

	/**
	 * Get room file
	 *
	 * @param  int
	 * @param  int
	 * @param  array
	 * @return array
	 */
	public function get_room_file($room_id, $file_id, $conditions = array())
	{
		$url = sprintf('/rooms/%s/files/%s', $room_id, $file_id);

		return $this->get($url, array(
			'create_download_url' => (int) \Arr::get($conditions, 'create_download_url'),
		));
	}
}

