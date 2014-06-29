<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="http:<?php echo $jsUrl; ?>"></script>
<script id="module-inline-and-ads">
    var gptWrapper = {};
    YCustom.use('node', 'io', function(Y) {
<?php foreach ($moduleInlineJs as $inline) { ?>
            Y.later(1000, this, function() {
    <?php echo $inline; ?>
            });
<?php } ?>

        //Ads display
        Y.later(10, this, function() {
            try {
<?php echo $adsInlineJs; ?>;
<?php echo $adsDisplayInlineJs; ?>
            } catch (e) {

            }
        });

    });
</script>
<script id="stickyjs">
    YCustom.use('node', 'services', function(Y) {
        Y.later(1000, this, function() {
            try {
                if (Y.one("#right")) {
                    new Y.services.StickyService({
                        node: Y.one("#right>div"),
                        stickPosition: "bottom",
                        offsetWidth: 30
                    });
                }
            } catch (e) {
                console.log('Sticky Service failed');
            }
        });
    });

</script>

<script id="lazy-images">
    // Lazy loading images
    YCustom.use('node', 'imageloader', function(Y) {
        Y.later(10, this, function() {
            var foldGroup = new Y.ImgLoadGroup({name: 'fold group', foldDistance: 25});
            var nodes = Y.all('.asa-lazy')
            nodes.each(function(node) {
                var id = node.generateID();
                var img = node.getAttribute('data-src');
                node.removeClass('asa-lazy');
                foldGroup.registerImage({domId: id, srcUrl: img});
            });
        });
    });
</script>

