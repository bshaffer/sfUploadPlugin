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
    
    if (!$value) 
    {
      $value = array(0 => null); // Always have at least one
    }
    
    foreach ((array) $value as $uploadKey => $uploadValue) 
    {
      $widget = new sfWidgetFormInputFile($this->options, $this->attributes);
      $inner  = $widget->render($name.'[]', $uploadValue, $attributes, $errors);
      $html .= $this->renderContentTag('div', $inner, array('class' => 'upload'));
    }
    
    return $html;
  }
}