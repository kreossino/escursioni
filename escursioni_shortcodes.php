<?php
if (!defined('e107_INIT')) { exit; }

class plugin_escursioni_escursioni_shortcodes extends e_shortcode
{
    private function escursioniSlug($text)
    {
        $text = html_entity_decode((string) $text, ENT_QUOTES, 'UTF-8');
        $text = preg_replace('/[^A-Za-z0-9]+/', '-', $text);
        $text = trim($text, '-');

        return strtolower($text);
    }

    private function escursioniImageUrl($value)
    {
        if(empty($value))
        {
            return '';
        }

        return e107::getParser()->thumbUrl($value);
    }

    private function escursioniImageFullUrl($value)
    {
        if(empty($value))
        {
            return '';
        }

        $value = (string) $value;

        if(preg_match('#^https?://#i', $value) || strpos($value, '/') === 0)
        {
            return $value;
        }

        $constantMap = array(
            'e_MEDIA_IMAGE' => defined('e_MEDIA_IMAGE') ? e_MEDIA_IMAGE : '',
            'e_MEDIA_FILE'  => defined('e_MEDIA_FILE') ? e_MEDIA_FILE : '',
            'e_MEDIA_VIDEO' => defined('e_MEDIA_VIDEO') ? e_MEDIA_VIDEO : '',
            'e_MEDIA'       => defined('e_MEDIA') ? e_MEDIA : ''
        );

        foreach($constantMap as $tag => $path)
        {
            if($path !== '' && strpos($value, '{'.$tag.'}') !== false)
            {
                return $this->escursioniAbsoluteUrl(str_replace('{'.$tag.'}', $path, $value));
            }
        }

        $clean = preg_replace('/\{.*?\}/', '', $value);
        $clean = ltrim($clean, '/');

        if($clean !== '')
        {
            if(strpos($clean, 'e107_media/') === 0)
            {
                return SITEURL.$clean;
            }

            if(defined('e_MEDIA_IMAGE'))
            {
                return $this->escursioniAbsoluteUrl(e_MEDIA_IMAGE.$clean);
            }

            return SITEURL.'e107_media/'.$clean;
        }

        return $this->escursioniImageUrl($value);
    }

    private function escursioniAbsoluteUrl($url)
    {
        if($url === '' || preg_match('#^https?://#i', $url) || strpos($url, '/') === 0)
        {
            return $url;
        }

        return SITEURL.ltrim($url, '/');
    }

    // Restituisce il titolo dell'escursione
    function sc_escursioni_title()
    {
        return e107::getParser()->toHTML($this->var['ex_title']);
    }

    // Restituisce il link pubblico alla singola escursione
    function sc_escursioni_link()
    {
        if(empty($this->var['ex_id']))
        {
            return '';
        }

        $url = e107::url('escursioni', 'view', array(
            'ex_id'    => (int) $this->var['ex_id'],
            'ex_title' => $this->escursioniSlug(vartrue($this->var['ex_sef']) ?: vartrue($this->var['ex_title']))
        ));

        if(!empty($_SERVER['REQUEST_URI']))
        {
            $url .= (strpos($url, '?') === false ? '?' : '&').'return='.rawurlencode(base64_encode($_SERVER['REQUEST_URI']));
        }

        return $url;
    }

    // Restituisce il link di ritorno alla lista/selezione precedente
    function sc_escursioni_back_link()
    {
        if(!empty($_GET['return']))
        {
            $return = base64_decode(rawurldecode($_GET['return']), true);

            if(!empty($return) && strpos($return, '/') === 0 && strpos($return, '//') !== 0)
            {
                return e107::getParser()->toAttribute($return);
            }
        }

        return 'javascript:history.back()';
    }

    function sc_escursioni_back()
    {
        return $this->sc_escursioni_back_link();
    }

    // Restituisce la descrizione
function sc_escursioni_text()
{
    // Il secondo parametro 'true' forza e107 a renderizzare i tag [img] e [html] trasformandoli in immagini reali
    return e107::getParser()->toHTML($this->var['ex_text'], true, 'constants,bbcode');
}

// tronca il testo per la pagina generale

function sc_escursioni_short_text()
{
    // 1. Generiamo il testo completo convertendo i bbcode (esattamente come la funzione testo lungo)
    $testo_completo = e107::getParser()->toHTML($this->var['ex_text'], true, 'constants,bbcode'); 
    
    // 2. Rimuoviamo i tag HTML (così contiamo solo le lettere vere ed evitiamo tag troncati a metà)
    $testo_pulito = strip_tags($testo_completo);
    
    // 3. Tagliamo a 150 caratteri
    $testo_tagliato = mb_substr($testo_pulito, 0, 150);
    
    // 4. Se il testo originale era più lungo, ci mettiamo i tre puntini
    if (mb_strlen($testo_pulito) > 150) {
        $testo_tagliato .= '...';
    }
    
    // 6. Sputiamo fuori il testo troncato + il pulsante
    return $testo_tagliato;
}



