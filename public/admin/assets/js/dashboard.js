/* ============================================================
 * Dashboard
 * Generates widgets in the dashboard
 * For DEMO purposes only. Extract what you need.
 * ============================================================ */
(function($) {

    'use strict';

    $(document).ready(function() {
        //Widget 2
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            center: true,
            loop: true,
            nav: true,
            margin: 0,
            items: 1
        });
        owl.on('mousewheel', '.owl-stage', function(e) {
            if (e.deltaY > 0) {
                owl.trigger('next.owl');
            } else {
                owl.trigger('prev.owl');
            }
            e.preventDefault();
        });
        // Widget 17
        // Initialize Skycons
        var icons = new Skycons(),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;
        for (i = list.length; i--;) {
            var weatherType = list[i],
                elements = document.getElementsByClassName(weatherType);
            for (var e = elements.length; e--;) {
                icons.set(elements[e], weatherType);
            }
        }

        icons.play();
        var _background = $('.widget-1').find('.active').data('image');
        var _widget = $('.widget-1');

        _widget.css('background-image', 'url(../../images/news/' + _background + ')');
        $(".widget-1 .metro").liveTile({
            mode: 'slide',
            stops: "-180px,-360px,-540px,0px",
            // animationStarting: function(tileData, $front, $back) {
            //     var _background = $(this).find('.active').data('image');
            //     var css = '<style id="pseudo">.widget-1::after{background-image: url(../../storage/photos/1/news/' + _background + ') !important;}</style>';
            //     document.head.insertAdjacentHTML('beforeEnd', css);
            // },
            animationComplete: function(tileData, $front, $back) {
                var _background = $(this).find('.active').data('image');
                var _widget = $(this).closest('.widget-1');
                _widget.css('background-image', 'url(../../images/news/' + _background + ')');
            }
        });
        $(".widget-7 .metro").liveTile();
        // Init portlets

        var bars = $('.widget-loader-bar');
        var circles = $('.widget-loader-circle');
        var circlesLg = $('.widget-loader-circle-lg');
        var circlesLgMaster = $('.widget-loader-circle-lg-master');

        bars.each(function() {
            var elem = $(this);
            elem.card({
                progress: 'bar',
                onRefresh: function() {
                    setTimeout(function() {
                        elem.card({
                            refresh: false
                        });
                    }.bind(this), 2000);
                }
            });
        });


        circles.each(function() {
            var elem = $(this);
            elem.card({
                progress: 'circle',
                onRefresh: function() {
                    setTimeout(function() {
                        elem.card({
                            refresh: false
                        });
                    }.bind(this), 2000);
                }
            });
        });

        circlesLg.each(function() {
            var elem = $(this);
            elem.card({
                progress: 'circle-lg',
                progressColor: 'white',
                overlayColor: '0,0,0',
                overlayOpacity: 0.6,
                onRefresh: function() {
                    setTimeout(function() {
                        elem.card({
                            refresh: false
                        });
                    }.bind(this), 2000);
                }
            });
        });


        circlesLgMaster.each(function() {
            var elem = $(this);
            elem.card({
                progress: 'circle-lg',
                progressColor: 'master',
                overlayOpacity: 0.6,
                onRefresh: function() {
                    setTimeout(function() {
                        elem.card({
                            refresh: false
                        });
                    }.bind(this), 2000);
                }
            });
        });
    });

})(window.jQuery);