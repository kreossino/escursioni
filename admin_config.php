<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('escursioni',true);


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

		// 'main/div0'      => array('divider'=> true),
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P'),
		
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
	//	protected $eventName		= 'escursioni-escursioni'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'escursioni';
		protected $pid				= 'ex_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('tab1'=>'Tab 1', 'tab2'=>'Tab 2'); // Use 'tab'=>'tab1'  OR 'tab'=>'tab2' in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'ex_id DESC';
	
		protected $fields 		= array (
			'checkboxes'              => array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => 'value', 'class' => 'center', 'toggle' => 'e-multiselect', 'readParms' => [], 'writeParms' => [],),
			'ex_id'                   => array ( 'title' => LAN_ID, 'type' => 'number', 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
			'ex_title'                => array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
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
	
	//	protected $filterSort = ['field_key_5', 'field_key_7']; // Display these fields first in the filter drop-down. 
	
	//	protected $batchSort = ['field_key_5', 'field_key_7'];; // Display these fields first in the batch drop-down.
	

	//	protected $preftabs        = array('General', 'Other' );
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
        
        // Recupera le preferenze salvate dinamicamente dal pannello
        $pref = e107::getPlugPref('escursioni');
        
        // Se la preferenza è scritta usa quella, altrimenti usa i valori di default
        $types_str = !empty($pref['tipo']) ? $pref['tipo'] : "Trekking, Enogastronomia, Culturale, Relax";
        $dur_str   = !empty($pref['durata']) ? $pref['durata'] : "1 Ora, 2 Ore, 4 Ore totali, Giornata intera";
        $diff_str  = !empty($pref['difficoltà']) ? $pref['difficoltà'] : "Facile (mt.100), Medio (mt.400), Difficile (mt.800)";

        // Trasforma le stringhe in array per i dropdown
        $types_arr = explode(',', $types_str);
        $this->fields['ex_type']['writeParms']['optArray'] = array_combine(array_map('trim', $types_arr), array_map('trim', $types_arr)); 

        $dur_arr = explode(',', $dur_str);
        $this->fields['ex_duration']['writeParms']['optArray'] = array_combine(array_map('trim', $dur_arr), array_map('trim', $dur_arr)); 

        $diff_arr = explode(',', $diff_str);
        $this->fields['ex_difficulty']['writeParms']['optArray'] = array_combine(array_map('trim', $diff_arr), array_map('trim', $diff_arr)); 
    }


		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
		// left-panel help menu area. (replaces e_help.php used in old plugins)
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = 'Some help text';

			return array('caption'=>$caption,'text'=> $text);

		}
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			if($this->getPosted('custom-submit')) // after form is submitted. 
			{
				e107::getMessage()->addSuccess('Changes made: '. $this->getPosted('example'));
			}

			$this->addTitle('My Custom Title');


			$frm = $this->getUI();
			$text = $frm->open('my-form', 'post');

				$tab1 = "<table class='table table-bordered adminform'>
					<colgroup>
						<col class='col-label'>
						<col class='col-control'>
					</colgroup>
					<tr>
						<td>Label ".$frm->help('A help tip')."</td>
						<td>".$frm->text('example', $this->getPosted('example'), 80, ['size'=>'xlarge'])."</td>
					</tr>
					</table>";

			// Display Tab
			$text .= $frm->tabs([
				'general'   => ['caption'=>LAN_GENERAL, 'text' => $tab1],
			]);

			$text .= "<div class='buttons-bar text-center'>".$frm->button('custom-submit', 'submit', 'submit', LAN_CREATE)."</div>";
			$text .= $frm->close();

			return $text;
			
		}
			
		
		
	*/
			
}
				


class escursioni_form_ui extends e_admin_form_ui
{

}		
		
		
new escursioni_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

