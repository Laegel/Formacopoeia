domReady(function () {
    jQuery.get('/wp-admin/admin-ajax.php', {
        action: 'get_fields'
    }, function (dataFields) {
        var slots = selectAll('form[data-formacopoeia-slot]');
        toArray(slots).forEach(function (slot) {
            jQuery.get('/wp-admin/admin-ajax.php', {
                action: 'get_form',
                id: slot.dataset.formacopoeiaSlot,
                token: slot.dataset.token
            }, function (data) {
                var form = '';
                data.form.forEach(function (field) {
                    form += renderer(dataFields.fields[field.type], field.props);
                });
                select('.fc-wrapper', slot).innerHTML = form;
                slot.removeAttribute('data-token');
                slot.on('submit', function (e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function () {
                        if (this.readyState === XMLHttpRequest.DONE) {
                            if (this.status === 200) {
                                console.log(JSON.parse(this.responseText));
                                var trigger = new CustomEvent('success', {
                                    detail: {
                                        data: JSON.parse(this.responseText),
                                        status: this.status
                                    }
                                });
                            }
                            else {
                                var trigger = new CustomEvent('failure', {
                                    detail: {
                                        data: JSON.parse(event.responseText),
                                        status: this.status
                                    }
                                });
                            }
                        }
                    };
                    request.open('post', '/wp-admin/admin-ajax.php?action=submit_formacopoeia');
                    formData.append('id', slot.dataset.formacopoeiaSlot);
                    request.send(formData);
                });
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
