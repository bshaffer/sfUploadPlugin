<?php

/**
* 
*/
class sfValidatorFileMultiple extends sfValidatorBase
{
  // Options passed to sfValidatorFile
  // 
  // NOTE: We cannot just extend sfValidatorFile (as would be preferrable)
  //       due to magic in the Form Framework which specifically checks for
  //       the sfValidatorFile widget
  
  protected function configure($options = array(), $messages = array())
  {
    if (!ini_get('file_uploads'))
    {
      throw new LogicException(sprintf('Unable to use a file validator as "file_uploads" is disabled in your php.ini file (%s)', get_cfg_var('cfg_file_path')));
    }

    $this->addOption('max_size');
    $this->addOption('mime_types');
    $this->addOption('mime_type_guessers', array(
      array($this, 'guessFromFileinfo'),
      array($this, 'guessFromMimeContentType'),
      array($this, 'guessFromFileBinary'),
    ));
    $this->addOption('mime_categories', array(
      'web_images' => array(
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/x-png',
        'image/gif',
    )));
    $this->addOption('validated_file_class', 'sfValidatedFile');
    $this->addOption('path', null);

    $this->addMessage('max_size', 'File is too large (maximum is %max_size% bytes).');
    $this->addMessage('mime_types', 'Invalid mime type (%mime_type%).');
    $this->addMessage('partial', 'The uploaded file was only partially uploaded.');
    $this->addMessage('no_tmp_dir', 'Missing a temporary folder.');
    $this->addMessage('cant_write', 'Failed to write file to disk.');
    $this->addMessage('extension', 'File upload stopped by extension.');
  }
    
  public function doClean($value)
  {
    $clean = array();

    $fileVal = new sfValidatorFile((array) $this->options, (array) $this->messges);
    
    foreach ((array) $value as $key => $file) 
    {
      if($validatedFile = $fileVal->clean($file))
      {
        $validatedFile->save();
        $clean[$validatedFile->getOriginalName()] = basename($validatedFile->getSavedName());
      }
    }

    return $clean;
  }
}
