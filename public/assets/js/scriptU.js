document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.eventsSwiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true
        },

        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
        },

        effect: 'slide',
        speed: 600,

        touchRatio: 1,
        touchAngle: 45,
        grabCursor: true,

        direction: 'horizontal',
    });

    const swiperContainer = document.querySelector('.eventsSwiper');

    swiperContainer.addEventListener('mouseenter', () => {
        swiper.autoplay.stop();
    });

    swiperContainer.addEventListener('mouseleave', () => {
        swiper.autoplay.start();
    });
});

(function ($, window, undefined) {

    'use strict';

    // global
    var Modernizr = window.Modernizr, $body = $('body');

    $.DLMenu = function (options, element) {
        this.$el = $(element);
        this._init(options);
    };

    // the options
    $.DLMenu.defaults = {
        // classes for the animation effects
        animationClasses: { classin: 'dl-animate-in-1', classout: 'dl-animate-out-1' },
        // callback: click a link that has a sub menu
        // el is the link element (li); name is the level name
        onLevelClick: function (el, name) { return false; },
        // callback: click a link that does not have a sub menu
        // el is the link element (li); ev is the event obj
        onLinkClick: function (el, ev) { return false; }
    };

    $.DLMenu.prototype = {
        _init: function (options) {

            // options
            this.options = $.extend(true, {}, $.DLMenu.defaults, options);
            // cache some elements and initialize some variables
            this._config();

            var animEndEventNames = {
                'WebkitAnimation': 'webkitAnimationEnd',
                'OAnimation': 'oAnimationEnd',
                'msAnimation': 'MSAnimationEnd',
                'animation': 'animationend'
            },
                transEndEventNames = {
                    'WebkitTransition': 'webkitTransitionEnd',
                    'MozTransition': 'transitionend',
                    'OTransition': 'oTransitionEnd',
                    'msTransition': 'MSTransitionEnd',
                    'transition': 'transitionend'
                };
            // animation end event name
            this.animEndEventName = animEndEventNames[Modernizr.prefixed('animation')] + '.dlmenu';
            // transition end event name
            this.transEndEventName = transEndEventNames[Modernizr.prefixed('transition')] + '.dlmenu',
                // support for css animations and css transitions
                this.supportAnimations = Modernizr.cssanimations,
                this.supportTransitions = Modernizr.csstransitions;

            this._initEvents();

        },
        _config: function () {
            this.open = false;
            this.$trigger = this.$el.children('.dl-trigger');
            this.$menu = this.$el.children('ul.dl-menu');
            this.$menuitems = this.$menu.find('li:not(.dl-back)');
            this.$el.find('ul.dl-submenu').prepend('<li class="dl-back"><a href="#">السابق</a></li>');
            this.$back = this.$menu.find('li.dl-back');
        },
        _initEvents: function () {

            var self = this;

            this.$trigger.on('click.dlmenu', function () {

                if (self.open) {
                    self._closeMenu();
                }
                else {
                    self._openMenu();
                }
                return false;

            });

            this.$menuitems.on('click.dlmenu', function (event) {

                event.stopPropagation();

                var $item = $(this),
                    $submenu = $item.children('ul.dl-submenu');

                if ($submenu.length > 0) {

                    var $flyin = $submenu.clone().css('opacity', 0).insertAfter(self.$menu),
                        onAnimationEndFn = function () {
                            self.$menu.off(self.animEndEventName).removeClass(self.options.animationClasses.classout).addClass('dl-subview');
                            $item.addClass('dl-subviewopen').parents('.dl-subviewopen:first').removeClass('dl-subviewopen').addClass('dl-subview');
                            $flyin.remove();
                        };

                    setTimeout(function () {
                        $flyin.addClass(self.options.animationClasses.classin);
                        self.$menu.addClass(self.options.animationClasses.classout);
                        if (self.supportAnimations) {
                            self.$menu.on(self.animEndEventName, onAnimationEndFn);
                        }
                        else {
                            onAnimationEndFn.call();
                        }

                        self.options.onLevelClick($item, $item.children('a:first').text());
                    });

                    return false;

                }
                else {
                    self.options.onLinkClick($item, event);
                }

            });

            this.$back.on('click.dlmenu', function (event) {

                var $this = $(this),
                    $submenu = $this.parents('ul.dl-submenu:first'),
                    $item = $submenu.parent(),

                    $flyin = $submenu.clone().insertAfter(self.$menu);

                var onAnimationEndFn = function () {
                    self.$menu.off(self.animEndEventName).removeClass(self.options.animationClasses.classin);
                    $flyin.remove();
                };

                setTimeout(function () {
                    $flyin.addClass(self.options.animationClasses.classout);
                    self.$menu.addClass(self.options.animationClasses.classin);
                    if (self.supportAnimations) {
                        self.$menu.on(self.animEndEventName, onAnimationEndFn);
                    }
                    else {
                        onAnimationEndFn.call();
                    }

                    $item.removeClass('dl-subviewopen');

                    var $subview = $this.parents('.dl-subview:first');
                    if ($subview.is('li')) {
                        $subview.addClass('dl-subviewopen');
                    }
                    $subview.removeClass('dl-subview');
                });

                return false;

            });

        },
        closeMenu: function () {
            if (this.open) {
                this._closeMenu();
            }
        },
        _closeMenu: function () {
            var self = this,
                onTransitionEndFn = function () {
                    self.$menu.off(self.transEndEventName);
                    self._resetMenu();
                };

            this.$menu.removeClass('dl-menuopen');
            this.$menu.addClass('dl-menu-toggle');
            this.$trigger.removeClass('dl-active');

            if (this.supportTransitions) {
                this.$menu.on(this.transEndEventName, onTransitionEndFn);
            }
            else {
                onTransitionEndFn.call();
            }

            this.open = false;
        },
        openMenu: function () {
            if (!this.open) {
                this._openMenu();
            }
        },
        _openMenu: function () {
            var self = this;
            // clicking somewhere else makes the menu close
            $body.off('click').on('click.dlmenu', function () {
                self._closeMenu();
            });
            this.$menu.addClass('dl-menuopen dl-menu-toggle').on(this.transEndEventName, function () {
                $(this).removeClass('dl-menu-toggle');
            });
            this.$trigger.addClass('dl-active');
            this.open = true;
        },
        // resets the menu to its original state (first level of options)
        _resetMenu: function () {
            this.$menu.removeClass('dl-subview');
            this.$menuitems.removeClass('dl-subview dl-subviewopen');
        }
    };

    var logError = function (message) {
        if (window.console) {
            window.console.error(message);
        }
    };

    $.fn.dlmenu = function (options) {
        if (typeof options === 'string') {
            var args = Array.prototype.slice.call(arguments, 1);
            this.each(function () {
                var instance = $.data(this, 'dlmenu');
                if (!instance) {
                    logError("cannot call methods on dlmenu prior to initialization; " +
                        "attempted to call method '" + options + "'");
                    return;
                }
                if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
                    logError("no such method '" + options + "' for dlmenu instance");
                    return;
                }
                instance[options].apply(instance, args);
            });
        }
        else {
            this.each(function () {
                var instance = $.data(this, 'dlmenu');
                if (instance) {
                    instance._init();
                }
                else {
                    instance = $.data(this, 'dlmenu', new $.DLMenu(options, this));
                }
            });
        }
        return this;
    };

})(jQuery, window);


//uso
$(function () {
    $('#dl-menu').dlmenu();
});


const kodoLink = document.getElementById('kodoLink');
const modalOverlay = document.getElementById('modalOverlay');
const closeBtn = document.getElementById('closeBtn');

// فتح المودال
kodoLink.addEventListener('click', function (e) {
    e.preventDefault();
    modalOverlay.classList.add('show');
    document.body.style.overflow = 'hidden';
});

// إغلاق المودال عند الضغط على زر الإغلاق
closeBtn.addEventListener('click', function () {
    modalOverlay.classList.remove('show');
    document.body.style.overflow = 'hidden';
});

// إغلاق المودال عند الضغط خارج المحتوى
modalOverlay.addEventListener('click', function (e) {
    if (e.target === modalOverlay) {
        modalOverlay.classList.remove('show');
        document.body.style.overflow = 'hidden';
    }
});

// إغلاق المودال بضغط مفتاح Escape
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && modalOverlay.classList.contains('show')) {
        modalOverlay.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
});

