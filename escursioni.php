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
        
        // Carichiamo il template grafico 'default' definito dentro escursioni_template.php
        $template = e107::getTemplate('escursioni', 'escursioni', 'default');

        // Stampiamo l'apertura del template grafico
        $text .= $tp->parseTemplate($template['start'], true, $sc);

        // Interroghiamo la tabella escursioni ordinando per ID decrescente
        if($rows = $sql->retrieve('escursioni', '*', 'ORDER BY ex_id DESC', true))
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
            $text .= "<div class='alert alert-info text-center'>Nessuna escursione disponibile al momento.</div>";
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
