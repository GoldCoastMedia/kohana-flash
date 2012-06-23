Kohana 3.2 Flash Message Module
===========================
**Authors: Dan Gibbs, Gold Coast Media**

**NOTE: This module hasn't been used or tested yet. It should work though**

This module adds an easy flash message system for the Kohana framework.

Installation
-----------
Add to the Kohana *module* directory and then add to your *application/bootstrap.php*

Example:

```
Kohana::modules(array(
	...
	'flash' => MODPATH.'flash',
	...
	));
```

Usage
-----
There are five default flash message types: *SUCCESS, INFO, NOTICE, WARNING, ERROR*

Setting a flash message:

```
Flash::notice('A notice message.');
```

To render and display flash messages:

```
<div><?php echo Flash::render(); ?></div>
```

Changing Views
------------
By default the view file *views/flash/default.php* is used. To set a different
view use:

```
Flash::view('another/view');
```
Alternatively you can set a different view when rendering the flash message:

```
<div><?php echo Flash::render('another/view'); ?></div>
```

