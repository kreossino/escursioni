<?php
if (!defined('e107_INIT')) { exit; }
e107::lan('escursioni', 'admin');

class escursioni_url
{
    function config()
    {
        $config = array();
        $config['view'] = array(
            'alias'		=> 'escursioni',
            'regex'		=> '^{alias}/([0-9]+)/?(.*)$',
            'sef'		=> '{alias}/{ex_id}/{ex_title}',
            'redirect'	=> '{e_PLUGIN}escursioni/escursioni.php?id=$1',
            'parseVars'	=> array('ex_id', 'ex_title'),
        );
        $config['selezione'] = array(
            'alias'		=> 'escursioni',
            'regex'		=> '^{alias}/selezione/([A-Za-z0-9-]+)/?$',
            'sef'		=> '{alias}/selezione/{sel_slug}',
            'redirect'	=> '{e_PLUGIN}escursioni/escursioni.php?sel=$1',
            'parseVars'	=> array('sel_slug'),
        );
        $config['other'] = array(
            'alias'		=> 'escursioni',
            'regex'		=> '^{alias}/other/?$',
            'sef'		=> '{alias}/other/',
            'redirect'	=> '{e_PLUGIN}escursioni/escursioni.php?other=1',
        );
        $config['index'] = array(
            'alias'		=> 'escursioni',
            'regex'		=> '^{alias}/?$',
            'sef'		=> '{alias}',
            'redirect'	=> '{e_PLUGIN}escursioni/escursioni.php',
        );
        return $config;
    }

    function admin()
    {
        return array(
            'labels' => array(
                'name'        => $LAN['escursioni_url_name'],
                'label'       => $LAN['escursioni_url_label'],
                'description' => $LAN['escursioni_url_desc'],
                'examples'    => array('{SITEURL}escursioni/1/titolo-escursione'),
            ),
            'generate' => array(
                'table'   => 'escursioni',
                'primary' => 'ex_id',
                'input'   => 'ex_title',
                'output'  => 'ex_sef',
            ),
            'form'      => array(),
            'callbacks' => array(),
        );
    }
}