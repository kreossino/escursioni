<?php
if (!defined('e107_INIT')) { exit; }
e107::lan('escursioni', 'front');

class escursioni_related
{
    function compile($tags, $parm = array())
    {
        global $LAN;
        $sql = e107::getDb();
        $tp  = e107::getParser();
        $items = array();
        
        $currentId = (int) vartrue($parm['current'], 0);
        $limit     = (int) vartrue($parm['limit'], 3);
        
        // Query sicura compatibile con la tua tabella 'escursioni'
        $query = "SELECT ex_id, ex_title, ex_text, ex_type 
                  FROM `#escursioni` 
                  WHERE ex_id != {$currentId} 
                  ORDER BY RAND() 
                  LIMIT {$limit}";
                  
        if($sql->gen($query)) {
            while($row = $sql->fetch()) {
                $slug = $this->slug($row['ex_title']);
                $items[] = array(
                    'title'   => $tp->toHTML($row['ex_title'], true, 'TITLE'),
                    'url'     => e107::url('escursioni', 'view', array(
                        'ex_id'    => (int)$row['ex_id'], 
                        'ex_title' => $slug
                    )),
                    'summary' => $tp->truncate($tp->toHTML($row['ex_text'], true, 'bbcode'), 120),
                    'image'   => '' // Puoi popolare con ex_image1 se necessario
                );
            }
        }
        return $items;
    }
    
    private function slug($text)
    {
        $text = html_entity_decode((string) $text, ENT_QUOTES, 'UTF-8');
        $text = preg_replace('/[^A-Za-z0-9]+/', '-', $text);
        $text = trim($text, '-');
        return strtolower($text);
    }
}