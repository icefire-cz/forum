// Javascript for the VanillaBootstrap theme by Kasper Kronborg Isager
// Requires jQuery > v1.7.2 in order to function properly

jQuery(document).ready(function() {

	$('html').show();

	// Autosize textareas
	$('textarea.TextBox').livequery(function() {
		$(this).autosize();
	});

	// Make videos fluid
	$('.Video').fitVids();

	// Stop auto drafts
	$.fn.autosave = function(opts) {
		return;
	};

	// Smooth Scroll to Top
	$('.back-to-top').click(function(){
		$('html, body').animate({scrollTop:0}, 250);
		return false;
	});

	// Correctly position markup help
	$('.CommentForm .Buttons').each(function() {
		var $markuphelp = $(this).find('.MarkupHelp');
		var $content = $markuphelp.outerHTML();
		var $backbutton = $(this).find('.Back');
		$markuphelp.remove();
		$backbutton.after($content);
	});

	// Nice excerpt popovers
	$('.ItemDiscussion').each(function() {
		var $item = $(this).find('a.Title');
		var $title = $item.html();
		var $excerpt = $(this).find('.Excerpt').remove().text();
	});

	// Enable Popovers and Tooltips
	$("a[rel=popover]").popover();
	$("a[rel=tooltip]").tooltip();

	// Make Category selectors utilize Chosen
	$('.Category select').each(function() {

		// Trim the trailing spaces of all options
		// and make sure only clean spaces are used
		$(this).find('option').each(function() {
			var $text = $.trim($(this).text());
			$(this).contents().replaceWith($text.replace(/(\u00a0)/g,' '));
		});

		// Turn option[disabled] into an optgroup header
		// and sort options into newly created optgroup
		$(this).find('option[disabled]').each(function() {
			var $label = $(this).text();
			var $options = $(this).nextUntil('option[disabled]');
			var $optionsHtml = $('<option />').append($($options)).html();
			$(this).replaceWith($('<optgroup label="'+$label+'">'+$optionsHtml+'</optgroup>'));
		});

		$(this).chosen();

	});

	// Non-livequery based markup changes
	// ---------------------------------

	// Fix an annoying bug
	$('body').removeClass('thumbnail');

	// Icons
	$('.Tag-Closed').html('<i class="icon-lock icon-white"></i> ');

	// Buttons
	$('.Button').toggleClass('Button btn');
	$('.NavButton').toggleClass('NavButton btn');
	$('a.Cancel, .Danger').addClass('btn btn-danger');
	$('.Primary.btn, .DiscussionButton, .NewDiscussion').addClass('btn-primary');
	$('.ButtonGroup.Big .btn').addClass('btn-large');

	// Checkboxes and radio buttons
	$('.CheckBoxLabel').toggleClass('CheckBoxLabel checkbox');
	$('.RadioLabel').toggleClass('RadioLabel radio');

	// Labels and Badges
	$('.Tag').addClass('label');
	$('.Tag-Closed').addClass('label-important');
	$('.Tag-Announcement').addClass('label-info');
	$('.Alert').addClass('badge badge-important');
	$('.HasNew').addClass('badge badge-warning');

	// Alerts
	$('.AlertMessage, .InfoMessage').addClass('alert');
	$('.CasualMessage').addClass('alert alert-info');
	$('.Count').addClass('badge badge-info');
	$('.WarningMessage').addClass('alert alert-danger');

	// Pagination
	$('.NumberedPager').each(function() {
		$(this).addClass('btn-group');
		$(this).find('a, span').addClass('btn btn-small');
		$(this).find('.Highlight').addClass('active');
	});

	// Flyout Menus
	$('.MenuItems').toggleClass('MenuItems dropdown-menu');
	$('.FlyoutMenu').addClass('dropdown-menu');

	// Navigation
	$('.navbar form').each(function() {
		$(this).addClass('navbar-search pull-left');
		$(this).find('input').addClass('search-query span2').attr('placeholder','Search...');
		$(this).find('input[type="submit"]').remove();
	});
	$('.FilterMenu, .PanelInfo').each(function() {
		$(this).toggleClass('nav nav-list');
		$(this).find('.Active').toggleClass('Active active');
		//$(this).find('li a').append('<i class="icon-chevron-right"></i>');
	});

	// Change structure of panels
	$('.PanelInfo li:not(.Heading)').each(function() {
		var $text = $(this).contents()
			.filter(function() {
				return this.nodeType == Node.TEXT_NODE;
			}).text();
		var $text = '<span class="Aside">'+$.trim($text)+'</span>';
		var $img = $(this).find('img').outerHTML();
		var $link = $(this).find('a:not(.PhotoWrap)').outerHTML();
		$(this).empty().append($link).find('a').append($img + $aside + $text);
		$(this).find('.Aside:empty, .badge:empty').remove();
	});
	$('.PanelInfo li.Heading').each(function() {
		$(this).toggleClass('Heading nav-header');
	});

	// Grouped Buttons
	$('.ButtonGroup').each(function() {
		$(this).addClass('btn-group');
		$(this).find('.btn').addClass('btn-primary');
		$(this).find('.Handle').each(function() {
			$(this).addClass('dropdown-toggle').append('<span class="caret"></span>');
		});
	});
	$(document).delegate('.ButtonGroup > .Handle', 'click', function() {
		var buttonGroup = $(this).parents('.ButtonGroup');
		if (buttonGroup.hasClass('open')) {
			$('.ButtonGroup').removeClass('open');
		} else {
			$('.ButtonGroup').removeClass('open');
			buttonGroup.addClass('open');
		}
		return false;
	});

	// Pages
	$('.Entry').each(function() {
		$(this).find('#panel').remove();
		$(this).find('#content').toggleClass('span9 span6 offset3');
	});
	$('body.Conversations.add #panel, body.Vanilla.Post #panel').remove();
	$('body.Conversations.add #content, body.Vanilla.Post #content').toggleClass('span9 span10 offset1');

	// Livequery based markup changes
	// ------------------------------

	// Icons
	$('.Note.Closed').livequery(function() {
		$(this).prepend('<i class="icon-lock"></i> ');
	});

	// Buttons
	$('.Button').livequery(function() {
		$(this).toggleClass('Button btn');
	});
	$('a.Cancel').livequery(function() {
		$(this).addClass('btn btn-danger');
	});
	$('.Cancel').find('a').livequery(function() {
		$(this).addClass('btn btn-danger');
	});
	$('.ForgotPassword').livequery(function() {
		$(this).addClass('btn btn-danger');
	});
	$('.Primary.btn, .DiscussionButton').livequery(function() {
		$(this).addClass('btn-primary');
	});

	// Checkboxes and radio buttons
	$('.CheckBoxLabel').livequery(function() {
		$(this).toggleClass('CheckBoxLabel checkbox');
	});
	$('.RadioLabel').livequery(function() {
		$(this).toggleClass('RadioLabel radio');
	});

	// Pagination
	$('.MorePager').livequery(function() {
		$(this).find('a').addClass('btn btn-small btn-block');
	});

	// Flyout Menus
	$('.MenuItems').livequery(function() {
		$(this).toggleClass('MenuItems dropdown-menu');
	});
	$('.FlyoutMenu').livequery(function() {
		$(this).addClass('dropdown-menu');
	});
	$('.ac_results').livequery(function() {
		$(this).find('ul').addClass('typeahead dropdown-menu');
	});

	// Navigation
	$('.dropdown-menu ul li hr').livequery(function() {
		$(this).parent().addClass('divider');
		$(this).remove();
	});

	// Modals
	$('.Popup').livequery(function() {
		$(this).find('.Body').addClass('modal');
	});
	$('.Popup .Content').livequery(function() {
		$(this).children('h1, h2').addClass('modal-header');
		$(this).children('*:not(.modal-header):not(.Entry)').addClass('modal-body');
	});
	$('.Popup .Content h1, .Popup .Content h2').livequery(function() {
		$(this).addClass('modal-header');
	});
	$('.Popup .Content').find('> *:not(.modal-header):not(.Entry)').livequery(function() {
		$(this).addClass('modal-body');
	});
	$('.Popup .Footer').livequery(function() {
		$(this).find('span').addClass('close');
	});
	$('.Overlay').livequery(function() {
		$(this).fadeIn(150);
	});

	// Grouped Buttons
	$('.ButtonGroup').livequery(function() {
		$(this).find('.Dropdown').addClass('dropdown-menu');
	});

	//Notifications
	$('.InformMessage').livequery(function() {
		$(this).toggleClass('InformMessage alert').fadeIn(200);
		$(this).find('.Close').addClass('close');
	});

	// Plugin specific Javascript
	// ------------------

		// QnA plugin
		$('.DataBox-Comments .QnA-Item-Accepted').remove();
		$('.QnA-Tag-Answered, .QnA-Tag-Accepted').addClass('label-success');

});

