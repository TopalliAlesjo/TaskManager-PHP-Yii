<?php
/**
 * CButtonColumn class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link https://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

Yii::import('zii.widgets.grid.CGridColumn');

/**
 * CButtonColumn represents a grid view column that renders one or several buttons.
 *
 * By default, it will display three buttons, "view", "update" and "delete", which triggers the corresponding
 * actions on the model of the row.
 *
 * By configuring {@link buttons} and {@link template} properties, the column can display other buttons
 * and customize the display order of the buttons.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package zii.widgets.grid
 * @since 1.1
 */
class CButtonColumn extends CGridColumn
{
	/**
	 * @var array the HTML options for the data cell tags.
	 */
	public $htmlOptions=array('class'=>'button-column');
	/**
	 * @var array the HTML options for the header cell tag.
	 */
	public $headerHtmlOptions=array('class'=>'button-column');
	/**
	 * @var array the HTML options for the footer cell tag.
	 */
	public $footerHtmlOptions=array('class'=>'button-column');
	/**
	 * @var string the template that is used to render the content in each data cell.
	 * These default tokens are recognized: {view}, {update} and {delete}. If the {@link buttons} property
	 * defines additional buttons, their IDs are also recognized here. For example, if a button named 'preview'
	 * is declared in {@link buttons}, we can use the token '{preview}' here to specify where to display the button.
	 */
	public $template='{view} {update} {delete}';
	
	/**
	 * @var string the base template that is used to render the content in each data cell.
	 * This will be extended with state-specific buttons.
	 */
	public $baseTemplate='{view} {update} {delete}';
	
	/**
	 * @var string the attribute name in the data model that represents the task state.
	 * This is used to determine which additional buttons to show.
	 */
	public $stateAttribute='status';
	
	/**
	 * @var array mapping of state values to additional buttons to display.
	 * Format: array('state_value' => 'additional_buttons_template')
	 * Example: array('To_Do' => '{inwork} {done}', 'Done' => '{todo} {inwork}')
	 */
	public $stateButtons=array();
	
	/**
	 * @var string the label for the view button. Defaults to "View".
	 * Note that the label will not be HTML-encoded when rendering.
	 */
	public $viewButtonLabel;
	/**
	 * @var string the image URL for the view button. If not set, an integrated image will be used.
	 * You may set this property to be false to render a text link instead.
	 */
	public $viewButtonImageUrl;
	/**
	 * @var string a PHP expression that is evaluated for every view button and whose result is used
	 * as the URL for the view button. In this expression, you can use the following variables:
	 * <ul>
	 *   <li><code>$row</code> the row number (zero-based).</li>
	 *   <li><code>$data</code> the value provided by grid view object for the row.</li>
	 *   <li><code>$this</code> the column object.</li>
	 * </ul>
	 * Type of the <code>$data</code> depends on {@link IDataProvider data provider} which is passed to the 
	 * {@link CGridView grid view object}. In case of {@link CActiveDataProvider}, <code>$data</code> will have
	 * object type and its values are accessed like <code>$data->property</code>. In case of 
	 * {@link CArrayDataProvider} or {@link CSqlDataProvider}, it will have array type and its values must be
	 * accessed like <code>$data['property']</code>.
	 *
	 * The PHP expression will be evaluated using {@link evaluateExpression}.
	 *
	 * A PHP expression can be any PHP code that has a value. To learn more about what an expression is,
	 * please refer to the {@link https://www.php.net/manual/en/language.expressions.php php manual}.
	 */
	public $viewButtonUrl='Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))';
	/**
	 * @var array the HTML options for the view button tag.
	 */
	public $viewButtonOptions=array('class'=>'view');

