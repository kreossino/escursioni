<?php
if (!defined('e107_INIT'))
{
    require_once(__DIR__.'/../../class2.php');
}

class escursioni_front
{
    function __construct()
    {
        e107::lan('escursioni');
        e107::meta('keywords', 'escursioni, trekking, vacanze, b&b');
    }

    public function run()
    {
        $sql = e107::getDb();
        $tp  = e107::getParser();
        $ns  = e107::getRender();

        $text = '';

        // Inizializziamo il blocco degli shortcodes del plugin
        $sc = e107::getScBatch('escursioni', true, 'escursioni');

        // LOGICA DI FILTRO DINAMICA
        $where_clause = "1"; // Di base mostra tutto
        $single_view = false;

        if(empty($_GET['id']) && !empty($_SERVER['REQUEST_URI']) && preg_match('#/escursioni/([0-9]+)/#', $_SERVER['REQUEST_URI'], $match))
        {
            $_GET['id'] = (int) $match[1];
        }

        if(!empty($_GET['sel']))
        {
            $clean_sel = preg_replace('/[^A-Za-z0-9-]/', '', $_GET['sel']);
            $selection = $sql->retrieve('escursioni_selezioni', 'sel_ids, sel_title', "WHERE sel_slug='".$sql->escape($clean_sel)."'");

            if(!empty($selection['sel_ids']))
            {
                $clean_ids = preg_replace('/[^0-9,]/', '', $selection['sel_ids']);

                if(!empty($clean_ids))
                {
                    $where_clause = "ex_id IN ({$clean_ids})";
                }
            }
        }
        elseif(!empty($_GET['id']))
        {
            $where_clause = "ex_id = " . (int) $_GET['id'];
            $single_view = true;
        }
        elseif(!empty($_GET['type']))
        {
            $clean_type = rawurldecode($_GET['type']);
            if(!empty($clean_type))
            {
                $where_clause = "ex_type = '" . $sql->escape($clean_type) . "'";
            }
        }
        elseif(!empty($_GET['ids']))
        {
            $clean_ids = preg_replace('/[^0-9,]/', '', $_GET['ids']);
            if(!empty($clean_ids))
            {
                $where_clause = "ex_id IN ({$clean_ids})";
            }
        }

        $rows = $sql->retrieve('escursioni', '*', "WHERE {$where_clause} ORDER BY ex_id DESC", true);
        $templateKey = $single_view ? 'single' : 'default';
        $template = e107::getTemplate('escursioni', 'escursioni', $templateKey);

        // Stampiamo l'apertura del template grafico
        $text .= $tp->parseTemplate($template['start'], true, $sc);

        // Interroghiamo la tabella escursioni applicando il nostro filtro (o tutto se vuoto)
        if(!empty($rows))
        {
            foreach($rows as $key => $value)
            {
                // Passiamo i dati del record corrente all'istanza degli shortcodes
                $sc->setVars($value);
                
                // Il parser sostituisce i tag {ESCURSIONI_X} con il codice HTML finale di quella riga
                $text .= $tp->parseTemplate($template['item'], true, $sc);
            }
        }
        else
        {
            $text .= "<div class='alert alert-info text-center'>Nessuna escursione disponibile per questa categoria.</div>";
        }

        // Stampiamo la chiusura del template grafico
        $text .= $tp->parseTemplate($template['end'], true, $sc);

        // Renderizziamo tutto dentro il box grafico del tema corrente del sito
        $ns->tablerender("Le nostre Escursioni consigliate", $text);
    }
}

$escursioniFront = new escursioni_front;
require_once(HEADERF);
$escursioniFront->run();
require_once(FOOTERF);
