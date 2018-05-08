var test = {
    onActive() {
        formacopoeia.currentForm.tabs.options = formacopoeia.currentForm.tabs.options || {};
        const redirect = select('#fc-redirect');
        const reload = select('#fc-reload');

        redirect.on('input', function() {
            formacopoeia.currentForm.tabs.options.redirect = redirect.value;
        });

        reload.on('change', function() {
            formacopoeia.currentForm.tabs.options.reload = reload.checked;
            console.log(reload);
        });
    }
};