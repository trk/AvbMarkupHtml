<?php

/**
 * Class HtmlTags
 *
 * @author          : İskender TOTOĞLU, @ukyo (community), @trk (Github)
 * @website         : http://altivebir.com
 * @projectWebsite  : https://github.com/trk/AvbMarkupHtml
 *
 * HTML Element Reference : http://www.w3schools.com/tags/
 */
class HtmlTags {

    /**
     * Instance of MarkupHtml
     *
     * @var MarkupHtml
     */
    public static $MarkupHtml;

    /**
     * Creates a new instance
     *
     * @param MarkupHtml $MarkupHtml
     */
    public function __construct(MarkupHtml $MarkupHtml = null) {
        self::$MarkupHtml = $MarkupHtml ? $MarkupHtml : new MarkupHtml;
    }

    /**
     * Magic function : if function not exist, call self::tag() function
     *
     * @param $tag
     * @param array $args
     * @return $this
     */
    public static function __callStatic($tag, $args=array()) {
        return self::getMarkupHtml()->tag($tag, $args);
    }

    /**
     * Get or create new MarkupHtml instance
     *
     * @return MarkupHtml
     */
    public static function getMarkupHtml() {
        return self::$MarkupHtml ? self::$MarkupHtml : new MarkupHtml;
    }

    /**
     * Statically create new custom configured MarkupHtml
     *
     * @param  array $config
     *
     * @return MarkupHtml
     */
    public static function configure(array $config = array()) {
        return self::$MarkupHtml = self::getMarkupHtml()->configure($config);
    }

    /**
     * Setup <tag>
     *
     * Self closed tag = "/>"
     * Don't close tag = "->"
     * Custom tag = "->"
     *
     * @param null $tag
     * @param array $args
     * @return MarkupHtml
     */
    public static function tag($tag=null, $args=array()) {
        return self::getMarkupHtml()->tag($tag, $args);
    }

    /**
     * <!--...-->	Defines a comment
     *
     * @param string $value
     * @return $this
     */
    public static function comment($value='') {
        return self::getMarkupHtml()->tag("<!--,-->", array($value, "=>"));
    }

    /**
     * <!DOCTYPE> 	Defines the document type
     *
     * @return $this
     */
    public static function doctype() {
        return self::getMarkupHtml()->tag("!DOCTYPE", array(null, "->"));
    }

    /**
     * <a>	Defines a hyperlink
     *
     * @param string $value
     * @return $this
     */
    public static function a($value='') {
        return self::getMarkupHtml()->tag("a", array($value));
    }

    /**
     * <abbr>	Defines an abbreviation or an acronym
     *
     * @param string $value
     * @return $this
     */
    public static function abbr($value='') {
        return self::getMarkupHtml()->tag("abbr", array($value));
    }

    /**
     * <acronym>	Not supported in HTML5. Use <abbr> instead.
     * Defines an acronym
     *
     * @param string $value
     * @return $this
     */
    public static function acronym($value='') {
        return self::getMarkupHtml()->tag("acronym", array($value));
    }

    /**
     * <address>	Defines contact information for the author/owner of a document
     *
     * @param string $value
     * @return $this
     */
    public static function address($value='') {
        return self::getMarkupHtml()->tag("address", array($value));
    }

    /**
     * <applet>	Not supported in HTML5. Use <embed> or <object> instead.
     * Defines an embedded applet
     *
     * @param string $value
     * @return $this
     */
    public static function applet($value='') {
        return self::getMarkupHtml()->tag("applet", array($value));
    }

    /**
     * <area>	Defines an area inside an image-map
     *
     * @return $this
     */
    public static function area() {
        return self::getMarkupHtml()->tag("area", array(null, "->"));
    }

    /**
     * <article>	Defines an article
     *
     * @param string $value
     * @return $this
     */
    public static function article($value='') {
        return self::getMarkupHtml()->tag("article", array($value));
    }

    /**
     * <aside>	Defines content aside from the page content
     *
     * @param string $value
     * @return $this
     */
    public static function aside($value='') {
        return self::getMarkupHtml()->tag("aside", array($value));
    }

