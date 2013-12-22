<?php
/**
 * FuelPHP ChatWork Packages
 *
 * @author    Kotaro Chiba
 * @copyright Kotaro Chiba
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * @package   Fuel
 */

Autoloader::add_core_namespace('ChatWork');

Autoloader::add_classes(array(
    // ChatWork class
    'ChatWork\\ChatWork'             => __DIR__.'/classes/chatwork.php',
    'ChatWork\\Api'                  => __DIR__.'/classes/api.php',
    'ChatWork\\Object'               => __DIR__.'/classes/object.php',
    'ChatWork\\Model'                => __DIR__.'/classes/model.php',
    'ChatWork\\Model\\CurrentUser'   => __DIR__.'/classes/model/currentuser.php',
    'ChatWork\\Model\\Contact'       => __DIR__.'/classes/model/contact.php',
    'ChatWork\\Model\\Room'          => __DIR__.'/classes/model/room.php',
    'ChatWork\\Model\\Task'          => __DIR__.'/classes/model/task.php',
    'ChatWork\\Model\\File'          => __DIR__.'/classes/model/file.php',
    'ChatWork\\Model\\Member'        => __DIR__.'/classes/model/member.php',
    'ChatWork\\Model\\Message'       => __DIR__.'/classes/model/message.php',
    'ChatWork\\Collection'           => __DIR__.'/classes/collection.php',
    'ChatWork\\Collection\\Rooms'    => __DIR__.'/classes/collection/rooms.php',
    'ChatWork\\Collection\\Tasks'    => __DIR__.'/classes/collection/tasks.php',
    'ChatWork\\Collection\\Contacts' => __DIR__.'/classes/collection/contacts.php',
    'ChatWork\\Collection\\Members'  => __DIR__.'/classes/collection/members.php',
    'ChatWork\\Collection\\Messages' => __DIR__.'/classes/collection/messages.php',
    'ChatWork\\Collection\\Files'    => __DIR__.'/classes/collection/files.php',
));
