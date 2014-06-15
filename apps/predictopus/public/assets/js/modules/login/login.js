YCustom.later(10, window, function() {
    YCustom.use('node', 'io', 'json-parse', function(Y) {

        var fbLogin = Y.all("#lgn-fb, #fb-lgn-modal");
        var twLogin = Y.all("#lgn-tw, #tw-lgn-modal");
        var logoutText = Y.one("#sign-out");

        var host = window.location.host;
        try {
            fbLogin.on("click", function(){
                triggerProviderLogin('facebook');
            });
        } catch (e) {

        }
        try {
            twLogin.on("click", function(){
                triggerProviderLogin('twitter');
            });
        } catch (e) {

        }
        Y.Global.on("global-fb-login", function(e) {
            triggerProviderLogin('facebook');
        });
        Y.Global.on("global-tw-login", function(e) {
            triggerProviderLogin('twitter');
        });

        if (logoutText) {
            logoutText.on("click", function(e) {
                e.preventDefault();
                var cfg = {
                    method: "POST",
                    on: {
                        success: function() {
                            window.location.href = window.location.origin + window.location.pathname;
                        }
                    }
                };
                var url = "/login/_xhr/logoutaction";
                Y.io(url, cfg);
            });
        }
        if (!Y.one('body').hasClass('.loggedin')) {
            Y.all('#pn-submit, #hScore1, #hScore2, #fScore1, #fScore2, .pn-toolrow, #pn-login, #hp-lgn').on('click', function(e) {
                e.preventDefault();
                $('#myModal').modal({
                    keyboard: true,
                    backdrop: false
                });
            });
        }
        function triggerProviderLogin(provider) {
            var url = "http://" + host + "/login/oauth/"+provider;
            var winObj = Y.one(window)
                    , width = 600
                    , height = 480;
            var top = (winObj.get('winHeight') - height) / 2
                    , left = (winObj.get('winWidth') - width) / 2
                    ;
            var signinWin = window.open(url, 'Login_to_Predictopus', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=' + height + ',width=' + width + ',top=' + top + ',left=' + left);
            signinWin.focus();
        }

    });
});