<?php
/**
 * CopyToClipboard - this extension lets you put a copy to clipboard button
 *
 * To activate this extension, add the following into your LocalSettings.php file:
 * require_once('$IP/extensions/CopyToClipboard.php');
 *
 * @ingroup Extensions
 * @author Nischay Nahata <nischayn22@gmail.com>
 * @version 1.0
 * @link https://www.mediawiki.org/wiki/Extension:CopyToClipboard
 */
 
/**
 * Protect against register_globals vulnerabilities.
 * This line must be present before any global variable is referenced.
 */
if( !defined( 'MEDIAWIKI' ) ) {
        echo( "This is an extension to the MediaWiki package and cannot be run standalone.\n" );
        die( -1 );
}
 
// Extension credits that will show up on Special:Version    
$wgExtensionCredits['parser extensions'][] = array(
        'path'           => __FILE__,
        'name'           => 'CopyToClipboard',
        'version'        => '0.1',
        'author'         => 'Nischay Nahata', 
        'url'            => 'https://www.mediawiki.org/wiki/Extension:CopyToClipboard',
        'descriptionmsg' => 'copytoclipboard',
);

$wgCopyToClipboardIP = dirname( __FILE__ ) . '/';
$wgClippy = "/lug_nitk/extensions/CopyToClipboard/clippy.swf";
$wgExtensionMessagesFiles['CopyToClipboard'] = $wgCopyToClipboardIP . 'CopyToClipboard.i18n.php';
$wgHooks['ParserFirstCallInit'][] = 'wfCopyToClipboardInit';
function wfCopyToClipboardInit( Parser $parser ) {
    $parser->setHook( 'clippy', 'wfAddObjectTag' );
    return true;
}
 
function wfAddObjectTag( $input, array $args, Parser $parser, PPFrame $frame ) {
global $wgClippy;


	$link = htmlspecialchars($input);
	if(isset($args['show'])&& $args['show']== true)
		$html = $link.'  ';
	else
		$html = '  ';
	$html .= '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="110" height="14" id="clippy" ><param name="movie" value="'.$wgClippy.'"/><param name="allowScriptAccess" value="always" /><param name="quality" value="high" /><param name="scale" value="noscale" /><param NAME="FlashVars" value="text='.$link.'"><param name="bgcolor" value="#white"><embed src="'.$wgClippy.'" width="110" height="14" name="clippy" quality="high" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" FlashVars="text='.$link.'"bgcolor="#white"/></object>';
	
	return $html;
}
