<?php
namespace RichTestani\HTML_Form;
use RichTestani\HTML_Form\Input;

/**
 * Description of Form Class
 * @package HTML_Form
 * @author richtestani
 * @version 0.5
 */
class Form  {
    
    protected $action;
    protected $method;
    protected $form;
    protected $input;
    
	/**
	* @param string $action this is where the form will be submitted to
	* @param string $method this is how the form will be submitted
	* @return void
	*/
    public function __construct($action , $method='post')
    {
        $this->action = $action;
        $this->method = $method;
        $this->input = null;
    }
    
	/**
	* @param string $id applies an id for this row
	* @return void
	*/
    public function insertRow($id)
    {
        $rowStart = '<div class="row form-row" id="'.$id.'">'."\n";
        $this->form[] = $rowStart;
    }
	/**
	* @param string $class applies a class for the div wrapper
	* @param string $id applies an id for this row
	* @return void
	*/
    public function insertDiv($id='', $class='')
    {
		$class = (!empty($class)) ? ' class="'.$class.'"' : '';
		$id = (!empty($id)) ? ' id="'.$id.'"' : '';
        $div = '<div'.$class.$id.'>';
        $this->form[] = $div;
    }
	
	public function insertHTML($html)
	{
		$this->form[] = $html;
	}
	
	public function endDiv()
	{
		$this->form[] = '</div>'."\n";
	}
    
    public function insertInput($type, $name, $value, $attributes=array(), $selectOption = array())
    {
        $this->input = new Input($type, $name, $value, $attributes, $selectOption);
        $this->form[] = $this->input;
    }
    
    public function endRow()
    {
        $this->form[] = '</div>';
    }
    
    public function insertInputFirst($type, $name, $attributes=array())
    {
        $this->input = new Input($type, $name, $attributes);
        array_unshift($this->form, $this->input);
    }
    
    public function insertBefore($element, $type, $name, $attributes)
    {
        
    }
    
    public function insertInputAfter($element, $name, $attribtues=array())
    {
        
    }
    
    public function insertInputLast($type, $name, $value='', $attributes = array())
    {
        $this->input = new Input($type, $name, $value,  $attributes);
        array_push($this->form, $this->input);
    }
    
    public function setLabel($label, $name)
    {
        array_push($this->form, $this->input->label($label, array('for'=>$name)));
    }
    
    public function get()
    {
		$this->insertDiv('page-buttons');
        $this->form[] = new Input('button', 'submit', 'Submit', array('class'=>'btn btn-primary'));
		$this->endDiv();
        $form = '<form action="'.$this->action.'" method="'.$this->method.'">';
        foreach($this->form as $input)
        {
            if(is_object($input))
            {
                $form .= $input->get();
            }
            else
            {
                $form .= $input;
            }
        }
        
        $form .= '</form>';
        return $form;
    }
    
}
