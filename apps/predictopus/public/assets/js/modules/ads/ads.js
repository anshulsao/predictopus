YCustom.later(10, window, function() {
    YCustom.use('node', function(Y) {
        var banner = Y.one('#ad-banner');
        if(banner){
            banner.on('click', function(){
                banner.toggleClass('collapsed');
                
            });
        }
    });
});