<?php
if (!defined('e107_INIT')) { exit; }
e107::lan('escursioni', 'admin');

class escursioni_menu
{
    /**
     * Campi di configurazione nel backend di e107
     */
    public function config($menu = '')
    {
        global $LAN;
        $fields = array();
        
        $fields['escursioni_menu_caption'] = array(
            'title'      => $LAN['escursioni_menucfg_title'],
            'type'       => 'text',
            'multilan'   => true,
            'writeParms' => array('size' => 'xxlarge')
        );
        
        $fields['escursioni_menu_count'] = array(
            'title'      => $LAN['escursioni_menucfg_count'],
            'type'       => 'number',
            'writeParms' => array('default' => 3)
        );
        
        return $fields;
    }
}