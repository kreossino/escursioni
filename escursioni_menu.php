<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2016 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * escursioni menu file.
 *
 */

if (!defined('e107_INIT')) { exit; }

// 1. Recuperiamo la configurazione salvata nel backend (impostata tramite e_menu.php)
// Se usi e107 v2, i parametri vengono passati direttamente nell'array $parm
$caption = (!empty($parm['escursioniCaption'])) ? $parm['escursioniCaption'] : "Escursioni Consigliate";
$limit   = (!empty($parm['escursioniCount']))   ? (int)$parm['escursioniCount']   : 3;

$sql = e107::getDb();
$tp  = e107::getParser();
$ns  = e107::getRender();

// 2. Inizializziamo il blocco degli shortcode del plugin escursioni
$sc = e107::getScBatch('escursioni', true, 'escursioni');

// 3. Recuperiamo il pezzo di template 'menu' che abbiamo aggiunto nel file dei template
$template = e107::getTemplate('escursioni', 'escursioni', 'menu');

$menu_text = "";

// Stampiamo l'apertura della lista (es. <div class='list-group'>)
$menu_text .= $tp->parseTemplate($template['start'], true, $sc);

// 4. Interroghiamo il database per prendere le ultime X escursioni
$rows = $sql->retrieve('escursioni', '*', "WHERE 1 ORDER BY ex_id DESC LIMIT 0, {$limit}", true);

if(!empty($rows))
{
    foreach($rows as $key => $value)
    {
        // Passiamo i dati del record corrente agli shortcode ({ESCURSIONI_TITLE}, ecc.)
        $sc->setVars($value);
        
        // Generiamo l'HTML del singolo elemento della sidebar
        $menu_text .= $tp->parseTemplate($template['item'], true, $sc);
    }
}
else
{
    $menu_text .= "<div class='text-muted small text-center py-3'>Nessuna escursione disponibile.</div>";
}

// Stampiamo la chiusura del contenitore
$menu_text .= $tp->parseTemplate($template['end'], true, $sc);

// 5. Renderizziamo il blocco finale nella colonna del tuo sito
$ns->tablerender($caption, $menu_text, 'escursioni_menu');
