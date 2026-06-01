<?php
if (!defined('e107_INIT')) { exit; }
e107::lan('escursioni', 'front');

$caption = (!empty($parm['escursioni_menu_caption'])) ? $parm['escursioni_menu_caption'] : $LAN['escursioni_menu_caption'];

$escursioni_prefs = e107::getPlugPref('escursioni');
$limit = 3;
if (!empty($escursioni_prefs['escursioni_menu_global_limit'])) {
    $limit = (int)$escursioni_prefs['escursioni_menu_global_limit'];
} elseif (!empty($parm['escursioni_menu_count'])) {
    $limit = (int)$parm['escursioni_menu_count'];
}

$sql = e107::getDb();
$tp  = e107::getParser();
$ns  = e107::getRender();
$sc  = e107::getScBatch('escursioni', true, 'escursioni');
$template = e107::getTemplate('escursioni', 'escursioni', 'menu');
$menu_text = "";

$menu_text .= $tp->parseTemplate($template['start'], true, $sc);

$rows = $sql->retrieve('escursioni', '*', "WHERE 1 ORDER BY ex_id DESC LIMIT 0, {$limit}", true);

if(!empty($rows)) {
    foreach($rows as $key => $value) {
        $sc->setVars($value);
        $menu_text .= $tp->parseTemplate($template['item'], true, $sc);
    }
} else {
    $menu_text .= "<div class='text-muted small text-center py-3'>".$LAN['escursioni_no_available']."</div>";
}

$menu_text .= $tp->parseTemplate($template['end'], true, $sc);
$ns->tablerender($caption, $menu_text, 'escursioni_menu');