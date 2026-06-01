<?php
if (!defined('e107_INIT')) { exit; }

$LAN['escursioni_admin_title']   = "Gestione Escursioni";
$LAN['escursioni_config_limit']  = "Numero di record da visualizzare nel blocco";
$LAN['escursioni_save_success']  = "Impostazioni salvate con successo!";

// Form Headers and Table Fields
$LAN['escursioni_adm_batch_selection'] = "Crea link selezione";
$LAN['escursioni_adm_th_frontend']     = "Link Frontend";
$LAN['escursioni_adm_th_text']         = "Testo";
$LAN['escursioni_adm_th_image1']       = "Immagine 1";
$LAN['escursioni_adm_th_image2']       = "Immagine 2";
$LAN['escursioni_adm_th_image3']       = "Immagine 3";
$LAN['escursioni_adm_th_image4']       = "Immagine 4";
$LAN['escursioni_adm_th_file']         = "File PDF";
$LAN['escursioni_adm_th_type']         = "Tipologia";
$LAN['escursioni_adm_th_duration']     = "Durata";
$LAN['escursioni_adm_th_difficulty']   = "Difficoltà";

// Field Help Messages
$LAN['escursioni_adm_help_image1']     = "Carica l'immagine principale";
$LAN['escursioni_adm_help_file']       = "Carica il file PDF informativo";

// Plugin Preferences
$LAN['escursioni_adm_pref_type_t']     = "Opzioni Tipologia";
$LAN['escursioni_adm_pref_type_h']     = "Inserisci i tipi separati da virgola (es: Trekking, Relax)";
$LAN['escursioni_adm_pref_dur_t']      = "Opzioni Durata";
$LAN['escursioni_adm_pref_dur_h']      = "Inserisci le durate separate da virgola (es: 1 Ora, 2 Ore)";
$LAN['escursioni_adm_pref_diff_t']     = "Opzioni Difficoltà";
$LAN['escursioni_adm_pref_diff_h']     = "Inserisci le difficoltà separate da virgola";
$LAN['escursioni_adm_pref_limit_t']    = "Limite Record Menu";
$LAN['escursioni_adm_pref_limit_h']    = "Indica il numero massimo di escursioni da mostrare nel menu laterale prima dello scroll";

// System Messages and Notifications
$LAN['escursioni_adm_err_not_installed'] = "Il plugin non è ancora installato. Il salvataggio e il caricamento dei dati falliranno.";
$LAN['escursioni_adm_select_min_one']    = "Seleziona almeno un'escursione.";
$LAN['escursioni_adm_err_enter_title']   = "Inserisci un nome per il link della selezione.";
$LAN['escursioni_adm_err_invalid_sef']   = "Il nome scelto non è valido per creare un link SEF.";
$LAN['escursioni_adm_err_save_fail']     = "Impossibile salvare la selezione:";
$LAN['escursioni_adm_err_token_inv']     = "Token non valido: link selezione non eliminato.";
$LAN['escursioni_adm_success_deleted']   = "Link selezione eliminato con successo.";
$LAN['escursioni_adm_err_del_fail']      = "Impossibile eliminare il link selezione:";

// Buttons, Forms and Selection Manager
$LAN['escursioni_adm_lbl_sef_link']      = "Link SEF alla selezione";
$LAN['escursioni_adm_lbl_sef_name']      = "Nome del link SEF";
$LAN['escursioni_adm_placeholder_sef']   = "es. Weekend di Maggio";
$LAN['escursioni_adm_btn_open']          = "Apri";
$LAN['escursioni_adm_btn_create_link']   = "Crea link";
$LAN['escursioni_adm_btn_view']          = "Visualizza sul sito";
$LAN['escursioni_adm_btn_view_t']        = "Apri";
$LAN['escursioni_adm_panel_title']       = "Link selezione creati";
$LAN['escursioni_adm_no_selections']     = "Nessun link selezione creato.";
$LAN['escursioni_adm_confirm_delete']    = "Eliminare questo link selezione?";

// General Help Section
$LAN['escursioni_adm_help_text']         = "Pannello di gestione delle escursioni. Puoi creare nuovi ingressi, modificare quelli esistenti o generare link personalizzati raggruppando gli elementi.";

// Extensions and Events
$LAN['escursioni_eadm_blank_url']    = "URL Vuoto";
$LAN['escursioni_eadm_blank_custom'] = "Campo Personalizzato Vuoto";
$LAN['escursioni_eadm_batch_cmd']    = "Comando Batch Personalizzato";
$LAN['escursioni_eadm_custom_lbl']   = "Personalizzato";
$LAN['escursioni_evt_error']         = "Errore nell'evento:";
$LAN['escursioni_evt_block']         = "Blocco dei trigger successivi per:";

// Libraries and System Links
$LAN['escursioni_lib_example_name'] = "Libreria di esempio (Mockup)";
$LAN['escursioni_lib_simple_name']  = "Libreria semplice (Mockup)";
$LAN['escursioni_lnk_all']          = "Elenco Generale Escursioni";
$LAN['escursioni_lnk_single']       = "Escursione: ";
$LAN['escursioni_lnk_selection']    = "Selezione escursioni: ";
$LAN['escursioni_menucfg_title']    = "Titolo del Menu";
$LAN['escursioni_menucfg_count']    = "Numero di escursioni da mostrare";

// Setup and Install
$LAN['escursioni_setup_sample_title'] = "Prima Escursione di Esempio";
$LAN['escursioni_setup_sample_text']  = "Testo descrittivo dell'escursione di prova.";
$LAN['escursioni_setup_install_ok']   = "Plugin Escursioni installato con successo. Record di esempio inserito.";
$LAN['escursioni_setup_install_ko']   = "Impossibile inserire i dati tabella iniziali.";
$LAN['escursioni_setup_un_label']     = "Opzioni rimozione dati";
$LAN['escursioni_setup_un_preview']   = "Anteprima area rimozione";
$LAN['escursioni_setup_un_help']      = "Scegli come gestire i dati associati al plugin durante la disinstallazione.";
$LAN['escursioni_setup_un_opt1']      = "Mantieni tabelle nel database";
$LAN['escursioni_setup_un_opt2']      = "Elimina permanentemente tutte le tabelle delle escursioni";

// Sitelinks and SEO
$LAN['escursioni_sitelink_name'] = "Link Escursioni Dinamici (Pagine e Selezioni)";
$LAN['escursioni_url_label']     = "URL Amichevoli";
$LAN['escursioni_url_desc']      = "Configurazione URL SEO e riscrittura per il plugin escursioni";
$LAN['LAN_PREF_TIPO']            = "Tipo Escursione";
$LAN['LAN_PREF_DURATA']          = "Durata Escursione";
$LAN['LAN_PREF_DIFFICOLTA']      = "Livello di Difficoltà";
$LAN['LAN_PREF_FILE']            = "File Allegato";
// Chiavi specifiche per le Preferenze del Plugin (Admin Menu)
$LAN['escursioni_adm_pref_type_t']     = "Opzioni Tipo";
$LAN['escursioni_adm_pref_dur_t']      = "Opzioni Durata";
$LAN['escursioni_adm_pref_diff_t']     = "Opzioni Difficoltà";
$LAN['escursioni_adm_pref_limit_t']    = "Limite Record Menu";
