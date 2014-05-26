/*
 | 1. Before you start with this create a file in your logs folder (eg : 'query.log') and grant laravel write access to it.
 | 2. Place the snippet in your '/app/start/local.php' file. (or routes.php or anywhere...)
 | 3. Access artisan from your console and type this -
 |    $ php artisan tail --path="app/storage/logs/query.log" (better use full path)
*/ 

$path = storage_path().'/logs/query.log';

App::before(function($request) use($path) {
    $start = PHP_EOL.'=| '.$request->method().' '.$request->path().' |='.PHP_EOL;
  File::append($path, $start);
});

Event::listen('illuminate.query', function($sql, $bindings, $time) use($path) {
    // Uncomment this if you want to include bindings to queries
    //$sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
    //$sql = vsprintf($sql, $bindings);
    $time_now = (new DateTime)->format('Y-m-d H:i:s');;
    $log = $time_now.' | '.$sql.' | '.$time.'ms'.PHP_EOL;
  File::append($path, $log);
});
