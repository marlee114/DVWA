<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: Brute Force' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'brute';
$page[ 'help_button' ]   = 'brute';
$page[ 'source_button' ] = 'brute';
dvwaDatabaseConnect();

$method            = 'GET';
$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'vulnerable':
		$vulnerabilityFile = 'vulnerable.php';
		break;
	default:
		$vulnerabilityFile = 'secure.php';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/brute/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerability: Brute Force</h1>

	<div class=\"vulnerable_code_area\">
		<h2>Login</h2>

		<form action=\"#\" method=\"{$method}\">
			Username:<br />
			<input type=\"text\" name=\"username\"><br />
			Password:<br />
			<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password\"><br />
			<br />
			<input type=\"submit\" value=\"Login\" name=\"Login\">\n";

$page[ 'body' ] .= "
		</form>
		{$html}
	</div>

	<h2>More Information</h2>
	<ul>
		<li>" . dvwaExternalLinkUrlGet( 'https://owasp.org/www-community/attacks/Brute_force_attack' ) . "</li>
		<li>" . dvwaExternalLinkUrlGet( 'http://www.symantec.com/connect/articles/password-crackers-ensuring-security-your-password' ) . "</li>
		<li>" . dvwaExternalLinkUrlGet( 'http://www.sillychicken.co.nz/Security/how-to-brute-force-http-forms-in-windows.html' ) . "</li>
	</ul>
</div>\n";

dvwaHtmlEcho( $page );

?>
