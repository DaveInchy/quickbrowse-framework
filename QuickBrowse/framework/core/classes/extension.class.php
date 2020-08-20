<?php
class Extension{

    private $QB;

    private $PLUGINS_ROOT = 'includes/plugins';
    private $PACKAGES_ROOT = 'framework/packages';
    private $PACKAGES_AUTOLOAD = 'installed/autoload.php';
    
    public function __construct(object $parent){
        
        // Pass QuickBrowse object as Parent.
        $this->QB = $parent;
        
        // Initialize test before initializing...
        isset($parent->ROOT) ? $parent->DEBUG->log("Loading Extentions Object parralel to QuickBrowse") && $result = true : $parent->DEBUG->error(__METHOD__ , "ERROR Loading Extentions Object...", E_USER_WARNING) && $result = false;
        
        // Init now
        $this->init() ? $parent->DEBUG->log("Loading Extention files like theme plugins and php packages...") && $result = true : $result = false;
        
        return $result;
    }
    
    private function init(){
        
        // Load $TEMPLATE_ROOT . '/includes/plugins' per directory.
        $this->QB->add_instance('PLUGINS_ROOT', $this->QB->TEMPLATE_ROOT . '/' . $this->PLUGINS_ROOT);
        $autoload = $this->plugins_autoload(glob($this->QB->PLUGINS_ROOT . '/*'));
        $result = $autoload ? $this->QB->DEBUG->log("Finished autoloading plugins...") && true : false;
        
        // Load Composer PHP Packages with composer autoload.php
        $this->QB->add_instance('PACKAGES_ROOT', $this->QB->ROOT . '/' . $this->PACKAGES_ROOT);
        $autoload = $this->packages_autoload($this->QB->PACKAGES_ROOT . '/' . $this->PACKAGES_AUTOLOAD);
        $result = $autoload ? $this->QB->DEBUG->log("Finished autoloading packages...") && true : false;
        
        return $result;
    }
    
    private function plugins_autoload(array $plugins = Array()){
        
        //load every quickbrowse plugins by loading plugins/example/plugin.php
        return false;
        
    }
    
    private function packages_autoload(string $autoloader = 'vendor/autoload.php'){
        
        //load composers autoload.php to include all installed packages.
        $result = file_exists($autoloader) ? require_once($autoloader) : false;
        return $result;
    
    }
    
}
?>
