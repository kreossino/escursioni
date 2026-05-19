<?php
/*
 * e107 Bootstrap CMS
 *
 * Copyright (C) 2008-2015 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * IMPORTANT: Make sure the redirect script uses the following code to load class2.php: 
 * 
 * 	if (!defined('e107_INIT'))
 * 	{
 * 		require_once(__DIR__.'/../../class2.php');
 * 	}
 * 
 */
 
if (!defined('e107_INIT')) { exit; }

// v2.x Standard  - Simple mod-rewrite module. 

class escursioni_url // plugin-folder + '_url'
{
	function config() 
	{
		$config = array();

		$config['other'] = array(
			'alias'         => 'escursioni',                            // default alias 'escursioni'. {alias} is substituted with this value below. Allows for customization within the admin area.
			'regex'			=> '^{alias}/other/?$', 						// matched against url, and if true, redirected to 'redirect' below.
			'sef'			=> '{alias}/other/', 							// used by e107::url(); to create a url from the db table.
			'redirect'		=> '{e_PLUGIN}escursioni/escursioni.php?other=1', 		// file-path of what to load when the regex returns true.

		);


		$config['index'] = array(
			'regex'			=> '^escursioni/?$', 						// matched against url, and if true, redirected to 'redirect' below.
			'sef'			=> 'escursioni', 							// used by e107::url(); to create a url from the db table.
			'redirect'		=> '{e_PLUGIN}escursioni/escursioni.php', 		// file-path of what to load when the regex returns true.

		);

		$config['parked'] = array(
			'domain'        => 'parked-domain.com',
			'regex'			=> '^custom/?$', 						// matched against url, and if true, redirected to 'redirect' below.
			'sef'			=> 'custom', 							// used by e107::url(); to create a url from the db table.
			'redirect'		=> '{e_PLUGIN}escursioni/escursioni.php?custom=1', 		// file-path of what to load when the regex returns true.

		);

		return $config;
	}
	

}