    /**
     * <audio>	Defines sound content
     *
     * @param string $value
     * @return $this
     */
    public static function audio($value='') {
        return self::getMarkupHtml()->tag("audio", array($value));
    }

    /**
     * <b>	Defines bold text
     *
     * @param string $value
     * @return $this
     */
    public static function b($value='') {
        return self::getMarkupHtml()->tag("b", array($value));
    }

    /**
     * <base>	Specifies the base URL/target for all relative URLs in a document
     *
     * @return $this
     */
    public static function base() {
        return self::getMarkupHtml()->tag("base", array(null, "->"));
    }

    /**
     * <basefont>	Not supported in HTML5. Use CSS instead.
     * Specifies a default color, size, and font for all text in a document
     *
     * @return $this
     */
    public static function basefont() {
        return self::getMarkupHtml()->tag("basefont", array(null, "->"));
    }

    /**
     * <bdi>	Isolates a part of text that might be formatted in a different direction from other text outside it
     *
     * @param string $value
     * @return $this
     */
    public static function bdi($value='') {
        return self::getMarkupHtml()->tag("bdi", array($value));
    }

    /**
     * <bdo>	Overrides the current text direction
     *
     * @param string $value
     * @return $this
     */
    public static function bdo($value='') {
        return self::getMarkupHtml()->tag("bdo", array($value));
    }

    /**
     * <big>	Not supported in HTML5. Use CSS instead.
     * Defines big text
     *
     * @param string $value
     * @return $this
     */
    public static function big($value='') {
        return self::getMarkupHtml()->tag("big", array($value));
    }

    /**
     * <blockquote>	Defines a section that is quoted from another source
     *
     * @param string $value
     * @return $this
     */
    public static function blockquote($value='') {
        return self::getMarkupHtml()->tag("blockquote", array($value));
    }

    /**
     * <body>	Defines the document's body
     *
     * @param string $value
     * @return $this
     */
    public static function body($value='') {
        return self::getMarkupHtml()->tag("body", array($value));
    }

    /**
     * <br>	Defines a single line break
     *
     * @return $this
     */
    public static function br() {
        return self::getMarkupHtml()->tag("br", array(null, "->"));
    }

    /**
     * <button>	Defines a clickable button
     *
     * @param string $value
     * @return $this
     */
    public static function button($value='') {
        return self::getMarkupHtml()->tag("button", array($value));
    }

    /**
     * <canvas>	Used to draw graphics, on the fly, via scripting (usually JavaScript)
     *
     * @param string $value
     * @return $this
     */
    public static function canvas($value='') {
        return self::getMarkupHtml()->tag("canvas", array($value));
    }

    /**
     * <caption>	Defines a table caption
     *
     * @param string $value
     * @return $this
     */
    public static function caption($value='') {
        return self::getMarkupHtml()->tag("caption", array($value));
    }

    /**
     * <center>	Not supported in HTML5. Use CSS instead.
     * Defines centered text
     *
     * @param string $value
     * @return $this
     */
    public static function center($value='') {
        return self::getMarkupHtml()->tag("center", array($value));
    }

    /**
     * <cite>	Defines the title of a work
     *
     * @param string $value
     * @return $this
     */
    public static function cite($value='') {
        return self::getMarkupHtml()->tag("cite", array($value));
    }

    /**
     * <code>	Defines a piece of computer code
     *
     * @param string $value
     * @return $this
     */
    public static function code($value='') {
        return self::getMarkupHtml()->tag("code", array($value));
    }

    /**
     * <col>	Specifies column properties for each column within a <colgroup> element
     *
     * @return $this
     */
    public static function col() {
        return self::getMarkupHtml()->tag("col", array(null, "->"));
    }

    /**
     * <colgroup>	Specifies a group of one or more columns in a table for formatting
     *
     * @param string $value
     * @return $this
     */
    public static function colgroup($value='') {
        return self::getMarkupHtml()->tag("colgroup", array($value));
    }

