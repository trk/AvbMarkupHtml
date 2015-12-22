## AvbMarkupHtml - HTML tag manager for ProcessWire

This module allow you to use less HTML elements inside your PHP code !

### Module Author

* [İskender TOTOĞLU](http://altivebir.com)

### Example

#### $page->html()->tag('h1', array('class'=>'h1-class'))->render();

```php
$title = $page->html('title')->tag('h1', array('class'=>'h1-class'))->render();
echo $title;

// This will directly print
$page->html('title')->tag('h1', array('class'=>'h1-class'))->output();
```