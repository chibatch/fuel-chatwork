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
use ChatWork\Model\Message;
use ChatWork\Model\Task;
use ChatWork\Model\File;
use ChatWork\Collection\Tasks;
use ChatWork\Collection\Files;
use ChatWork\Collection\Members;
use ChatWork\Collection\Messages;

/**
 * Room model
 *
 * @package chatwork
 * @extends Model
 */
class Room extends Model
{
	protected $room_id          = 0;
	protected $name             = '';
	protected $type             = 'group';
	protected $role             = 'member';
	protected $sticky           = 0;
	protected $unread_num       = 0;
	protected $mention_num      = 0;
	protected $mytask_num       = 0;
	protected $message_num      = 0;
	protected $file_num         = 0;
	protected $task_num         = 0;
	protected $icon_path        = '';
	protected $description      = '';
	protected $last_update_time = 0;

	/**
	 * Leave
	 */
	public function leave()
	{
		$this->api->leave_room($this->room_id);
	}

	/**
	 * Delete
	 */
	public function delete()
	{
		$this->api->delete_room($this->room_id);
	}

	/**
	 * Find members
	 *
	 * @return ChatWork\Collection\Members
	 */
	public function get_members()
	{
		$result = $this->api->get_room_members($this->room_id);

		return new Members($result, $this->room_id);
	}

	/**
	 * Update members
	 *
	 * @param  array
	 * @return ChatWork\Collection\Members
	 */
	public function update_members($members)
	{
		$room_id      = $this->data['room_id'];
		$admin_ids    = \Arr::get($members, 'admin',    array());
		$member_ids   = \Arr::get($members, 'member',   array());
		$readonly_ids = \Arr::get($members, 'readonly', array());

		$params = array(
			'members_admin_ids'    => implode(',', $admin_ids),
			'members_member_ids'   => implode(',', $member_ids),
			'members_readonly_ids' => implode(',', $readonly_ids),
		);

		$this->api->update_room_members($room_id, $params);

		return $this->get_members();
	}

	/**
	 * Get messages
	 *
	 * @return ChatWork\Collection\Messages
	 */
	public function get_messages()
	{
		$result = $this->api->get_room_messages($this->room_id);

		return new Messages($result, $this->room_id);
	}

	/**
	 * Get message
	 *
	 * @param  int
	 * @return ChatWork\Model\Message
	 */
	public function get_message($message_id)
	{
		$result = $this->api->get_room_message($this->room_id, $message_id);

		return new Message($result, $this->room_id);
	}

	/**
	 * Send message
	 *
	 * @param  string
	 * @return ChatWork\Model\Message
	 */
	public function send_message($message)
	{
		$result = $this->api->create_room_message($this->room_id, array(
			'body' => $message,
		));

		$message_id = \Arr::get($result, 'message_id');

		return $this->get_message($message_id);
	}

	/**
	 * Find tasks
	 *
	 * @param  array
	 * @return ChatWork\Collection\Tasks
	 */
	public function get_tasks($conditions = array())
	{
		$result = $this->api->get_room_tasks($this->room_id, $conditions);

		return new Tasks($result, $this->room_id);
	}

	/**
	 * Get task
	 *
	 * @param  int
	 * @param  array
	 * @return ChatWork\Model\Task
	 */
	public function get_task($task_id, $conditions = array())
	{
		$result = $this->api->get_room_task($this->room_id, $task_id, $conditions);

		return new Task($result, $this->room_id);
	}

	/**
	 * Add task
	 *
	 * @param  string
	 * @param  array
	 * @return task
	 */
	public function add_task($task, $params)
	{
		$to_ids = \Arr::get($params, 'to_ids');

		return $this->api->create_room_task($this->room_id, array(
			'body'   => $task,
			'to_ids' => implode(',', $to_ids),
			'limit'  => \Arr::get($params, 'limit'),
		));
	}

	/**
	 * Find files
	 *
	 * @param  array
	 * @return ChatWork\Collection\Files
	 */
	public function get_files($conditions = array())
	{
		$result = $this->api->get_room_files($this->room_id, $conditions);

		return new Files($result, $this->room_id);
	}

	/**
	 * Get file
	 *
	 * @param  int
	 * @param  array
	 * @return ChatWork\Model\File
	 */
	public function get_file($file_id, $conditions = array())
	{
		$result = $this->api->get_room_file($this->room_id, $file_id, $conditions);

		return new File($result, $this->room_id);
	}
}
