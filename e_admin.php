<?php
if (!defined('e107_INIT')) { exit; }
e107::lan('escursioni', 'admin');

class escursioni_admin implements e_admin_addon_interface
{
    public function load($event, $ids)
    {
        return array(3 => array('url' => 'https://myurl.com'));
    }

    public function config(e_admin_ui $ui)
    {
        global $LAN;
        $action = $ui->getAction();
        $type   = $ui->getEventName();
        $config = array();
        $defaultValue = 'https://';

        switch($type)
        {
            case 'news':
                $config['fields']['url'] = array(
                    'title' => $LAN['escursioni_eadm_blank_url'],
                    'type' => 'url',
                    'tab' => 1,
                    'writeParms' => array('size' => 'xxlarge', 'placeholder' => '', 'default' => $defaultValue),
                    'width' => 'auto', 'help' => '', 'readParms' => '', 'class' => 'left', 'thclass' => 'left',
                );
                $config['fields']['custom'] = array(
                    'title' => $LAN['escursioni_eadm_blank_custom'],
                    'type' => 'method',
                    'tab' => 1,
                    'writeParms' => array('size' => 'xxlarge', 'placeholder' => '', 'default' => $defaultValue),
                    'width' => 'auto', 'help' => '', 'readParms' => '', 'class' => 'left', 'thclass' => 'left',
                );
                $config['batchOptions'] = array('custom' => $LAN['escursioni_eadm_batch_cmd']);
                break;
            case 'page':
                break;
        }
        return $config;
    }

    public function process(e_admin_ui $ui, $id = null)
    {
        $data   = $ui->getPosted();
        $type   = $ui->getEventName();
        $action = $ui->getAction();

        switch($action)
        {
            case 'create':
            case 'edit':
                if(!empty($id) && !empty($data['x_escursioni_url']))
                {
                    // Qui andrebbe la logica di salvataggio nel DB
                }
                break;
            case 'delete':
                break;
            case 'batch':
                $id = (array) $id;
                $arrayOfRecordIds = $id['ids'];
                $command = $id['cmd'];
                break;
        }
    }
}

class escursioni_admin_form extends e_form
{
    function x_escursioni_custom($curval, $mode, $att = null)
    {
        global $LAN;
        $controller = e107::getAdminUI()->getController();
        $text = '';
        switch($mode)
        {
            case "read":
                $field = $controller->getEventName() . '_id';
                $text = "<span class='e-tip' title='".$controller->getFieldVar($field)."'>".$LAN['escursioni_eadm_custom_lbl']."</span>";
                break;
            case "write":
            case "filter":
            case "batch":
                break;
        }
        return $text;
    }
}