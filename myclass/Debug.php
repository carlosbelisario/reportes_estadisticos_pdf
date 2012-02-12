<?php
namespace myclass\debug;
/**
 * Class for the debug of code
 *
 * @author carlos
 */
class Debug 
{
    /**
     * @method dump show the dump of $var 
     * @param mixe $var 
     */
    public static function dump($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }            
}
?>