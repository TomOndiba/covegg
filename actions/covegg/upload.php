<?php

$guid = get_input('guid');
$owner = get_entity($guid);

# TODO
if (!$owner || !($owner instanceof ElggUser) || !$owner->canEdit()) {
	register_error(elgg_echo('avatar:upload:fail'));
	forward(REFERER);
}

if ($_FILES['cover']['error'] != 0) {
	register_error(elgg_echo('covegg:upload:fail'));
	forward(REFERER);
}

// get the images and save their file handlers into an array
// so we can do clean up if one fails.
$resized = get_resized_image_from_uploaded_file('cover', 1200, 500, False, True);

if ($resized) {
	//@todo Make these actual entities.  See exts #348.
	$file = new ElggFile();
	$file->owner_guid = $guid;
	$file->setFilename("profile/{$guid}{$name}.jpg");
	$file->open('write');
	$file->write($resized);
	$file->close();

	$owner->cover = $file->getFilenameOnFilestore();
   	if ( ! $owner->save()) {
		register_error(elgg_echo('covegg:upload:fail'));
		forward(REFERER);
	}
}
else {
	register_error(elgg_echo('covegg:resize:fail'));
	forward(REFERER);
}

system_message(elgg_echo("covegg:upload:success"));

$view = 'river/user/default/profilecoverupdate';
elgg_delete_river(array('subject_guid' => $owner->guid, 'view' => $view));
add_to_river($view, 'update', $owner->guid, $owner->guid);

forward(REFERER);
