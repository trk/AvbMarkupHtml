<?php if(!defined("PROCESSWIRE")) die();

/**
 * Class AvbMarkupHtml
 *
 * @author          : İskender TOTOĞLU, @ukyo (community), @trk (Github)
 * @website         : http://altivebir.com
 * @projectWebsite  : https://github.com/trk/AvbMarkupHtml
 */
class AvbMarkupHtml extends WireData implements Module {

    /**
     * AvbMarkupHtml Module Info
     *
     * @return array
     */
    public static function getModuleInfo() {
        return array(
            'title' => 'AvbMarkupHtml',
            'summary' => __('Module allow to use less HTML elements inside your PHP code'),
            'version' => 4,
            'author' => 'İskender TOTOĞLU | @ukyo(community), @trk (Github), http://altivebir.com',
            'icon' => 'code',
            'singular' => true,
            'autoload' => true,
            'href' => 'https://github.com/trk/AvbMarkupHtml',
            'requires' => 'ProcessWire>=2.6.1'
        );
    }

    public function init() {
        $this->addHook('Page::html', $this, '_html');
        if(is_null($this->page)) $this->page = wire('page');
    }

    public function ready(){
        wire()->wire('html', new MarkupHtml());
    }

    public function _html($event) {
        $config = array();
        $page = $event->object;

        if(!empty($event->arguments[0])) {
            if(!is_array($event->arguments[0]) && $page->{$event->arguments[0]}) {
                $config['field'] = $event->arguments[0];
                $config['field_value'] = $page->{$event->arguments[0]};
            } else {
                $config = $event->arguments[0];
            }
        } else {
            $config['page'] = $page;
        }

        $event->return = new MarkupHtml($config);
    }

    public function html(array $config = array()) { return new MarkupHtml($config); }
}

class MarkupHtml extends WireData {

    /**
     * Config
     *
     * @var array
     */
    public $config = array(
        'indent_with' => '    ',
        'tags_without_indentation' => 'html,link,img,meta',
        'page' => null,
        'tag' => null,
        'tagSelfClosed' => null,
        'prepend' => '',
        'prepends' => '',
        'attributes' => '',
        'dataAttributes' => '',
        'label' => '',
        'note' => '',
        'text' => '',
        'texts' => array(),
        'field' => '',
        'field_value' => '',
        'fields' => array(),
        'loop' => '',
        'child' => '',
        'children' => '',
        'append' => '',
        'appends' => ''
    );

