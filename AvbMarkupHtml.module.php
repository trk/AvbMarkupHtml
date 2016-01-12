<?php if(!defined("PROCESSWIRE")) die();

if(!class_exists('MarkupHtml')) {
    require_once(dirname(__FILE__) . "/MarkupHtml.php");
}

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
            'version' => 16,
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
    }

    /**
     * For
     * $page->html() api calls
     *
     * @param $event
     */
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
            $config['WirePage'] = $page;
        }

        $event->return = new MarkupHtml($config);
    }
}