	/**
	 * @var string the label for the update button. Defaults to "Update".
	 * Note that the label will not be HTML-encoded when rendering.
	 */
	public $updateButtonLabel;
	/**
	 * @var string the image URL for the update button. If not set, an integrated image will be used.
	 * You may set this property to be false to render a text link instead.
	 */
	public $updateButtonImageUrl;
	/**
	 * @var string a PHP expression that is evaluated for every update button and whose result is used
	 * as the URL for the update button. In this expression, you can use the following variables:
	 * <ul>
	 *   <li><code>$row</code> the row number (zero-based).</li>
	 *   <li><code>$data</code> the value provided by grid view object for the row.</li>
	 *   <li><code>$this</code> the column object.</li>
	 * </ul>
	 * Type of the <code>$data</code> depends on {@link IDataProvider data provider} which is passed to the 
	 * {@link CGridView grid view object}. In case of {@link CActiveDataProvider}, <code>$data</code> will have
	 * object type and its values are accessed like <code>$data->property</code>. In case of 
	 * {@link CArrayDataProvider} or {@link CSqlDataProvider}, it will have array type and its values must be
	 * accessed like <code>$data['property']</code>.
	 *
	 * The PHP expression will be evaluated using {@link evaluateExpression}.
	 *
	 * A PHP expression can be any PHP code that has a value. To learn more about what an expression is,
	 * please refer to the {@link https://www.php.net/manual/en/language.expressions.php php manual}.
	 */
	public $updateButtonUrl='Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))';
	/**
	 * @var array the HTML options for the update button tag.
	 */
	public $updateButtonOptions=array('class'=>'update');

	/**
	 * @var string the label for the delete button. Defaults to "Delete".
	 * Note that the label will not be HTML-encoded when rendering.
	 */
	public $deleteButtonLabel;
	/**
	 * @var string the image URL for the delete button. If not set, an integrated image will be used.
	 * You may set this property to be false to render a text link instead.
	 */
	public $deleteButtonImageUrl;
	/**
	 * @var string a PHP expression that is evaluated for every delete button and whose result is used
	 * as the URL for the delete button. In this expression, you can use the following variables:
	 * <ul>
	 *   <li><code>$row</code> the row number (zero-based).</li>
	 *   <li><code>$data</code> the value provided by grid view object for the row.</li>
	 *   <li><code>$this</code> the column object.</li>
	 * </ul>
	 * Type of the <code>$data</code> depends on {@link IDataProvider data provider} which is passed to the 
	 * {@link CGridView grid view object}. In case of {@link CActiveDataProvider}, <code>$data</code> will have
	 * object type and its values are accessed like <code>$data->property</code>. In case of 
	 * {@link CArrayDataProvider} or {@link CSqlDataProvider}, it will have array type and its values must be
	 * accessed like <code>$data['property']</code>.
	 *
	 * The PHP expression will be evaluated using {@link evaluateExpression}.
	 *
	 * A PHP expression can be any PHP code that has a value. To learn more about what an expression is,
	 * please refer to the {@link https://www.php.net/manual/en/language.expressions.php php manual}.
	 */
	public $deleteButtonUrl='Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))';
	/**
	 * @var array the HTML options for the delete button tag.
	 */
	public $deleteButtonOptions=array('class'=>'delete');
	/**
	 * @var string the confirmation message to be displayed when delete button is clicked.
	 * By setting this property to be false, no confirmation message will be displayed.
	 * This property is used only if <code>$this->buttons['delete']['click']</code> is not set.
	 */
	public $deleteConfirmation;
	/**
	 * @var string a javascript function that will be invoked after the delete ajax call.
	 * This property is used only if <code>$this->buttons['delete']['click']</code> is not set.
	 *
	 * The function signature is <code>function(link, success, data)</code>
	 * <ul>
	 * <li><code>link</code> references the delete link.</li>
	 * <li><code>success</code> status of the ajax call, true if the ajax call was successful, false if the ajax call failed.
	 * <li><code>data</code> the data returned by the server in case of a successful call or XHR object in case of error.
	 * </ul>
	 * Note that if success is true it does not mean that the delete was successful, it only means that the ajax call was successful.
	 *
	 * Example:
	 * <pre>
	 *  array(
	 *     class'=>'CButtonColumn',
	 *     'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfully"); }',
	 *  ),
	 * </pre>
	 */
	public $afterDelete;
	/**
	 * @var array the configuration for buttons. Each array element specifies a single button
	 * which has the following format:
	 * <pre>
	 * 'buttonID' => array(
	 *     'label'=>'...',     // text label of the button
	 *     'url'=>'...',       // a PHP expression for generating the URL of the button
	 *     'imageUrl'=>'...',  // image URL of the button. If not set or false, a text link is used
	 *     'options'=>array(...), // HTML options for the button tag
	 *     'click'=>'...',     // a JS function to be invoked when the button is clicked
	 *     'visible'=>'...',   // a PHP expression for determining whether the button is visible
	 * )
	 * </pre>
	 *
	 * In the PHP expression for the 'url' option and/or 'visible' option, the variable <code>$row</code>
	 * refers to the current row number (zero-based), and <code>$data</code> refers to the data model for
	 * the row.
	 * The PHP expression will be evaluated using {@link evaluateExpression}.
	 * A PHP expression can be any PHP code that has a value. To learn more about what an expression is,
	 * please refer to the {@link https://www.php.net/manual/en/language.expressions.php php manual}.
	 *
	 * If the 'buttonID' is 'view', 'update' or 'delete' the options will be applied to the default buttons.
	 *
	 * Note that in order to display non-default buttons, the {@link template} property needs to
	 * be configured so that the corresponding button IDs appear as tokens in the template.
	 */
	
