﻿/* Okler Themes - Style Switcher - 2.9.0 - 2014-03-20 */
;(function($){

var styleSwitcher = {
	initialized: !1,
	options: {
		color: "#CCC",
		gradient: "false"
	},
	initialize: function() {
		var a = this;
        if (!this.initialized) {
			if ($("html").hasClass("ie8")) {
				a.setLogo(!0);
				var b, c = theme_settings.assets + "css/skins/default-ie8.css";
				return b = document.createElement("link"), b.rel = "stylesheet", b.href = c, document.getElementsByTagName("head")[0].appendChild(b), !1
			}
			jQuery.styleSwitcherCachedScript = function(a, b) {
				return b = $.extend(b || {}, {
					dataType: "script",
					cache: !0,
					url: a
				}), jQuery.ajax(b)
			}, $("head").append($('<link rel="stylesheet">').attr("href", theme_settings.assets + "master/style-switcher/style-switcher.css")), $("head").append($('<link rel="stylesheet/less">').attr("href", theme_settings.assets + "master/less/skin.less")), $("head").append($('<link rel="stylesheet">').attr("href", theme_settings.assets + "master/style-switcher/colorpicker/css/colorpicker.css")), $.styleSwitcherCachedScript(theme_settings.assets + "master/style-switcher/colorpicker/js/colorpicker.js").done(function() {
				less = {
					env: "development"
				}, $.styleSwitcherCachedScript(theme_settings.assets + "master/less/less.js").done(function() {
					a.build(), a.events(), null != $.cookie("colorGradient") && (a.options.gradient = $.cookie("colorGradient")), null != $.cookie("skin") ? a.setColor($.cookie("skin")) : a.container.find("ul[data-type=colors] li:first a").click(), null != $.cookie("layout") && a.setLayoutStyle($.cookie("layout")), null != $.cookie("backgroundcolor") && a.setBackgroundColor($.cookie("backgroundcolor")), null != $.cookie("pattern") && a.setPattern($.cookie("pattern")), null == $.cookie("initialized") && (a.container.find("h4 a").click(), $.cookie("initialized", !0)), a.initialized = !0, $(window).load(function() {
						$.event.trigger({
							type: "styleSwitcher.setColor",
							color: a.options.color
						})
					})
				})
			}), $.styleSwitcherCachedScript(theme_settings.assets + "master/style-switcher/cssbeautify/cssbeautify.js").done(function() {})
		}
	},
	build: function() {
		var a = this,
			b = $("<div />").attr("id", "styleSwitcher").addClass("style-switcher hidden-xs").append($("<h4 />").html("Style Switcher").append($("<a />").attr("href", "#").append($("<i />").addClass("fa fa-cogs"))), $("<div />").addClass("style-switcher-mode").append($("<div />").addClass("options-links mode").append($("<a />").attr("href", "#").attr("data-mode", "basic").addClass("active").html("Basic"), $("<a />").attr("href", "#").attr("data-mode", "advanced").html("Advanced"))), $("<div />").addClass("style-switcher-wrap").append($("<h5 />").html("Colors"), $("<ul />").addClass("options colors").attr("data-type", "colors"), $("<h5 />").html("Layout Style"), $("<div />").addClass("options-links layout").append($("<a />").attr("href", "#").attr("data-layout-type", "wide").addClass("active").html("Wide"), $("<a />").attr("href", "#").attr("data-layout-type", "boxed").html("Boxed")), $("<div />").hide().addClass("patterns").append($("<h5 />").html("Background Patterns"), $("<ul />").addClass("options").attr("data-type", "patterns")), $("<hr />"), $("<div />").addClass("options-links").append($("<a />").addClass("reset").attr("href", "#").html("Reset"), $("<a />").addClass("get-css").attr("href", "#getCSSModal").html("Get Skin CSS"))));
		$("body").append(b);
		var c = '<div class="modal fade" id="getCSSModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> <h4 class="modal-title" id="cssModalLabel">Skin CSS</h4> </div> <div class="modal-body"> <div class="alert alert-info fade in" id="addBoxedClassInfo">Please add the <strong>&quot;boxed&quot;</strong> class to the &lt;body&gt; element.</div><textarea id="getCSSTextarea" class="get-css" readonly></textarea></div> </div> </div> </div> </div>';
		$("body").append(c), this.container = $("#styleSwitcher"), this.container.find("div.options-links.mode a").click(function(a) {
			a.preventDefault();
			var b = $(this).parents(".mode");
			b.find("a.active").removeClass("active"), $(this).addClass("active"), "advanced" == $(this).attr("data-mode") ? $("#styleSwitcher").addClass("advanced").removeClass("basic") : $("#styleSwitcher").addClass("basic").removeClass("advanced")
		});
		var d = [{
			Hex: "#f9c56a",
			colorName: "Yellow"
		},
		{
			Hex: "#dc8068",
			colorName: "Brown"
		},
		{
			Hex: "#00becc",
			colorName: "Cyan"
		},
		{
			Hex: "#5bb75b",
			colorName: "Green"
		},
		{
			Hex: "#ff7149",
			colorName: "Orange"
		},
		{
			Hex: "#fba1a1",
			colorName: "Pink"
		},
		{
			Hex: "#dc3522",
			colorName: "Red"
		},
		{
			Hex: "#45b5f5",
			colorName: "Blue"
		}],
			e = this.container.find("ul[data-type=colors]");
		if ($.each(d, function(a) {
			var b = $("<li />").append($("<a />").css("background-color", d[a].Hex).attr({
				"data-color-hex": d[a].Hex,
				"data-color-name": d[a].colorName,
				href: "#",
				title: d[a].colorName
			}));
			e.append(b)
		}), null != $.cookie("skin")) var f = $.cookie("skin");
		else
		var f = d[0].Hex;
		var g = $("<div />"),
			h = $("<div />").attr("id", "colorPickerHolder").attr("data-color", f).attr("data-color-format", "hex").addClass("color-picker");
		e.before(g, h), e.find("a").click(function(b) {
			b.preventDefault(), a.setColor($(this).attr("data-color-hex")), $("#colorPickerHolder").ColorPickerSetColor($(this).attr("data-color-hex"))
		}), $("#colorPickerHolder").ColorPicker({
			color: f,
			flat: !0,
			livePreview: !1,
			onChange: function(b, c) {
				a.setColor("#" + c)
			}
		}), $("#colorPickerHolder .colorpicker_color, #colorPickerHolder .colorpicker_hue").on("mousedown", function(b) {
			b.preventDefault(), a.isChanging = !0
		}).on("mouseup", function(b) {
			b.preventDefault(), a.isChanging = !1, setTimeout(function() {
				a.setColor("#" + $("#colorPickerHolder .colorpicker_hex input").val())
			}, 100)
		}), null != $.cookie("colorGradient") && (a.options.gradient = $.cookie("colorGradient")), "true" == a.options.gradient ? $("#colorGradient").attr("checked", "checked") : $("#colorGradient").removeAttr("checked"), $("#colorGradient").on("change", function() {
			var b = $(this).is(":checked").toString();
			a.options.gradient = b, a.setColor(a.options.color), $.cookie("colorGradient", b)
		}), this.container.find("div.options-links.layout a").click(function(b) {
			b.preventDefault(), a.setLayoutStyle($(this).attr("data-layout-type"), !0)
		}), this.container.find("div.options-links.background-color a").click(function(b) {
			b.preventDefault(), a.setBackgroundColor($(this).attr("data-background-color"))
		}), this.container.find("div.options-links.website-type a").click(function(a) {
			a.preventDefault(), $.cookie("showSwitcher", !0), self.location = $(this).attr("href")
		}), $("body").hasClass("one-page") ? (this.container.find("div.options-links.website-type a:last").addClass("active"), this.container.find("div.options-links.layout").prev().remove(), this.container.find("div.options-links.layout").remove()) : this.container.find("div.options-links.website-type a:first").addClass("active");
		var i = ["wood_pattern", "shattered", "vichy", "random_grey_variations", "irongrip", "gplaypattern", "diamond_upholstery", "denim", "crissXcross", "climpek", "pw_maze_white", "tweed"],
			j = this.container.find("ul[data-type=patterns]");
		$.each(i, function(a, b) {
			var c = $("<li />").append($("<a />").addClass("pattern").css("background-image", "url(" + theme_settings.assets + "img/patterns/" + b + ".png)").attr({
				"data-pattern": b,
				href: "#",
				title: b.charAt(0).toUpperCase() + b.slice(1)
			}));
			j.append(c)
		}), j.find("a").click(function(b) {
			b.preventDefault(), a.setPattern($(this).attr("data-pattern"))
		}), a.container.find("a.reset").click(function(b) {
			b.preventDefault(), a.reset()
		}), a.container.find("a.get-css").click(function(b) {
			b.preventDefault(), a.getCss()
		})
	},
	events: function() {
		var a = this;
		a.container.find("h4 a").click(function(b) {
			b.preventDefault(), a.container.hasClass("active") ? a.container.animate({
				left: "-" + a.container.width() + "px"
			}, 300).removeClass("active") : a.container.animate({
				left: "0"
			}, 300).addClass("active")
		}), (null != $.cookie("showSwitcher") || $("body").hasClass("one-page")) && (a.container.find("h4 a").click(), $.removeCookie("showSwitcher"))
	},
	setColor: function(a) {
		var b = this;
		return this.isChanging ? !1 : (b.options.color = a, less.modifyVars({
			gradient: b.options.gradient,
			skinColor: a
		}), $.cookie("skin", a), this.setLogo(), void $.event.trigger({
			type: "styleSwitcher.setColor",
			color: a
		}))
	},
	setLayoutStyle: function(a, b) {
		if ($("body").hasClass("one-page")) return !1;
		if ($.cookie("layout", a), b) return $.cookie("showSwitcher", !0), window.location.reload(), !1;
		var c = this.container.find("div.options-links.layout"),
			d = this.container.find("div.patterns");
		c.find("a.active").removeClass("active"), c.find("a[data-layout-type=" + a + "]").addClass("active"), "wide" == a ? (d.hide(), $("html").removeClass("boxed"), $.removeCookie("pattern")) : (d.show(), $("html").addClass("boxed"), null == $.cookie("pattern") && this.container.find("ul[data-type=patterns] li:first a").click())
	},
	setBackgroundColor: function(a) {
        
        $.cookie("backgroundcolor", a);
		var b = this.container.find("div.options-links.background-color");
		b.find("a.active").removeClass("active"), b.find("a[data-background-color=" + a + "]").addClass("active"), "dark" == a ? ($("html").addClass("dark"), $.event.trigger({
			type: "styleSwitcher.setBackgroundColor",
			color: "dark"
		})) : ($("html").removeClass("dark"), $.event.trigger({
			type: "styleSwitcher.setBackgroundColor",
			color: ""
		})), this.setLogo()
	},
	setPattern: function(a) {
		var b = $("html").hasClass("boxed");
		b && $("html").css("background-image", "url(" + theme_settings.assets + "img/patterns/" + a + ".png)"), $.cookie("pattern", a)
	},
	setLogo: function(a) {
		a || $.cookie("skin") == this.container.find("ul[data-type=colors] li:first a").attr("data-color-hex") && "dark" != $.cookie("backgroundcolor") ? $("h1.logo img").attr("src", theme_settings.assets + "img/logo-default.png") : "dark" == $.cookie("backgroundcolor") ? $("h1.logo img").attr("src", theme_settings.assets + "img/logo-dark.png") : $("h1.logo img").attr("src", theme_settings.assets + "img/logo.png")
	},
	reset: function() {
		$.removeCookie("skin"), $.removeCookie("layout"), $.removeCookie("backgroundcolor"), $.removeCookie("pattern"), $.removeCookie("colorGradient"), $.cookie("showSwitcher", !0), window.location.reload()
	},
	getCss: function() {
		raw = "";
		var a = $("html").hasClass("boxed");
		a ? (raw = 'html { background-image: url("' + theme_settings.assets + 'img/patterns/' + $.cookie("pattern") + '.png"); }', $("#addBoxedClassInfo").show()) : $("#addBoxedClassInfo").hide(), $("#getCSSTextarea").text(""), $("#getCSSTextarea").text($('style[id^="less:"]').text()), $("#getCSSModal").modal("show"), options = {
			indent: "	",
			autosemicolon: !0
		}, raw += $("#getCSSTextarea").text(), $("#getCSSTextarea").text(cssbeautify(raw, options))
	}
};
styleSwitcher.initialize();

})(jQuery);