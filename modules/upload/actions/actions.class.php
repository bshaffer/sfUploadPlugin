<?php

/**
* 
*/
class uploadActions extends sfActions
{
  public function executeJavascript(sfWebRequest $request)
  {
    return $this->renderPartial('upload/upload');
  }
}
