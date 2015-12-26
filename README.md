## AvbMarkupHtml - HTML tag manager for ProcessWire

This module allow you to use less HTML elements inside your PHP code !

### Module Author

* [İskender TOTOĞLU](http://altivebir.com)

### Example
#### Added hook for page. For make quick markup calls : $page->html();

```php
// All Configs
$config = array(
    'indent_with' => '    ',
    'tags_without_indentation' => 'link,img,meta',
    'WirePage' => null,
    'tag' => null,
    'tagSelfClosed' => null,
    'tagNoClose' => null,
    'tagCustom' => null,
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

// All Methods
$page->html(array('key', 'value')) // $config
    ->tag('string', $args=array())) // tag name, $args=content,tag-options => "/>" self closed, "->" no close, "=>" special tag
    ->addClass('string') // Element class name
    ->id('string') // Element id
    ->attr('key', 'value') // output : key='value'
    ->attributes(array('key', 'value')) // attributes
    ->data('key', 'value') // output : data-key='value'
    ->dataAttributes(array('key', 'value')) // data-attributes, this will add auto data- prefix to your attribute
    ->prepend('string') // a string value
    ->prepends(array('values')) // array for values
    ->text('string') // text for inner tag
    ->field('field_name', 'page_object') // Field name and page object
    ->texts(array()) // enter text array | array('Text 1', 'Text 2')
    ->fields(array(), 'page_object') // enter field names as array, a page | array('title', 'body')
    ->note('field_name', 'page') // enter a field name, a page
    ->label('field_name', 'page') // enter a field name, a page
    ->append('string') // a string value
    ->appends(array('values')) // array for values
    ->r(true|false) // Alis with ->render(); function
    ->render(true|false) // This will return result
    ->o(true|false) // Alias with ->output(); function
    ->output(true|false); // This will print result | default pretty print value is : false

// Working With ProcessWire
$ul = html::ul()->addClass('list');
foreach($page->children as $p) {
	$ul->child(
		html::li()
			->addClass('list-item')
			->data('id', $p->id)
			->child(
				html::a($p->title)
					->addClass('list-item-link')
					->attr('href', $p->url)
					->data('id', $p->id)->r()
			)->r()
	);
}
$ul->o(true);
/* output :
<ul class='list'>
    <li class='list-item' data-id='1057'>
        <a class='list-item-link' href='/en/villas/' data-id='1057'>
            Villas
        </a>
    </li>
    <li class='list-item' data-id='1001'>
        <a class='list-item-link' href='/en/location/' data-id='1001'>
            Location
        </a>
    </li>
    <li class='list-item' data-id='1090'>
        <a class='list-item-link' href='/en/guestbook/' data-id='1090'>
            Guestbook
        </a>
    </li>
    <li class='list-item' data-id='1055'>
        <a class='list-item-link' href='/en/contact/' data-id='1055'>
            Contact
        </a>
    </li>
    <li class='list-item' data-id='1005'>
        <a class='list-item-link' href='/en/site-map/' data-id='1005'>
            Site Map
        </a>
    </li>
</ul>
*/
html::div("Hey !")
    ->addClass('container')
    ->addClass('container-center')
    ->id('centered-container')
    ->output(true);
/* output ::
<div id='centered-container' class='container container-center'>
    Hey !
</div>
*/
html::ul()->addClass('list')->children(array(
	html::li('Li element value 1')->addClass('list-item')->render(),
	html::li('Li element value 2')->addClass('list-item')->render(),
	html::li('Li element value 3')->addClass('list-item')->render(),
	html::li('Li element value 4')->addClass('list-item')->render(),
	html::li('Li element value 5')->addClass('list-item')->render()
))->output(true);
/* output ::
<ul class='list'>
    <li class='list-item'>
        Li element value 1
    </li>
    <li class='list-item'>
        Li element value 2
    </li>
    <li class='list-item'>
        Li element value 3
    </li>
    <li class='list-item'>
        Li element value 4
    </li>
    <li class='list-item'>
        Li element value 5
    </li>
</ul>
*/

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

// Example #4 | Multiple child, prepend, append
$html = $page->html()->tag('div', array('class' => 'uk-container uk-container-center'));

$html->prepend(
    $page->html()->tag('div')->text('Prepend #1 !')->render()
);
$html->prepend(
    $page->html()->tag('div')->text('Prepend #2 !')->render()
);
$html->child(
    $page->html()->tag('div')->text('Hey !')->render()
);
$html->child(
    $page->html()->tag('div')->text('Foo !')->render()
);
$html->child(
    $page->html()->tag('div')->text('Bar !')->render()
);
$html->append(
    $page->html()->tag('div')->text('Append #1 !')->render()
);
$html->append(
    $page->html()->tag('div')->text('Append #2 !')->render()
);
$html->output();

// Example #5 | Create A HTML page
// Create Html Tag
$html = $page->html()->tag('html', array(
    'lang' => 'en',
    'dir' => 'ltr'
));

// Create Head Tag
$head = $page->html()->tag('head');

// Add TITLE inside HEAD tag
$head->child(
    $page->html()->tag('title')->text('My Website')->render()
);
// Put HEAD inside HTML Tag
$html->child($head->render());

// Create BODY Tag
$body = $page->html()->tag('body', array('class' => $page->template));

// Create DIV Tag
$container = $page->html()->tag('div', array('class' => 'container'));
$container->children(array(
    $page->html()->tag('h1', array('class' => 'h1-title'))->text('H1 Title')->render(),
    $page->html()->tag('div', array('class' => 'body-content'))->text('Body Content')->render()
));

// Put DIV.container inside BODY Tag
$body->child($container->render());

// Put BODY inside HTML Tag
$html->child($body->render());
$html->output(true); // Pretty HTML output

/* OUTPUT
<html lang='en' dir='ltr'>
<head>
    <title>
         My Website
    </title>
</head>
<body class='homepage'>
    <div class='container'>
        <h1 class='h1-title'>
             H1 Title
        </h1>
        <div class='body-content'>
             Body Content
        </div>
    </div>
</body>
</html>
*/

// Static Call Example
$article = html::tag('article', array('class' => 'uk-article'))->children(array(
    html::field('title')->tag('h1', array('class' => 'uk-article-title'))->render(),
    html::tag('hr:/', array('class' => 'uk-article-divider'))->render(),
    html::field('body')->render()
));
$article->output(true);

/* OUPUT
<article class='uk-article'>
    <h1 class='uk-article-title'>Page Title</h1>
    <hr class='uk-article-divider' />
    Body Content
</article>
*/
```