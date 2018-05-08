domReady(function() {
    jQuery.get('/wp-admin/admin-ajax.php', {
        action: 'get_fields'
    }, function(dataFields) {
        const slots = selectAll('form[data-formacopoeia-slot]');
        toArray(slots).forEach(slot => {
            jQuery.get('/wp-admin/admin-ajax.php', {
                action: 'get_form',
                id: slot.dataset.formacopoeiaSlot,
                token: slot.dataset.token
            }, function(data) {
                let form = '';
                data.form.forEach(field => {
                    form += renderer(dataFields.fields[field.type], field.props);
                });
                select('.fc-wrapper', slot).innerHTML = form;
                slot.removeAttribute('data-token');
                slot.on('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    const request = new XMLHttpRequest();
                    request.onreadystatechange = function() {
                        if (this.readyState === XMLHttpRequest.DONE) {
                            if (this.status === 200) {
                                console.log(JSON.parse(this.responseText))
                                const trigger = new CustomEvent('success', {
                                    detail: {
                                        data: JSON.parse(this.responseText),
                                        status: this.status
                                    }
                                });
                            } else {
                                const trigger = new CustomEvent('failure', {
                                    detail: {
                                        data: JSON.parse(this.responseText),
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
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}