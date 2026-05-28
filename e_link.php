<?php
if (!defined('e107_INIT')) { exit; }

class escursioni_link
{
    /**
     * Genera l'elenco dei link pronti da associare ai menu dell'admin
     */
    public function config()
    {
        $sql = e107::getDb();
        $link_array = array();

        // 1. Link alla pagina indice principale del plugin
        $link_array[] = array(
            'name' => 'Elenco Generale Escursioni',
            'url'  => e107::url('escursioni', 'index'),
            'type' => 'page'
        );

        // 2. Query dinamica per estrarre le singole escursioni
        // Sostituisci 'escursioni' con il nome reale della tua tabella (senza prefisso)
        if ($sql->select('escursioni', 'ex_id, ex_title, ex_sef')) 
        {
            while ($row = $sql->fetch()) 
            {
                $link_array[] = array(
                    'name' => 'Escursione: ' . $row['ex_title'],
                    // Genera l'URL usando il rewrite_url.php che abbiamo configurato prima
                    'url'  => e107::url('escursioni', 'view', array('ex_id' => $row['ex_id'], 'ex_title' => e107::getParser()->title2sef(vartrue($row['ex_sef']) ?: $row['ex_title']))),
                    'type' => 'link'
                );
            }
        }

        if ($sql->select('escursioni_selezioni', 'sel_slug, sel_title', "sel_slug != '' ORDER BY sel_title ASC"))
        {
            while ($row = $sql->fetch())
            {
                $link_array[] = array(
                    'name' => 'Selezione escursioni: ' . $row['sel_title'],
                    'url'  => e107::url('escursioni', 'selezione', array('sel_slug' => $row['sel_slug'])),
                    'type' => 'link'
                );
            }
        }

        return $link_array;
    }
}
