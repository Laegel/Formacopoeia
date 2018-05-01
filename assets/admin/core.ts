domReady(function() {
    const tabs = selectAll('.fc-tab');
    const container = select('#fc-container');
    const saveButton = select('#fc-save');
    const spinner = select('.spinner');

    tabs.forEach(tab => {
        const object = formacopoeia.components[tab.dataset.tab];
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
        const tab = this.dataset.tab;
        const object = formacopoeia.components[tab];
        container.innerHTML = select('template[data-tab="' + tab + '"]').innerHTML;
        if (object && object.onActive) {
            object.onActive();
        }
    });
    tabs[0].click();

    saveButton.on('click', () => {
        spinner.style.visibility = 'visible';
        const tabsConfigs = {};
        tabs.forEach(function(tab) {
            const object = formacopoeia.components[tab.dataset.tab];
            if (object && object.onInit) {
                tabsConfigs[tab.dataset.tab] = object.onSave();
            }
        });
        const url = new URL(window.location.href);
        const searchParams = new URLSearchParams(url.search);

        jQuery.post('/wp-admin/admin-ajax.php', {
            action: 'save_form', 
            tabs: tabsConfigs, 
            ast: formacopoeia.currentForm,
            id: searchParams.get('id'),
            title: select('#title').value
        }, function(data) {
            spinner.style.visibility = 'hidden';
            console.log(data);
        });
    });
});

function populateSidePanel(title, content, bottom = '') {
    const sidePanel = select('#fc-side-panel');
    sidePanel.innerHTML = `
    <h2>
        <span>${title}</span>
    </h2>
    <div class="inside">${content}</div>
    <div class="fc-panel-bottom">${bottom}</div>
    `
    sidePanel.style.display = 'block';
}

function emptySidePanel() {
    const sidePanel = select('#fc-side-panel');
    sidePanel.style.display = 'none';
    sidePanel.innerHTML = '';
}

function manageBoxing(type = 'box') {
    const toSend = [];
    formacopoeia.currentForm.forEach(function(field) {
        const tempField = {...field};
        const currentField = getFieldByType(field.type);
        tempField.props = {...field.props};
        for (let prop in currentField.options.props) {
            const currentProperty = getPropertyByName(currentField.options.props[prop].type);
            if (currentProperty[type]) {
                tempField.props[prop] = currentProperty[type](tempField.props[prop])
            }  
        }
        toSend.push(tempField);
    });
    return toSend;
}

function getFieldByType(type) {
    for (let i = 0; i < formacopoeia.fields.length; ++i) {
        if (type === formacopoeia.fields[i].name) {
            return formacopoeia.fields[i];
        }
    }
}

function getThemeByName(name) {
    for (let i = 0; i < formacopoeia.themes.length; ++i) {
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