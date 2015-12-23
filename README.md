## AvbMarkupHtml - HTML tag manager for ProcessWire

This module allow you to use less HTML elements inside your PHP code !

### Module Author

* [İskender TOTOĞLU](http://altivebir.com)

### Example
#### Added hook for page. For make quick markup calls : $page->html();

```php
// All Configs
$config = array(
    'htmlFormatter' => true,
    'indentWith' => '    ',
    'tagsWithoutIndentation' => 'html,link,img,meta',
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

// All Methods
$page->html(array('key', 'value')) // $config
    ->tag('string', array('key', 'value')) // tag name, quick attributes
    ->attributes(array('key', 'value')) // attributes
    ->dataAttributes(array('key', 'value')) // data-attributes, this will add auto data- prefix to your attribute
    ->prepend('string') // a string value
    ->prepends(array('values')) // array for values
    ->text('string') // text for inner tag
    ->field('field_name', 'page_object') // Field name and page object
    ->loop() // !! will work on this !!
    ->texts(array()) // !! will work on this !!
    ->fields(array()) // !! Will work on this !!
    ->note() // !! will work on this !!
    ->label() // !! Will work on this !!
    ->append('string') // a string value
    ->appends(array('values')) // array for values
    ->render() // This will return result
    ->output(); // This will print result

$title = $page->html('title')->tag('h1', array('class'=>'h1-class'))->render();
echo $title;

// This will directly print
$page->html('title')->tag('h1', array('class'=>'h1-class'))->output();

// Self Closed Tag
$modules->AvbMarkupHtml->html()->tag('hr:/')->output();

// Example #1
$page->html('title')->tag('h1', array('class' => 'my-h1-title'))->output();

// Example #2
$page->html('title', $pages->get('/contact/'))->tag('h1', array('class' => 'my-h1-title'))->output();

// Example #3
$modules->AvbMarkupHtml->html()->tag('div', array('class' => 'container'))->children(array(
    $page->html('title')->tag('h1', array('class' => 'my-title'))->render(),
    $page->html('body')->tag('div', array('class' => 'my-body'))->render()
))->output();
```