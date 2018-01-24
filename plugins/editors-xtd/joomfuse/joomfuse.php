<?php
/**
 * @package     Joomla.JoomFuse.Plugin
 * @subpackage  Editors-xtd.joomfuse
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * JoomFuse editor buttons
 */
class PlgButtonJoomfuse extends JPlugin{
    /**
     * Display the button.
     *
     * @param   string   $name    The name of the button to display.
     * @param   string   $asset   The name of the asset being edited.
     * @param   integer  $author  The id of the author owning the asset being edited.
     *
     * @return  array    A two element array of (imageName, textToInsert) or false if not authorised.
     */
    public function onDisplay($name, $asset, $author){
        /*
         * Javascript to insert the shortcode
         * Like the edits-xtd.article plugin, the view element calls jfSelectShortcode when a shortcode is clicked
         * jfSelectShortcode creates the link tag, sends it to the editor, and closes the select frame.
         */
        $js = "
		function jfSelectShortcode(fieldname){
			var text = '{JoomFuse '+fieldname+'}';
			jInsertEditorText(text, '" . $name . "');
			SqueezeBox.close();
		}";
        JFactory::getDocument()->addScriptDeclaration($js);


        $link = 'index.php?option=com_joomfuse&amp;view=shortcodefields&amp;tmpl=component';
        $button = new JObject;
        $button->modal = true;
        $button->class = 'btn';
        $button->link = $link;
        $button->text = 'JoomFuse Shortcode';
        $button->name = 'user';
        $button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";

        //return '<select name="test" id="test"><option value="1">MEOW</option></select>';
        return $button;

    }
}
