<?php
if (!defined('e107_INIT')) { exit; }

class plugin_escursioni_escursioni_shortcodes extends e_shortcode
{
    // Restituisce il titolo dell'escursione
    function sc_escursioni_title()
    {
        return e107::getParser()->toHTML($this->var['ex_title']);
    }

    // Restituisce la descrizione
function sc_escursioni_text()
{
    // Il secondo parametro 'true' forza e107 a renderizzare i tag [img] e [html] trasformandoli in immagini reali
    return e107::getParser()->toHTML($this->var['ex_text'], true, 'constants,bbcode');
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
        
        $tp = e107::getParser();
        // Converte l'eventuale tracciamento media nativo nel percorso url corretto dell'immagine
        $img_url = $tp->thumbUrl($this->var['ex_image1']); 
        
        return "<img src='{$img_url}' class='img-fluid rounded mb-3' alt='{$this->var['ex_title']}' />";
    }

    // Restituisce il link per scaricare il PDF (se caricato) o visualizzare il video mp4
function sc_escursioni_pdforvideo()
    {
        if(empty($this->var['ex_file'])) return '';
        
        $tp = e107::getParser();
        $raw_file = $this->var['ex_file'];
        
        // 1. Isoliarmo l'anno/mese e il nome del file (es: 2026-05/partita_sir.mp4)
        $clean_path = preg_replace('/\{.*?\}/', '', $raw_file);
        $clean_path = ltrim($clean_path, '/');
        
        $extension = strtolower(pathinfo($clean_path, PATHINFO_EXTENSION));

        // 2. CASO VIDEO: Mostriamo la card con il player incorporato direttamente nella pagina
        if ($extension === 'mp4' || $extension === 'webm' || $extension === 'ogg') 
        {
            $file_url = SITEURL . 'e107_media/88f45b03dc/videos/' . $clean_path;

            $text = "
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

            return $text;
        }
        // 3. CASO PDF / ALLEGATI STANDARD: Rimane il pulsante classico di download
        else 
        {
            $parsed_path = $tp->toHTML($raw_file, true, 'constants,url');
            $pdf_path = str_replace(array(SITEURL, 'http://', 'https://'), '', $parsed_path);
            $pdf_path = ltrim($pdf_path, '/');
            $file_url = SITEURL . $pdf_path;
            
            $slug_title = preg_replace('/[^A-Za-z0-9\-]/', '_', $this->var['ex_title']);
            $download_name = $slug_title . '.' . $extension;

            return "<a href='{$file_url}' download='{$download_name}' class='btn btn-danger btn-sm' target='_blank'><i class='fas fa-file-pdf'></i> Scarica la Guida (PDF)</a>";
        }
    }
}
