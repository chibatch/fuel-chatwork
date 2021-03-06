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
	/**
	 * Find Room
	 *
	 * @param  int|string
	 * @return ChatWork\Model\Room
	 */
	public static function find($room_id)
	{
		$api = parent::get_api();

		$result = $api->get_room($room_id);

		return new static($result);
	}

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
		$api = parent::get_api();
		$api->leave_room($this->room_id);
	}

	/**
	 * Delete
	 */
	public function delete()
	{
		$api = parent::get_api();
		$api->delete_room($this->room_id);
	}

	/**
	 * Find members
	 *
	 * @return ChatWork\Collection\Members
	 */
	public function get_members()
	{
		return Members::find($this->room_id);
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

		$api = parent::get_api();
		$api->update_room_members($room_id, $params);

		return $this->get_members();
	}

	/**
	 * Get messages
	 *
	 * @return ChatWork\Collection\Messages
	 */
	public function get_messages()
	{
		return Messages::find($this->room_id);
	}

	/**
	 * Get message
	 *
	 * @param  int
	 * @return ChatWork\Model\Message
	 */
	public function get_message($message_id)
	{
		return Message::find($this->room_id, $message_id);
	}

	/**
	 * Send message
	 *
	 * @param  string
	 * @return ChatWork\Model\Message
	 */
	public function send_message($message)
	{
		$api = parent::get_api();
		$result = $api->create_room_message($this->room_id, array(
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
		return Tasks::find($this->room_id, $conditions);
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
		return Task::find($this->room_id, $task_id, $conditions);
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

		$api = parent::get_api();
		return $api->create_room_task($this->room_id, array(
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
		return Files::find($this->room_id, $conditions);
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
		return File::find($this->room_id, $file_id, $conditions);
	}
}
