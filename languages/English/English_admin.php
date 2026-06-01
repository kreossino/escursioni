<?php
if (!defined('e107_INIT')) { exit; }

$LAN['escursioni_admin_title']   = "Excursions Management";
$LAN['escursioni_config_limit']  = "Number of records to display in the block";
$LAN['escursioni_save_success']  = "Settings saved successfully!";

// Form Headers and Table Fields
$LAN['escursioni_adm_batch_selection'] = "Create selection link";
$LAN['escursioni_adm_th_frontend']     = "Frontend Link";
$LAN['escursioni_adm_th_text']         = "Text";
$LAN['escursioni_adm_th_image1']       = "Image 1";
$LAN['escursioni_adm_th_image2']       = "Image 2";
$LAN['escursioni_adm_th_image3']       = "Image 3";
$LAN['escursioni_adm_th_image4']       = "Image 4";
$LAN['escursioni_adm_th_file']         = "PDF File";
$LAN['escursioni_adm_th_type']         = "Type";
$LAN['escursioni_adm_th_duration']     = "Duration";
$LAN['escursioni_adm_th_difficulty']   = "Difficulty";

// Field Help Messages
$LAN['escursioni_adm_help_image1']     = "Upload the main image";
$LAN['escursioni_adm_help_file']       = "Upload the informative PDF file";

// Plugin Preferences
$LAN['escursioni_adm_pref_type_t']     = "Type Options";
$LAN['escursioni_adm_pref_type_h']     = "Enter types separated by commas (e.g., Trekking, Relax)";
$LAN['escursioni_adm_pref_dur_t']      = "Duration Options";
$LAN['escursioni_adm_pref_dur_h']      = "Enter durations separated by commas (e.g., 1 Hour, 2 Hours)";
$LAN['escursioni_adm_pref_diff_t']     = "Difficulty Options";
$LAN['escursioni_adm_pref_diff_h']     = "Enter difficulty levels separated by commas";
$LAN['escursioni_adm_pref_limit_t']    = "Number of records in Menu Block";
$LAN['escursioni_adm_pref_limit_h']    = "Indicate the maximum number of excursions to show in the side widget before scrolling";

// System Messages and Notifications
$LAN['escursioni_adm_err_not_installed'] = "This plugin is not yet installed. Saving and loading preference or table data will fail.";
$LAN['escursioni_adm_select_min_one']    = "Select at least one excursion.";
$LAN['escursioni_adm_err_enter_title']   = "Enter a name for the selection link.";
$LAN['escursioni_adm_err_invalid_sef']   = "The chosen name is not valid for creating a SEF link.";
$LAN['escursioni_adm_err_save_fail']     = "Unable to save the selection:";
$LAN['escursioni_adm_err_token_inv']     = "Invalid token: selection link not deleted.";
$LAN['escursioni_adm_success_deleted']   = "Selection link successfully deleted.";
$LAN['escursioni_adm_err_del_fail']      = "Unable to delete the selection link:";

// Buttons, Forms and Selection Manager
$LAN['escursioni_adm_lbl_sef_link']      = "SEF link to selection";
$LAN['escursioni_adm_lbl_sef_name']      = "SEF link name";
$LAN['escursioni_adm_placeholder_sef']   = "e.g., May Weekend";
$LAN['escursioni_adm_btn_open']          = "Open";
$LAN['escursioni_adm_btn_create_link']   = "Create link";
$LAN['escursioni_adm_btn_view']          = "View on site";
$LAN['escursioni_adm_btn_view_t']        = "Open";
$LAN['escursioni_adm_panel_title']       = "Created selection links";
$LAN['escursioni_adm_no_selections']     = "No selection links created.";
$LAN['escursioni_adm_confirm_delete']    = "Delete this selection link?";

// General Help Section
$LAN['escursioni_adm_help_text']         = "Excursions management panel. You can create new entries, edit existing ones, or generate custom SEF links by grouping items.";

// Extensions and Events
$LAN['escursioni_eadm_blank_url']    = "Empty URL";
$LAN['escursioni_eadm_blank_custom'] = "Empty custom field";
$LAN['escursioni_eadm_batch_cmd']    = "Custom batch command";
$LAN['escursioni_eadm_custom_lbl']   = "Custom";
$LAN['escursioni_evt_error']         = "Error in event:";
$LAN['escursioni_evt_block']         = "Blocking further triggers for:";

// Libraries and System Links
$LAN['escursioni_lib_example_name'] = "Example library (Mockup)";
$LAN['escursioni_lib_simple_name']  = "Simple library (Mockup)";
$LAN['escursioni_lnk_all']          = "General Excursions List";
$LAN['escursioni_lnk_single']       = "Excursion: ";
$LAN['escursioni_lnk_selection']    = "Excursion selection: ";
$LAN['escursioni_menucfg_title']    = "Menu Title";
$LAN['escursioni_menucfg_count']    = "Number of excursions to show";

// Setup and Install
$LAN['escursioni_setup_sample_title'] = "First Sample Excursion";
$LAN['escursioni_setup_sample_text']  = "Descriptive text for the test excursion.";
$LAN['escursioni_setup_install_ok']   = "Excursions plugin installed successfully. Sample record inserted.";
$LAN['escursioni_setup_install_ko']   = "Unable to insert initial sample table data.";
$LAN['escursioni_setup_un_label']     = "Data removal options";
$LAN['escursioni_setup_un_preview']   = "Removal area preview";
$LAN['escursioni_setup_un_help']      = "Choose how to manage data associated with the plugin during uninstallation.";
$LAN['escursioni_setup_un_opt1']      = "Keep tables in the database";
$LAN['escursioni_setup_un_opt2']      = "Permanently delete all excursions tables";

// Sitelinks and SEO
$LAN['escursioni_sitelink_name'] = "Dynamic Excursions Links (Pages and Selections)";
$LAN['escursioni_url_label']     = "Friendly URLs";
$LAN['escursioni_url_desc']      = "SEO URL configuration and rewriting for the excursions plugin";
$LAN['LAN_PREF_TIPO']            = "Excursion Type";
$LAN['LAN_PREF_DURATA']          = "Excursion Duration";
$LAN['LAN_PREF_DIFFICOLTA']      = "Difficulty Level";
$LAN['LAN_PREF_FILE']            = "Attached File";
// Table Headers (Selection Manager)
$LAN['escursioni_adm_th_name']       = "Name";
$LAN['escursioni_adm_th_url']        = "URL";
// e_url.php labels
$LAN['escursioni_url_name']    = "Escursions";
$LAN['escursioni_url_label']   = "Friendly URLs";
$LAN['escursioni_url_desc']    = "SEO URL configuration and rewriting for the excursions plugin";
