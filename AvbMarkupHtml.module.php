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
            'version' => 1,
            'author' => 'İskender TOTOĞLU | @ukyo(community), @trk (Github), http://altivebir.com',
            'icon' => 'code',
            'href' => 'https://github.com/trk/AvbMarkupHtml',
            'requires' => 'ProcessWire>=2.6.1'
        );
    }

    /**
     * Config
     *
     * @var array
     */
    public $config = array(
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

    public function init() {
        $this->addHook('Page::html', $this, 'html');
        if(is_null($this->page)) $this->page = wire('page');
    }

    public function html($event) {
        $config = array();
        $page = $event->object;
        if(!empty($event->arguments[0])) {
            if(!is_array($event->arguments[0]) && $page->{$event->arguments[0]}) {
                $config['field'] = $event->arguments[0];
                $config['field_value'] = $page->{$event->arguments[0]};
            } else {
                $config = $event->arguments[0];
            }
        }
        $config['page'] = $page;

        $event->return = new AvbMarkupHtml($config);
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
        $this->prepend = $prepend;
        return $this;
    }

    public function prepends($prepends=array()) {
        if(!empty($prepends)) foreach($prepends as $key => $prepend) $this->prepends .= $prepend;
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
        $this->child = $child;
        return $this;
    }

    public function children($children=array()) {
        if(!empty($children)) foreach($children as $key => $child) $this->children .= $child;
        return $this;
    }

    public function append($append='') {
        $this->append = $append;
        return $this;
    }

    public function appends($appends=array()) {
        if(!empty($appends)) foreach($appends as $key => $append) $this->appends .= $append;
        return $this;
    }

    public function render() {
        $output = "";

        if($this->prepend != '') $output .= "\n\t" . $this->prepend;
        if($this->prepends != '') $output .= "\n\t" . $this->prepends;

        if(!is_null($this->tag)) {
            if(!is_null($this->tagSelfClosed)) $output .= "\n<{$this->tag}{$this->attributes}{$this->dataAttributes} />";
            else $output .= "\n<{$this->tag}{$this->attributes}{$this->dataAttributes}>";
        }

        if($this->field_value != '') $output .= "\n\t" . $this->field_value;
        if($this->text != '') $output .= "\n\t" . $this->text;
        if($this->child != '') $output .= "\n\t" . $this->child;
        if($this->children != '') $output .= "\n\t" . $this->children;
        if($this->label != '') $output .= "\n\t" . $this->label;
        if($this->note != '') $output .= "\n\t" . $this->note;

        if(!is_null($this->tag) && is_null($this->tagSelfClosed)) $output .= "\n</$this->tag>";

        if($this->append != '') $output .= "\n\t" . $this->append;
        if($this->appends != '') $output .= "\n\t" . $this->appends;
        $this->reset();
        return $output;
    }

    public function output() {
        echo $this->render();
    }
}