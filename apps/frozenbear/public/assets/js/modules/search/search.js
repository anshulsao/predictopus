YCustom.later(10, window, function() {
    YCustom.use('node', 'io', 'json-parse', 'base', 'event-key', function(Y) {
        var AJAX_SEARCH_URL = '/header/xhrsearch';
        var ioreq = null;
        var inputBox = Y.one('#search-input');
        var resultContainer = Y.one('#result-holder');

        inputBox.on('keyup', function(evt) {
            getSearchResults(evt);
        }, window);
        inputBox.on('focus', function(evt) {
            resultContainer.removeClass('hidden');
        }, window);

        resultContainer.on('clickoutside', function() {
            resultContainer.addClass('hidden');
        });
        var getSearchResults = function(evt) {
            var query = evt.target.get("value"),
                    params = {
                        method: 'GET',
                        data: {
                            'q': query
                        },
                        on: {
                            success: showResults
                        }
                    };
            if (!(evt.keyCode == 13 || evt.which == 13) && query.length > 1) {
                if (ioreq) {
                    ioreq.abort();
                }
                ioreq = Y.io(AJAX_SEARCH_URL, params);
            }
        };

        var template = "<ul class='nolist srl'>  \
    {{#users}} \
    <li class='srl-item srl-user' title='{{name}}'>  \
        <a href='/user/{{fb_id}}' class='srl-link'> \
        <div class='srl-link-cont'> \
            {{#profile_pic}}<img class='srl-pic' src='{{profile_pic}}'>{{/profile_pic}} \
            {{^profile_pic}}<img class='srl-pic' src='http://upload.wikimedia.org/wikipedia/commons/d/d3/User_Circle.png'>{{/profile_pic}} \
            <span class='srl-name'>{{name}}</span> \
        </div> \
        </a> \
    </li> \
    {{/users}} \
    {{#nouns}} \
    <li class='srl-item srl-noun' title='{{name}}'> \
        <a href='/stamp/{{id}}' class='srl-link'> \
        <div class='srl-link-cont'> \
            <img class='srl-pic' src='http://cdn.arstechnica.net/wp-content/uploads/2009/08/Ramp%20Champ_256x256.png'> \
            <span class='srl-name'>{{name}}</span> \
        </div> \
        </a> \
    </li> \
    {{/nouns}} \
</ul>";
        var showResults = function(tx, r) {
            var parsedResponse = Y.JSON.parse(r.responseText);
            var modData = parsedResponse.data.search;
            var html = Mustache.render(template, modData);
            resultContainer.set('innerHTML', html);
            resultContainer.removeClass('hidden');
        }
    });
});