    public function __construct(array $config = array()) {
        // Set Custom Configs
        $this->configure($config);
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

    public function reset() {
        foreach($this->config as $key => $value) $this->$key = $value;
        return $this;
    }

    public function tag($tag=null, $attributes=array()) {
        if(!is_null($tag) && $tag != "") {
            if(strpos($tag, ':/') !== false) {
                $this->tagSelfClosed = true;
                $tag = str_replace(':/', '', $tag);
            }
            $this->tag = $tag;
        }
        if(!empty($attributes)) $this->attributes = $this->attributesToString($attributes);
        return $this;
    }

    public function attributes($attributes=array()) {
        $this->attributes = $this->attributesToString($attributes);
        return $this;
    }

    public function dataAttributes($dataAttributes=array()) {
        $this->dataAttributes = $this->attributesToString($dataAttributes, 'data-');
        return $this;
    }

    protected function attributesToString($attributes=array(), $prefix='') {
        $return = "";
        if(!empty($attributes)) {
            foreach($attributes as $key => $value) {
                $return .= " {$prefix}{$key}='{$value}'";
            }
        }
        return $return;
    }

    public function prepend($prepend='') {
        $this->prepend .= $prepend;
        return $this;
    }

    public function prepends($prepends=array()) {
        if(!empty($prepends) && is_array($prepends)) $this->prepends = implode('', $prepends);
        return $this;
    }

    public function page($page=null) {
        if(!is_null($page) && $page) $this->page = $page;
        else $this->page = wire('page');
        return $this;
    }

    public function label($field=null, $page=null) {
        if(is_null($field)) $field = $this->field;
        if(is_null($page)) $page = $this->page();
        if(!is_null($page) && $page->{$field}) {
            $prefix = wire('user')->language->isDefault() ? "label" : "label" . wire('user')->language->id;
            $this->label = wire('fields')->get($field)->get($prefix);
        }
        return $this;
    }

    public function note($field=null, $page=null) {
        if(is_null($field)) $field = $this->field;
        if(is_null($page)) $page = $this->page();
        if(!is_null($page) && $page->{$field}) {
            $prefix = wire('user')->language->isDefault() ? "notes" : "notes" . wire('user')->language->id;
            $this->note = wire('fields')->get($field)->get($prefix);
        }
        return $this;
    }

    public function field($field=null, $page=null) {
        if(is_null($page)) $page = $this->page;
        if(!is_null($field) && $field!=''&& !is_null($page) && $page->{$field}) {
            $this->field = $field;
            $this->field_value = $page->{$field};
        }
        return $this;
    }

    public function fields($fields=array()) {
        if(!is_null($fields) && is_array($fields) && !empty($fields)) $this->fields = $fields;
        return $this;
    }

    public function text($text=null) {
        if(!is_null($text) && $text!='') $this->text = $text;
        return $this;
    }

    public function texts($texts=array()) {
        if(!is_null($texts) && is_array($texts) && !empty($texts)) $this->texts = $texts;
        return $this;
    }

    public function child($child='') {
        $this->child .= $child;
        return $this;
    }

    public function children(array $children = array()) {
        if(!empty($children) && is_array($children)) $this->children = implode('', $children);
        return $this;
    }

    public function append($append='') {
        $this->append .= $append;
        return $this;
    }

    public function appends($appends=array()) {
        if(!empty($appends) && is_array($appends)) $this->appends = implode('', $appends);
        return $this;
    }

    public function render($formatter = false) {
        $output = "";

        if($this->prepend != '') $output .= $this->prepend;
        if($this->prepends != '') $output .= $this->prepends;

        if(!is_null($this->tag)) {
            if(!is_null($this->tagSelfClosed)) $output .= "<{$this->tag}{$this->attributes}{$this->dataAttributes} />";
            else $output .= "<{$this->tag}{$this->attributes}{$this->dataAttributes}>";
        }

        if($this->field_value != '') $output .= $this->field_value;
        if($this->text != '') $output .= $this->text;
        if($this->child != '') $output .= $this->child;
        if($this->children != '') $output .= $this->children;
        if($this->label != '') $output .= $this->label;
        if($this->note != '') $output .= $this->note;

        if(!is_null($this->tag) && is_null($this->tagSelfClosed)) $output .= "</$this->tag>";

        if($this->append != '') $output .= $this->append;
        if($this->appends != '') $output .= $this->appends;
        $this->reset();

        // Formatter
        if(is_bool($formatter) && $formatter === true) return "\n" . $this->format($output, $this->indent_with, $this->tags_without_indentation);

        return $output;
    }

    public function output($formatter = false) {
        echo $this->render($formatter);
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
            if ($element['opening'])
            {
                $output[] = "\n".str_repeat($indentWith, $indent).trim($element['content']);
                // make sure that only the elements who have not been blacklisted are being indented
                if ( ! in_array($element['type'], explode(',', $tagsWithoutIndentation)))
                {
                    ++$indent;
                }
            }
            else if ($element['standalone'])
            {
                $output[] = "\n".str_repeat($indentWith, $indent).trim($element['content']);
            }
            else if ($element['closing'])
            {
                --$indent;

                // str_repeat(): Second argument has to be greater than or equal
                if($indent > $indentWith) $lf = "\n".str_repeat($indentWith, $indent);
                else $lf = "";
                // $lf = "\n".str_repeat($indentWith, $indent);

                if (isset($dom[$index - 1]) && $dom[$index - 1]['opening'])
                {
                    $lf = '';
                }
                $output[] = $lf.trim($element['content']);
            }
            else if ($element['text'])
            {
                // $output[] = "\n".str_repeat($indentWith, $indent).trim($element['content']);
                $output[] = "\n".str_repeat($indentWith, $indent).preg_replace('/ [ \t]*/', ' ', $element['content']);
            }
            else if ($element['comment'])
            {
                $output[] = "\n".str_repeat($indentWith, $indent).trim($element['content']);
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