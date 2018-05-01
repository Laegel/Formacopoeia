domReady(function() {
    const tabs = selectAll('.fc-tab');
    const container = select('#fc-container');
    const saveButton = select('#fc-save');

    tabs.forEach(function(tab) {
        var object = formacopoeia.components[tab.dataset.tab];
        if (object && object.onInit) {
            object.onInit();
        }
    });

    tabs.on('click', function(e) {
        e.preventDefault();
        const activeTab = select('.fc-tab.active');
        if (activeTab) {
            activeTab.classList.remove('active');
            if (formacopoeia.components[activeTab.dataset.tab].onRemoveActive) {
                formacopoeia.components[activeTab.dataset.tab].onRemoveActive();
            }
        }
        this.classList.add('active');
        var tab = this.dataset.tab;
        var object = formacopoeia.components[tab];
        container.innerHTML = select('template[data-tab="' + tab + '"]').innerHTML;
        if (object && object.onActive) {
            object.onActive();
        }
    });
    tabs[0].click();

    saveButton.on('click', function() {
        var tabsConfigs = {};
        tabs.forEach(function(tab) {
            var object = formacopoeia.components[tab.dataset.tab];
            if (object && object.onInit) {
                tabsConfigs[tab.dataset.tab] = object.onSave();
            }
        });
        var url = new URL(window.location.href);
        var searchParams = new URLSearchParams(url.search);
        var toSend = [];
        // formacopoeia.currentForm.forEach(function(field) {
        //     var tempField = Object.assign({}, field);
        //     var currentField = getFieldByType(field.type);
        //     for (var prop in currentField.options.props) {
        //         var currentProperty = getPropertyByName(currentField.options.props[prop].type);
        //         if (currentProperty.box) {
        //             tempField.props[prop] = currentProperty.box(tempField.props[prop])
        //         }  
        //     }
        //     toSend.push(tempField);
        // });
        console.log(formacopoeia.currentForm, toSend)

        jQuery.post('/wp-admin/admin-ajax.php', {
            action: 'save_form', 
            tabs: tabsConfigs, 
            ast: formacopoeia.currentForm,
            id: searchParams.get('id'),
            title: select('#title').value
        }, function(data) {
            console.log(data);
        });
    });
});

function getFieldByType(type) {
    for (var i = 0; i < formacopoeia.fields.length; ++i) {
        if (type === formacopoeia.fields[i].name) {
            return formacopoeia.fields[i];
        }
    }
}

function getThemeByName(name) {
    for (var i = 0; i < formacopoeia.themes.length; ++i) {
        if (name === formacopoeia.themes[i].name) {
            return formacopoeia.themes[i];
        }
    }
}

function getPropertyByName(name) {
    return formacopoeia.properties[name];
}

function guidGenerator() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}