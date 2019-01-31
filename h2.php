<?php
    $path=dirname($_SERVER['SCRIPT_NAME']);
    header('Link: "<'.$path.'/libs/bootstrap.min.css>;rel=preload"',false);
    header('Link: "<'.$path.'/libs/bootstrap.min.js>;rel=preload"',false);
    header('Link: "<'.$path.'/libs/jquery.min.js>;rel=preload"',false);
    header('Link: "<'.$path.'/bower_components/crypto-js/crypto-js.js>;rel=preload"',false);
    header('Link: "<'.$path.'/fonts/glyphicons-halflings-regular.woff2>;rel=preload"',false);
    header('Link: "<'.$path.'/fonts/glyphicons-halflings-regular.woff>;rel=preload"',false);
    header('Link: "<'.$path.'/fonts/glyphicons-halflings-regular.ttf>;rel=preload"',false);
    header('Link: "<'.$path.'/index.js>;rel=preload"',false);
    header('Link: "<'.$path.'/index.css>;rel=preload"',false);

?>
