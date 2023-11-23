<?php

    $directory = dirname(__DIR__,1)."/";

    require_once 'scssphp/scss.inc.php';

    use ScssPhp\ScssPhp\Compiler;

    $compiler = new Compiler();

    $compiler->setSourceMap(Compiler::SOURCE_MAP_FILE);
    $compiler->setSourceMapOptions([
        // relative or full url to the above .map file
        'sourceMapURL' => './main.map',

        // (optional) relative or full url to the .css file
        'sourceMapFilename' => 'assets/css/main.css',

        // partial path (server root) removed (normalized) to create a relative url
        'sourceMapBasepath' => $directory,

        // (optional) prepended to 'source' field entries for relocating source files
        'sourceRoot' => '/',
    ]);


    $compiler->setImportPaths('assets/scss/');

    // will search for 'assets/stylesheets/mixins.scss'
    //echo $compiler->compileString('@import "main.scss";')->getCss();

    $result = $compiler->compileString('@import "main.scss";');

    file_put_contents($directory.'assets/css/main.map', $result->getSourceMap());
    file_put_contents($directory.'assets/css/main.css', $result->getCss());

    ?>

    <link rel="stylesheet" href="./assets/css/main.css?time=<?php echo filemtime('./assets/css/main.css');?>">