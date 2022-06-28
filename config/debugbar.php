<?php

return [
  'local' => explode(',', env('LOCAL_MIDDLEWARE_DEBUGBAR')),
  'remote' => explode(',', env('REMOTE_MIDDLEWARE_DEBUGBAR')),
  'enabled' => true,
];
