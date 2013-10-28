<?php
$user = $vars['entity'];
if (isset($vars['entity']->cover)) {
	$cover_url = str_replace("profile/icondirect.php", "covegg/view.php", $user->getIcon() . "&etag={$user->cover}");
	$user_cover = elgg_view(
							'output/img',
							array(
								  'src' => $cover_url,
								  'alt' => elgg_echo('cover'),
								  'height' => "100px"
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
		'class' => 'elgg-button elgg-button-cancel',
	));
}

$form_params = array('enctype' => 'multipart/form-data');
$upload_form = elgg_view_form('covegg/upload', $form_params, $vars);

?>

<p>
	<?php echo elgg_echo('covegg:upload:instructions'); ?>
</p>

<div class="row">
	<div class="span8">
	    <label><?php echo $current_label?></label><br />
	    <?php echo $user_cover;
	    echo $remove_button
         ?>
	</div>
</div>
<br />
<div class="row">
	<div id="cover-upload" class="span8">
	<?php echo $upload_form?>
	</div>
</div>
