<head>
    <meta content="width=device-width,minimum-scale=1.0" name="viewport">
</head>
<body>
<script src = "//yui.yahooapis.com/3.14.0/build/yui/yui-min.js"></script>
<script>
    if (!window.YCustom) {
        var YCustom = YUI();
        YCustom.includes = [];
        YCustom.module_includes = [];
    }

</script>
<?php if(isset($css)){?>
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo $css; ?>">
<?php }?>
<?php if(isset($js)){?>
<script src = "<?php echo $js; ?>"></script>
<?php }?>

<script>
    YCustom.use('node', function(Y) {
        Y.later(10, this, function() {<?php echo $inline; ?>
        });
    });
</script>
<div class="<?php echo $classes; ?>">
    <?php echo $markup; ?>
</div>
</body>