    /**
     * <datalist>	Specifies a list of pre-defined options for input controls
     *
     * @param string $value
     * @return $this
     */
    public static function datalist($value='') {
        return self::getMarkupHtml()->tag("datalist", array($value));
    }

    /**
     * <dd>	Defines a description/value of a term in a description list
     *
     * @param string $value
     * @return $this
     */
    public static function dd($value='') {
        return self::getMarkupHtml()->tag("dd", array($value));
    }

    /**
     * <del>	Defines text that has been deleted from a document
     *
     * @param string $value
     * @return $this
     */
    public static function del($value='') {
        return self::getMarkupHtml()->tag("del", array($value));
    }

    /**
     * <details>	Defines additional details that the user can view or hide
     *
     * @param string $value
     * @return $this
     */
    public static function details($value='') {
        return self::getMarkupHtml()->tag("details", array($value));
    }

    /**
     * <dfn>	Represents the defining instance of a term
     *
     * @param string $value
     * @return $this
     */
    public static function dfn($value='') {
        return self::getMarkupHtml()->tag("dfn", array($value));
    }

    /**
     * <dialog>	Defines a dialog box or window
     *
     * @param string $value
     * @return $this
     */
    public static function dialog($value='') {
        return self::getMarkupHtml()->tag("dialog", array($value));
    }

    /**
     * <dir>	Not supported in HTML5. Use <ul> instead.
     * Defines a directory list
     *
     * @param string $value
     * @return $this
     */
    public static function dir($value='') {
        return self::getMarkupHtml()->tag("dir", array($value));
    }

    /**
     * <div>	Defines a section in a document
     *
     * @param string $value
     * @return $this
     */
    public static function div($value='') {
        return self::getMarkupHtml()->tag("div", array($value));
    }

    /**
     * <dl>	Defines a description list
     *
     * @param string $value
     * @return $this
     */
    public static function dl($value='') {
        return self::getMarkupHtml()->tag("dl", array($value));
    }

    /**
     * <dt>	Defines a term/name in a description list
     *
     * @param string $value
     * @return $this
     */
    public static function dt($value='') {
        return self::getMarkupHtml()->tag("dt", array($value));
    }

    /**
     * <em>	Defines emphasized text
     *
     * @param string $value
     * @return $this
     */
    public static function em($value='') {
        return self::getMarkupHtml()->tag("em", array($value));
    }

    /**
     * <embed>	Defines a container for an external (non-HTML) application
     *
     * @return $this
     */
    public static function embed() {
        return self::getMarkupHtml()->tag("embed", array(null, "->"));
    }

    /**
     * <fieldset>	Groups related elements in a form
     *
     * @param string $value
     * @return $this
     */
    public static function fieldset($value='') {
        return self::getMarkupHtml()->tag("fieldset", array($value));
    }

    /**
     * <figcaption>	Defines a caption for a <figure> element
     *
     * @param string $value
     * @return $this
     */
    public static function figcaption($value='') {
        return self::getMarkupHtml()->tag("figcaption", array($value));
    }

    /**
     * <figure>	Specifies self-contained content
     *
     * @param string $value
     * @return $this
     */
    public static function figure($value='') {
        return self::getMarkupHtml()->tag("figure", array($value));
    }

    /**
     * <font>	Not supported in HTML5. Use CSS instead.
     * Defines font, color, and size for text
     *
     * @param string $value
     * @return $this
     */
    public static function font($value='') {
        return self::getMarkupHtml()->tag("font", array($value));
    }

    /**
     * <footer>	Defines a footer for a document or section
     *
     * @param string $value
     * @return $this
     */
    public static function footer($value='') {
        return self::getMarkupHtml()->tag("footer", array($value));
    }

    /**
     * <form>	Defines an HTML form for user input
     *
     * @param string $value
     * @return $this
     */
    public static function form($value='') {
        return self::getMarkupHtml()->tag("form", array($value));
    }

    /**
     * <frame>	Not supported in HTML5.
     * Defines a window (a frame) in a frameset
     *
     * @return $this
     */
    public static function frame() {
        return self::getMarkupHtml()->tag("frame", array(null, "->"));
    }

