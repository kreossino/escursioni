<?php
if (!defined('e107_INIT')) { exit; }
e107::lan('escursioni', 'admin');

class escursioni_event
{
    function config()
    {
        $event = array();
        // Esempio 1: evento core ("login")
        $event[] = array('name' => "login", 'function' => "myfunction");
        // Esempio 2: evento core di un plugin
        $event[] = array('name' => "user_forum_post_created", 'function' => "myfunction");
        // Esempio 3: evento personalizzato di un plugin di terze parti
        $event[] = array('name' => "customplugin_customevent", 'function' => "anotherfunction");
        // Esempio 4: evento specifico del plugin escursioni
        $event[] = array('name' => "escursioni_static_event", 'function' => "staticfunction");
        // Esempio 5: handler basato su classe e metodo statico
        $event[] = array('name' => "escursioni_custom_class", 'function' => 'escursioniCustomEventClass::escursioniMethod');
        
        return $event;
    }

    public function myfunction($data, $event) { /* Logica per login/forum */ }
    public function anotherfunction($data, $event) { /* Logica per evento custom */ }

    public static function staticfunction($data, $event)
    {
        global $LAN;
        return $LAN['escursioni_evt_error'] . ' ' . $event;
    }
}

class escursioniCustomEventClass
{
    public static function escursioniMethod($data, $event)
    {
        global $LAN;
        return $LAN['escursioni_evt_block'] . ' ' . $event . ' ' . json_encode($data);
    }
}