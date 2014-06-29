<title><?php echo $title; ?></title>
<meta name="description" content="<?= $description ?>">
<?php echo $socialHeader; ?>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo $cssUrl; ?>" />
<?php
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']
        == 'https') {
    $yuiPath = 'https://yui-s.yahooapis.com/3.11.0/build/yui/yui-min.js';
    $yuiBasePath = 'https://yui-s.yahooapis.com/combo?';
} else {
    $yuiPath = "http://yui.yahooapis.com/3.11.0/build/yui/yui-min.js";
    $yuiBasePath = "http://yui.yahooapis.com/combo?";
}
?>
<script type="text/javascript" src="<?php echo $yuiPath; ?>"></script>
<link rel="icon" type="image/png" href="/favicon.ico" />
<script>
    if (!window.YCustom) {
        var YCustom = YUI({<?php
echo "comboBase:'$yuiBasePath'"
?>});
        YCustom.includes = [];
        YCustom.module_includes = [];
    }

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo $jsUrl; ?>"></script>