 /*   function sc_escursioni_text()
    {
        return e107::getParser()->toHTML($this->var['ex_text']);
    }*/

    // Restituisce il Tipo (Trekking, Relax, ecc.)
    function sc_escursioni_type()
    {
        return e107::getParser()->toHTML($this->var['ex_type']);
    }

    // Restituisce la durata
    function sc_escursioni_duration()
    {
        return e107::getParser()->toHTML($this->var['ex_duration']);
    }

    // Restituisce la difficoltà
    function sc_escursioni_difficulty()
    {
        return e107::getParser()->toHTML($this->var['ex_difficulty']);
    }

    // Gestisce e mostra l'immagine 1 (se presente) convertendo il percorso json/media nativo di e107
    function sc_escursioni_image1()
    {
        if(empty($this->var['ex_image1'])) return '';
        
        $img_url = $this->escursioniImageUrl($this->var['ex_image1']); 
        
        return "<img src='{$img_url}' class='img-fluid rounded mb-3' alt='{$this->var['ex_title']}' />";
    }

    function sc_escursioni_image2()
    {
        return $this->escursioniSingleImage('ex_image2');
    }

    function sc_escursioni_image3()
    {
        return $this->escursioniSingleImage('ex_image3');
    }

    function sc_escursioni_image4()
    {
        return $this->escursioniSingleImage('ex_image4');
    }

    private function escursioniSingleImage($field)
    {
        if(empty($this->var[$field]))
        {
            return '';
        }

        $img_url = $this->escursioniImageUrl($this->var[$field]);

        if(empty($img_url))
        {
            return '';
        }

        $title = e107::getParser()->toAttribute(vartrue($this->var['ex_title']));

        return "<img src='{$img_url}' class='img-fluid rounded mb-3' alt='{$title}' />";
    }

