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

