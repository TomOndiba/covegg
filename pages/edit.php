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

// Only logged in users
gatekeeper();

$user_entity = elgg_get_page_owner_entity();

// TODO
if (!elgg_instanceof($user_entity, 'user') || ! $user_entity->canEdit()) {
	register_error(elgg_echo('covegg:noaccess'));
	forward(REFERER);
}

// Prepare view
$title = elgg_echo('covegg:title:edit');
$content = elgg_view('covegg/upload', array('entity' => $user_entity));

$params = array(
				'title' => $title,
				'content' => $content,
				);

$body = elgg_view_layout('one_sidebar', $params);
echo elgg_view_page($title, $body);