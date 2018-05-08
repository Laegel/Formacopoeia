var test = {
    onActive: function () {
        formacopoeia.currentForm.tabs.options = formacopoeia.currentForm.tabs.options || {};
        var redirect = select('#fc-redirect');
        var reload = select('#fc-reload');
        redirect.on('input', function () {
            formacopoeia.currentForm.tabs.options.redirect = redirect.value;
        });
        reload.on('change', function () {
            formacopoeia.currentForm.tabs.options.reload = reload.checked;
            console.log(reload);
        });
    }
};
