<?php
/**
 * @package   OSMap
 * @copyright 2007-2014 XMap - Joomla! Vargas - Guillermo Vargas. All rights reserved.
 * @copyright 2016 Open Source Training, LLC. All rights reserved.
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

namespace Alledia\OSMap\View\Sitemap;

use Alledia\OSMap;

defined('_JEXEC') or die();


class HtmlPro extends Html
{
    /**
     * @var int
     */
    protected $columns = 1;

    /**
     * The constructor
     */
    public function __construct($config = array())
    {
        parent::__construct($config);

        $this->columns = (int)$this->params->get('columns', 1);
    }

    /**
     * Open a menu list
     *
     * @param object $node
     * @param string $cssClass
     *
     * @return void
     */
    public function openMenu($node, $cssClass = '')
    {
        $cssClass .= ' columns_' . $this->columns;

        parent::openMenu($node, $cssClass);
    }
}
