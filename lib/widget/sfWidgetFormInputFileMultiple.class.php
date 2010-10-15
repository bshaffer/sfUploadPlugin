<?php

/**
* 
*/
class sfWidgetFormInputFileMultiple extends sfWidgetFormInputFile
{
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $widget     = new sfWidgetFormInputFile($this->options, $this->attributes);
    $prototype  = $widget->render($name.'[]', null, array_merge(array('disabled' => true), $attributes));
    
    $html       = $this->renderContentTag('div', $prototype, array('class' => 'prototype', 'style' => 'display:none'));
    
    foreach ((array) $value as $key => $uploadValue) 
    {
      if (is_int($key)) // This means the file has already been uploaded
      {
        $html  .= $this->renderFileWidget($name, $uploadValue, $attributes, $errors);
      }
      else
      {
        // Hide upload field
        $widget   = new sfWidgetFormInputHidden();
        $checkbox = new sfWidgetFormInputCheckbox();
        $inner    = $widget->render(sprintf('%s[%s]', $name, $key), $uploadValue);
        $checkbox = $checkbox->render(sprintf('%s[remove][%s]', $name, $key), null, array('class' => 'checkbox')) . $this->renderContentTag('label', 'Remove '.$this->renderContentTag('span', $key));
        $html  .= $this->renderContentTag('div', $inner. $checkbox, array('class' => 'upload'));
      }
    }

    $html      .= $this->renderFileWidget($name, null, $attributes, $errors);
    
    return $html;
  }
  
  protected function renderFileWidget($name, $uploadValue, $attributes, $errors)
  {
    $widget = new sfWidgetFormInputFile($this->options, $this->attributes);
    $inner  = $widget->render($name.'[]', $uploadValue, $attributes, $errors);
    return $this->renderContentTag('div', $inner, array('class' => 'upload'));
  }
}