	public $buttons=array();

	/**
	 * Initializes the column.
	 * This method registers necessary client script for the button column.
	 */
	public function init()
	{
		$this->initDefaultButtons();

		// Assicurati che il baseTemplate sia impostato se non è stato definito
		if($this->baseTemplate === null) {
			$this->baseTemplate = $this->template;
		}

		// Aggiungi tutti i bottoni personalizzati al template per l'inizializzazione
		if(!empty($this->stateButtons)) {
			foreach($this->stateButtons as $state => $stateTemplate) {
				$this->template .= ' ' . $stateTemplate;
			}
		}

		foreach($this->buttons as $id=>$button)
		{
			if(strpos($this->template,'{'.$id.'}')===false)
				unset($this->buttons[$id]);
			elseif(isset($button['click']))
			{
				if(!isset($button['options']['class']))
					$this->buttons[$id]['options']['class']=$id;
				if(!($button['click'] instanceof CJavaScriptExpression))
					$this->buttons[$id]['click']=new CJavaScriptExpression($button['click']);
			}
		}

		$this->registerClientScript();
	}

	/**
	 * Initializes the default buttons (view, update and delete).
	 */
	protected function initDefaultButtons()
	{
		if($this->viewButtonLabel===null)
			$this->viewButtonLabel='<i class="fa fa-eye"></i>';
		if($this->updateButtonLabel===null)
			$this->updateButtonLabel='<i class="fa fa-pen"></i>';
		if($this->deleteButtonLabel===null)
			$this->deleteButtonLabel='<i class="fa fa-trash"></i>';

		// Disabilita le immagini di default
		$this->viewButtonImageUrl = false;
		$this->updateButtonImageUrl = false;
		$this->deleteButtonImageUrl = false;

		if($this->deleteConfirmation===null)
			$this->deleteConfirmation='Sei sicuro di voler eliminare questa task?';

		foreach(array('view','update','delete') as $id)
		{
			$button=array(
				'label'=>$this->{$id.'ButtonLabel'},
				'url'=>$this->{$id.'ButtonUrl'},
				'imageUrl'=>false,
				'options'=>$this->{$id.'ButtonOptions'},
			);
			if(isset($this->buttons[$id]))
				$this->buttons[$id]=array_merge($button,$this->buttons[$id]);
			else
				$this->buttons[$id]=$button;
		}

		if(!isset($this->buttons['delete']['click']))
		{
			if(is_string($this->deleteConfirmation))
				$confirmation="if(!confirm(".CJavaScript::encode($this->deleteConfirmation).")) return false;";
			else
				$confirmation='';

			if(Yii::app()->request->enableCsrfValidation)
			{
				$csrfTokenName = Yii::app()->request->csrfTokenName;
				$csrfToken = Yii::app()->request->csrfToken;
				$csrf = "\n\t\tdata:{ '$csrfTokenName':'$csrfToken' },";
			}
			else
				$csrf = '';

			if($this->afterDelete===null)
				$this->afterDelete='function(){}';

			$this->buttons['delete']['click']=<<<EOD
function() {
	$confirmation
	var th = this,
		afterDelete = $this->afterDelete;
	jQuery('#{$this->grid->id}').yiiGridView('update', {
		type: 'POST',
		url: jQuery(this).attr('href'),$csrf
		success: function(data) {
			jQuery('#{$this->grid->id}').yiiGridView('update');
			afterDelete(th, true, data);
		},
		error: function(XHR) {
			return afterDelete(th, false, XHR);
		}
	});
	return false;
}
EOD;
		}
	}

