YCustom.later(10, window, function() {
    YCustom.use('node', 'io', 'json-parse', function(Y) {

        var fbLogin = Y.one("#lgn-fb");

        var host = window.location.host;
        try {
            fbLogin.on("click", triggerProviderLogin);
        } catch (e) {

        }


        function triggerProviderLogin() {
            var url = "http://" + host + "/login/oauth/facebook";
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