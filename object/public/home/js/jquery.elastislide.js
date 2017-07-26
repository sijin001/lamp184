(function (window, $, undefined) {

    var currIndex = 2;
    var count = 0;
    var maxIndex = 0;
    var prevDir = "";

    // http://www.netcu.de/jquery-touchwipe-iphone-ipad-library
    $.fn.touchwipe = function (settings) {

        var config = {
            min_move_x: 20,
            min_move_y: 20,
            wipeLeft: function () { },
            wipeRight: function () { },
            wipeUp: function () { },
            wipeDown: function () { },
            preventDefaultEvents: true
        };

        if (settings) $.extend(config, settings);

        this.each(function () {
            var startX;
            var startY;
            var isMoving = false;

            function cancelTouch() {
                this.removeEventListener('touchmove', onTouchMove);
                startX = null;
                isMoving = false;
            }

            function onTouchMove(e) {
                if (config.preventDefaultEvents) {
                    e.preventDefault();
                }
                if (isMoving) {
                    var x = e.touches[0].pageX;
                    var y = e.touches[0].pageY;
                    var dx = startX - x;
                    var dy = startY - y;
                    if (Math.abs(dx) >= config.min_move_x) {
                        cancelTouch();
                        if (dx > 0) {
                            config.wipeLeft();
                        }
                        else {
                            config.wipeRight();
                        }
                    }
                    else if (Math.abs(dy) >= config.min_move_y) {
                        cancelTouch();
                        if (dy > 0) {
                            config.wipeDown();
                        }
                        else {
                            config.wipeUp();
                        }
                    }
                }
            }

            function onTouchStart(e) {
                if (e.touches.length == 1) {
                    startX = e.touches[0].pageX;
                    startY = e.touches[0].pageY;
                    isMoving = true;
                    this.addEventListener('touchmove', onTouchMove, false);
                }
            }
            if ('ontouchstart' in document.documentElement) {
                this.addEventListener('touchstart', onTouchStart, false);
            }
        });

        return this;
    };

    $.elastislide = function (options, element) {
        this.$el = $(element);
        this._init(options);
    };

    $.elastislide.defaults = {
        speed: 400,	// animation speed
        easing: '',	// animation easing effect
        imageW: 224,	// the images width
        margin: 0,	// image margin right
        border: 1,	// image border
        minItems: 1,	// the minimum number of items to show. 
        // when we resize the window, this will make sure minItems are always shown 
        // (unless of course minItems is higher than the total number of elements)
        current: 0,	// index of the current item
        // when we resize the window, the carousel will make sure this item is visible 
        onClick: function (ev, instance) {
            //判断是向右还是向左
            //console.log(ev.offset().left + ".." + ev.index());
            if (ev.offset().left >= 780) {
                if ($(".es-nav-next").css("display") == "block") {
                    prevDir = "right";
                    //兼容处理
                   
                    //prevImg.find("img").attr("src", prevImg.find("img").attr("data-url"))
                    //currImg.find("img").attr("src", currImg.attr("data-url"))
                    instance._slide('right');
                }
                else {


                }
               
            }
            else {
                if ($(".es-nav-prev").css("display") == "block") {
                    prevDir = "left";
                    instance._slide('left');
                }
             
            }

        } // click item callback
    };

    $.elastislide.prototype = {
        _init: function (options) {

         
            defaultHtml = $("#carousel1 ul").html();

            this.options = $.extend(true, {}, $.elastislide.defaults, options);

            // <ul>
            this.$slider = this.$el.find('ul');

            // <li>
            this.$items = this.$slider.children('li');

            // total number of elements / images
            this.itemsCount = this.$items.length;

            // cache the <ul>'s parent, since we will eventually need to recalculate its width on window resize
            this.$esCarousel = this.$slider.parent();

            // validate options
            this._validateOptions();

            // set sizes and initialize some vars...
            this._configure();

            // add navigation buttons
            this._addControls();
         
            // initialize the events
            this._initEvents();

            // show the <ul>
            this.$slider.show();
          
            $("#m-mall-con").show();
            // slide to current's position
            this._slideToCurrent(false);



        },
        _validateOptions: function () {

            if (this.options.speed < 0)
                this.options.speed = 450;
            if (this.options.margin < 0)
                this.options.margin = 4;
            if (this.options.border < 0)
                this.options.border = 1;
            if (this.options.minItems < 1 || this.options.minItems > this.itemsCount)
                this.options.minItems = 1;
            if (this.options.current > this.itemsCount - 1)
                this.options.current = 0;

        },
        _configure: function () {

            // current item's index
            this.current = this.options.current;

            // the ul's parent's (div.es-carousel) width is the "visible" width
            this.visibleWidth = this.$esCarousel.width();

            // test to see if we need to initially resize the items
            if (this.visibleWidth < this.options.minItems * (this.options.imageW + 2 * this.options.border) + (this.options.minItems - 1) * this.options.margin) {
                this._setDim((this.visibleWidth - (this.options.minItems - 1) * this.options.margin) / this.options.minItems);
                this._setCurrentValues();
                // how many items fit with the current width
                this.fitCount = this.options.minItems;
            }
            else {
                this._setDim();
                this._setCurrentValues();
            }

            // set the <ul> width
            this.$slider.css({
                width: this.sliderW
            });

        },
        _setDim: function (elW) {

            // <li> style
            this.$items.css({
                marginRight: this.options.margin,
                width: (elW) ? elW : this.options.imageW + 2 * this.options.border
            }).children('img').css({ // <a> style
                borderWidth: this.options.border
            });

        },
        _setCurrentValues: function () {

            // the total space occupied by one item
            this.itemW = this.$items.outerWidth(true);

            // total width of the slider / <ul>
            // this will eventually change on window resize
            this.sliderW = this.itemW * this.itemsCount;

            // the ul parent's (div.es-carousel) width is the "visible" width
            this.visibleWidth = this.$esCarousel.width();

            // how many items fit with the current width
            this.fitCount = Math.floor(this.visibleWidth / this.itemW);

        },
        _addControls: function () {

            this.$navNext = $('<span class="es-nav-next">Next</span>');
            this.$navPrev = $('<span class="es-nav-prev">Previous</span>');
            $('<div class="es-nav"/>')
			.append(this.$navPrev)
			.append(this.$navNext)
			.appendTo(this.$el);

            //this._toggleControls();

        },
        _toggleControls: function (dir, status) {

            
            // show / hide navigation buttons
            if (dir && status) {
                var _liLength = $(".es-carousel ul li").length / 2+2;
                if (status === 1) {
                    (dir === 'right') ? this.$navNext.show() : this.$navPrev.show();
                    if (_liLength == currIndex) {
                       
                       // alert(defaultHtml);
                        //$("#carousel1 ul").html(defaultHtml);
                        if (prevDir == "right")
                        {
                            currIndex = 2;
                            $(".es-carousel ul").css("margin-left", "0px");
                        }
                        
                    }
                    // if (dir === "left") { $(".es-carousel ul").css("margin-left", "-740px"); currIndex = 9; }
                }

                else {
                    //设置图片从头开始
                    if (dir === "right") {
                    
                        if (_liLength == currIndex) {
                            alert("1..");
                            //alert("currindex:"+currIndex);
                            currIndex = 1;
                            $(".es-carousel ul").css("margin-left", "224px");
                        }
                        else {
                            if (_liLength == currIndex - 1) {
                                alert("2..");
                                currIndex = 2;
                            }
                           // currIndex = 0;
                           // $(".es-carousel ul").css("margin-left", "224px");
                        }
                    }
                    if (dir === "left" && currIndex < 3 && count > 0) {
                       
                        if (_liLength > 0) {
                            //如果是1，2则可以循环点击
                            if (currIndex == 2) {
                                
                                //设置
                                currIndex = _liLength;
                                var _width = 224 * ($(".es-carousel ul li").length / 2);
                              //  alert(_width + "...." + currIndex);
                                $(".es-carousel ul").css("margin-left", "-" + _width + "px");
                            }

                            //if (currIndex == 1) {
                            //    //设置
                            //    currIndex = _liLength - 4;
                            //    var _width = 224 * (_liLength / 2)-224;
                            //    $(".es-carousel ul").css("margin-left", "-" + _width + "px");
                            //}
                        }
                    }
                    //if (dir === "left" && currIndex<= 3 ) {
                    //    console.log(111);
                    //    debugger;
                    //    $(".es-carousel ul").css("margin-left", "-740"); currIndex = 6;
                    //}
                    //(dir === 'right') ? this.$navNext.hide() : this.$navPrev.hide();
                }

            }
            else if (this.current === this.itemsCount - 1 || this.fitCount >= this.itemsCount)
                this.$navNext.hide();

        },
        _initEvents: function () {

            var instance = this;

            // window resize
            $(window).bind('resize.elastislide', function (event) {

                // set values again
                instance._setCurrentValues();

                // need to resize items
                if (instance.visibleWidth < instance.options.minItems * (instance.options.imageW + 2 * instance.options.border) + (instance.options.minItems - 1) * instance.options.margin) {
                    instance._setDim((instance.visibleWidth - (instance.options.minItems - 1) * instance.options.margin) / instance.options.minItems);
                    instance._setCurrentValues();
                    instance.fitCount = instance.options.minItems;
                }
                else {
                    instance._setDim();
                    instance._setCurrentValues();
                }

                instance.$slider.css({
                    width: instance.sliderW + 10 // TODO: +10px seems to solve a firefox "bug" :S
                });

                // slide to the current element
                clearTimeout(instance.resetTimeout);
                instance.resetTimeout = setTimeout(function () {
                    instance._slideToCurrent();
                }, 224);

            });

            // navigation buttons events
            this.$navNext.bind('click.elastislide', function (event) {

                //currIndex++;
                // console.log(currIndex);
                prevDir = "right";
                instance._slide('right');
                //设置内容区域
                //$("div.m-mall-con-content").hide();
                //$("div.m-mall-con-content:eq(" +  (currIndex) + ")").show();

            });

            this.$navPrev.bind('click.elastislide', function (event) {
                // currIndex--;
                // console.log(currIndex);
                prevDir = "left";
                instance._slide('left');

                //$("div.m-mall-con-content").hide();
                //$("div.m-mall-con-content:eq(" + (currIndex ) + ")").show();
            });

            // item click event
            this.$items.bind('click.elastislide', function (event) {
                instance.options.onClick($(this), instance);
                return false;
            });

            // touch events
            instance.$slider.touchwipe({
                wipeLeft: function () {
                    instance._slide('right');
                },
                wipeRight: function () {
                    instance._slide('left');
                }
            });

        },
        _slide: function (dir, val, anim, callback) {



            // if animating return
            if (this.$slider.is(':animated'))
                return false;

            // current margin left
            var ml = parseFloat(this.$slider.css('margin-left'));

            // val is just passed when we want an exact value for the margin left (used in the _slideToCurrent function)
            if (val === undefined) {


                // how much to slide?
                var amount = this.fitCount * this.itemW, val;

                if (amount < 0) return false;

                amount = "-224";
                // make sure not to leave a space between the last item / first item and the end / beggining of the slider available width
                if (dir === 'right' && this.sliderW - (Math.abs(ml) + amount) < this.visibleWidth) {
                    amount = this.sliderW - (Math.abs(ml) + this.visibleWidth) - this.options.margin; // decrease the margin left
                    // show / hide navigation buttons
                    this._toggleControls('right', -1);
                    this._toggleControls('left', 1);

                }
                else if (dir === 'left' && Math.abs(ml) - amount < 0) {
                    amount = Math.abs(ml);
                    // show / hide navigation buttons
                    this._toggleControls('left', -1);
                    this._toggleControls('right', 1);
                }
                else {

                    var fml; // future margin left
                    (dir === 'right')
						? fml = Math.abs(ml) + this.options.margin + Math.abs(amount)
						: fml = Math.abs(ml) - this.options.margin - Math.abs(amount);

                    // show / hide navigation buttons
                    if (fml > 0)
                        this._toggleControls('left', 1);
                    else
                        this._toggleControls('left', -1);

                    if (fml < this.sliderW - this.visibleWidth)
                        this._toggleControls('right', 1);
                    else
                        this._toggleControls('right', -1);

                }

                (dir === 'right') ? val = '-=' + amount : val = '+=' + amount

            }
            else {

                var fml = Math.abs(val); // future margin left

                if (Math.max(this.sliderW, this.visibleWidth) - fml < this.visibleWidth) {
                    val = -(Math.max(this.sliderW, this.visibleWidth) - this.visibleWidth);
                    if (val !== 0)
                        val += this.options.margin;	// decrease the margin left if not on the first position

                    // show / hide navigation buttons
                    this._toggleControls('right', -1);
                    fml = Math.abs(val);
                }

                // show / hide navigation buttons
                if (fml > 0)
                    this._toggleControls('left', 1);
                else
                    this._toggleControls('left', -1);

                if (Math.max(this.sliderW, this.visibleWidth) - this.visibleWidth > fml + this.options.margin)
                    this._toggleControls('right', 1);
                else
                    this._toggleControls('right', -1);

            }

            $.fn.applyStyle = (anim === undefined) ? $.fn.animate : $.fn.css;
            if (count > 0 && dir != "") {
                if (dir == "right") val = "-=224"
                else val = "+=224"
            }
            // console.log("dir:" + dir + ", count:" + count + ",val:" + val);
            if (dir == "right") {

                currIndex++;

                $(".es-carousel ul li").each(function (v) {
                    if (currIndex == v) {
                        $(this).find("img").attr("src", $(this).attr("data-url"));
                        $("#show_img").find("img").attr("src", $(this).attr("data-url"));
                        //$(this).addClass("liimg");
                        //$(this).find("img").addClass("imgstyle");
                    }
                    else {
                        $(this).find("img").attr("src", $(this).find("img").attr("data-url"));
                        //$(this).removeClass("liimg");
                        //$(this).find("img").removeClass("imgstyle");
                    }
                });

                //var prevImg = $(".es-carousel ul li:eq(" + (currIndex - 1) + ")");//.find("img");
                //var currImg = $(".es-carousel ul li:eq(" + (currIndex) + ")");
                //var def = prevImg.find("img").attr("def");
                //alert("src:" + prevImg.find("img").attr("src") + ",data-url：" + prevImg.find("img").attr("data-url"));
                //if (def != undefined && def != "")
                //    prevImg.find("img").attr("src", def);
                //else
                //    prevImg.find("img").attr("src", prevImg.attr("data-url"));


                //currImg.find("img").attr("src", currImg.attr("data-url"));
            }
            else if (dir == "left") {
                currIndex--;
                $(".es-carousel ul li").each(function (v) {
                  
                    if (currIndex == v) {
                        $(this).find("img").attr("src", $(this).attr("data-url"));
                        $("#show_img").find("img").attr("src", $(this).attr("data-url"));
                        //$(this).addClass("liimg");
                        //$(this).find("img").addClass("imgstyle");
                    }
                    else {
                        $(this).find("img").attr("src", $(this).find("img").attr("data-url"));
                        //$(this).removeClass("liimg");
                        //$(this).find("img").removeClass("imgstyle");
                    }
                });

                //console.log("currIndex:" + currIndex);
                //var prevImg = $(".es-carousel ul li:eq(" + (currIndex + 3) + ")");
                //var currImg = $(".es-carousel ul li:eq(" + (currIndex + 2) + ")");
                //prevImg.find("img").attr("src", prevImg.find("img").attr("data-url"));
                //currImg.find("img").attr("src", currImg.attr("data-url"));
            }

            $("div.m-mall-con-content").hide();
            $("div.m-mall-con-content:eq(" + (currIndex) + ")").show();
            $("div.m-mall-con-content:eq(" + (currIndex) + ")").css("position", "")
            console.log("currIndex:" + currIndex);
            //控制每次的条数
          
            var sliderCSS = { marginLeft: val };

            count++;
            var instance = this;

            this.$slider.applyStyle(sliderCSS, $.extend(true, [], {
                duration: this.options.speed, easing: this.options.easing, complete: function () {
                    if (callback) callback.call();
                }
            }));



        },
        _slideToCurrent: function (anim) {

            // how much to slide?
            var amount = this.current * this.itemW;
            this._slide('', -amount, anim);

        },
        add: function ($newelems, callback) {

            // adds new items to the carousel
            this.$items = this.$items.add($newelems);
            this.itemsCount = this.$items.length;
            this._setDim();
            this._setCurrentValues();
            this.$slider.css({
                width: this.sliderW
            });
            this._slideToCurrent();

            if (callback) callback.call($newelems);

        },
        destroy: function (callback) {
            this._destroy(callback);
        },
        _destroy: function (callback) {
            this.$el.unbind('.elastislide').removeData('elastislide');
            $(window).unbind('.elastislide');
            if (callback) callback.call();
        }
    };

    var logError = function (message) {
        if (this.console) {
            console.error(message);
        }
    };

    $.fn.elastislide = function (options) {
        if (typeof options === 'string') {
            var args = Array.prototype.slice.call(arguments, 1);

            this.each(function () {
                var instance = $.data(this, 'elastislide');
                if (!instance) {
                    logError("cannot call methods on elastislide prior to initialization; " +
					"attempted to call method '" + options + "'");
                    return;
                }
                if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
                    logError("no such method '" + options + "' for elastislide instance");
                    return;
                }
                instance[options].apply(instance, args);
            });
        }
        else {
            this.each(function () {
                var instance = $.data(this, 'elastislide');
                if (!instance) {
                    $.data(this, 'elastislide', new $.elastislide(options, this));
                }
            });
        }
        return this;
    };

})(window, jQuery);