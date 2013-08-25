<?php
if (isset($vars['entity']->cover)) {
	$user_cover = elgg_view(
							'output/img',
							array(
								  'src' => $vars['entity']->cover,
								  'alt' => elgg_echo('cover'),
								  )
							);
}
else {
	$user_cover = elgg_echo('covegg:nocover');
}

$current_label = elgg_echo('covegg:current');

$remove_button = '';
if ($vars['entity']->cover) {
	$remove_button = elgg_view('output/url', array(
		'text' => elgg_echo('remove'),
		'title' => elgg_echo('covegg:remove'),
		'href' => 'action/covegg/remove?guid=' . elgg_get_page_owner_guid(),
		'is_action' => true,
		'class' => 'elgg-button elgg-button-cancel mll',
	));
}

$form_params = array('enctype' => 'multipart/form-data');
$upload_form = elgg_view_form('covegg/upload', $form_params, $vars);

?>

<p class="mtm">
	<?php echo elgg_echo('covegg:upload:instructions'); ?>
</p>

<?php

$image = <<<HTML
<div id="current-user-cover" class="mrl prl">
	<label>$current_label</label><br />
	$user_cover
</div>
$remove_button
HTML;

$body = <<<HTML
<div id="cover-upload">
	$upload_form
</div>
HTML;

echo elgg_view_image_block($image, $upload_form);
