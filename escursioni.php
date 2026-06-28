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

/*kreos da qui*/

if(!empty($rows)) {
            foreach($rows as $key => $value) {
                
                // Controllo manuale: se nel testo c'è lo shortcode, lo compiliamo a forza prima dei tag [html]
                if(strpos($value['ex_text'], '{IMAGE_RESPONSIVE_ESCURSIONI:') !== false) {
                    $value['ex_text'] = preg_replace_callback('/\{IMAGE_RESPONSIVE_ESCURSIONI:\s*([^}]+)\}/', function($matches) use ($tp) {
                        $parms = eHelper::scParams($matches[1]);
                        
                        $src = trim(vartrue($parms['src'], ''), '"\' ');
                        $width = vartrue($parms['width'], 12); 
                        $lightbox = vartrue($parms['lightbox'], 0);
                        $alt = vartrue($parms['alt'], 'Immagine escursione');
                        $class = vartrue($parms['class'], '');
                        
                        if (empty($src)) return '';
                        
                        // Se l'immagine non è un URL remoto, cerchiamola sul server
                        if (strpos($src, 'http') !== 0 && strpos($src, '{') !== 0) {
                            
                            $filename = basename($src); // Isola il nome del file (es. telefono_1.png)
                            
                            // Risolviamo il percorso fisico reale della cartella images di e107
                            // Trasformiamo '{e_MEDIA_IMAGE}' o la costante nel path reale del server
                            $raw_media_path = defined('e_MEDIA_IMAGE') ? e_MEDIA_IMAGE : 'e107_media/images/';
                            $resolved_media_dir = $tp->replaceConstants($raw_media_path, 'full'); 
                            
                            // Definiamo la cartella di partenza assoluta sul server per la funzione glob
                            $server_root_dir = e_BASE . ltrim(str_replace(SITEURL, '', $resolved_media_dir), '/');
                            
                            
/*da qui kreos*/
// Prepariamo le varianti dell'estensione (es. jpg, JPG, jpeg, JPEG, png, PNG)
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                            $base_name = pathinfo($filename, PATHINFO_FILENAME);
                            
                            if(!empty($ext)) {
                                $ext_pattern = '{' . strtolower($ext) . ',' . strtoupper($ext) . '}';
                                $search_filename = $base_name . '.' . $ext_pattern;
                            } else {
                                $search_filename = $filename;
                            }

                            // Pattern di ricerca ricorsivo con supporto GLOB_BRACE
                            $search_patterns = array(
                                $server_root_dir . $search_filename,
                                $server_root_dir . '*/' . $search_filename,
                                $server_root_dir . '*/*/' . $search_filename,
                                $server_root_dir . '*/*/*/' . $search_filename
                            );
                            
                            $file_found = false;
                            foreach($search_patterns as $pattern) {
                                // Il flag GLOB_BRACE permette di cercare le varianti dentro le parentesi graffe {}
                                $matches_glob = glob($pattern, GLOB_BRACE);                        
/* a qui */

        if(!empty($matches_glob)) {
                                    // Abbiamo trovato il file sul server! Convertiamo il percorso assoluto in URL pulito
                                    $relative_url = str_replace(e_BASE, '', $matches_glob[0]);
                                    $src = SITEURL . ltrim($relative_url, '/');
                                    $file_found = true;
                                    break;
                                }
                            }
                            
                            // Fallback se glob non trova nulla: proviamo a lasciarlo gestire a e107
                            if(!$file_found) {
                                $src = $tp->replaceConstants('{e_MEDIA_IMAGE}' . $src, 'abs');
                            }
                        } else {
                            // Se conteneva già costanti o http, lo convertiamo normalmente in URL assoluto
                            $src = $tp->replaceConstants($src, 'abs');
                        }
                        
                        // Forza l'URL ad essere assoluto rispetto al sito se è saltato fuori relativo
                        if (strpos($src, 'http') !== 0 && strpos($src, '/') !== 0) {
                            $src = SITEURL . $src;
                        }
                        
                        $imageSrc = $src;
                        $colClass = 'col-12 col-md-' . (int)$width;
                        
                        // Generazione dell'HTML finale compatibile con Bootstrap 5
                        $html = '<div class="' . $colClass . ' mb-4 ' . $class . '">';
                        if ($lightbox == 1) {
                            $html .= '<a href="' . $imageSrc . '" data-gal="prettyPhoto[escursioni]">';
                            $html .= '<img src="' . $imageSrc . '" alt="' . $tp->toAttribute($alt) . '" class="img-fluid rounded shadow-sm hover-zoom" />';
                            $html .= '</a>';
                        } else {
                            $html .= '<img src="' . $imageSrc . '" alt="' . $tp->toAttribute($alt) . '" class="img-fluid rounded shadow-sm" />';
                        }
                        $html .= '</div>';
                        
                        return $html;
                    }, $value['ex_text']);
                }

                $sc->setVars($value);
                $text .= $tp->parseTemplate($template['item'], true, $sc);
            }
        } else {
            $text .= "<div class='alert alert-info text-center'>".$LAN['escursioni_front_none']."</div>";
        }

        $text .= $tp->parseTemplate($template['end'], true, $sc);
        $ns->tablerender($LAN['escursioni_front_title'], $text);
    }




/* a qui*/

}

$escursioniFront = new escursioni_front;
require_once(HEADERF);
$escursioniFront->run();
require_once(FOOTERF);
