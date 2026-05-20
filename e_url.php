<?php
/*
 * e107 Bootstrap CMS
 * Copyright (C) 2008-2015 e107 Inc (e107.org)
 * Released under the terms and conditions of the GNU General Public License
 */
 
if (!defined('e107_INIT')) { exit; }

class escursioni_url 
{
	function config() 
	{
		$config = array();

		// NUOVA REGOLA: Visualizzazione singola escursione
		$config['view'] = array(
			'alias'         => 'escursioni',
			'regex'			=> '^{alias}/([0-9]+)/(.*)$', 	// Intercetta escursioni/ID/Titolo
			'sef'			=> '{alias}/{ex_id}/{ex_title}', // Struttura URL generata da e107::url()
			'redirect'		=> '{e_PLUGIN}escursioni/escursioni.php?id=$1', // Invia l'ID al file frontend
		);

		$config['selezione'] = array(
			'alias'         => 'escursioni',
			'regex'			=> '^{alias}/selezione/([A-Za-z0-9-]+)/?$', 
			'sef'			=> '{alias}/selezione/{sel_slug}', 
			'redirect'		=> '{e_PLUGIN}escursioni/escursioni.php?sel=$1', 
		);

		$config['other'] = array(
			'alias'         => 'escursioni',
			'regex'			=> '^{alias}/other/?$', 
			'sef'			=> '{alias}/other/', 
			'redirect'		=> '{e_PLUGIN}escursioni/escursioni.php?other=1', 
		);

		$config['index'] = array(
			'regex'			=> '^escursioni/?$', 
			'sef'			=> 'escursioni', 
			'redirect'		=> '{e_PLUGIN}escursioni/escursioni.php', 
		);

		$config['parked'] = array(
			'domain'        => 'parked-domain.com',
			'regex'			=> '^custom/?$', 
			'sef'			=> 'custom', 
			'redirect'		=> '{e_PLUGIN}escursioni/escursioni.php?custom=1', 
		);

		return $config;
	}
}
