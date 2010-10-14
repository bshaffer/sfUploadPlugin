sfUploadPlugin
==============

Add multiple uploads to your models

This plugin is very simple, and is really only useful for the widget and validator it provides

* sfWidgetFormInputFileMultiple
* sfValidatorFileMultiple

Set these widgets to a field of type "array" in your model.  Note this only works with _doctrine_ objects.

    # schema.yml
    MyObject:
      columns:
        uploads:
          type:     array
          default:  null
          
In your form class:

    class MyObjectForm extends BaseMyObjectForm
    {
      public function configure()
      {
        $this->setWidget('uploads', new sfWidgetFormInputFileMultiple());
        $this->setValidator('uploads', new sfValidatorFileMultiple());
      }
    }
    
It should be noted that the widget and the validator have no specific options, but pass the 
options for sfWidgetFormInputFile and sfValidatorFile to the array of validators.