<?php
// CODEX_MARKER_ESCURSIONI_ADMIN_2026_06_01_FINAL_FIXED
require_once('../../class2.php');

// ✅ Carica la lingua admin SUBITO dopo class2.php
e107::lan('escursioni', 'admin');

if (!getperms('P')) {
    e107::redirect('admin');
    exit;
}

class escursioni_adminArea extends e_admin_dispatcher
{
    protected $modes = array(
        'main' => array(
            'controller' => 'escursioni_ui',
            'path'       => null,
            'ui'         => 'escursioni_form_ui',
            'uipath'     => null
        ),
    );

    // ✅ Costanti CORE e107: funzionano in dichiarazione proprietà PHP 8.1+
    protected $adminMenu = array(
        'main/list'   => array('caption' => LAN_MANAGE, 'perm' => 'P'),
        'main/create' => array('caption' => LAN_CREATE, 'perm' => 'P'),
        'main/prefs'  => array('caption' => LAN_PREFS,  'perm' => 'P'),
    );

    protected $adminMenuAliases = array(
        'main/edit' => 'main/list',
        'index'     => 'main/list'  // ← Fondamentale per evitare "IndexPage not found"
    );

    protected $menuTitle = 'escursioni';
}

class escursioni_ui extends e_admin_ui
{
    // ✅ Proprietà con valori statici o costanti core
    protected $pluginTitle = 'escursioni';
    protected $pluginName  = 'escursioni';
    protected $table       = 'escursioni';
    protected $pid         = 'ex_id';
    protected $perPage     = 10;
    protected $batchDelete = true;
    protected $batchExport = true;
    protected $batchCopy   = true;
    protected $listOrder   = 'ex_id DESC';
    protected $fieldpref   = array('ex_title', 'ex_type');

