<?php
/**
 * @package   AdminTools
 * @copyright 2010-2017 Akeeba Ltd / Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 3, or later
 */

// Protect from unauthorized access
defined('_JEXEC') or die;

@ob_end_clean();
echo '###' . json_encode($this->retarray) . '###';

$this->container->platform->closeApplication();