// Recaptcha
var RecaptchaOptions = {
	theme : 'clean'
};

// OuterHTML function
jQuery.fn.outerHTML = function(s) {
	return s ? this.before(s).remove() : jQuery("<p>").append(this.eq(0).clone()).html();
};

// Detect clicks outside elements
(function(jQuery) {
	jQuery.fn.clickOutside = function(callback) {
		var outside = 1, self = $(this);
		self.cb = callback;
		this.click(function() {
			outside = 0;
		});
		$(document).click(function() {
			outside && self.cb();
			outside = 1;
		});
		return $(this);
	};
})(jQuery);

! function (e) {
    "use strict";
    var t = function (e, t) {
        this.init("tooltip", e, t);
    };
    t.prototype = {
        constructor: t,
        init: function (t, n, r) {
            var i, s;
            this.type = t;
            this.$element = e(n);
            this.options = this.getOptions(r);
            this.enabled = !0;
            if (this.options.trigger == "click") this.$element.on("click." + this.type, this.options.selector, e.proxy(this.toggle, this));
            else if (this.options.trigger != "manual") {
                i = this.options.trigger == "hover" ? "mouseenter" : "focus";
                s = this.options.trigger == "hover" ? "mouseleave" : "blur";
                this.$element.on(i + "." + this.type, this.options.selector, e.proxy(this.enter, this));
                this.$element.on(s + "." + this.type, this.options.selector, e.proxy(this.leave, this));
            }
            this.options.selector ? this._options = e.extend({}, this.options, {
                trigger: "manual",
                selector: ""
            }) : this.fixTitle()
        },
        getOptions: function (t) {
            t = e.extend({}, e.fn[this.type].defaults, t, this.$element.data());
            t.delay && typeof t.delay == "number" && (t.delay = {
                show: t.delay,
                hide: t.delay
            });
            return t;
        },
        enter: function (t) {
            var n = e(t.currentTarget)[this.type](this._options).data(this.type);
            if (!n.options.delay || !n.options.delay.show) return n.show();
            clearTimeout(this.timeout);
            n.hoverState = "in";
            this.timeout = setTimeout(function () {
                n.hoverState == "in" && n.show()
            }, n.options.delay.show);
        },
        leave: function (t) {
            var n = e(t.currentTarget)[this.type](this._options).data(this.type);
            this.timeout && clearTimeout(this.timeout);
            if (!n.options.delay || !n.options.delay.hide) return n.hide();
            n.hoverState = "out";
            this.timeout = setTimeout(function () {
                n.hoverState == "out" && n.hide()
            }, n.options.delay.hide);
        },
        show: function () {
            var e, t, n, r, i, s, o;
            if (this.hasContent() && this.enabled) {
                e = this.tip();
                this.setContent();
                this.options.animation && e.addClass("fade");
                s = typeof this.options.placement == "function" ? this.options.placement.call(this, e[0], this.$element[0]) : this.options.placement;
                t = /in/.test(s);
                e.remove().css({
                    top: 0,
                    left: 0,
                    display: "block"
                }).appendTo(t ? this.$element : document.body);
                n = this.getPosition(t);
                r = e[0].offsetWidth;
                i = e[0].offsetHeight;
                switch (t ? s.split(" ")[1] : s) {
                case "bottom":
                    o = {
                        top: n.top + n.height,
                        left: n.left + n.width / 2 - r / 2
                    };
                    break;
                case "top":
                    o = {
                        top: n.top - i,
                        left: n.left + n.width / 2 - r / 2
                    };
                    break;
                case "left":
                    o = {
                        top: n.top + n.height / 2 - i / 2,
                        left: n.left - r
                    };
                    break;
                case "right":
                    o = {
                        top: n.top + n.height / 2 - i / 2,
                        left: n.left + n.width
                    };
                }
                e.css(o).addClass(s).addClass("in");
            }
        },
        setContent: function () {
            var e = this.tip(),
                t = this.getTitle();
            e.find(".tooltip-inner")[this.options.html ? "html" : "text"](t);
            e.removeClass("fade in top bottom left right");
        },
        hide: function () {
            function r() {
                var t = setTimeout(function () {
                    n.off(e.support.transition.end).remove();
                }, 500);
                n.one(e.support.transition.end, function () {
                    clearTimeout(t);
                    n.remove();
                });
            }
            var t = this,
                n = this.tip();
            n.removeClass("in");
            e.support.transition && this.$tip.hasClass("fade") ? r() : n.remove();
            return this;
        },
        fixTitle: function () {
            var e = this.$element;
            (e.attr("title") || typeof e.attr("data-original-title") != "string") && e.attr("data-original-title", e.attr("title") || "").removeAttr("title")
        },
        hasContent: function () {
            return this.getTitle();
        },
        getPosition: function (t) {
            return e.extend({}, t ? {
                top: 0,
                left: 0
            } : this.$element.offset(), {
                width: this.$element[0].offsetWidth,
                height: this.$element[0].offsetHeight
            });
        },
        getTitle: function () {
            var e, t = this.$element,
                n = this.options;
            e = t.attr("data-original-title") || (typeof n.title == "function" ? n.title.call(t[0]) : n.title);
            return e;
        },
        tip: function () {
            return this.$tip = this.$tip || e(this.options.template);
        },
        validate: function () {
            if (!this.$element[0].parentNode) {
                this.hide();
                this.$element = null;
                this.options = null;
            }
        },
        enable: function () {
            this.enabled = !0;
        },
        disable: function () {
            this.enabled = !1;
        },
        toggleEnabled: function () {
            this.enabled = !this.enabled;
        },
        toggle: function () {
            this[this.tip().hasClass("in") ? "hide" : "show"]();
        },
        destroy: function () {
            this.hide().$element.off("." + this.type).removeData(this.type);
        }
    };
    e.fn.tooltip = function (n) {
        return this.each(function () {
            var r = e(this),
                i = r.data("tooltip"),
                s = typeof n == "object" && n;
            i || r.data("tooltip", i = new t(this, s));
            typeof n == "string" && i[n]();
        });
    };
    e.fn.tooltip.Constructor = t;
    e.fn.tooltip.defaults = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover",
        title: "",
        delay: 0,
        html: !0
    };
}(window.jQuery);
! function (e) {
    "use strict";
    var t = function (e, t) {
        this.init("popover", e, t);
    };
    t.prototype = e.extend({}, e.fn.tooltip.Constructor.prototype, {
        constructor: t,
        setContent: function () {
            var e = this.tip(),
                t = this.getTitle(),
                n = this.getContent();
            e.find(".popover-title")[this.options.html ? "html" : "text"](t);
            e.find(".popover-content > *")[this.options.html ? "html" : "text"](n);
            e.removeClass("fade top bottom left right in");
        },
        hasContent: function () {
            return this.getTitle() || this.getContent();
        },
        getContent: function () {
            var e, t = this.$element,
                n = this.options;
            e = t.attr("data-content") || (typeof n.content == "function" ? n.content.call(t[0]) : n.content);
            return e;
        },
        tip: function () {
            this.$tip || (this.$tip = e(this.options.template));
            return this.$tip
        },
        destroy: function () {
            this.hide().$element.off("." + this.type).removeData(this.type);
        }
    });
    e.fn.popover = function (n) {
        return this.each(function () {
            var r = e(this),
                i = r.data("popover"),
                s = typeof n == "object" && n;
            i || r.data("popover", i = new t(this, s));
            typeof n == "string" && i[n]();
        });
    };
    e.fn.popover.Constructor = t;
    e.fn.popover.defaults = e.extend({}, e.fn.tooltip.defaults, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'
    })
}(window.jQuery);
(function (e) {
    e.fn.fitVids = function (t) {
        var n = {
            customSelector: null
        }, r = document.createElement("div"),
            i = document.getElementsByTagName("base")[0] || document.getElementsByTagName("script")[0];
        r.className = "fit-vids-style";
        r.innerHTML = "&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>";
        i.parentNode.insertBefore(r, i);
        t && e.extend(n, t);
        return this.each(function () {
            var t = ["iframe[src*='player.vimeo.com']", "iframe[src*='www.youtube.com']", "iframe[src*='www.kickstarter.com']", "object", "embed"];
            n.customSelector && t.push(n.customSelector);
            var r = e(this).find(t.join(","));
            r.each(function () {
                var t = e(this);
                if (this.tagName.toLowerCase() == "embed" && t.parent("object").length || t.parent(".fluid-width-video-wrapper").length) return;
                var n = this.tagName.toLowerCase() == "object" ? t.attr("height") : t.height(),
                    r = n / t.width();
                if (!t.attr("id")) {
                    var i = "fitvid" + Math.floor(Math.random() * 999999);
                    t.attr("id", i);
                }
                t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top", r * 100 + "%");
                t.removeAttr("height").removeAttr("width");
            });
        });
    };
})(jQuery);
