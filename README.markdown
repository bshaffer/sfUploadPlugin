sfUploadPlugin
==============

Add multiple uploads to your models using this plugin's widgets and validators

Installation
------------

### With git

    git submodule add git://github.com/bshaffer/sfUploadsPlugin.git plugins/sfUploadsPlugin
    git submodule init
    git submodule update

### With subversion

    svn propedit svn:externals plugins

In the editor that's displayed, add the following entry and then save

    sfUploadsPlugin https://svn.github.com/bshaffer/sfUploadsPlugin.git

Finally, update:

    svn up

# Setup

In your `config/ProjectConfiguration.class.php` file, make sure you have
the plugin enabled.

    $this->enablePlugins('sfUploadsPlugin');
    
Publish your assets

    ./symfony plugin:publish-assets

Clear your cache

    ./symfony cc

# Usage

This plugin is very simple, and provides two very useful classes for attaching multiple files to an object

* sfWidgetFormInputFileMultiple
* sfValidatorFileMultiple

In order to use these classes, you must have a field of type `array` on your model.  This should be done in `config/doctrine/schema.yml`.
**Note**: this field type is only available with _doctrine_ objects.  Read more on array field types [here](http://www.doctrine-project.org/documentation/manual/1_0/en/defining-models:columns:data-types#array)

    MyModelForm:
      columns:
        uploads:
          type:     array
          default:  null
          
Set the widget and validator to `sfWidgetFormInputFileMultiple` and `sfValidatorFileMultiple` in your model's form class

    class MyModelForm extends BaseMyModelForm
    {
      public function configure()
      {
        $this->setWidget('uploads', new sfWidgetFormInputFileMultiple());
        $this->setValidator('uploads', new sfValidatorFileMultiple());
      }
    }
    
# sfWidgetFormInputFileMultiple

This class extends sfWidgetFormInputFile and has the following additional options:

 * **max** - the max number of uploads allowed on the object.  Set to null if there is no maximum
 * **disable_js** - enable this to use the plugin without javascript enabled.
 
# sfValidatorFileMultiple

This class extends sfValidatorFile and has the following additional options:

 * **max** - the max number of uploads allowed on the object.  Displays the _max_ error message if it fails
 