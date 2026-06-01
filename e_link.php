<?php
if (!defined('e107_INIT')) { exit; }
e107::lan('escursioni', 'admin');

class escursioni_link
{
    public function config()
    {
        global $LAN;
        $sql = e107::getDb();
        $tp  = e107::getParser();
        $link_array = array();
        
        $link_array[] = array(
            'name' => $LAN['escursioni_lnk_all'],
            'url'  => e107::url('escursioni', 'index'),
            'type' => 'page'
        );
        
        if ($sql->select('escursioni', 'ex_id, ex_title, ex_sef')) {
            while ($row = $sql->fetch()) {
                $link_array[] = array(
                    'name' => $LAN['escursioni_lnk_single'] . $tp->toHTML($row['ex_title'], true, 'TITLE'),
                    'url'  => e107::url('escursioni', 'view', array(
                        'ex_id'    => (int)$row['ex_id'], 
                        'ex_title' => $this->slug(vartrue($row['ex_sef']) ?: $row['ex_title'])
                    )),
                    'type' => 'link'
                );
            }
        }
        
        if ($sql->select('escursioni_selezioni', 'sel_slug, sel_title', "sel_slug != '' ORDER BY sel_title ASC")) {
            while ($row = $sql->fetch()) {
                $link_array[] = array(
                    'name' => $LAN['escursioni_lnk_selection'] . $tp->toHTML($row['sel_title'], true, 'TITLE'),
                    'url'  => e107::url('escursioni', 'selezione', array('sel_slug' => $row['sel_slug'])),
                    'type' => 'link'
                );
            }
        }
        return $link_array;
    }
    
    private function slug($text)
    {
        $text = html_entity_decode((string) $text, ENT_QUOTES, 'UTF-8');
        $text = preg_replace('/[^A-Za-z0-9]+/', '-', $text);
        $text = trim($text, '-');
        return strtolower($text);
    }
}