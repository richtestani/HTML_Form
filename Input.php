<?php
namespace RichTestani\HTML_Form;

/**
 * Description of Input Class
 * @package HTML_Form
 * @author richtestani
 * @version 0.5
 */
class Input {
    
    protected $type;
    protected $name;
    protected $value;
    protected $attributes;
    protected $input;
    protected $label;
    
    public function __construct($type, $name, $value, $attributes=array(), $list=array())
    {
		
        $this->attributes = '';
        if(!empty($attributes) && is_array($attributes))
        {
            foreach($attributes as $n => $v)
            {
                if(empty($v))
                {
                    $this->attributes .= $n.' ';
                }
                else
                {
                    $this->attributes .= $n.'="'.$v.'" ';
                }
                
            }
        }

        if(method_exists($this, $type))
        {
            $this->$type($name, $value, $this->attributes, $list);
        }
        
        
        
    }
    
    public function label($label, $value='', $attributes = '')
    {
        $this->label = '<label '.$attributes.'>'.$label.'</label>';
    }
    
    private function text($name, $value, $attributes)
    {
        $this->input = '<input type="text" name="'.$name.'" value="'.$value.'" '.$attributes.' />';
    }
    
    private function checkbox()
    {
        
    }
    
    private function hidden($name, $value, $attributes='')
    {
        $this->input = '<input type="hidden" name="'.$name.'" value="'.$value.'" '.$attributes.' />';
    }
    
    private function radio($name, $value, $attributes, $list)
    {
        $radios = '';
        foreach($list as $k => $v)
        {
            $radios .= '<input type="radio" name="'.$name.'" value="'.$v.'" '.$attributes;
            $radios .= ' />'.$k.'<br>';
        }
        
        $this->input = $radios;
    }
    
    private function file($name, $value='', $attributes='')
    {
        $file = '<input type="file" '.$attributes.' />';
        $this->input = $file;
    }
    
    private function select($name, $value, $attributes, $options)
    {
       $select = '<select name="'.$name.'" '.$attributes.'>';
        foreach($options as $k => $v)
        {
            $select .= '<option value="'.$v['value'].'"';

            if($v['value'] == $value)
            {
                $select .= ' selected="selected"';
            }
            $select .= '>'.$v['name'].'</option>';
        }
        
        $select .= '</select>';
        
        $this->input = $select;
    }
    
    private function button($name, $value, $attributes='')
    {
        $this->input = '<button id="'.$name.'" role="'.$value.'" '.$attributes.'">'.$value.'</button>';
    }
    
    private function textarea($name, $value, $attributes)
    {
        $this->input = '<textarea name="'.$name.'" '.$attributes.' />'.$value.'</textarea>';
    }
    
    public function get()
    {
        return $this->label.$this->input;
    }
}
