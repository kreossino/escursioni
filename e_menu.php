<?php
if (!defined('e107_INIT')) { exit; }

class escursioni_menu
{
    /**
     * Campi di configurazione nel backend di e107
     */
    public function config($menu = '')
    {
        $fields = array();
        
        // Titolo del menu (es: "Ultime Escursioni")
        $fields['escursioniCaption'] = array(
            'title'     => "Titolo del Menu", 
            'type'      => 'text', 
            'multilan'  => true, 
            'writeParms'=> array('size' => 'xxlarge')
        );
        
        // Numero di record da mostrare nella sidebar
        $fields['escursioniCount'] = array(
            'title'     => "Numero di escursioni da mostrare", 
            'type'      => 'number',
            'writeParms'=> array('default' => 3)
        );

        return $fields;
    }
}