	/**
	 * Registers the client scripts for the button column.
	 */
	protected function registerClientScript()
	{
		$js=array();
		foreach($this->buttons as $id=>$button)
		{
			if(isset($button['click']))
			{
				$function=CJavaScript::encode($button['click']);
				$class=preg_replace('/\s+/','.',$button['options']['class']);
				$js[]="jQuery(document).on('click','#{$this->grid->id} a.{$class}',$function);";
			}
		}

		if($js!==array())
			Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$this->id, implode("\n",$js));
	}

	/**
	 * Returns the data cell content.
	 * This method renders the view, update and delete buttons in the data cell.
	 * @param integer $row the row number (zero-based)
	 * @return string the data cell content.
	 * @since 1.1.16
	 */
	public function getDataCellContent($row)
	{
		$data=$this->grid->dataProvider->data[$row];
		
		// Determina il template in base allo stato della task
		$this->determineTemplate($data);
		
		$tr=array();
		ob_start();
		foreach($this->buttons as $id=>$button)
		{
			$this->renderButton($id,$button,$row,$data);
			$tr['{'.$id.'}']=ob_get_contents();
			ob_clean();
		}
		ob_end_clean();
		return strtr($this->template,$tr);
	}
	
	/**
	 * Determina il template da utilizzare in base allo stato della task
	 * @param mixed $data il modello dati della riga corrente
	 */
	protected function determineTemplate($data)
	{
		// Inizia con il template base
		$this->template = $this->baseTemplate;
		
		// Se non ci sono stateButtons definiti, usa solo il template base
		if(empty($this->stateButtons)){
			return;
		}
		// Ottieni lo stato corrente della task
		$state = null;
		if(is_object($data) && isset($data->{$this->stateAttribute}))
			$state = $data->{$this->stateAttribute};
		elseif(is_array($data) && isset($data[$this->stateAttribute]))
			$state = $data[$this->stateAttribute];
		
		// Se lo stato è valido e abbiamo bottoni definiti per questo stato, aggiungi i bottoni al template
		if($state !== null && isset($this->stateButtons[$state])) {
			$this->template .= ' ' . $this->stateButtons[$state];
		}
	}

	/**
	 * Renders a link button.
	 * @param string $id the ID of the button
	 * @param array $button the button configuration which may contain 'label', 'url', 'imageUrl' and 'options' elements.
	 * See {@link buttons} for more details.
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data object associated with the row
	 */
	protected function renderButton($id,$button,$row,$data)
	{
		if (isset($button['visible']) && !$this->evaluateExpression($button['visible'],array('row'=>$row,'data'=>$data)))
			return;
		$label=isset($button['label']) ? $button['label'] : $id;
		$url=isset($button['url']) ? $this->evaluateExpression($button['url'],array('data'=>$data,'row'=>$row)) : '#';
		$options=isset($button['options']) ? $button['options'] : array();

		// IMPOSTA IL TITLE SOLO SE NON ESISTE, E NON USARE IL LABEL HTML
		if(!isset($options['title'])) {
			// Titolo descrittivo per ogni bottone
			if($id === 'view') $options['title'] = 'Visualizza';
			elseif($id === 'update') $options['title'] = 'Modifica';
			elseif($id === 'delete') $options['title'] = 'Elimina';
			else $options['title'] = ucfirst($id);
		}

		if(isset($button['imageUrl']) && is_string($button['imageUrl']))
			echo CHtml::link(CHtml::image($button['imageUrl'],$label),$url,$options);
		else
			echo CHtml::link($label,$url,$options);
	}
}