    /**
     * <frameset>	Not supported in HTML5.
     * Defines a set of frames
     *
     * @param string $value
     * @return $this
     */
    public static function frameset($value='') {
        return self::getMarkupHtml()->tag("frameset", array($value));
    }

    /**
     * <h1> to <h6>	Defines HTML headings
     *
     * @param string $value
     * @return $this
     */
    public static function h1($value='') {
        return self::getMarkupHtml()->tag("h1", array($value));
    }

    /**
     * <h1> to <h6>	Defines HTML headings
     *
     * @param string $value
     * @return $this
     */
    public static function h2($value='') {
        return self::getMarkupHtml()->tag("h2", array($value));
    }

    /**
     * <h1> to <h6>	Defines HTML headings
     *
     * @param string $value
     * @return $this
     */
    public static function h3($value='') {
        return self::getMarkupHtml()->tag("h3", array($value));
    }

    /**
     * <h1> to <h6>	Defines HTML headings
     *
     * @param string $value
     * @return $this
     */
    public static function h4($value='') {
        return self::getMarkupHtml()->tag("h4", array($value));
    }

    /**
     * <h1> to <h6>	Defines HTML headings
     *
     * @param string $value
     * @return $this
     */
    public static function h5($value='') {
        return self::getMarkupHtml()->tag("h5", array($value));
    }

    /**
     * <h1> to <h6>	Defines HTML headings
     *
     * @param string $value
     * @return $this
     */
    public static function h6($value='') {
        return self::getMarkupHtml()->tag("h6", array($value));
    }

    /**
     * <head>	Defines information about the document
     *
     * @param string $value
     * @return $this
     */
    public static function head($value='') {
        return self::getMarkupHtml()->tag("head", array($value));
    }

    /**
     * <header>	Defines a header for a document or section
     *
     * @param string $value
     * @return $this
     */
    public static function header($value='') {
        return self::getMarkupHtml()->tag("header", array($value));
    }

    /**
     * <hr>	Defines a thematic change in the content
     *
     * @return $this
     */
    public static function hr() {
        return self::getMarkupHtml()->tag("hr", array(null, "->"));
    }

    /**
     * <html>	Defines the root of an HTML document
     *
     * @param string $value
     * @return $this
     */
    public static function html($value='') {
        return self::getMarkupHtml()->tag("html", array($value));
    }

    /**
     * <i>	Defines a part of text in an alternate voice or mood
     *
     * @param string $value
     * @return $this
     */
    public static function i($value='') {
        return self::getMarkupHtml()->tag("i", array($value));
    }

    /**
     * <iframe>	Defines an inline frame
     *
     * @param string $value
     * @return $this
     */
    public static function iframe($value='') {
        return self::getMarkupHtml()->tag("iframe", array($value));
    }

    /**
     * <img>	Defines an image
     *
     * @return $this
     */
    public static function img() {
        return self::getMarkupHtml()->tag("img", array(null, "->"));
    }

    /**
     * <input>	Defines an input control
     *
     * @return $this
     */
    public static function input() {
        return self::getMarkupHtml()->tag("input", array(null, "->"));
    }

    /**
     * <ins>	Defines a text that has been inserted into a document
     *
     * @param string $value
     * @return $this
     */
    public static function ins($value='') {
        return self::getMarkupHtml()->tag("ins", array($value));
    }

    /**
     * <kbd>	Defines keyboard input
     *
     * @param string $value
     * @return $this
     */
    public static function kbd($value='') {
        return self::getMarkupHtml()->tag("kbd", array($value));
    }

    /**
     * <keygen>	Defines a key-pair generator field (for forms)
     *
     * @return $this
     */
    public static function keygen() {
        return self::getMarkupHtml()->tag("keygen", array(null, "->"));
    }

    /**
     * <label>	Defines a label for an <input> element
     *
     * @param string $value
     * @return $this
     */
    public static function label($value='') {
        return self::getMarkupHtml()->tag("label", array($value));
    }

