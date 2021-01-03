(function($) {

    $.fn.filemanager = function(type, options) {
        type = type || 'file';

        this.on('click', function(e) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            var target_input = $('#' + $(this).data('input'));
            var target_name = $('#' + $(this).data('name'));
            var target_preview = $('#' + $(this).data('preview'));
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
            window.SetUrl = function(items) {
                var file_path = items.map(function(item) {
                    return item.url;
                }).join(',');

                // set the value of the desired input to image url
                target_input.val('').val(file_path).trigger('change');

                var file_name = items.map(function(item) {
                    return item.name;
                }).join(',');
                // set the value of the desired input to image url
                target_name.val('').val(file_name).trigger('change');

                // clear previous preview
                target_preview.html('');

                // set or change the preview image src
                items.forEach(function(item) {
                    target_preview.append(
                        $('<img>').css('width', '100%').attr('src', item.url)
                    );
                });

                // trigger change event
                target_preview.trigger('change');
            };
            return false;
        });
    }

})(jQuery);