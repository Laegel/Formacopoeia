fcUtils.domReady(async function() {

    qwest.setDefaultOptions({
        responseType: 'json',
    });

    const slots = fcUtils.selectAll('form[data-formacopoeia]');
    
    slots.forEach(async slot => {
        slot.removeAttribute('action');
        slot.removeAttribute('method');

        const data = await qwest.get('/wp-admin/admin-ajax.php', {
            action: 'get_form',
            id: slot.dataset.formacopoeia,
            token: slot.dataset.token
        });
        let formContent = '';
        
        data.response.form.forEach(field => {
            if (formacopoeia.fields[field.type] && formacopoeia.fields[field.type].onInit) {
                formacopoeia.fields[field.type].onInit(fcUtils.select('[data-id="' + field.id + '"]'), field.props);
            }
        });
        // slot.removeAttribute('data-token');
        slot.on('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            const result = await qwest.post('/wp-admin/admin-ajax.php', formData, {
                dataType: 'formdata'
            });

            const event = new CustomEvent('fc:after', {
                detail: {
                    response: result.response,
                },
                bubbles: true,
                cancelable: true
            });
            this.dispatchEvent(event);
        });

        slot.on('fc:after', function(data) {
            if (data.detail.response.after && formacopoeia.afters[data.detail.response.after.name]) {                
                formacopoeia.afters[data.detail.response.after.name](this, data.detail.response);
            }
        });
    });
});

function guidGenerator() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}