    /**
     * <legend>	Defines a caption for a <fieldset> element
     *
     * @param string $value
     * @return $this
     */
    public static function legend($value='') {
        return self::getMarkupHtml()->tag("legend", array($value));
    }

    /**
     * <li>	Defines a list item
     *
     * @param string $value
     * @return $this
     */
    public static function li($value='') {
        return self::getMarkupHtml()->tag("li", array($value));
    }

    /**
     * <link>	Defines the relationship between a document and an external resource (most used to link to style sheets)
     *
     * @return $this
     */
    public static function link() {
        return self::getMarkupHtml()->tag("link", array(null, "->"));
    }

    /**
     * <main>	Specifies the main content of a document
     *
     * @param string $value
     * @return $this
     */
    public static function main($value='') {
        return self::getMarkupHtml()->tag("main", array($value));
    }

    /**
     * <map>	Defines a client-side image-map
     *
     * @param string $value
     * @return $this
     */
    public static function map($value='') {
        return self::getMarkupHtml()->tag("map", array($value));
    }

    /**
     * <mark>	Defines marked/highlighted text
     *
     * @param string $value
     * @return $this
     */
    public static function mark($value='') {
        return self::getMarkupHtml()->tag("mark", array($value));
    }

    /**
     * <menu>	Defines a list/menu of commands
     *
     * @param string $value
     * @return $this
     */
    public static function menu($value='') {
        return self::getMarkupHtml()->tag("menu", array($value));
    }

    /**
     * <menuitem>	Defines a command/menu item that the user can invoke from a popup menu
     *
     * @param string $value
     * @return $this
     */
    public static function menuitem($value='') {
        return self::getMarkupHtml()->tag("menuitem", array($value));
    }

    /**
     * <meta>	Defines metadata about an HTML document
     *
     * @return $this
     */
    public static function meta() {
        return self::getMarkupHtml()->tag("meta", array(null, "->"));
    }

    /**
     * <meter>	Defines a scalar measurement within a known range (a gauge)
     *
     * @param string $value
     * @return $this
     */
    public static function meter($value='') {
        return self::getMarkupHtml()->tag("meter", array($value));
    }

    /**
     * <nav>	Defines navigation links
     *
     * @param string $value
     * @return $this
     */
    public static function nav($value='') {
        return self::getMarkupHtml()->tag("nav", array($value));
    }

    /**
     * <noframes>	Not supported in HTML5.
     * Defines an alternate content for users that do not support frames
     *
     * @param string $value
     * @return $this
     */
    public static function noframes($value='') {
        return self::getMarkupHtml()->tag("noframes", array($value));
    }

    /**
     * <noscript>	Defines an alternate content for users that do not support client-side scripts
     *
     * @param string $value
     * @return $this
     */
    public static function noscript($value='') {
        return self::getMarkupHtml()->tag("noscript", array($value));
    }

    /**
     * <object>	Defines an embedded object
     *
     * @param string $value
     * @return $this
     */
    public static function object($value='') {
        return self::getMarkupHtml()->tag("object", array($value));
    }

    /**
     * <ol>	Defines an ordered list
     *
     * @param string $value
     * @return $this
     */
    public static function ol($value='') {
        return self::getMarkupHtml()->tag("ol", array($value));
    }

    /**
     * <optgroup>	Defines a group of related options in a drop-down list
     *
     * @param string $value
     * @return $this
     */
    public static function optgroup($value='') {
        return self::getMarkupHtml()->tag("optgroup", array($value));
    }

    /**
     * <option>	Defines an option in a drop-down list
     *
     * @param string $value
     * @return $this
     */
    public static function option($value='') {
        return self::getMarkupHtml()->tag("option", array($value));
    }

    /**
     * <output>	Defines the result of a calculation
     *
     * @param string $value
     * @return $this
     */
    public static function output($value='') {
        return self::getMarkupHtml()->tag("output", array($value));
    }