    // ✅ Campi con costanti core dirette (funzionano in dichiarazione)
    protected $fields = array(
        'checkboxes'       => array('title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => 'value', 'class' => 'center', 'toggle' => 'e-multiselect', 'readParms' => array(), 'writeParms' => array()),
        'ex_id'            => array('title' => LAN_ID, 'type' => 'number', 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => array(), 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_title'         => array('title' => LAN_TITLE, 'type' => 'text', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => array(), 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_link_frontend' => array('title' => 'Link Frontend', 'type' => 'method', 'data' => false, 'width' => 'auto', 'forced' => 'value', 'readParms' => array(), 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_text'          => array('title' => 'Text', 'type' => 'bbarea', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => array(), 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_image1'        => array('title' => 'Image1', 'type' => 'image', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => 'carica l\'immagine', 'readParms' => 'thumb=80x80', 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_image2'        => array('title' => 'Image2', 'type' => 'image', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => 'thumb=80x80', 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_image3'        => array('title' => 'Image3', 'type' => 'image', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => 'thumb=80x80', 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_image4'        => array('title' => 'Image4', 'type' => 'image', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => 'thumb=80x80', 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_file'          => array('title' => 'File', 'type' => 'file', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => 'carica il file pdf', 'readParms' => array(), 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_type'          => array('title' => 'Tipo', 'type' => 'dropdown', 'data' => 'safestr', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => array(), 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
        'ex_duration'      => array('title' => 'Duration', 'type' => 'dropdown', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => array(), 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left', 'filter' => false, 'batch' => false),
        'ex_difficulty'    => array('title' => 'Difficulty', 'type' => 'dropdown', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => array(), 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left', 'filter' => false, 'batch' => false),
        'options'          => array('title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => 'value', 'readParms' => array(), 'writeParms' => array()),
    );

    // ✅ Dichiarati vuoti: verranno popolati in init() con $LAN[]
    protected $prefs        = array();
    protected $batchOptions = array();

    public function init()
    {
        global $LAN; // ← OBBLIGATORIO per accedere a $LAN[] in PHP 8+

        // ✅ Localizza titolo plugin e batchOptions (solo qui, dentro init())
        $this->pluginTitle = vartrue($LAN['escursioni_admin_title'], 'Escursioni');
        $this->batchOptions = array(
            'link_selezione' => vartrue($LAN['escursioni_adm_batch_selection'], 'Create selection link')
        );

        // ✅ Sovrascrivi i titoli dei campi con le traduzioni personalizzate
        $this->fields['ex_link_frontend']['title'] = vartrue($LAN['escursioni_adm_th_frontend'], 'Frontend Link');
        $this->fields['ex_text']['title'] = vartrue($LAN['escursioni_adm_th_text'], 'Text');
        $this->fields['ex_image1']['title'] = vartrue($LAN['escursioni_adm_th_image1'], 'Image 1');
        $this->fields['ex_image1']['help']  = vartrue($LAN['escursioni_adm_help_image1'], '');
        $this->fields['ex_image2']['title'] = vartrue($LAN['escursioni_adm_th_image2'], 'Image 2');
        $this->fields['ex_image3']['title'] = vartrue($LAN['escursioni_adm_th_image3'], 'Image 3');
        $this->fields['ex_image4']['title'] = vartrue($LAN['escursioni_adm_th_image4'], 'Image 4');
        $this->fields['ex_file']['title']   = vartrue($LAN['escursioni_adm_th_file'], 'PDF File');
        $this->fields['ex_file']['help']    = vartrue($LAN['escursioni_adm_help_file'], '');
        $this->fields['ex_type']['title']   = vartrue($LAN['escursioni_adm_th_type'], 'Type');
        $this->fields['ex_duration']['title'] = vartrue($LAN['escursioni_adm_th_duration'], 'Duration');
        $this->fields['ex_difficulty']['title'] = vartrue($LAN['escursioni_adm_th_difficulty'], 'Difficulty');

// ✅ PREFERENCES: popolato qui con $LAN[] (non può essere in dichiarazione)
$this->prefs = array(
    'tipo' => array(
        'title' => vartrue($LAN['escursioni_adm_pref_type_t'], 'Opzioni Tipo'), 
        'tab' => 0, 
        'type' => 'text', 
        'data' => 'str', 
        'help' => vartrue($LAN['escursioni_adm_pref_type_h'], 'Inserisci i tipi separati da virgola')
    ),
    'durata' => array(
        'title' => vartrue($LAN['escursioni_adm_pref_dur_t'], 'Opzioni Durata'), 
        'tab' => 0, 
        'type' => 'text', 
        'data' => 'str', 
        'help' => vartrue($LAN['escursioni_adm_pref_dur_h'], 'Inserisci le durate separate da virgola')
    ),
    'difficoltà' => array(
        'title' => vartrue($LAN['escursioni_adm_pref_diff_t'], 'Opzioni Difficoltà'), 
        'tab' => 0, 
        'type' => 'text', 
        'data' => 'str', 
        'help' => vartrue($LAN['escursioni_adm_pref_diff_h'], 'Inserisci le difficoltà separate da virgola')
    ),
    'escursioni_menu_global_limit' => array(
        'title' => vartrue($LAN['escursioni_adm_pref_limit_t'], 'Limite Record Menu'), 
        'tab' => 0, 
        'type' => 'number', 
        'data' => 'int', 
        'help' => vartrue($LAN['escursioni_adm_pref_limit_h'], 'Numero massimo di escursioni nel menu')
    ),
);     

        if (!e107::isInstalled('escursioni')) {
            e107::getMessage()->addWarning(vartrue($LAN['escursioni_adm_err_not_installed'], 'Plugin not installed.'));
        }

        if (!empty($_POST['escursioni_save_selection'])) {
            $this->handleSelectionFormSubmit();
        }
        if (!empty($_GET['escursioni_delete_selection'])) {
            $this->handleSelectionDelete();
        }

        // Popola dropdown con preferenze
        $pref = e107::getPlugPref('escursioni');
        $types_str = !empty($pref['tipo']) ? $pref['tipo'] : "Trekking, Enogastronomia, Culturale, Relax";
        $dur_str   = !empty($pref['durata']) ? $pref['durata'] : "1 Ora, 2 Ore, 4 Ore totali, Giornata intera";
        $diff_str  = !empty($pref['difficoltà']) ? $pref['difficoltà'] : "Facile (mt.100), Medio (mt.400), Difficile (mt.800)";

        $this->fields['ex_type']['writeParms']['optArray'] = $this->safeArrayCombine($types_str);
        $this->fields['ex_duration']['writeParms']['optArray'] = $this->safeArrayCombine($dur_str);
        $this->fields['ex_difficulty']['writeParms']['optArray'] = $this->safeArrayCombine($diff_str);

        $this->viewURL = e107::url('escursioni', 'view', array('ex_id' => '--ID--', 'ex_title' => '--TITLE--'));
        
        // ✅ Il pannello "Link selezione creati" viene assegnato qui
        $this->preFilterMarkup = $this->renderSelectionManager();

        // ✅ parent::init() SEMPRE ALLA FINE
        parent::init();
    }

    private function safeArrayCombine($str)
    {
        $arr = array_map('trim', explode(',', $str));
        return count($arr) > 0 && !empty($arr[0]) ? array_combine($arr, $arr) : array();
    }

    protected function escursioniSlug($text)
    {
        $text = html_entity_decode((string) $text, ENT_QUOTES, 'UTF-8');
        $text = preg_replace('/[^A-Za-z0-9]+/', '-', $text);
        return strtolower(trim($text, '-'));
    }

    protected function getSelectedFrontendUrl($slug)
    {
        return e107::url('escursioni', 'selezione', array('sel_slug' => $slug));
    }

    protected function getSelectedIds($selected)
    {
        $ids = array();
        foreach ((array) $selected as $id) {
            $id = (int) $id;
            if ($id > 0) $ids[] = $id;
        }
        return array_unique($ids);
    }

    protected function getBatchTitle($value)
    {
        if (is_array($value)) {
            foreach ($value as $item) {
                $item = trim((string) $item);
                if ($item !== '') return $item;
            }
            return '';
        }
        return trim((string) $value);
    }

    protected function saveSelection($ids, $title)
    {
        global $LAN;
        $ids = $this->getSelectedIds($ids);
        $title = trim((string) $title);

        if (empty($ids)) {
            e107::getMessage()->addWarning(vartrue($LAN['escursioni_adm_select_min_one'], 'Select at least one excursion.'));
            return false;
        }
        if ($title === '') {
            e107::getMessage()->addWarning(vartrue($LAN['escursioni_adm_err_enter_title'], 'Enter a name for the selection link.'));
            return false;
        }

        $sql = e107::getDb();
        $tp = e107::getParser();
        $slug = $this->escursioniSlug($title);

        if ($slug === '' || $slug === 'create') {
            e107::getMessage()->addWarning(vartrue($LAN['escursioni_adm_err_invalid_sef'], 'Invalid SEF name.'));
            return false;
        }

        $data = array(
            'sel_slug'      => $tp->toDB($slug),
            'sel_title'     => $tp->toDB($title),
            'sel_ids'       => $tp->toDB(implode(',', $ids)),
            'sel_datestamp' => time()
        );

        if ($exists = $sql->retrieve('escursioni_selezioni', 'sel_id', "WHERE sel_slug='".$tp->toDB($slug)."'")) {
            $ok = $sql->update('escursioni_selezioni', $data, "WHERE sel_id=".(int) $exists);
        } else {
            $ok = $sql->insert('escursioni_selezioni', $data);
        }

        if (!$ok) {
            e107::getMessage()->addError(vartrue($LAN['escursioni_adm_err_save_fail'], 'Save failed:') . ' ' . $sql->getLastErrorText());
            return false;
        }
        return $slug;
    }

    protected function renderSelectionLink($slug)
    {
        global $LAN;
        $tp = e107::getParser();
        $url = $this->getSelectedFrontendUrl($slug);
        $safeUrl = $tp->toAttribute($url);

        $text = "<div class='form-group'>";
        $text .= "<label>".vartrue($LAN['escursioni_adm_lbl_sef_link'], 'SEF link to selection')."</label>";
        $text .= "<div class='input-group'>";
        $text .= "<input type='text' class='form-control input-lg' value='".$safeUrl."' readonly onclick='this.select()' />";
        $text .= "<span class='input-group-btn'>";
        $text .= "<a class='btn btn-primary btn-lg' href='".$safeUrl."' target='_blank' rel='noopener'>".vartrue($LAN['escursioni_adm_btn_open'], 'Open')."</a>";
        $text .= "</span>";
        $text .= "</div></div>";
        e107::getMessage()->addInfo($text);
    }

    protected function renderSelectionNameForm($ids)
    {
        global $LAN;
        $ids = $this->getSelectedIds($ids);
        if (empty($ids)) {
            e107::getMessage()->addWarning(vartrue($LAN['escursioni_adm_select_min_one'], 'Select at least one.'));
            return;
        }
        $tp = e107::getParser();
        $safeIds = $tp->toAttribute(implode(',', $ids));
        $action = $tp->toAttribute(e_SELF.'?'.e_QUERY);

        $text = "<form method='post' action='".$action."' class='form-horizontal'>";
        $text .= "<input type='hidden' name='escursioni_save_selection' value='1' />";
        $text .= "<input type='hidden' name='escursioni_selection_ids' value='".$safeIds."' />";
        $text .= "<div class='form-group'>";
        $text .= "<label class='col-sm-3 control-label'>".vartrue($LAN['escursioni_adm_lbl_sef_name'], 'SEF link name')."</label>";
        $text .= "<div class='col-sm-6'>";
        $text .= "<input type='text' name='escursioni_selection_title' class='form-control' placeholder='".vartrue($LAN['escursioni_adm_placeholder_sef'], 'e.g. May Weekend')."' required />";
        $text .= "</div>";
        $text .= "<div class='col-sm-3'>";
        $text .= "<button type='submit' class='btn btn-primary'>".vartrue($LAN['escursioni_adm_btn_create_link'], 'Create link')."</button>";
        $text .= "</div></div></form>";
        e107::getMessage()->addInfo($text);
    }

    protected function handleSelectionFormSubmit()
    {
        $ids = !empty($_POST['escursioni_selection_ids']) ? explode(',', $_POST['escursioni_selection_ids']) : array();
        $title = vartrue($_POST['escursioni_selection_title']);
        $slug = $this->saveSelection($ids, $title);
        if ($slug) $this->renderSelectionLink($slug);
    }

    protected function handleSelectionDelete()
    {
        global $LAN;
        $id = (int) $_GET['escursioni_delete_selection'];
        if ($id < 1) return;

        $token = vartrue($_GET['e-token']);
        if (empty($token) || $token !== defset('e_TOKEN')) {
            e107::getMessage()->addError(vartrue($LAN['escursioni_adm_err_token_inv'], 'Invalid token.'));
            return;
        }

        $sql = e107::getDb();
        if ($sql->delete('escursioni_selezioni', 'sel_id='.(int) $id)) {
            e107::getMessage()->addSuccess(vartrue($LAN['escursioni_adm_success_deleted'], 'Deleted successfully.'));
        } else {
            e107::getMessage()->addError(vartrue($LAN['escursioni_adm_err_del_fail'], 'Delete failed:') . ' ' . $sql->getLastErrorText());
        }
    }

    protected function renderSelectionManager()
    {
        global $LAN; // ← OBBLIGATORIO
        $sql = e107::getDb();
        $tp = e107::getParser();

        $text = "<div class='panel panel-default card mb-3'>";
        $text .= "<div class='panel-heading card-header'><strong>".vartrue($LAN['escursioni_adm_panel_title'], 'Created selection links')."</strong></div>";
        $text .= "<div class='panel-body card-body'>";

        $rows = $sql->retrieve('escursioni_selezioni', 'sel_id, sel_slug, sel_title, sel_ids, sel_datestamp', "sel_slug != '' ORDER BY sel_datestamp DESC, sel_title ASC", true);

        if (empty($rows)) {
            $text .= "<p class='text-muted'>".vartrue($LAN['escursioni_adm_no_selections'], 'No links created.')."</p></div></div>";
            return $text;
        }

        $text .= "<div class='table-responsive overflow-auto border p-3' style='max-height:250px;'>";
        $text .= "<table class='table table-striped table-bordered'>";
        $text .= "<thead><tr>";
        // ✅ FIX: usa defset() per le costanti core dentro metodi
        $text .= "<th>".defset('LAN_NAME', 'Name')."</th>";
        $text .= "<th>URL</th>";
        $text .= "<th class='text-center'>".defset('LAN_RECORDS', 'Records')."</th>";
        $text .= "<th>".defset('LAN_CREATED', 'Created')."</th>";
        $text .= "<th class='text-center'>".defset('LAN_OPTIONS', 'Options')."</th>";
        $text .= "</tr></thead><tbody>";

        foreach ($rows as $row) {
            $title = $tp->toHTML(vartrue($row['sel_title']), true, 'TITLE');
            $url = $this->getSelectedFrontendUrl($row['sel_slug']);
            $safeUrl = $tp->toAttribute($url);
            $count = count($this->getSelectedIds(explode(',', vartrue($row['sel_ids']))));
            $date = !empty($row['sel_datestamp']) ? date('Y-m-d H:i', (int) $row['sel_datestamp']) : '';
            $deleteUrl = e_SELF.'?mode=main&amp;action=list&amp;escursioni_delete_selection='.(int)$row['sel_id'].'&amp;e-token='.defset('e_TOKEN');

            $text .= "<tr>";
            $text .= "<td>".$title."</td>";
            $text .= "<td><input type='text' class='form-control input-sm' value='".$safeUrl."' readonly onclick='this.select()' /></td>";
            $text .= "<td class='text-center'>".$count."</td>";
            $text .= "<td>".$tp->toHTML($date)."</td>";
            $text .= "<td class='text-center'>";
            $text .= "<a class='btn btn-xs btn-default btn-secondary' href='".$safeUrl."' target='_blank' rel='noopener'>".vartrue($LAN['escursioni_adm_btn_open'], 'Open')."</a> ";
            // ✅ FIX: usa defset() anche per LAN_DELETE
            $text .= "<a class='btn btn-xs btn-danger' href='".$deleteUrl."' onclick=\"return confirm('".vartrue($LAN['escursioni_adm_confirm_delete'], 'Delete this link?')."');\">".defset('LAN_DELETE', 'Delete')."</a>";
            $text .= "</td></tr>";
        }
        $text .= "</tbody></table></div></div></div>";
        return $text;
    }

    protected function handleListLinkSelezioneBatch($selected, $value = null)
    {
        return $this->renderSelectionNameForm($selected);
    }
    protected function handleListLinkSelezioneCreateBatch($selected, $value = null)
    {
        return $this->renderSelectionNameForm($selected);
    }

    public function beforeCreate($new_data,$old_data) { return $new_data; }
    public function afterCreate($new_data, $old_data, $id) {}
    public function onCreateError($new_data, $old_data) {}
    public function beforeUpdate($new_data, $old_data, $id) { return $new_data; }
    public function afterUpdate($new_data, $old_data, $id) {}
    public function onUpdateError($new_data, $old_data, $id) {}

    public function renderHelp()
    {
        global $LAN;
        return array(
            'caption' => defset('LAN_HELP', 'Help'),
            'text'    => vartrue($LAN['escursioni_adm_help_text'], 'Help text.')
        );
    }
}

class escursioni_form_ui extends e_admin_form_ui
{
    private function escursioniSlug($text)
    {
        $text = html_entity_decode((string) $text, ENT_QUOTES, 'UTF-8');
        $text = preg_replace('/[^A-Za-z0-9]+/', '-', $text);
        return strtolower(trim($text, '-'));
    }

    public function ex_link_frontend($curVal, $mode, $parm = null)
    {
        global $LAN;
        if (!in_array($mode, array('read', 'list'), true)) return '';

        $controller = e107::getAdminUI()->getController();
        $model = (is_object($controller) && method_exists($controller, 'getListModel')) ? $controller->getListModel() : null;
        $row = (is_object($model) && method_exists($model, 'getData')) ? $model->getData() : array();
        if (empty($row['ex_id'])) return '';

        $url = e107::url('escursioni', 'view', array(
            'ex_id'    => (int) $row['ex_id'],
            'ex_title' => $this->escursioniSlug(vartrue($row['ex_sef']) ?: vartrue($row['ex_title']))
        ));
        $title = e107::getParser()->toAttribute(vartrue($row['ex_title']));
        return "<a class='btn btn-xs btn-primary' href='".$url."' target='_blank' rel='noopener' title='".vartrue($LAN['escursioni_adm_btn_view'], 'View')." ".$title."'><i class='fa fa-external-link'></i> ".vartrue($LAN['escursioni_adm_btn_view'], 'View')."</a>";
    }
}

new escursioni_adminArea();
require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();
require_once(e_ADMIN."footer.php");
exit;
