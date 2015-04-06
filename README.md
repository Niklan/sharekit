# ShareKit
ShareKit is Drupal module. ShareKit provide simple API for displaying social
share buttons and their statistics. You can theme social share buttons
whatever you like.

Available social buttons (machine name for using in API):

*  Facebook (facebook);
*  Twitter (twitter);
*  Google+ (pluseone);
*  VKontakte (vkontakte);
*  Mail.RU (mailru);
*  Odnoklassniki (odnoklassniki);
*  Pinterest (pinterest).

## API

Print single share button.
~~~php
print sharekit_get_button('facebook');
~~~

Print multiple share buttons.
~~~php
print sharekit_get_buttons('facebook, vkontakte, twitter');
~~~

Print share button with custom style.
~~~php
print sharekit_get_button('facebook', 'mystyle');
~~~

Then you must create one or more template files:

-  sharekit--NETWORK--STYLE.tpl.php
-  sharekit--STYLE.tpl.php

F.e.:
~~~
sharekit--NETWORK--mystyle.tpl.php
sharekit--mystyle.tpl.php
~~~

Print share button with options:
~~~php
print sharekit_get_button('facebook', NULL, array(
    'share_url' => 'http://niklan.net',
    'share_title' => 'My personal blog'
));
~~

You can use several options for share buttons:

*  share_url (str)
*  share_title (str)
*  label (str)
*  popup_width (int)
*  popup_height (int)
*  classes_array (array)

