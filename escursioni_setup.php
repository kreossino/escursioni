<?php
if(!defined('e107_INIT')) { exit; }

if(!class_exists("escursioni_setup"))
{
    class escursioni_setup
    {
        function install_pre($var) {}

        function install_post($var)
        {
            $sql = e107::getDb();
            $mes = e107::getMessage();

            // ✅ Usa stringhe dirette: i file lingua NON sono ancora caricati in questa fase
            $e107escursioni = array(
                'ex_title'          => 'Prima Escursione di Esempio',
                'ex_text'           => 'Testo descrittivo dell\'escursione di prova.',
                'ex_image1'         => '',
                'ex_image2'         => '',
                'ex_image3'         => '',
                'ex_image4'         => '',
                'ex_file'           => '',
                'ex_type'           => 'Trekking',
                'ex_duration'       => '2 Ore',
                'ex_difficulty'     => 'Medio',
                'escursioni_name'   => 'My Name',
                'escursioni_folder' => 'Folder Value'
            );

            if($sql->insert('escursioni', $e107escursioni))
            {
                // Tenta di caricare la lingua per i messaggi, con fallback sicuro
                e107::lan('escursioni', 'admin');
                $msg = vartrue($LAN['escursioni_setup_install_ok'], 'Plugin installato correttamente. Record di esempio inserito.');
                $mes->add($msg, E_MESSAGE_SUCCESS);
            }
            else
            {
                $message = $sql->getLastErrorText();
                e107::lan('escursioni', 'admin');
                $msg = vartrue($LAN['escursioni_setup_install_ko'], 'Errore durante l\'inserimento dei dati di esempio.');
                $mes->add($msg, E_MESSAGE_ERROR);
                $mes->add($message, E_MESSAGE_ERROR);
            }
        }

        function uninstall_options()
        {
            e107::lan('escursioni', 'admin');
            $listoptions = array(
                0 => vartrue($LAN['escursioni_setup_un_opt1'], 'Mantieni tabelle nel database'),
                1 => vartrue($LAN['escursioni_setup_un_opt2'], 'Elimina permanentemente tutte le tabelle')
            );
            $options = array();
            $options['mypref'] = array(
                'label'       => vartrue($LAN['escursioni_setup_un_label'], 'Opzioni di rimozione dati'),
                'preview'     => vartrue($LAN['escursioni_setup_un_preview'], 'Anteprima area di rimozione'),
                'helpText'    => vartrue($LAN['escursioni_setup_un_help'], 'Scegli come gestire i dati associati al plugin durante la disinstallazione.'),
                'itemList'    => $listoptions,
                'itemDefault' => 0
            );
            return $options;
        }

        function uninstall_post($var) {}
        function upgrade_required() { return false; }
        function upgrade_post($var) {}
    }
}
