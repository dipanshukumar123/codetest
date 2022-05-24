var lfm = function (id, options, callback) {
    let button = document.getElementById(id);

    button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        var type = options.type || 'image';

        window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items) {
            callback(items);
        };
    });
};

// Usage
//
// var route_prefix = "{{ url('filemanager') }}";
// lfm('lfm', {
//     prefix: route_prefix,
//     type: 'image', // image or file
// }, function (items) {
//     console.log(items);
// });
