<?php
/**
 * Joomfuse views
 * @package     site.com_joomfuse
 * @subpackage	views.jomfuse.tmpldefault
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>


<?php if(empty($this->result)){
    echo 'SUCCESS';
} else {
    echo 'FAIL: '.$this->result;
}
?>