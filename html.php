<?php

if(!class_exists('HtmlTags')) {
    require_once(dirname(__FILE__) . "/HtmlTags.php");
}

/**
 * Class html
 *
 * @author          : İskender TOTOĞLU, @ukyo (community), @trk (Github)
 * @website         : http://altivebir.com
 * @projectWebsite  : https://github.com/trk/AvbMarkupHtml
 */
class html extends HtmlTags {

    /**
     * Creates a new instance
     *
     * @param MarkupHtml $MarkupHtml
     */
    public function __construct(MarkupHtml $MarkupHtml = null) {
        parent::__construct($MarkupHtml);
    }

    /**
     * Setup <tag>
     *
     * Self closed tag = "/>"
     * Don't close tag = "->"
     * Custom tag = "=>"
     *
     * @param null $tag
     * @param array $args
     * @return MarkupHtml
     */
    public static function tag($tag=null, $args=array()) {
        return self::getMarkupHtml()->tag($tag, $args);
    }

    /**
     * Set Quote type for tag-attributes
     *
     * @param string $quote
     * @return MarkupHtml
     */
    public static function setQuote($quote='"') {
        return self::getMarkupHtml()->setQuote($quote);
    }

    /**
     * Add multiple class='variables'
     *
     * @param string $class
     * @return MarkupHtml
     */
    public static function addClass($class="") {
        return self::getMarkupHtml()->addClass($class);
    }

    /**
     * Add id='' to tag
     *
     * @param string $id
     * @return MarkupHtml
     */
    public static function id($id="") {
        return self::getMarkupHtml()->id($id);
    }

    /**
     * Set <tag> attribute
     *
     * @param null $key
     * @param string $value
     * @return MarkupHtml
     */
    public static function attr($key=null, $value="") {
        return self::getMarkupHtml()->attr($key, $value);
    }

    /**
     * Set <tag> attributes
     *
     * @param array $attributes
     * @return MarkupHtml
     */
    public static function attributes($attributes=array()) {
        return self::getMarkupHtml()->attributes($attributes);
    }

    /**
     * Set <tag> data-attribute
     *
     * @param null $key
     * @param string $value
     * @return MarkupHtml
     */
    public static function data($key=null, $value="") {
        return self::getMarkupHtml()->data($key, $value);
    }

    /**
     * Set <tag> data-attributes
     *
     * @param array $dataAttributes
     * @return MarkupHtml
     */
    public static function dataAttributes($dataAttributes=array()) {
        return self::getMarkupHtml()->dataAttributes($dataAttributes);
    }

    /**
     * Add Prepend element
     *
     * @param string $prepend
     * @return MarkupHtml
     */
    public static function prepend($prepend='') {
        return self::getMarkupHtml()->prepend($prepend);
    }

    /**
     * Add Prepend Elements
     *
     * @param array $prepends
     * @return MarkupHtml
     */
    public static function prepends($prepends=array()) {
        return self::getMarkupHtml()->prepends($prepends);
    }

    /**
     * Set current wire('page') as $this->WirePage
     * or
     * Set given page as $this->WirePage
     * and
     * Return this page
     *
     * @param null $page
     * @return null|Page
     */
    public static function page($page=null) {
        return self::getMarkupHtml()->page($page);
    }

    /**
     * Get given field label value
     *
     * @param null $field
     * @return MarkupHtml
     */
    public static function fieldLabel($field=null) {
        return self::getMarkupHtml()->fieldLabel($field);
    }

    /**
     * Get given field label value
     *
     * @param null $field
     * @return MarkupHtml
     */
    public static function fieldDesc($field=null) {
        return self::getMarkupHtml()->fieldDesc($field);
    }

    /**
     * Get given field note value
     *
     * @param null $field
     * @return MarkupHtml
     */
    public static function fieldNote($field=null) {
        return self::getMarkupHtml()->fieldNote($field);
    }

    /**
     * Get give page field value
     *
     * @param null $field
     * @param null $page
     * @return MarkupHtml
     */
    public static function field($field=null, $page=null) {
        return self::getMarkupHtml()->field($field, $page);
    }

    /**
     * Get give page fields values
     *
     * @param array $fields
     * @param null $page
     * @return MarkupHtml
     */
    public static function fields($fields=array(), $page=null) {
        return self::getMarkupHtml()->fields($fields, $page);
    }

    /**
     * Set given text value
     *
     * @param null $text
     * @return MarkupHtml
     */
    public static function text($text=null) {
        return self::getMarkupHtml()->text($text);
    }

    /**
     * Set given texts values
     *
     * @param array $texts
     * @return MarkupHtml
     */
    public static function texts($texts=array()) {
        return self::getMarkupHtml()->texts($texts);
    }

    /**
     * Add Child Element
     *
     * @param string $child
     * @return MarkupHtml
     */
    public static function child($child='') {
        return self::getMarkupHtml()->child($child);
    }

    /**
     * Add Children Elements
     *
     * @param array $children
     * @return MarkupHtml
     */
    public static function children($children = array()) {
        return self::getMarkupHtml()->children($children);
    }

    /**
     * Add Append Element
     *
     * @param string $append
     * @return MarkupHtml
     */
    public static function append($append='') {
        return self::getMarkupHtml()->append($append);
    }

    /**
     * Add Appends Elements
     *
     * @param array $appends
     * @return MarkupHtml
     */
    public static function appends($appends=array()) {
        return self::getMarkupHtml()->appends($appends);
    }

    /**
     * Alias with $this->render();
     *
     * Render | return result
     *
     * @param bool|false $formatter
     * @return string
     */
    public static function r($formatter = false) {
        return self::getMarkupHtml()->render($formatter);
    }

    /**
     * Render | return result
     *
     * @param bool|false $formatter
     * @return string
     */
    public static function render($formatter = false) {
        return self::getMarkupHtml()->render($formatter);
    }

    /**
     * Alias with $this->output()
     *
     * Print Result
     *
     * @param bool|false $formatter
     * @return string
     */
    public static function o($formatter = false) {
        return self::getMarkupHtml()->output($formatter);
    }

    /**
     * Print Result
     *
     * @param bool|false $formatter
     * @return string
     */
    public static function output($formatter = false) {
        return self::getMarkupHtml()->output($formatter);
    }
}