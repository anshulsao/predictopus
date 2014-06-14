YCustom.later(10, window, function() {
    YCustom.use('node', 'io', 'json-parse', function(Y) {

        var SAVE_PREF_URL = '/predictnow/_xhr/save';
        var templates = {
            'all': 'You predicted that {{^teamW}} the match will be a draw{{/teamW}} {{#teamW}}<strong>{{{teamW}}}</strong>' +
                    ' will win {{/teamW}}{{#hScore}}, half time score will be <strong>{{hScore}}</strong>{{/hScore}}' +
                    '{{#fScore}} and the full time score will be <strong>{{fScore}}</strong>{{/fScore}}.',
        };
        var submit = Y.one('#pn-submit');
        var hScore1Ele = Y.one('#hScore1');
        var hScore2Ele = Y.one('#hScore2');
        var fScore1Ele = Y.one('#fScore1');
        var fScore2Ele = Y.one('#fScore2');
        var errorDiv = Y.one('#pn-errorDiv');
        var infoDiv = Y.one('#pn-infoDiv');
        var gameid = submit.getAttribute('data-gameid');
        var showSummary = submit.getAttribute('data-show-summary');
        if (showSummary) {
                parseData(false);
        }

        submit.on('click', function() {
            parseData(true);
        });
        function parseData(fireSave) {
            var hScore1 = hScore1Ele.get('value');
            var hScore2 = hScore2Ele.get('value');
            var fScore1 = fScore1Ele.get('value');
            var fScore2 = fScore2Ele.get('value');
            var hScore = hScore1 && hScore2 ? hScore1 + " - " + hScore2 : '';
            var fScore = fScore1 && fScore2 ? fScore1 + " - " + fScore2 : '';
            if (validate(hScore1, hScore2, fScore1, fScore2)) {
                var result = fScore1 > fScore2 ? 1 : fScore1 < fScore2 ? 2 : 0;
                // team1/2Global vars set in mustache
                try {
                    var teamW = result == 1 ? team1 : result == 2 ? team2 : 0;
                } catch (e) {
                    var teamW = '  ';
                }
                var template = templates['all'];
                var data = {
                    'hScore': hScore,
                    'fScore': fScore,
                    'teamW': teamW
                };
                var html = Mustache.render(template, data);
                showMessage(html, 'info');
                if (fireSave) {
                    var cfg = {
                        method: 'POST',
                        data: {
                            hScore1: hScore1,
                            hScore2: hScore2,
                            fScore1: fScore1,
                            fScore2: fScore2,
                            result: result,
                            gameid: gameid
                        },
                        on: {
                            success: function(tlid, response) {
                                var res = response.response;
                                var resO = Y.JSON.parse(res);
                                if (resO.status == "error") {
                                    showMessage(resO.message, 'error');
                                } else {
                                    submit.setHTML('Edit Prediction');
                                }
                            }
                        }
                    };
                    Y.io(SAVE_PREF_URL, cfg);
                }
            }
        }

        function showMessage(msg, type) {
            switch (type) {
                case 'error':
                    errorDiv.setHTML(msg);
                    errorDiv.removeClass('hidden');
                    break;
                case 'info':
                    infoDiv.setHTML(msg);
                    infoDiv.removeClass('hidden');
                    break;
            }

        }
        /**
         *  TODO: Add more validations
         * @param {type} hScore1
         * @param {type} hScore2
         * @param {type} fScore1
         * @param {type} fScore2
         * @param {type} winningELe
         * @returns {Boolean}
         */
        function validate(hScore1, hScore2, fScore1, fScore2) {
            var error = false;
            if(!fScore1 || !fScore2){
                error = 'Full time score prediction is mandatory.';
            }
            if(!hScore1 || !hScore2){
                error = 'We have made half time score prediction mandatory. '
                        + 'If you predicted earlier, you can update your prediction or leave it as is.';
            }
            if ((fScore1 !== '' && fScore1 < hScore1) ||
                    (fScore2 !== '' && fScore2 < hScore2)) {
                error = 'Full time score cannot be less than half time score.';
            }

            if (error) {
                showMessage(error, 'error');
                return false;
            }
            errorDiv.addClass('hidden');
            return true;
        }
    });
});