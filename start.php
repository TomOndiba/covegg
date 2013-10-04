<?php
/*
 * Cover profile for Elgg
 * Copyright (C) 2013 Juan José González
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

elgg_register_event_handler('init', 'system', 'covegg_init');

function covegg_init() {
	elgg_register_plugin_hook_handler('register', 'menu:user_hover',
									  'covegg_user_hover_menu');

	// Page handlers
	elgg_register_page_handler('covegg', 'covegg_page_handler');

	// Actions
	elgg_register_action('covegg/upload', elgg_get_plugins_path() .
						 'covegg/actions/covegg/upload.php');
}

/**
 * Handle page requests
 */
function covegg_page_handler($page) {
	if ( isset($page[0]) && isset($page[1]) ){
		set_input('username', $page[0]);
		require(elgg_get_plugins_path() . 'covegg/pages/covegg/edit.php');
	}
}

/**
 * Add "Edit cover" item to user hover menu
 */
function covegg_user_hover_menu($hook, $type, $return, $params){
	$user = $params['entity'];

	if (elgg_get_logged_in_user_guid() == $user->guid) {
		$url = "covegg/{$user->username}/edit";
		$item = new ElggMenuItem('covegg:edit', elgg_echo('covegg:edit'),
								 $url);
		$item->setSection('action');
		$return[] = $item;
	}	

	return $return;
}