<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2015 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 */

if (!defined('e107_INIT')) { exit; }

class escursioni_menu
{
    /**
     * Campi di configurazione nel backend di e107
     */
    public function config($menu = '')
    {
        $fields = array();
        
        // Titolo personalizzato del Menu
        $fields['escursioni_menu_caption'] = array(
            'title'      => "Titolo del Menu", 
            'type'       => 'text', 
            'multilan'   => true, 
            'writeParms' => array('size' => 'xxlarge')
        );
        
        // Numero di record da mostrare
        $fields['escursioni_menu_count'] = array(
            'title'      => "Numero di escursioni da mostrare", 
            'type'       => 'number',
            'writeParms' => array('default' => 3)
        );

        return $fields;
    }
}
