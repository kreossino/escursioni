<?php
/*
* e107 website system
*
* Copyright (C) 2008-2013 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom install/uninstall/update routines for escursioni plugin
**
*/

if(!class_exists("escursioni_setup"))
{
    class escursioni_setup
    {

        function install_pre($var)
        {
            // print_a($var);
            // echo "custom install 'pre' function<br /><br />";
        }

        /**
         * For inserting default database content during install after table has been created by the escursioni_sql.php file.
         */
        function install_post($var)
        {
            $sql = e107::getDb();
            $mes = e107::getMessage();

            // CORRETTO: Adesso l'array usa i campi reali definiti nel tuo escursioni_sql.php
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
                $mes->add("Custom - Install Message.", E_MESSAGE_SUCCESS);
            }
            else
            {
                $message = $sql->getLastErrorText();
                $mes->add("Custom - Failed to add default table data.", E_MESSAGE_ERROR);
                $mes->add($message, E_MESSAGE_ERROR);
            }

        }

        function uninstall_options()
        {
            $listoptions = array(0=>'option 1',1=>'option 2');

            $options = array();
            $options['mypref'] = array(
                    'label'     => 'Custom Uninstall Label',
                    'preview'   => 'Preview Area',
                    'helpText'  => 'Custom Help Text',
                    'itemList'  => $listoptions,
                    'itemDefault'   => 1
            );

            return $options;
        }

        function uninstall_post($var)
        {
            // print_a($var);
        }

        /*
         * Call During Upgrade Check. May be used to check for existance of tables etc and if not found return TRUE to call for an upgrade.
         *
         * @return bool true = upgrade required; false = upgrade not required
         */
        function upgrade_required()
        {
            $legacyMenuPref = e107::getConfig('menu')->getPref();
            return false;
        }

        function upgrade_post($var)
        {
            // $sql = e107::getDb();
        }

    }
}
