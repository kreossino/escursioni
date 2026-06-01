<?php
if (!defined('e107_INIT')) { exit; }
e107::lan('escursioni', 'front');

class escursioni_search extends e_search
{
    function config()
    {
        $search = array(
            'name'		=> $LAN['escursioni_search_modname'],
            'table'		=> 'escursioni',
            'advanced' 	=> array(
                'date'	=> array('type'	=> 'date', 'text' => LAN_DATE_POSTED),
                'type'	=> array('type'	=> 'dropdown', 'text' => $LAN['escursioni_type'], 'values' => array())
            ),
            'return_fields'	=> array('ex_id', 'ex_title', 'ex_text', 'ex_datestamp'),
            'search_fields'	=> array('ex_title' => '1.5', 'ex_text' => '1.0'),
            'order'			=> array('ex_datestamp' => 'DESC'),
            'refpage'		=> 'escursioni.php'
        );
        return $search;
    }

    function compile($row)
    {
        $tp = e107::getParser();
        $res = array();
        $res['link'] 		= e107::url('escursioni', 'view', array('ex_id' => (int)$row['ex_id'], 'ex_title' => ''));
        $res['pre_title'] 	= LAN_SEARCH_7;
        $res['title'] 		= $tp->toHTML(vartrue($row['ex_title']), true, 'TITLE');
        $res['summary'] 	= $tp->truncate($tp->toHTML(vartrue($row['ex_text']), true, 'bbcode'), 200);
        $res['detail'] 		= '';
        return $res;
    }

    function where($parm=null)
    {
        $tp = e107::getParser();
        $qry = "";
        if (vartrue($parm['time']) && is_numeric($parm['time'])) {
            $qry .= " ex_datestamp ".($parm['on'] == 'new' ? '>=' : '<=')." '".(time() - $parm['time'])."' AND";
        }
        return $qry;
    }
}