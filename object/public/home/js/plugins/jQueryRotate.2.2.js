(function ($) {
    for (var IE, supportedCSS, styles = document.getElementsByTagName("head")[0].style, toCheck = "transformProperty WebkitTransform OTransform msTransform MozTransform".split(" "),
    a = 0; a < toCheck.length; a++) styles[toCheck[a]] !== undefined && (supportedCSS = toCheck[a]);
    IE = eval('"v"=="\v"');
    jQuery.fn.extend({
        rotate: function (n) {
            var r, i, u, t, f, e;
            if (this.length !== 0 && typeof n != "undefined") {
                for (typeof n == "number" && (n = { angle: n }),
                r = [], i = 0, u = this.length; i < u; i++) t = this.get(i),
                t.Wilq32 && t.Wilq32.PhotoEffect ? t.Wilq32.PhotoEffect._handleRotation(n) : (f = $.extend(!0, {},
                n),
                e = new Wilq32.PhotoEffect(t, f)._rootObj, r.push($(e)));
                return r
            }
        },
        getRotateAngle: function () {
            for (var n, i = [], t = 0, r = this.length; t < r; t++) n = this.get(t),
            n.Wilq32 && n.Wilq32.PhotoEffect && (i[t] = n.Wilq32.PhotoEffect._angle);
            return i
        },
        stopRotate: function () {
            for (var n, t = 0, i = this.length; t < i; t++) n = this.get(t),
            n.Wilq32 && n.Wilq32.PhotoEffect && clearTimeout(n.Wilq32.PhotoEffect._timer)
        }
    });
    Wilq32 = window.Wilq32 || {};
    Wilq32.PhotoEffect = function () {
        return supportedCSS ? function (n, t) {
            n.Wilq32 = { PhotoEffect: this };
            this._img = this._rootObj = this._eventObj = n; this._handleRotation(t)
        } : function (n, t) {
            if (this._img = n, this._rootObj = document.createElement("span"),
            this._rootObj.style.display = "inline-block", this._rootObj.Wilq32 = { PhotoEffect: this },
            n.parentNode.insertBefore(this._rootObj, n),
            n.complete) this._Loader(t);
            else { var i = this; jQuery(this._img).bind("load", function () { i._Loader(t) }) }
        }
    }();
    Wilq32.PhotoEffect.prototype = {
        _setupParameters: function (n) {
            this._parameters = this._parameters || {};
            typeof this._angle != "number" && (this._angle = 0);
            typeof n.angle == "number" && (this._angle = n.angle);
            this._parameters.animateTo = typeof n.animateTo == "number" ? n.animateTo : this._angle; this._parameters.step = n.step || this._parameters.step || null; this._parameters.easing = n.easing || this._parameters.easing || function (n, t, i, r, u) { return -r * ((t = t / u - 1) * t * t * t - 1) + i };
            this._parameters.duration = n.duration || this._parameters.duration || 1e3; this._parameters.callback = n.callback || this._parameters.callback || function () { };
            n.bind && n.bind != this._parameters.bind && this._BindEvents(n.bind)
        },
        _handleRotation: function (n) {
            this._setupParameters(n);
            this._angle == this._parameters.animateTo ? this._rotate(this._angle) : this._animateStart()
        },
        _BindEvents: function (n) {
            var i, t;
            if (n && this._eventObj) {
                if (this._parameters.bind) { i = this._parameters.bind; for (t in i) i.hasOwnProperty(t) && jQuery(this._eventObj).unbind(t, i[t]) }
                this._parameters.bind = n; for (t in n) n.hasOwnProperty(t) && jQuery(this._eventObj).bind(t, n[t])
            }
        },
        _Loader: function () {
            return IE ? function (n) {
                var t = this._img.width, i = this._img.height; this._img.parentNode.removeChild(this._img);
                this._vimage = this.createVMLNode("image");
                this._vimage.src = this._img.src; this._vimage.style.height = i + "px"; this._vimage.style.width = t + "px"; this._vimage.style.position = "absolute"; this._vimage.style.top = "0px"; this._vimage.style.left = "0px"; this._container = this.createVMLNode("group");
                this._container.style.width = t; this._container.style.height = i; this._container.style.position = "absolute"; this._container.setAttribute("coordsize", t - 1 + "," + (i - 1));
                this._container.appendChild(this._vimage);
                this._rootObj.appendChild(this._container);
                this._rootObj.style.position = "relative"; this._rootObj.style.width = t + "px"; this._rootObj.style.height = i + "px"; this._rootObj.setAttribute("id", this._img.getAttribute("id"));
                this._rootObj.className = this._img.className; this._eventObj = this._rootObj; this._handleRotation(n)
            } : function (n) {
                this._rootObj.setAttribute("id", this._img.getAttribute("id"));
                this._rootObj.className = this._img.className; this._width = this._img.width; this._height = this._img.height; this._widthHalf = this._width / 2; this._heightHalf = this._height / 2; var t = Math.sqrt(this._height * this._height + this._width * this._width);
                this._widthAdd = t - this._width; this._heightAdd = t - this._height; this._widthAddHalf = this._widthAdd / 2; this._heightAddHalf = this._heightAdd / 2; this._img.parentNode.removeChild(this._img);
                this._aspectW = (parseInt(this._img.style.width, 10) || this._width) / this._img.width; this._aspectH = (parseInt(this._img.style.height, 10) || this._height) / this._img.height; this._canvas = document.createElement("canvas");
                this._canvas.setAttribute("width", this._width);
                this._canvas.style.position = "relative"; this._canvas.style.left = -this._widthAddHalf + "px"; this._canvas.style.top = -this._heightAddHalf + "px"; this._canvas.Wilq32 = this._rootObj.Wilq32; this._rootObj.appendChild(this._canvas);
                this._rootObj.style.width = this._width + "px"; this._rootObj.style.height = this._height + "px"; this._eventObj = this._canvas; this._cnv = this._canvas.getContext("2d");
                this._handleRotation(n)
            }
        }(),
        _animateStart: function () {
            this._timer && clearTimeout(this._timer);
            this._animateStartTime = +new Date; this._animateStartAngle = this._angle; this._animate()
        },
        _animate: function () {
            var t = +new Date, i = t - this._animateStartTime > this._parameters.duration, r, n; i && !this._parameters.animatedGif ? clearTimeout(this._timer) : ((this._canvas || this._vimage || this._img) && (r = this._parameters.easing(0, t - this._animateStartTime, this._animateStartAngle, this._parameters.animateTo - this._animateStartAngle, this._parameters.duration),
            this._rotate(~~(r * 10) / 10)),
            this._parameters.step && this._parameters.step(this._angle),
            n = this, this._timer = setTimeout(function () { n._animate.call(n) },
            10));
            this._parameters.callback && i && (this._angle = this._parameters.animateTo, this._rotate(this._angle),
            this._parameters.callback.call(this._rootObj))
        },
        _rotate: function () {
            var n = Math.PI / 180; return IE ? function (n) { this._angle = n; this._container.style.rotation = n % 360 + "deg" } : supportedCSS ? function (n) { this._angle = n; this._img.style[supportedCSS] = "rotate(" + n % 360 + "deg)" } : function (t) {
                this._angle = t; t = t % 360 * n; this._canvas.width = this._width + this._widthAdd; this._canvas.height = this._height + this._heightAdd; this._cnv.translate(this._widthAddHalf, this._heightAddHalf);
                this._cnv.translate(this._widthHalf, this._heightHalf);
                this._cnv.rotate(t);
                this._cnv.translate(-this._widthHalf, -this._heightHalf);
                this._cnv.scale(this._aspectW, this._aspectH);
                this._cnv.drawImage(this._img, 0, 0)
            }
        }()
    };
    IE && (Wilq32.PhotoEffect.prototype.createVMLNode = function () {
        document.createStyleSheet().addRule(".rvml", "behavior:url(#default#VML)");
        try {
            return document.namespaces.rvml || document.namespaces.add("rvml", "urn:schemas-microsoft-com:vml"),
            function (n) { return document.createElement("<rvml:" + n + ' class="rvml">') }
        }
        catch (n) { return function (n) { return document.createElement("<" + n + ' xmlns="urn:schemas-microsoft.com:vml" class="rvml">') } }
    }())
})(jQuery);