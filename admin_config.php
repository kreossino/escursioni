<?php
// CODEX_MARKER_ESCURSIONI_ADMIN_2026_05_20_SELECTIONS_V2

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

class escursioni_adminArea extends e_admin_dispatcher
{
	protected $modes = array(	
		'main'	=> array(
			'controller' 	=> 'escursioni_ui',
			'path' 			=> null,
			'ui' 			=> 'escursioni_form_ui',
			'uipath' 		=> null
		),
	);	
	
	protected $adminMenu = array(
		'main/list'			=> array('caption'=> LAN_MANAGE, 'perm' => 'P'),
		'main/create'		=> array('caption'=> LAN_CREATE, 'perm' => 'P'),
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'escursioni';
}

class escursioni_ui extends e_admin_ui
{
		protected $pluginTitle		= 'escursioni';
		protected $pluginName		= 'escursioni';
		protected $table			= 'escursioni';
		protected $pid				= 'ex_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;
		protected $batchOptions		= array(
			'link_selezione' => 'Crea link selezione'
		);
		protected $listOrder		= 'ex_id DESC';
	
		protected $fields 		= array (
			'checkboxes'              => array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => 'value', 'class' => 'center', 'toggle' => 'e-multiselect', 'readParms' => [], 'writeParms' => [],),
			'ex_id'                   => array ( 'title' => LAN_ID, 'type' => 'number', 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_title'                => array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_link_frontend'        => array ( 'title' => 'Link Frontend', 'type' => 'method', 'data' => false, 'width' => 'auto', 'forced' => 'value', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_text'                 => array ( 'title' => 'Text', 'type' => 'bbarea', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_image1'               => array ( 'title' => 'Image1', 'type' => 'image', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => 'carica l\'immagine', 'readParms' => 'thumb=80x80', 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_image2'               => array ( 'title' => 'Image2', 'type' => 'image', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => 'thumb=80x80', 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_image3'               => array ( 'title' => 'Image3', 'type' => 'image', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => 'thumb=80x80', 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_image4'               => array ( 'title' => 'Image4', 'type' => 'image', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => 'thumb=80x80', 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_file'                 => array ( 'title' => 'File', 'type' => 'file', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => 'carica il file pdf', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_type'                 => array ( 'title' => 'Tipo', 'type' => 'dropdown', 'data' => 'safestr', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_duration'             => array ( 'title' => 'Duration', 'type' => 'dropdown', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left', 'filter' => false, 'batch' => false,),
			'ex_difficulty'           => array ( 'title' => 'Difficulty', 'type' => 'dropdown', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left', 'filter' => false, 'batch' => false,),
			'options'                 => array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => 'value', 'readParms' => [], 'writeParms' => [],),
		);		
		
		protected $fieldpref = array('ex_title', 'ex_type');

		protected $prefs = array(
			'tipo'        => array('title'=> 'Opzioni Tipo', 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'Inserisci i tipi separati da virgola (es: Trekking, Relax)'),
			'durata'      => array('title'=> 'Opzioni Durata', 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'Inserisci le durate separate da virgola (es: 1 Ora, 2 Ore)'),
			'difficoltà'  => array('title'=> 'Opzioni Difficoltà', 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'Inserisci le difficoltà separate da virgola'),
		);		
	
		public function init()
		{
			if(!e107::isInstalled('escursioni'))
			{
				e107::getMessage()->addWarning("This plugin is not yet installed. Saving and loading of preference or table data will fail.");
			}

			if(!empty($_POST['escursioni_save_selection']))
			{
				$this->handleSelectionFormSubmit();
			}

			if(!empty($_GET['escursioni_delete_selection']))
			{
				$this->handleSelectionDelete();
			}
			
			$pref = e107::getPlugPref('escursioni');
			
			$types_str = !empty($pref['tipo']) ? $pref['tipo'] : "Trekking, Enogastronomia, Culturale, Relax";
			$dur_str   = !empty($pref['durata']) ? $pref['durata'] : "1 Ora, 2 Ore, 4 Ore totali, Giornata intera";
			$diff_str  = !empty($pref['difficoltà']) ? $pref['difficoltà'] : "Facile (mt.100), Medio (mt.400), Difficile (mt.800)";

			$types_arr = explode(',', $types_str);
			$this->fields['ex_type']['writeParms']['optArray'] = array_combine(array_map('trim', $types_arr), array_map('trim', $types_arr)); 

			$dur_arr = explode(',', $dur_str);
			$this->fields['ex_duration']['writeParms']['optArray'] = array_combine(array_map('trim', $dur_arr), array_map('trim', $dur_arr)); 

			$diff_arr = explode(',', $diff_str);
			$this->fields['ex_difficulty']['writeParms']['optArray'] = array_combine(array_map('trim', $diff_arr), array_map('trim', $diff_arr)); 
			
			$this->viewURL = e107::url('escursioni', 'view', array('ex_id' => '--ID--', 'ex_title' => '--TITLE--'));
			$this->preFilterMarkup = $this->renderSelectionManager();
		}

		protected function escursioniSlug($text)
		{
			$text = html_entity_decode((string) $text, ENT_QUOTES, 'UTF-8');
			$text = preg_replace('/[^A-Za-z0-9]+/', '-', $text);
			$text = trim($text, '-');

			return strtolower($text);
		}

		protected function getSelectedFrontendUrl($slug)
		{
			return e107::url('escursioni', 'selezione', array('sel_slug' => $slug));
		}

		protected function getSelectedIds($selected)
		{
			$ids = array();

			foreach((array) $selected as $id)
			{
				$id = (int) $id;

				if($id > 0)
				{
					$ids[] = $id;
				}
			}

			$ids = array_unique($ids);

			return $ids;
		}

		protected function getBatchTitle($value)
		{
			if(is_array($value))
			{
				foreach($value as $item)
				{
					$item = trim((string) $item);

					if($item !== '')
					{
						return $item;
					}
				}

				return '';
			}

			return trim((string) $value);
		}

		protected function saveSelection($ids, $title)
		{
			$ids = $this->getSelectedIds($ids);
			$title = trim((string) $title);

			if(empty($ids))
			{
				e107::getMessage()->addWarning('Seleziona almeno una escursione.');
				return false;
			}

			if($title === '')
			{
				e107::getMessage()->addWarning('Inserisci un nome per il link della selezione.');
				return false;
			}

			$sql = e107::getDb();
			$tp = e107::getParser();
			$slug = $this->escursioniSlug($title);

			if($slug === '' || $slug === 'create')
			{
				e107::getMessage()->addWarning('Il nome scelto non e valido per creare un link SEF.');
				return false;
			}

			$data = array(
				'sel_slug'      => $tp->toDB($slug),
				'sel_title'     => $tp->toDB($title),
				'sel_ids'       => $tp->toDB(implode(',', $ids)),
				'sel_datestamp' => time()
			);

			if($exists = $sql->retrieve('escursioni_selezioni', 'sel_id', "WHERE sel_slug='".$tp->toDB($slug)."'"))
			{
				$ok = $sql->update('escursioni_selezioni', $data, "WHERE sel_id=".(int) $exists);
			}
			else
			{
				$ok = $sql->insert('escursioni_selezioni', $data);
			}

			if(!$ok)
			{
				e107::getMessage()->addError('Non riesco a salvare la selezione: '.$sql->getLastErrorText());
				return false;
			}

			return $slug;
		}

		protected function renderSelectionLink($slug)
		{
			$tp = e107::getParser();
			$url = $this->getSelectedFrontendUrl($slug);
			$safeUrl = $tp->toAttribute($url);

			$text = "<div class='form-group'>";
			$text .= "<label>Link SEF alla selezione</label>";
			$text .= "<div class='input-group'>";
			$text .= "<input type='text' class='form-control input-lg' value='".$safeUrl."' readonly onclick='this.select()' />";
			$text .= "<span class='input-group-btn'>";
			$text .= "<a class='btn btn-primary btn-lg' href='".$safeUrl."' target='_blank' rel='noopener'>Apri</a>";
			$text .= "</span>";
			$text .= "</div>";
			$text .= "</div>";

			e107::getMessage()->addInfo($text);
		}

		protected function renderSelectionNameForm($ids)
		{
			$ids = $this->getSelectedIds($ids);

			if(empty($ids))
			{
				e107::getMessage()->addWarning('Seleziona almeno una escursione.');
				return;
			}

			$tp = e107::getParser();
			$safeIds = $tp->toAttribute(implode(',', $ids));
			$action = $tp->toAttribute(e_SELF.'?'.e_QUERY);

			$text = "<form method='post' action='".$action."' class='form-horizontal'>";
			$text .= "<input type='hidden' name='escursioni_save_selection' value='1' />";
			$text .= "<input type='hidden' name='escursioni_selection_ids' value='".$safeIds."' />";
			$text .= "<div class='form-group'>";
			$text .= "<label class='col-sm-3 control-label'>Nome link SEF</label>";
			$text .= "<div class='col-sm-6'>";
			$text .= "<input type='text' name='escursioni_selection_title' class='form-control' placeholder='es. Weekend maggio' required />";
			$text .= "</div>";
			$text .= "<div class='col-sm-3'>";
			$text .= "<button type='submit' class='btn btn-primary'>Crea link</button>";
			$text .= "</div>";
			$text .= "</div>";
			$text .= "</form>";

			e107::getMessage()->addInfo($text);
		}

		protected function handleSelectionFormSubmit()
		{
			$ids = !empty($_POST['escursioni_selection_ids']) ? explode(',', $_POST['escursioni_selection_ids']) : array();
			$title = vartrue($_POST['escursioni_selection_title']);
			$slug = $this->saveSelection($ids, $title);

			if($slug)
			{
				$this->renderSelectionLink($slug);
			}
		}

		protected function handleSelectionDelete()
		{
			$id = (int) $_GET['escursioni_delete_selection'];

			if($id < 1)
			{
				return;
			}

			$token = vartrue($_GET['e-token']);

			if(empty($token) || $token !== defset('e_TOKEN'))
			{
				e107::getMessage()->addError('Token non valido: link selezione non eliminato.');
				return;
			}

			$sql = e107::getDb();

			if($sql->delete('escursioni_selezioni', 'sel_id='.(int) $id))
			{
				e107::getMessage()->addSuccess('Link selezione eliminato.');
			}
			else
			{
				e107::getMessage()->addError('Non riesco a eliminare il link selezione: '.$sql->getLastErrorText());
			}
		}

		protected function renderSelectionManager()
		{
			$sql = e107::getDb();
			$tp = e107::getParser();

			$text = "<div class='panel panel-default card mb-3'>";
			$text .= "<div class='panel-heading card-header'><strong>Link selezione creati</strong></div>";
			$text .= "<div class='panel-body card-body'>";

			$rows = $sql->retrieve('escursioni_selezioni', 'sel_id, sel_slug, sel_title, sel_ids, sel_datestamp', "sel_slug != '' ORDER BY sel_datestamp DESC, sel_title ASC", true);

			if(empty($rows))
			{
				$text .= "<p class='text-muted'>Nessun link selezione creato.</p>";
				$text .= "</div></div>";
				return $text;
			}

			$text .= "<div class='table-responsive overflow-auto border p-3' style='max-height:250px;'>";
			$text .= "<table class='table table-striped table-bordered'>";
			$text .= "<thead><tr>";
			$text .= "<th>Nome</th>";
			$text .= "<th>URL</th>";
			$text .= "<th class='text-center'>Records</th>";
			$text .= "<th>Creato</th>";
			$text .= "<th class='text-center'>Opzioni</th>";
			$text .= "</tr></thead><tbody>";

			foreach($rows as $row)
			{
				$id = (int) $row['sel_id'];
				$title = $tp->toHTML(vartrue($row['sel_title']), true, 'TITLE');
				$url = $this->getSelectedFrontendUrl($row['sel_slug']);
				$safeUrl = $tp->toAttribute($url);
				$count = count($this->getSelectedIds(explode(',', vartrue($row['sel_ids']))));
				$date = !empty($row['sel_datestamp']) ? date('Y-m-d H:i', (int) $row['sel_datestamp']) : '';
				$deleteUrl = e_SELF.'?mode=main&amp;action=list&amp;escursioni_delete_selection='.$id.'&amp;e-token='.defset('e_TOKEN');

				$text .= "<tr>";
				$text .= "<td>".$title."</td>";
				$text .= "<td><input type='text' class='form-control input-sm' value='".$safeUrl."' readonly onclick='this.select()' /></td>";
				$text .= "<td class='text-center'>".$count."</td>";
				$text .= "<td>".$tp->toHTML($date)."</td>";
				$text .= "<td class='text-center'>";
				$text .= "<a class='btn btn-xs btn-default btn-secondary' href='".$safeUrl."' target='_blank' rel='noopener'>Apri</a> ";
				$text .= "<a class='btn btn-xs btn-danger' href='".$deleteUrl."' onclick=\"return confirm('Eliminare questo link selezione?');\">Elimina</a>";
				$text .= "</td>";
				$text .= "</tr>";
			}

			$text .= "</tbody></table>";
			$text .= "</div></div></div>";

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

		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
		}

		public function onCreateError($new_data, $old_data)
		{
		}		
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
		}		
		
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = 'Some help text';
			return array('caption'=>$caption,'text'=> $text);
		}
}

class escursioni_form_ui extends e_admin_form_ui
{
	private function escursioniSlug($text)
	{
		$text = html_entity_decode((string) $text, ENT_QUOTES, 'UTF-8');
		$text = preg_replace('/[^A-Za-z0-9]+/', '-', $text);
		$text = trim($text, '-');

		return strtolower($text);
	}

	public function ex_link_frontend($curVal, $mode, $parm = null)
	{
		if(!in_array($mode, array('read', 'list'), true))
		{
			return '';
		}

		$controller = e107::getAdminUI()->getController();
		$model = (is_object($controller) && method_exists($controller, 'getListModel')) ? $controller->getListModel() : null;
		$row = (is_object($model) && method_exists($model, 'getData')) ? $model->getData() : array();

		if(empty($row['ex_id']))
		{
			return '';
		}

		$url = e107::url('escursioni', 'view', array(
			'ex_id'    => (int) $row['ex_id'],
			'ex_title' => $this->escursioniSlug(vartrue($row['ex_sef']) ?: vartrue($row['ex_title']))
		));

		$title = e107::getParser()->toAttribute(vartrue($row['ex_title']));

		return "<a class='btn btn-xs btn-primary' href='".$url."' target='_blank' rel='noopener' title='Apri ".$title."'><i class='fa fa-external-link'></i> Vedi sul sito</a>";
	}
}


		
new escursioni_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;
