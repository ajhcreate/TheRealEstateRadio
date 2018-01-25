<?php
/**
 * Joomfuse tables
 * @package     admin.com_joomfuse
 * @subpackage	tables.ifsuser
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JTableIFSUser extends JTable
{
	/**
	 * @param   JDatabaseDriver  A database connector object
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__joomfuse_users', 'id', $db);
	}
}