    /**
     * <p>	Defines a paragraph
     *
     * @param string $value
     * @return $this
     */
    public static function p($value='') {
        return self::getMarkupHtml()->tag("p", array($value));
    }

    /**
     * <param>	Defines a parameter for an object
     *
     * @return $this
     */
    public static function param() {
        return self::getMarkupHtml()->tag("param", array(null, "->"));
    }

    /**
     * <pre>	Defines preformatted text
     *
     * @param string $value
     * @return $this
     */
    public static function pre($value='') {
        return self::getMarkupHtml()->tag("pre", array($value));
    }

    /**
     * <progress>	Represents the progress of a task
     *
     * @param string $value
     * @return $this
     */
    public static function progress($value='') {
        return self::getMarkupHtml()->tag("progress", array($value));
    }

    /**
     * <q>	Defines a short quotation
     *
     * @param string $value
     * @return $this
     */
    public static function q($value='') {
        return self::getMarkupHtml()->tag("q", array($value));
    }

    /**
     * <rp>	Defines what to show in browsers that do not support ruby annotations
     *
     * @param string $value
     * @return $this
     */
    public static function rp($value='') {
        return self::getMarkupHtml()->tag("rp", array($value));
    }

    /**
     * <rt>	Defines an explanation/pronunciation of characters (for East Asian typography)
     *
     * @param string $value
     * @return $this
     */
    public static function rt($value='') {
        return self::getMarkupHtml()->tag("rt", array($value));
    }

    /**
     * <ruby>	Defines a ruby annotation (for East Asian typography)
     *
     * @param string $value
     * @return $this
     */
    public static function ruby($value='') {
        return self::getMarkupHtml()->tag("ruby", array($value));
    }

    /**
     * <s>	Defines text that is no longer correct
     *
     * @param string $value
     * @return $this
     */
    public static function s($value='') {
        return self::getMarkupHtml()->tag("s", array($value));
    }

    /**
     * <samp>	Defines sample output from a computer program
     *
     * @param string $value
     * @return $this
     */
    public static function samp($value='') {
        return self::getMarkupHtml()->tag("samp", array($value));
    }

    /**
     * <script>	Defines a client-side script
     *
     * @param string $value
     * @return $this
     */
    public static function script($value='') {
        return self::getMarkupHtml()->tag("script", array($value));
    }

    /**
     * <section>	Defines a section in a document
     *
     * @param string $value
     * @return $this
     */
    public static function section($value='') {
        return self::getMarkupHtml()->tag("section", array($value));
    }

    /**
     * <select>	Defines a drop-down list
     *
     * @param string $value
     * @return $this
     */
    public static function select($value='') {
        return self::getMarkupHtml()->tag("select", array($value));
    }

    /**
     * <small>	Defines smaller text
     *
     * @param string $value
     * @return $this
     */
    public static function small($value='') {
        return self::getMarkupHtml()->tag("small", array($value));
    }

    /**
     * <source>	Defines multiple media resources for media elements (<video> and <audio>)
     *
     * @return $this
     */
    public static function source() {
        return self::getMarkupHtml()->tag("source", array(null, "->"));
    }

    /**
     * <span>	Defines a section in a document
     *
     * @param string $value
     * @return $this
     */
    public static function span($value='') {
        return self::getMarkupHtml()->tag("span", array($value));
    }

    /**
     * <strike>	Not supported in HTML5. Use <del> or <s> instead.
     * Defines strikethrough text
     *
     * @param string $value
     * @return $this
     */
    public static function strike($value='') {
        return self::getMarkupHtml()->tag("strike", array($value));
    }

    /**
     * <strong>	Defines important text
     *
     * @param string $value
     * @return $this
     */
    public static function strong($value='') {
        return self::getMarkupHtml()->tag("strong", array($value));
    }

    /**
     * <style>	Defines style information for a document
     *
     * @param string $value
     * @return $this
     */
    public static function style($value='') {
        return self::getMarkupHtml()->tag("style", array($value));
    }

    /**
     * <sub>	Defines subscripted text
     *
     * @param string $value
     * @return $this
     */
    public static function sub($value='') {
        return self::getMarkupHtml()->tag("sub", array($value));
    }

