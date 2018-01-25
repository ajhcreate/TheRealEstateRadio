<?php
/**
 * @package   OSMap
 * @copyright 2007-2014 XMap - Joomla! Vargas - Guillermo Vargas. All rights reserved.
 * @copyright 2016 Open Source Training, LLC. All rights reserved.
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

namespace Alledia\OSMap\Helper;

defined('_JEXEC') or die();


class ImagesPro extends Images
{
    /**
     * Extracts images from the given text.
     *
     * @param string $text
     * @param int    $max
     *
     * @return array
     */
    public function getImagesFromText($text, $max = 9999)
    {
        $text = \JHtml::_('content.prepare', $text);

        return parent::getImagesFromText($text, $max);
    }
}
