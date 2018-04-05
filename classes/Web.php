<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

namespace Web;

class Web
{
    public function __construct() {
        require_once(THIRDPARTY_PATH . 'htmLawed/htmLawed.php');
    }

    /**
     * Load template file
     *
     * @param string $tplFile Template file to load
     * @return string Content of template file
     */
    public function tplLoad($tplFile) 
    {
        if ($fp = @fopen($tplFile, 'r'))
        {
            $tpl = fread($fp, filesize($tplFile));
            fclose ($fp);

        } else $tpl = "Error: Template not found ($tplFile)";

        return $tpl;
    }

    /**
     * Print template file
     *
     * @param string $tplContent Content of template file
     * @param array $array Array with keys and values to replace in template
     * @return string Template ready to display
     */
    public function tplPrint($tplContent, $array) 
    {   
        foreach($array as $key => $value)
        {
            $tplContent = str_replace('{' . $key . '}', $value, $tplContent);
        }
        return $tplContent;
    }

    /**
     * Quick and easy way to load a basic template file
     *
     * @param string $tplFile Template file to load 
     * @param array $array Array with keys and values to replace in template
     * @return string Template ready to display
     */
    public function tpl($tplFile, $array) 
    {   
        return $this->tplPrint($this->tplLoad($tplFile), $array);
    }

    /**
     * Sanitize input
     *
     * @param string $content String to sanitize
     * @return string Sanitized string
     */
    public function sanitize($content) 
    {
        $content = htmLawed(trim($content), ['safe' => 1, 'deny_attribute' => '*']);
        return trim($content);
    }

    /**
     * Convert input into slug
     *
     * @param string $content String to sanitize
     * @return string Slug
     */
    public function toSlug($content) 
    {
        $content = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $this->sanitize($content))))), '-'));
        return $content;
    }

    /**
     * Redirect to url
     *
     * @param string $url URL to redirect to
     */
    public function redirect($url) 
    {
        header('Location: ' . $url);
        header('Content-Length: 0'); 
        die();
    }

    /**
     * inString
     *
     * @param string $needle String find
     * @param string $haystack String to search in
     * @return bool Was $needle found in $haystack?
     */
    public function inString($needle, $haystack) { 
        if(!is_array($needle)) $needle = array($needle); 
        foreach($needle as $what) 
        { 
            if (($pos = strpos($haystack, $what)) !== false) return true;
        } 
        return false;
    } 

}