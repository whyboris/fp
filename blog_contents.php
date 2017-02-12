<?php

$contribTypeArray = array(
    'contributor' => 'Contributor',
    'editor' => 'Editor',
    'staff' => 'Staff',
);

$deptArray = array(
    'dev' => 'Developers',
    'art' => 'Art',
    'editorial' => 'Editorial',
);

$privilegeArray = array(
    'coffee' => 'Free coffee',
    'icecream' => 'Free ice cream',
    'cookies' => 'Free cookies',
);



// for BLOG SETTINGS
registerMeta('Blog ID', 'blogId', 'blog', 3);
registerMeta('Name of blog', 'name', 'blog', 3);
registerMeta('Subtitle', 'subtitle', 'blog', 3);
registerMeta('Category', 'category', 'blog', 3);
registerMeta('Primary Author', 'primaryAuthor', 'blog', 3);

// for BLOG SETTINGS
registerMeta('Dropdown', 'name1', 'blog', 4, $contribTypeArray, 'dropdown');
registerMeta('Radio buttons', 'name2', 'blog', 4, $deptArray, 'radio');
registerMeta('Checkboxes', 'name3', 'blog', 4, $privilegeArray, 'checkboxes');
registerMeta('Comments', 'comments', 'blog', 4);

?>
