<?php

use Bramus\Router\Router;

/**
 * @class Router
 * @package Core
 * @note Router class for manage routing of the web page
 */
class GDRCDRouter
{
    /**
     * Init vars PUBLIC STATIC
     * @var Router $_instance ;
     */
    public static
        $_instance;

    /**
     * @fn getInstance
     * @note Self Instance
     * @return GDRCDRouter class
     */
    public static final function getInstance(): GDRCDRouter
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @return bool
     */
    public static final function is_ajax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    /**
     * @fn startClasses
     * @note Start loader for dynamic integrations of the classes
     * @return void
     */
    public static final function startClasses()
    {
        spl_autoload_register([GDRCDRouter::getInstance(), 'loadController']);
    }

    /**
     * @fn loadController
     * @note Load called class
     * @param string $className
     * @return void
     * @throws Exception
     */
    private final function loadController(string $className)
    {
        $path = ROOT.'/classes' ;
        $roots = $this->dirList($path);

        $exist = false;

        foreach ($roots as $folder) {

            $new_path = $folder.'/'.$className.'.class.php';

            if (file_exists($new_path) && is_readable($new_path)) {
                require_once($new_path);
                $exist = true;
                break;
            }
        }

        if(!$exist){
            throw new Exception(
                "Class '$className' not exists.'");
        }

    }

    private final function dirList($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if(is_dir($path) && ($value != ".") && ($value != "..")) {
                $results[] = $path;
                $this->dirList($path, $results);
            }
        }

        return $results;
    }

    public function startRouting(){

        $router = new Router();

        $paths = DB::query("SELECT * FROM paths WHERE 1",'result');

        foreach ($paths as $path){
            $root = Filters::out($path['path']);
            $type = Filters::out($path['type']);
            $function = Filters::out($path['function']);
            $router->{$type}($root,$function);
        }

        $router->run();
    }

    function listFolders($dir)
    {
        $dh = scandir($dir);
        $return = array();

        foreach ($dh as $folder) {
            if ($folder != '.' && $folder != '..') {
                if (is_dir($dir . '/' . $folder)) {
                    $return[] = array($folder => $this->listFolders($dir . '/' . $folder));
                } else {
                    $return[] = $folder;
                }
            }
        }
        return $return;
    }
}
