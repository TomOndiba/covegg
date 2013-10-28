<?php

$subject = $vars['item']->getSubjectEntity();

$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

$string = elgg_echo('covegg:update:user:cover', array($subject_link));

$cover_url = str_replace("profile/icondirect.php", "covegg/view.php", $subject->getIcon() . "&etag={$subject->cover}");
$user_cover = elgg_view(
						'output/img',
						array(
							  'src' => $cover_url,
							  'alt' => elgg_echo('cover'),
							  'height' => "100px"
							  )
						);

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'summary' => $string,
	'attachments' => $user_cover,
));
