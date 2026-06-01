<?php
if (!defined('e107_INIT')) { exit; }
e107::lan('escursioni', 'front');

class escursioni_sitelink
{
    private function slug($text)
    {
        $text = html_entity_decode((string) $text, ENT_QUOTES, 'UTF-8');
        $text = preg_replace('/[^A-Za-z0-9]+/', '-', $text);
        $text = trim($text, '-');
        return strtolower($text);
    }

    function config()
    {
        $links = array();
        $links[] = array('name' => $LAN['escursioni_sitelink_dd'], 'function' => "myCategories");
        $links[] = array('name' => $LAN['escursioni_sitelink_mega'], 'function' => 'megaMenu');
        return $links;
    }

    function megaMenu()
    {
        // Placeholder HTML: sostituisco i testi visibili con chiavi LAN o li lascio come demo
        $text = '<div class="dropdown-menu mega-dropdown-menu">
        <div class="container-fluid2">
        <ul class="nav-list list-inline">
        <li><a data-filter=".89" href="#"><span>'.$LAN['escursioni_mega_cat1'].'</span></a></li>
        <li><a data-filter=".97" href="#"><span>'.$LAN['escursioni_mega_cat2'].'</span></a></li>
        <li><a data-filter=".96" href="#"><span>'.$LAN['escursioni_mega_cat3'].'</span></a></li>
        </ul>
        </div>
        </div>';
        return $text;
    }

    function myCategories()
    {
        $sql = e107::getDb();
        $tp = e107::getParser();
        $sublinks = array();

        if($sql->select("escursioni", "*", "ex_id > 0 ORDER BY ex_title ASC")) {
            while($row = $sql->fetch()) {
                $sublinks[] = array(
                    'link_name'			=> $tp->toHTML($row['ex_title'], '', 'TITLE'),
                    'link_url'			=> e107::url('escursioni', 'view', array('ex_id' => (int)$row['ex_id'], 'ex_title' => $this->slug(vartrue($row['ex_sef']) ?: $row['ex_title']))),
                    'link_description'	=> '',
                    'link_button'		=> vartrue($row['ex_image1']),
                    'link_category'		=> '',
                    'link_order'		=> '',
                    'link_parent'		=> '',
                    'link_open'			=> '',
                    'link_class'		=> e_UC_PUBLIC
                );
            }
        }

        if($sql->select("escursioni_selezioni", "sel_slug, sel_title", "sel_slug != '' ORDER BY sel_title ASC")) {
            while($row = $sql->fetch()) {
                $sublinks[] = array(
                    'link_name'			=> $tp->toHTML($row['sel_title'], '', 'TITLE'),
                    'link_url'			=> e107::url('escursioni', 'selezione', array('sel_slug' => $row['sel_slug'])),
                    'link_description'	=> '',
                    'link_button'		=> '',
                    'link_category'		=> '',
                    'link_order'		=> '',
                    'link_parent'		=> '',
                    'link_open'			=> '',
                    'link_class'		=> e_UC_PUBLIC
                );
            }
        }
        return $sublinks;
    }
}