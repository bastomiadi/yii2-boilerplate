<?php
return array(
    // 'GET /v1/some/test/' => 'v1/some/test',
    // 'GET /v2/some/test/' => 'v2/some/test',
    //'GET categories2' => '/categories/index',
    //'<module:\w+>' => '<module>/v1/categories/index',
    '<module:news>/<action:\w+>' => '<module>/default/<action>',
    '<module:news>/<action:\w+>/<id:\d+>' => '<module>/default/<action>',
    '<module:posts>/<controller:\w+>' => '<module>/<controller>/index',
    '<module:posts>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>'
);