    /**
     * <summary>	Defines a visible heading for a <details> element
     *
     * @param string $value
     * @return $this
     */
    public static function summary($value='') {
        return self::getMarkupHtml()->tag("summary", array($value));
    }

    /**
     * <sup>	Defines superscripted text
     *
     * @param string $value
     * @return $this
     */
    public static function sup($value='') {
        return self::getMarkupHtml()->tag("sup", array($value));
    }

    /**
     * <table>	Defines a table
     *
     * @param string $value
     * @return $this
     */
    public static function table($value='') {
        return self::getMarkupHtml()->tag("table", array($value));
    }

    /**
     * <tbody>	Groups the body content in a table
     *
     * @param string $value
     * @return $this
     */
    public static function tbody($value='') {
        return self::getMarkupHtml()->tag("tbody", array($value));
    }

    /**
     * <td>	Defines a cell in a table
     *
     * @param string $value
     * @return $this
     */
    public static function td($value='') {
        return self::getMarkupHtml()->tag("td", array($value));
    }

    /**
     * <textarea>	Defines a multiline input control (text area)
     *
     * @param string $value
     * @return $this
     */
    public static function textarea($value='') {
        return self::getMarkupHtml()->tag("textarea", array($value));
    }

    /**
     * <tfoot>	Groups the footer content in a table
     *
     * @param string $value
     * @return $this
     */
    public static function tfoot($value='') {
        return self::getMarkupHtml()->tag("tfoot", array($value));
    }

    /**
     * <th>	Defines a header cell in a table
     *
     * @param string $value
     * @return $this
     */
    public static function th($value='') {
        return self::getMarkupHtml()->tag("th", array($value));
    }

    /**
     * <thead>	Groups the header content in a table
     *
     * @param string $value
     * @return $this
     */
    public static function thead($value='') {
        return self::getMarkupHtml()->tag("thead", array($value));
    }

    /**
     * <time>	Defines a date/time
     *
     * @param string $value
     * @return $this
     */
    public static function time($value='') {
        return self::getMarkupHtml()->tag("time", array($value));
    }

    /**
     * <title>	Defines a title for the document
     *
     * @param string $value
     * @return $this
     */
    public static function title($value='') {
        return self::getMarkupHtml()->tag("title", array($value));
    }

    /**
     * <tr>	Defines a row in a table
     *
     * @param string $value
     * @return $this
     */
    public static function tr($value='') {
        return self::getMarkupHtml()->tag("tr", array($value));
    }

    /**
     * <track>	Defines text tracks for media elements (<video> and <audio>)
     *
     * @return $this
     */
    public static function track() {
        return self::getMarkupHtml()->tag("track", array(null, "->"));
    }

    /**
     * <tt>	Not supported in HTML5. Use CSS instead.
     * Defines teletype text
     *
     * @param string $value
     * @return $this
     */
    public static function tt($value='') {
        return self::getMarkupHtml()->tag("tt", array($value));
    }

    /**
     * <u>	Defines text that should be stylistically different from normal text
     *
     * @param string $value
     * @return $this
     */
    public static function u($value='') {
        return self::getMarkupHtml()->tag("u", array($value));
    }

    /**
     * <ul>	Defines an unordered list
     *
     * @param string $value
     * @return $this
     */
    public static function ul($value='') {
        return self::getMarkupHtml()->tag("ul", array($value));
    }

    /**
     * <var>	Defines a variable
     *
     * @param string $value
     * @return $this
     */
    public static function _var($value='') {
        return self::getMarkupHtml()->tag("var", array($value));
    }

    /**
     * <video>	Defines a video or movie
     *
     * @param string $value
     * @return $this
     */
    public static function video($value='') {
        return self::getMarkupHtml()->tag("video", array($value));
    }

    /**
     * <wbr>	Defines a possible line-break
     *
     * @param string $value
     * @return $this
     */
    public static function wbr($value='') {
        return self::getMarkupHtml()->tag("wbr", array($value));
    }
}