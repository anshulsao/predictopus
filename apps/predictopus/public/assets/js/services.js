YCustom.add('services', function(Y) {
    var ModuleLazyLoader = function() {
        ModuleLazyLoader.superclass.constructor.apply(this, arguments);
    };
    Y.namespace("services").ModuleLazyLoader = ModuleLazyLoader;
    Y.extend(ModuleLazyLoader, Y.Base, {
        initializer: function(config) {
            this._jsBase = '/assets/js/';
            this._cssBase = '/assets/css/';
            if (!config.modulePath || !config.parentId) {
                Y.log("Unable to lazy load module", "error");
            }
            this.moduleName = config.modulePath.split("/")[2];
            this.callModule();
        },
        callModule: function() {
            var modulePath = this.get("modulePath");
            var moduleParams = this.get("moduleParams");
            moduleParams["format"] = "json";
            var cfg = {
                method: "GET",
                data: moduleParams,
                on: {
                    complete: this.loadModule
                },
                timeout: 50000,
                failure: this.hideModule,
                context: this
            }
            this.jsLoaded = false;
            this.cssLoaded = false;
            this.markupLoaded = false;
            Y.io(modulePath, cfg);
        },
        hideModule: function(tlid, response) {
            var parent = Y.one("#" + this.get("parentId"));
            parent.addClass('z2t-hidden');
        },
        loadMarkup: function(parent, resp) {

            if (this.cssLoaded && this.jsLoaded) {
                parent.setHTML(resp.markup);
                if (resp.inline) {
                    eval(resp.inline);
                }
            }
        },
        loadModule: function(tlid, response) {
            var parent = Y.one("#" + this.get("parentId"));
            var self = this,
                    resp = response.responseText;

            if (!resp && parent) {
                parent.addClass('z2t-hidden');
                return;
            }
            try {
                resp = Y.JSON.parse(resp);
            }
            catch (e) {
                parent.addClass('z2t-hidden');
                return;
            }
            if (resp.markup) {
                if (resp.css && resp.css.length) {
                    Y.Get.css(resp.css, {
                        context: this
                    }, function(err) {
                        if (err) {
                            return;
                        } else {
                            this.cssLoaded = true;
                            this.loadMarkup(parent, resp);
                        }
                    });
                } else {
                    this.cssLoaded = true;
                }

                if (!parent) {
                    return;
                }

                if (resp.js && resp.js.length) {
                    Y.Get.js(resp.js, {
                        context: this
                    }, function(err) {
                        if (err) {
                            return;
                        }
                        this.jsLoaded = true;
                        this.loadMarkup(parent, resp);
                    });
                } else {
                    this.jsLoaded = true;
                    this.loadMarkup(parent, resp);
                }
            } else {
                parent.addClass('z2t-hidden');
            }
        }
    }, {
        ATTRS: {
            modulePath: {
                value: null
            },
            moduleParams: {
                value: {}
            },
            parentId: {
                value: null
            }
        }
    });

    /**
     * 
     * Service to handle stickiness
     */
    var STICK_BOTTOM = "bottom", STICK_TOP = "top";
    var StickyService = function() {
        StickyService.superclass.constructor.apply(this, arguments);
    };
    Y.namespace("services").StickyService = StickyService;
    Y.extend(StickyService, Y.Base, {
        initializer: function(config) {
            try {
                var placeHolder = Y.Node.create("<div></div>");
                this._placeHolderId = placeHolder.generateID();
                var position = config.stickPosition == STICK_BOTTOM ? "after" : "before";
                this.get("node").insert(placeHolder, position);
                if (config.stickPosition == STICK_BOTTOM) {
                    var nodeHeight = config.node.get('clientHeight');
                    var placeHolder = Y.one("#" + this._placeHolderId);
                    placeHolder.setStyle("position", "relative");
                    placeHolder.setStyle("top", nodeHeight);
                }
                this._winObj = Y.one(window);
                this.bindUI();

                if (config.callback) {
                    this.callback = config.callback;
                }
            } catch (exception) {

            }
        },
        bindUI: function() {
            this._winObj.on("scroll", this.recalculateAttributes, this);
            this._winObj.on("resize", this.recalculateAttributes, this, true);
        },
        recalculateAttributes: function(resize) {
            var stickPosition = this.get("stickPosition");
            var node = this.get("node");
            var placeHolder = Y.one("#" + this._placeHolderId);
            var windowY = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
            var windowBottomY = windowY + (window.innerHeight || document.documentElement.clientHeight);
            var nodeTopY = node.getY();
            var placeHolderTopY = placeHolder.getY();
            var nodeHeight = node.get("offsetHeight");
            placeHolder.setStyle("top", nodeHeight);
            var nodeBottomY = nodeTopY + nodeHeight;
            var parent = node.ancestor();
            var width = parent.get("offsetWidth") - this.get("offsetWidth");
            if (resize && node.hasClass("sticky") && this.get("ignore").split(",").indexOf("width") == -1) {
                node.setStyle("width", width);
            }
            switch (stickPosition) {
                case STICK_TOP:
                    this.evaluateStickToTop(node, nodeTopY, windowY,
                            placeHolderTopY, width);
                    break;
                case STICK_BOTTOM:
                    if (nodeBottomY > this._winObj.get("docHeight") - 50) {
                        return;
                    }
                    this.evaluateStickToBottom(node, nodeBottomY, windowBottomY,
                            placeHolderTopY, width);
                    break;
            }

        },
        evaluateStickToBottom: function(node, nodeBottomY, windowBottomY, placeHolderTopY, width) {
            if (!node.hasClass("sticky") && nodeBottomY <= windowBottomY) {
                node.addClass("sticky");
                node.setStyle("bottom", this.get("offset") + "px");
                node.setStyle("width", width);

                if (this.callback) {
                    this.callback();
                }

            } else {
                if (node.hasClass("sticky") && placeHolderTopY > windowBottomY) {
                    node.removeClass("sticky");
                    node.setStyle("width", "");
                    node.setStyle("bottom", "");
                    if (this.callback) {
                        this.callback(true);
                    }
                }

            }
        },
        evaluateStickToTop: function(node, nodeTopY, windowY, placeHolderTopY, width) {
            var offset = parseInt(this.get("offset")),
                    ignore = this.get("ignore").split(",");

            if (!node.hasClass("sticky") && nodeTopY <= windowY + offset) {
                node.addClass("sticky");

                if (ignore.indexOf("width") == -1) {
                    node.setStyle("width", width);
                }
                node.setStyle("top", this.get("offset") + "px");

                if (this.callback) {
                    this.callback();
                }

            } else {
                if (node.hasClass("sticky") && placeHolderTopY > windowY + offset) {
                    node.removeClass("sticky");
                    if (ignore.indexOf("width") == -1) {
                        node.setStyle("width", "");
                    }
                    node.setStyle("top", "");

                    if (this.callback) {
                        this.callback(true);
                    }
                }
            }
        }
    }, {
        ATTRS: {
            node: {
                value: null
            },
            offset: {
                value: 0
            },
            offsetWidth: {
                value: 0
            },
            stickPosition: {
                value: STICK_TOP
            },
            ignore: {
                value: ""
            }
        }
    });

}, '0.0.1', {
    requires: ['node', 'base', 'event', 'json-parse', 'io-base', 'get']
});