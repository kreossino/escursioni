<?php
if (!defined('e107_INIT')) { exit; }

$ESCURSIONI_TEMPLATE = array();

// Apertura della griglia Bootstrap prima del ciclo dei dati
$ESCURSIONI_TEMPLATE['default']['start'] = '
<div class="container my-4">
    <div class="row row-cols-1 row-cols-md-2 g-4">
';

// Il blocco HTML di ogni singola escursione (versione bella, a griglia e con i badge)
$ESCURSIONI_TEMPLATE['default']['item'] = '
    <div class="col">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                {ESCURSIONI_IMAGE1}
                <h3 class="card-title h4 text-primary mt-2">{ESCURSIONI_TITLE}</h3>
                
                <div class="mb-2">
                    <span class="badge bg-info text-dark">{ESCURSIONI_TYPE}</span>
                    <span class="badge bg-secondary"><i class="far fa-clock"></i> {ESCURSIONI_DURATION}</span>
                    <span class="badge bg-warning text-dark"><i class="fas fa-mountain"></i> {ESCURSIONI_DIFFICULTY}</span>
                </div>
                <p class="card-text text-muted">{ESCURSIONI_SHORT_TEXT}</p>
		                
                    {ESCURSIONI_PDFORVIDEO}

                <div class="mt-3">
                    <a class="btn btn-primary btn-sm" href="{ESCURSIONI_LINK}">Vedi escursione completa</a>
                </div>
            </div>
        </div>
    </div>
';

// Chiusura della griglia Bootstrap finiti i record
$ESCURSIONI_TEMPLATE['default']['end'] = '
    </div>
</div>
';

// Vista a tutta pagina del singolo record
$ESCURSIONI_TEMPLATE['single']['start'] = '
<div class="escursioni-single w-100">
';

$ESCURSIONI_TEMPLATE['single']['item'] = '
    <style>
        .escursioni-single-layout{display:grid;grid-template-columns:minmax(0,1fr) 280px;gap:2rem;align-items:start;width:100%;}
        .escursioni-single-content{min-width:0;}
        .escursioni-single-side{position:sticky;top:1rem;align-self:start;}
        .escursioni-single-title{margin:0 0 1rem;}
        .escursioni-single-side .badge{display:block;width:100%;white-space:normal;text-align:left;margin-bottom:.5rem;font-size:.9rem;line-height:1.35;}
        .escursioni-back-button{display:inline-block;margin-bottom:1rem;}
        .escursioni-gallery{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:.75rem;margin-bottom:1rem;}
        .escursioni-gallery-item{display:block;overflow:hidden;border-radius:.35rem;}
        .escursioni-gallery-item img{display:block;width:100%;height:180px;object-fit:cover;}
        @media (max-width: 991px){.escursioni-single-layout{grid-template-columns:1fr;}.escursioni-single-side{position:static;order:-1;}}
    </style>

    <div class="escursioni-single-layout">
        <main class="escursioni-single-content">
            <a class="btn btn-outline-primary btn-sm escursioni-back-button" href="#" onclick="window.history.back(); return false;">&laquo; Torna all elenco</a>
 <div class="escursioni-full-text mt-3">{ESCURSIONI_TEXT}</div>
{ESCURSIONI_PDFORVIDEO}
        </main>

        <aside class="escursioni-single-side">
          <div class="row">
  <a class="btn btn-outline-primary btn-sm escursioni-back-button" href="#" onclick="window.history.back(); return false;">&laquo; Torna all elenco</a>
</div>
            <h1 class="card-title h4 text-primary mt-2 escursioni-single-title">{ESCURSIONI_TITLE}</h1>
            <span class="badge bg-info text-dark">Tipo: {ESCURSIONI_TYPE}</span>
            <span class="badge bg-secondary">Durata: {ESCURSIONI_DURATION}</span>
            <span class="badge bg-warning text-dark">Difficolta: {ESCURSIONI_DIFFICULTY}</span>

		 <div class="escursioni-single-media">
                {ESCURSIONI_GALLERY}
                <noscript>
                    {ESCURSIONI_IMAGE1}
                    {ESCURSIONI_IMAGE2}
                    {ESCURSIONI_IMAGE3}
                    {ESCURSIONI_IMAGE4}
                </noscript>
            </div>
            <a class="btn btn-outline-primary btn-sm escursioni-back-button" href="#" onclick="window.history.back(); return false;">&laquo; Torna all elenco</a>
        </aside>
<a class="btn btn-outline-primary btn-sm escursioni-back-button" href="' . SITEURL . 'escursioni" onclick="if(document.referrer && document.referrer.includes(window.location.hostname)){ window.history.back(); return false; }">
    &laquo; Torna all\' elenco o visualizza Tutto
</a>
    </div>
';

$ESCURSIONI_TEMPLATE['single']['end'] = '
</div>
';




// ==========================================
// BLOCCO DI LAYOUT PER IL MENU (SIDEBAR)
// ==========================================

// Apertura del contenitore del menu (es: una lista compatta)
$ESCURSIONI_TEMPLATE['menu']['start'] = '
<div class="escursioni-menu-list list-group list-group-flush">
';

// Singolo elemento del menu (compatto, con titolo, tipo e link rapido)
$ESCURSIONI_TEMPLATE['menu']['item'] = '
<a href="{ESCURSIONI_LINK}" class="list-group-item list-group-item-action py-3 mt-2 px-0 border-bottom escursioni-menu-item">
    <!-- Titolo sempre a tutta larghezza in alto -->
    <div class="w-100 mb-2">
        <h5 class="h6 text-warning fw-bold p-2 bg-dark center rounded-top-5" style="margin:0;">{ESCURSIONI_TITLE}</h5>
    </div>
    


<div class="row g-2">
        
    <div class="col-12 col-md-2">
        <div class="d-flex flex-column gap-1 align-items-start w-100">
            <span class="badge bg-info text-dark w-100 text-start text-truncate" style="font-size: 0.72rem; padding: 0.35em 0.5em;">{ESCURSIONI_TYPE}</span>
            <span class="badge bg-light text-dark border w-100 text-start text-truncate" style="font-size: 0.72rem; padding: 0.35em 0.5em;"><i class="far fa-clock"></i> {ESCURSIONI_DURATION}</span>
            <span class="badge bg-warning text-dark w-100 text-start text-truncate" style="font-size: 0.72rem; padding: 0.35em 0.5em;"><i class="fas fa-mountain"></i> {ESCURSIONI_DIFFICULTY}</span>
        </div>
    </div>
    
    <div class="col-12 col-md-4 escursioni-menu-img">
        {ESCURSIONI_IMAGE1}
    </div>
    
    <div class="col-12 col-md-6 bg-dark text-white p-2 rounded-end">
        <p class="mb-0 lead" style="line-height: 1.3; margin:0;">{ESCURSIONI_SHORT_TEXT}</p>
    </div>
        
</div>
    </div>
</a>
';

// Chiusura del contenitore del menu
$ESCURSIONI_TEMPLATE['menu']['end'] = '
</div>
';
