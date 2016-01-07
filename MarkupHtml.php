<?php

if(!class_exists('html')) {
    require_once(dirname(__FILE__) . "/html.php");
}

/**
 * Class MarkupHtml
 *
 * @author          : İskender TOTOĞLU, @ukyo (community), @trk (Github)
 * @website         : http://altivebir.com
 * @projectWebsite  : https://github.com/trk/AvbMarkupHtml
 */
class MarkupHtml {

    protected $quote = '"';
    protected $indent_with = '    ';
    protected $tags_without_indentation = 'html,link,img,meta,head';
    protected $WirePage = null;
    protected $tag = null;
    protected $tagSelfClosed = false;
    protected $tagNoClose = false;
    protected $tagCustom = false;
    protected $tagStart = null;
    protected $tagEnd = null;
    protected $prepend = '';
    protected $prepends = '';
    protected $classes = array();
    protected $id = "";
    protected $attributes = array();
    protected $dataAttributes = array();
    protected $label = '';
    protected $note = '';
    protected $text = '';
    protected $texts = array();
    protected $hasTexts = false;
    protected $field = '';
    protected $field_value = '';
    protected $fields = array();
    protected $hasFields = false;
    protected $child = '';
    protected $children = '';
    protected $append = '';
    protected $appends = '';

    /**
     * Config
     *
     * @var array
     */
    public $config = array(
        'quote' => '"',
        'indent_with' => '    ',
        'tags_without_indentation' => 'html,link,img,meta',
        'WirePage' => null,
        'tag' => null,
        'tagSelfClosed' => false,
        'tagNoClose' => false,
        'tagCustom' => false,
        'tagStart' => '',
        'tagEnd' => '',
        'prepend' => '',
        'prepends' => '',
        'attributes' => '',
        'dataAttributes' => '',
        'label' => '',
        'note' => '',
        'text' => '',
        'texts' => array(),
        'hasTexts' => false,
        'field' => '',
        'field_value' => '',
        'fields' => array(),
        'hasFields' => false,
        'child' => '',
        'children' => '',
        'append' => '',
        'appends' => ''
    );

    /**
     * @param array $config
     */
    public function __construct(array $config = array()) {
        // Set Custom Configs
        $this->configure($config);
    }

    public function __call($tag, $args=array()) {
        return $this->tag($tag, $args);
    }

    /**
     * Overrides configuration settings
     *
     * @param array $config
     * @return $this
     */
    public function configure(array $config = array()) {
        foreach($this->config as $key => $value) {
            if(array_key_exists($key, $config)) $value = $config[$key];
            $this->$key = $value;
        }
        return $this;
    }

