<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.jcebrowser
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Editor JCE File Browser button
 *
 * @since  0.9.0
 */
class PlgButtonPbjcebrowser extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  0.9.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * Display the button
	 *
	 * @param   string  $name  The name of the button to add
	 *
	 * @return  JObject  The button options as JObject
	 *
	 * @since   0.9.0
	 */
	public function onDisplay($name)
	{
		/* Check JCE enabled */
		if ( !JComponentHelper::isEnabled('com_jce', true) ) return;

		/* Check persmissions */
		$user  = JFactory::getUser();
		$access = $user->authorise('core.create', 'com_content') || $user->authorise('core.edit', 'com_content') || $user->authorise('core.edit.own', 'com_content');

		if ( $access )
		{
			$link = 'index.php?option=com_jce&option=com_jce&task=plugin.display&plugin=browser&standalone=1&editor='.$name.'&'.JSession::getFormToken().'=1';

			$button          = new JObject;
			$button->modal   = true;
			$button->class   = 'btn';
			$button->link    = $link;
			$button->text    = JText::_('PLG_EDITORS-XTD_PBJCEBROWSER_BUTTON_FILES');
			$button->name    = 'folder-open';
			$button->options = "{handler: 'iframe', size: {x: 1024, y: 800}}";

			return $button;
		}
	}
}
