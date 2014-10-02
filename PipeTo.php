<?php

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'PipeTo',
	'version' => '0.1.0',
	'author' => 'Chris Harrington (aka [[User:ironiridis]])',
	'url' => 'https://www.mediawiki.org/wiki/Extension:PipeTo',
	'license-name' => 'GPL-2.0',
	'descriptionmsg' => 'pipeto_desc'
);

$wgHooks['ParserFirstCallInit'][] = 'PipeToExtensionSetup';
$wgMessageDirs['PipeTo'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['PipeTo'] = __DIR__ . '/PipeTo.i18n.php';

function PipeToExtensionSetup(&$parser) {
	$parser->setFunctionHook('pipeto', 'PipeToRender', SFH_OBJECT_ARGS);
	return true;
}
function PipeToRender($parser, $frame, $args) {
	$j = array();
	foreach($frame->getArguments() as $k=>$v) { $j[] = $k.'='.$v; }
	return(array('{{'.$args[0].'|'.join('|', $j).'}}', 'noparse'=>false, 'isHTML'=>false));
}