    /**
     * Reset All Configs
     *
     * @return $this
     */
    public function reset() {
        foreach($this->config as $key => $value) $this->$key = $value;
        return;
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
     * @return $this
     */
    public function tag($tag=null, $args=array()) {
        if(!is_null($tag) && $tag != "") {
            if(isset($args[0]) && is_string($args[0])) {
                $this->text = $args[0];
            }
            if(isset($args[1]) && is_string($args[1])) {
                if($args[1] == "/>") $this->tagSelfClosed = true;
                if($args[1] == "->") $this->tagNoClose = true;
                if($args[1] == "=>") {
                    if(strpos($tag, ',') !== false) {
                        $tags = explode(",", $tag);
                        if(isset($tags[0]) && is_string($tags[0])) $this->tagStart = $tags[0];
                        if(isset($tags[1]) && is_string($tags[1])) $this->tagEnd = $tags[1];
                    } else {
                        $this->tagStart = $tag;
                    }
                    $this->tagCustom = true;
                }
            }

            $this->tag = $tag;
        }
        return $this;
    }

    /**
     * Set Quote type for tag-attributes
     *
     * @param string $quote
     * @return $this
     */
    public function setQuote($quote='"') {
        $this->quote = $quote;
        return $this;
    }

    /**
     * Add multiple class='' variables
     *
     * @param string $class
     * @return $this
     */
    public function addClass($class="") {
        if(is_string($class) && $class != "") $this->classes[] = $class;
        return $this;
    }

    /**
     * Add id='' to tag
     *
     * @param string $id
     * @return $this
     */
    public function id($id="") {
        if(is_string($id) && $id != "") $this->id = $id;
        return $this;
    }

    /**
     * Set <tag> attribute
     *
     * @param null $key
     * @param string $value
     * @return $this
     */
    public function attr($key=null, $value="") {
        if(!is_null($key) && is_string($key)) $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * Set <tag> attributes
     *
     * @param array $attributes
     * @return $this
     */
    public function attributes($attributes=array()) {
        if(!empty($attributes)) $this->attributes = array_merge($this->attributes, $attributes);
        return $this;
    }

    /**
     *  Set <tag> data-attribute
     *
     * @param null $key
     * @param string $value
     * @return $this
     */
    public function data($key=null, $value="") {
        if(!is_null($key) && is_string($key)) $this->dataAttributes[$key] = $value;
        return $this;
    }

    /**
     * Set <tag> data-attributes
     *
     * @param array $dataAttributes
     * @return $this
     */
    public function dataAttributes($dataAttributes=array()) {
        if(!empty($dataAttributes)) $this->dataAttributes = array_merge($this->dataAttributes, $dataAttributes);
        return $this;
    }

    /**
     * Generate attributes and data-attributes as string
     *
     * @param array $attributes
     * @param string $prefix
     * @return string
     */
    protected function attributesToString($attributes=array(), $prefix='') {
        $return = "";
        if(!empty($attributes)) {
            foreach($attributes as $key => $value) {
                $return .= " {$prefix}{$key}";
                if($value != "") $return .= "={$this->quote}{$value}{$this->quote}";
            }
        }
        return $return;
    }

    /**
     * Add Prepend element
     *
     * @param string $prepend
     * @return $this
     */
    public function prepend($prepend='') {
        $this->prepend .= $prepend;
        return $this;
    }

    /**
     * Add Prepend Elements
     *
     * @param array $prepends
     * @return $this
     */
    public function prepends($prepends=array()) {
        if(!empty($prepends) && is_array($prepends)) $this->prepends = implode('', $prepends);
        return $this;
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
    public function page($page=null) {
        if(!is_null($page) && $page->id) $this->WirePage = $page;
        else $this->WirePage = wire('page');

        return $this->WirePage;
    }

    /**
     * Get given field label value
     *
     * @param null $field
     * @param null $page
     * @return $this
     */
    public function label($field=null, $page=null) {
        if(is_null($field)) $field = $this->field;
        $this->label = $this->getLabelOrNotes($field, $page);
        return $this;
    }

    /**
     * Get given field note value
     *
     * @param null $field
     * @param null $page
     * @return $this
     */
    public function note($field=null, $page=null) {
        if(is_null($field)) $field = $this->field;
        $this->note = $this->getLabelOrNotes($field, $page, 'notes');
        return $this;
    }

    /**
     * Get given field label or note value
     *
     * @param null $key
     * @param null $page
     * @param string $type
     * @return mixed|string
     */
    protected function getLabelOrNotes($key=null, $page=null, $type='label') {
        $page = $this->page($page);

        if(!is_null($key) && $key != "" && !is_null($page) && $page->{$key}) {
            $prefix = wire('user')->language->isDefault() ? $type : $type . wire('user')->language->id;
            return wire('fields')->get($key)->get($prefix);
        }

        return "";
    }

    /**
     * Get give page field value
     *
     * @param null $field
     * @param null $page
     * @return $this
     */
    public function field($field=null, $page=null) {
        if(is_null($page)) $page = $this->page($page);
        if(!is_null($field) && $field!='' && !is_null($page) && $page->{$field}) {
            $this->field = $field;
            $this->field_value = $page->{$field};
        }
        return $this;
    }

    /**
     * Get give page fields values
     *
     * @param array $fields
     * @param null $page
     * @return $this
     */
    public function fields($fields=array(), $page=null) {
        $page = $this->page($page);
        if(!is_null($fields) && is_array($fields) && !empty($fields) && !is_null($page) && $page->id) {
            foreach($fields as $field) {
                if($page->{$field}) $this->fields[$field] = $page->{$field};
            }
            if(count($this->fields) > 0) $this->hasFields = true;
        }
        return $this;
    }

    /**
     * Set given text value
     *
     * @param null $text
     * @return $this
     */
    public function text($text=null) {
        if(!is_null($text) && is_string($text) && $text!='') $this->text = $text;
        return $this;
    }

    /**
     * Set given texts values
     *
     * @param array $texts
     * @return $this
     */
    public function texts($texts=array()) {
        if(!is_null($texts) && is_array($texts) && !empty($texts)) {
            foreach($texts as $text) {
                $this->texts[] = $text;
            }
            if(count($this->texts) > 0) $this->hasTexts = true;
        }
        return $this;
    }

    /**
     * Add Child Element
     *
     * @param string $child
     * @return $this
     */
    public function child($child='') {
        $this->child .= $child;
        return $this;
    }

    /**
     * Add Children Elements
     *
     * @param array $children
     * @return $this
     */
    public function children(array $children = array()) {
        if(!empty($children) && is_array($children)) $this->children = implode('', $children);
        return $this;
    }

    /**
     * Add Append Element
     *
     * @param string $append
     * @return $this
     */
    public function append($append='') {
        $this->append .= $append;
        return $this;
    }

    /**
     * Add Appends Elements
     *
     * @param array $appends
     * @return $this
     */
    public function appends($appends=array()) {
        if(!empty($appends) && is_array($appends)) $this->appends = implode('', $appends);
        return $this;
    }

    /**
     * Build <tag> and values </tag>
     *
     * @return string
     */
    protected function trigger() {
        $output = "";

        // Prepend Elements
        if($this->prepend != '') $output .= $this->prepend;
        if($this->prepends != '') $output .= $this->prepends;

        // Open Tag
        if(!is_null($this->tag)) {
            $id = (!empty($this->id)) ? $id = " id={$this->quote}{$this->id}{$this->quote}" : "";
            $class = (!empty($this->classes)) ? $class = " class={$this->quote}" . implode(' ', $this->classes) . "{$this->quote}" : "";
            $attributes = (!empty($this->attributes)) ? $this->attributesToString($this->attributes) : "";
            $dataAttributes = (!empty($this->dataAttributes)) ? $this->attributesToString($this->dataAttributes, 'data-') : "";

            if($this->tagCustom === true && !is_null($this->tagStart)) {
                $output .= str_replace(
                    array('{id}', '{class}', '{attr}', '{data}'),
                    array($id, $class, $attributes, $dataAttributes),
                    $this->tagStart
                );
                // $output .= $this->tagStart;
            } else {
                $output .= "<{$this->tag}{$id}{$class}{$attributes}{$dataAttributes}";

                if($this->tagSelfClosed === true) $output .= " />";
                else $output .= ">";
            }
        }

        // Label, Value, Text, Note values
        if($this->label != '') $output .= $this->label;
        if($this->field_value != '') $output .= $this->field_value;
        if($this->text != '') $output .= $this->text;
        if($this->note != '') $output .= $this->note;

        // Child and Children Elements
        if($this->child) $output .= $this->child;
        if($this->children) $output .= $this->children;

        // Close Tag
        if(!is_null($this->tag)) {
            if($this->tagCustom === true && !is_null($this->tagEnd)) $output .= $this->tagEnd;
            if($this->tagSelfClosed != true && $this->tagNoClose != true && $this->tagCustom != true) $output .= "</$this->tag>";
        }

        // Append Elements
        if($this->append != '') $output .= $this->append;
        if($this->appends != '') $output .= $this->appends;

        return $output;

    }

    /**
     * Alias with $this->render();
     *
     * Render | return result
     *
     * @param bool|false $formatter
     * @return string
     */
    public function r($formatter = false) {
        return $this->render($formatter);
    }

    /**
     * Render | return result
     *
     * @param bool|false $formatter
     * @return string
     */
    public function render($formatter = false) {
        $output = "";
        if($this->hasFields === true) {
            foreach($this->fields as $key => $value) {
                $this->field = $key;
                $this->field_value = $value;
                $output .= $this->trigger();
            }
        } elseif($this->hasTexts === true) {
            foreach($this->texts as $key => $value) {
                $this->text = $value;
                $output .= $this->trigger();
            }
        } else {
            $output = $this->trigger();
        }

        // Formatter
        if(is_bool($formatter) && $formatter === true) $output = "\n" . $this->format($output, $this->indent_with, $this->tags_without_indentation);

        // Reset All Settings to Default
        $this->reset();

        return $output;
    }

    /**
     * Alias with $this->output();
     *
     * Print Result
     *
     * @param bool|false $formatter
     */
    public function o($formatter = false) {
        echo $this->render($formatter);
        return;
    }

    /**
     * Print Result
     *
     * @param bool|false $formatter
     */
    public function output($formatter = false) {
        echo $this->render($formatter);
        return;
    }

    /**
     * HTML Formatter
     * https://github.com/mihaeu/html-formatter
     * @author Michael Haeuslmann <haeuslmann@gmail.com>
     */

    /**
     * Formats HTML by re-indenting the tags and removing unnecessary whitespace.
     *
     * @param string $html HTML string.
     * @param string $indentWith Characters that are being used for indentation (default = 4 spaces).
     * @param string $tagsWithoutIndentation Comma-separated list of HTML tags that should not be indented (default = html,link,img,meta)
     * @return string Re-indented HTML.
     */
    public static function format($html, $indentWith = '    ', $tagsWithoutIndentation = 'html,link,img,meta')
    {
        // remove all line feeds and replace tabs with spaces
        $html = str_replace(["\n", "\r", "\t"], ['', '', ' '], $html);
        $elements = preg_split('/(<.+>)/U', $html, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $dom = self::parseDom($elements);
        $indent = 0;
        $output = array();
        foreach ($dom as $index => $element)
        {
            $indenter = ($indent >= $indentWith) ? str_repeat($indentWith, $indent) : "";

            if ($element['opening'])
            {
                $output[] = "\n".$indenter.trim($element['content']);
                // make sure that only the elements who have not been blacklisted are being indented
                if ( ! in_array($element['type'], explode(',', $tagsWithoutIndentation)))
                {
                    ++$indent;
                }
            }
            else if ($element['standalone'])
            {
                $output[] = "\n".$indenter.trim($element['content']);
            }
            else if ($element['closing'])
            {
                --$indent;
                $lf = "\n".$indenter;
                if (isset($dom[$index - 1]) && $dom[$index - 1]['opening'])
                {
                    $lf = '';
                }
                $output[] = $lf.trim($element['content']);
            }
            else if ($element['text'])
            {
                // $output[] = "\n".str_repeat($indentWith, $indent).trim($element['content']);
                $output[] = "\n".$indenter.preg_replace('/ [ \t]*/', ' ', $element['content']);
            }
            else if ($element['comment'])
            {
                $output[] = "\n".$indenter.trim($element['content']);
            }
        }
        return trim(implode('', $output));
    }

    /**
     * Parses an array of HTML tokens and adds basic information about about the type of
     * tag the token represents.
     *
     * @param Array $elements Array of HTML tokens (tags and text tokens).
     * @return Array HTML elements with extra information.
     */
    public static function parseDom(Array $elements)
    {
        $dom = array();
        foreach ($elements as $element)
        {
            $isText = false;
            $isComment = false;
            $isClosing = false;
            $isOpening = false;
            $isStandalone = false;
            $currentElement = trim($element);
            // comment
            if (strpos($currentElement, '<!') === 0)
            {
                $isComment = true;
            }
            // closing tag
            else if (strpos($currentElement, '</') === 0)
            {
                $isClosing = true;
            }
            // stand-alone tag
            else if (preg_match('/\/>$/', $currentElement))
            {
                $isStandalone = true;
            }
            // normal opening tag
            else if (strpos($currentElement, '<') === 0)
            {
                $isOpening = true;
            }
            // text
            else
            {
                $isText = true;
            }
            $dom[] = array(
                'text' 				=> $isText,
                'comment'			=> $isComment,
                'closing'	 		=> $isClosing,
                'opening'	 		=> $isOpening,
                'standalone'	 	=> $isStandalone,
                'content'			=> $element,
                'type'				=> preg_replace('/^<\/?(\w+)[ >].*$/U', '$1', $element)
            );
        }
        return $dom;
    }
}