    // Gallery immagini del record, compatibile con prettyPhoto.
    function sc_escursioni_gallery()
    {
        $tp = e107::getParser();
        $items = array();
        $group = 'escursione-'.(int) vartrue($this->var['ex_id']);
        $title = $tp->toAttribute(vartrue($this->var['ex_title']));

        for($i = 1; $i <= 4; $i++)
        {
            $field = 'ex_image'.$i;

            if(empty($this->var[$field]))
            {
                continue;
            }

            $thumbUrl = $this->escursioniImageUrl($this->var[$field]);
            $imageUrl = $this->escursioniImageFullUrl($this->var[$field]);

            if(empty($thumbUrl))
            {
                continue;
            }

            if(empty($imageUrl))
            {
                $imageUrl = $thumbUrl;
            }

            $items[] = "<a href='{$imageUrl}' data-gal='prettyPhoto[slide]' rel='prettyPhoto[{$group}]' title='{$title}' class='escursioni-gallery-item'><img src='{$thumbUrl}' alt='{$title}' /></a>";
        }

        if(empty($items))
        {
            return '';
        }

        $script = "
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/css/prettyPhoto.min.css' />
	   <script src='../test/e107/e107_web/lib/jquery.prettyPhoto/js/jquery.prettyPhoto.js'></script>
    <style>
        .escursioni-lightbox{position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,.88);display:none;align-items:center;justify-content:center;padding:2rem;}
        .escursioni-lightbox.is-open{display:flex;}
        .escursioni-lightbox img{max-width:92vw;max-height:86vh;box-shadow:0 10px 40px rgba(0,0,0,.45);background:#fff;}
        .escursioni-lightbox button{position:absolute;border:0;background:rgba(255,255,255,.9);color:#111;border-radius:3px;padding:.45rem .7rem;cursor:pointer;}
        .escursioni-lightbox-close{top:1rem;right:1rem;}
        .escursioni-lightbox-prev{left:1rem;top:50%;}
        .escursioni-lightbox-next{right:1rem;top:50%;}
        </style>
        
        <script>
        (function(){
            function initEscursioniFallback(){
                if(window.escursioniFallbackReady) {
                    return;
                }

                window.escursioniFallbackReady = true;
                var overlay = document.createElement('div');
                overlay.className = 'escursioni-lightbox';
                overlay.innerHTML = '<button type=\"button\" class=\"escursioni-lightbox-close\">Chiudi</button><button type=\"button\" class=\"escursioni-lightbox-prev\">&lsaquo;</button><img alt=\"\"><button type=\"button\" class=\"escursioni-lightbox-next\">&rsaquo;</button>';
                document.body.appendChild(overlay);

                var image = overlay.querySelector('img');
                var links = [];
                var index = 0;

                function show(i) {
                    if(!links.length) {
                        return;
                    }

                    index = (i + links.length) % links.length;
                    image.src = links[index].href;
                    image.alt = links[index].getAttribute('title') || '';
                    overlay.classList.add('is-open');
                }

                document.addEventListener('click', function(event) {
                    var link = event.target.closest ? event.target.closest('a[data-gal^=\"prettyPhoto\"], a[rel^=\"prettyPhoto\"]') : null;

                    if(!link) {
                        return;
                    }

                    if(window.jQuery && jQuery.fn.prettyPhoto && window.escursioniPrettyPhotoReady) {
                        return;
                    }

                    event.preventDefault();
                    var group = link.getAttribute('data-gal') || link.getAttribute('rel');
                    links = Array.prototype.slice.call(document.querySelectorAll('a[data-gal=\"' + group + '\"], a[rel=\"' + group + '\"]'));
                    show(links.indexOf(link));
                });

                overlay.querySelector('.escursioni-lightbox-close').onclick = function(){ overlay.classList.remove('is-open'); image.src = ''; };
                overlay.querySelector('.escursioni-lightbox-prev').onclick = function(){ show(index - 1); };
                overlay.querySelector('.escursioni-lightbox-next').onclick = function(){ show(index + 1); };
                overlay.onclick = function(event){ if(event.target === overlay) { overlay.classList.remove('is-open'); image.src = ''; } };
                document.addEventListener('keydown', function(event){
                    if(!overlay.classList.contains('is-open')) { return; }
                    if(event.key === 'Escape') { overlay.classList.remove('is-open'); image.src = ''; }
                    if(event.key === 'ArrowLeft') { show(index - 1); }
                    if(event.key === 'ArrowRight') { show(index + 1); }
                });
            }

            function initEscursioniPrettyPhoto(){
                if(!window.jQuery || !jQuery.fn.prettyPhoto || window.escursioniPrettyPhotoReady) {
                    return;
                }

                window.escursioniPrettyPhotoReady = true;
                jQuery('a[data-gal^=\"prettyPhoto\"]').prettyPhoto({
                    hook: 'data-gal',
                    social_tools: false,
                    theme: 'pp_default',
                    deeplinking: false,
                    slideshow: 5000,
                    autoplay_slideshow: false
                });
            }

            if(window.jQuery) {
                jQuery(initEscursioniPrettyPhoto);
                setTimeout(initEscursioniPrettyPhoto, 500);
            }

            if(document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initEscursioniFallback);
            } else {
                initEscursioniFallback();
            }
        })();
        </script>";

        return "<div class='escursioni-gallery'>".implode('', $items)."</div>".$script;
    }

// Restituisce il link per scaricare il PDF (se caricato) o visualizzare il video mp4
function sc_escursioni_pdforvideo()
{
    if(empty($this->var['ex_file'])) return '';
    
    $tp = e107::getParser();
    $raw_file = $this->var['ex_file'];
    
    $clean_path = preg_replace('/\{.*?\}/', '', $raw_file);
    $clean_path = ltrim($clean_path, '/');
    
    $extension = strtolower(pathinfo($clean_path, PATHINFO_EXTENSION));

    // 1. CASO VIDEO: La card ha già "my-3", quindi si distanzia da sola dal testo sopra
    if ($extension === 'mp4' || $extension === 'webm' || $extension === 'ogg') 
    {
        $file_url = SITEURL . 'e107_media/88f45b03dc/videos/' . $clean_path;

        return "
        <div class='card shadow-sm my-3'>
            <div class='card-header bg-dark text-white d-flex align-items-center'>
                <i class='fas fa-video me-2'></i> <strong class='mb-0'>Video dell'Escursione</strong>
            </div>
            <div class='card-body p-0 bg-black'>
                <div class='ratio ratio-16x9'>
                    <video controls preload='metadata' class='w-100'>
                        <source src='{$file_url}' type='video/{$extension}'>
                        Il tuo browser non supporta la riproduzione video HTML5.
                    </video>
                </div>
            </div>
            <div class='card-footer text-muted small text-center'>
                Riproduttore multimediale integrato
            </div>
        </div>";
    }
    // 2. CASO PDF: Qui avvolgiamo il pulsante dentro il div con "mt-4" per dargli lo spazio dal testo
    else 
    {
        $parsed_path = $tp->toHTML($raw_file, true, 'constants,url');
        $pdf_path = str_replace(array(SITEURL, 'http://', 'https://'), '', $parsed_path);
        $pdf_path = ltrim($pdf_path, '/');
        $file_url = SITEURL . $pdf_path;
        
        $slug_title = preg_replace('/[^A-Za-z0-9\-]/', '_', $this->var['ex_title']);
        $download_name = $slug_title . '.' . $extension;

        return "<div class='mt-4 escursioni-attachment'><a href='{$file_url}' download='{$download_name}' class='btn btn-danger btn-sm' target='_blank'><i class='fas fa-file-pdf'></i> Scarica la Guida (PDF)</a></div>";
    }
}

}
