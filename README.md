Escursioni plugin for my friend Michele
al momento solo uso testing visibile al momento su https://serverkreos.it/test/e107/escursioni


modifica mysql per rendere omogenee le tabelle con e107:

ALTER TABLE e107_escursioni CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE e107_escursioni_selezioni CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE e107_hits CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

per l'installazione sostituire sulle tabelle di escursioni_sql.php

ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
invece di quello presente
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

<!-- Immagine singola a tutta larghezza con lightbox -->
{IMAGE_RESPONSIVE_ESCURSIONI: src=escursione1.jpg&width=12&lightbox=1}

<!-- Griglia 2 colonne -->
<div class="row escursioni-gallery">
{IMAGE_RESPONSIVE_ESCURSIONI: src=escursione1.jpg&width=6&lightbox=1}
{IMAGE_RESPONSIVE_ESCURSIONI: src=escursione2.jpg&width=6&lightbox=1}
</div>

<!-- Griglia 3 colonne -->
<div class="row escursioni-gallery">
{IMAGE_RESPONSIVE_ESCURSIONI: src=escursione1.jpg&width=4&lightbox=1}
{IMAGE_RESPONSIVE_ESCURSIONI: src=escursione2.jpg&width=4&lightbox=1}
{IMAGE_RESPONSIVE_ESCURSIONI: src=escursione3.jpg&width=4&lightbox=1}
</div>

<!-- Senza lightbox -->
{IMAGE_RESPONSIVE_ESCURSIONI: src=escursione1.jpg&width=6&lightbox=0}

<!-- Con testo alternativo personalizzato -->
{IMAGE_RESPONSIVE_ESCURSIONI: src=escursione1.jpg&width=6&lightbox=1&alt=Dolomiti al tramonto}
