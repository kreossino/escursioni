<?php
if (!defined('e107_INIT')) { require_once(__DIR__.'/../../class2.php'); }

class escursioni_front
{
    function __construct()
    {
        e107::lan('escursioni', 'front');
        e107::meta('keywords', 'escursioni, trekking, vacanze, b&b');
    }

    public function run()
    {
        $sql = e107::getDb();
        $tp  = e107::getParser();
        $ns  = e107::getRender();
        $text = '';
        $sc = e107::getScBatch('escursioni', true, 'escursioni');
        
        $where_clause = "1";
        $single_view = false;

        if(empty($_GET['id']) && !empty($_SERVER['REQUEST_URI']) && preg_match('#/escursioni/([0-9]+)/#', $_SERVER['REQUEST_URI'], $match)) {
            $_GET['id'] = (int) $match[1];
        }

        if(!empty($_GET['sel'])) {
            $clean_sel = preg_replace('/[^A-Za-z0-9-]/', '', $_GET['sel']);
            $selection = $sql->retrieve('escursioni_selezioni', 'sel_ids, sel_title', "WHERE sel_slug='".$sql->escape($clean_sel)."'");
            if(!empty($selection['sel_ids'])) {
                $clean_ids = preg_replace('/[^0-9,]/', '', $selection['sel_ids']);
                if(!empty($clean_ids)) $where_clause = "ex_id IN ({$clean_ids})";
            }
        } elseif(!empty($_GET['id'])) {
            $where_clause = "ex_id = " . (int) $_GET['id'];
            $single_view = true;
        } elseif(!empty($_GET['type'])) {
            $clean_type = rawurldecode($_GET['type']);
            if(!empty($clean_type)) $where_clause = "ex_type = '" . $sql->escape($clean_type) . "'";
        } elseif(!empty($_GET['ids'])) {
            $clean_ids = preg_replace('/[^0-9,]/', '', $_GET['ids']);
            if(!empty($clean_ids)) $where_clause = "ex_id IN ({$clean_ids})";
        }

        $rows = $sql->retrieve('escursioni', '*', "WHERE {$where_clause} ORDER BY ex_id DESC", true);
        $templateKey = $single_view ? 'single' : 'default';
        $template = e107::getTemplate('escursioni', 'escursioni', $templateKey);

        $text .= $tp->parseTemplate($template['start'], true, $sc);

        if(!empty($rows)) {
            foreach($rows as $key => $value) {
                $sc->setVars($value);
                $text .= $tp->parseTemplate($template['item'], true, $sc);
            }
        } else {
            $text .= "<div class='alert alert-info text-center'>".$LAN['escursioni_front_none']."</div>";
        }

        $text .= $tp->parseTemplate($template['end'], true, $sc);
        $ns->tablerender($LAN['escursioni_front_title'], $text);
    }
}

$escursioniFront = new escursioni_front;
require_once(HEADERF);
$escursioniFront->run();
require_once(FOOTERF);