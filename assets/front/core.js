domReady(function () {
    jQuery.get('/wp-admin/admin-ajax.php', {
        action: 'get_fields'
    }, function (dataFields) {
        var slots = selectAll('div[data-formacopoeia-slot]');
        toArray(slots).forEach(function (slot) {
            jQuery.get('/wp-admin/admin-ajax.php', {
                action: 'get_form',
                id: slot.dataset.formacopoeiaSlot
            }, function (data) {
                var form = '';
                data.form.forEach(function (field) {
                    form += renderer(dataFields.fields[field.type], field.props);
                });
                slot.innerHTML = form;
            });
        });
    });
});
function guidGenerator() {
    var S4 = function () {
        return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
    };
    return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
}
