<?php
include_once 'simplehtmldom/simple_html_dom.php';
/**
 * 用于主题的部分修改
 * 
 * @package jthack
 * @author 教主
 * @version 1.0.0
 * @link https://jiaozhu.net
 */
class JPlugin_Plugin implements Typecho_Plugin_Interface {

    public static function activate() {
        Typecho_Plugin::factory('Widget_Archive')-> singleHandle = array('JPlugin_Plugin', 'hack');
    }
    public function hack($archive, $select){
        $html = str_get_html($archive->content);
        foreach($html->find('img') as $element){
            $src = $element->src;
            $alt = $element->alt;
            $element->outertext = '<p class="with-img"><img src='.$src.' alt="'.$alt.'" title="'.$alt.'"/></p>';
            //$element->outertext = '<p class="with-img">'.$element->outertext.'</p>'
        }
        foreach($html->find('a') as $element){
            $element->target="_blank";
        }
        $archive->content = $html;
    }
    public static function deactivate(){}

    public static function config(Typecho_Widget_Helper_Form $form) {}

    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    public static function render() {}
}
