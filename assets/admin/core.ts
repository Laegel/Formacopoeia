domReady(function() {
    const tabs = selectAll('.fc-tab');
    const container = select('#fc-container');
    const saveButton = select('#fc-save');
    const spinner = select('.spinner');

    tabs.forEach(tab => {
        const object = formacopoeia.components[tab.dataset.tab];
        let data = {};
        if (object && object.onInit) {
            data = object.onInit();
        }
        data['$tab'] = object;
        const handlebarsTemplate = Handlebars.compile(select('[data-template-tab="' + tab.dataset.tab + '"]').innerHTML);

        const template = document.createElement('script');
        template.dataset.templateCache = tab.dataset.tab;
        template.setAttribute('type', 'text/x-handlebars/template');
        template.innerHTML = handlebarsTemplate(data);
        document.body.appendChild(template);
    });

    tabs.on('click', function(e) {
        e.preventDefault();
        emptySidePanel();
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
        const template = select('[data-template-cache="' + tab + '"]');
        
        const handlebarsTemplate = Handlebars.compile(template.innerHTML);

        container.innerHTML = handlebarsTemplate();

        if (object && object.onActive) {
            object.onActive();
        }
    });
    tabs[0].click();

    saveButton.on('click', () => {
        spinner.style.visibility = 'visible';
        tabs.forEach(function(tab) {
            const object = formacopoeia.components[tab.dataset.tab];
            if (object && object.onSave) {
                object.onSave();
            }
        });
        const url = new URL(window.location.href);
        const searchParams = new URLSearchParams(url.search);

        jQuery.post('/wp-admin/admin-ajax.php', {
            action: 'save_form', 
            tabs: formacopoeia.currentForm.tabs, 
            fields: formacopoeia.currentForm.fields,
            id: searchParams.get('id'),
            title: select('#fc-title').value,
            status: select('#fc-status').checked
        }, function(data) {
            spinner.style.visibility = 'hidden';
        });
    });
});

window.on('resize', function() {
    if (850 > window.innerWidth) {
        return;
    }
    const sidePanel = select('#fc-side-panel');
    sidePanel.removeAttribute('style');
});

function stickySidePanel() {
    if (850 > window.innerWidth) {
        return;
    }
    const sidePanel = select('#fc-side-panel');
    const sidePanelHook = select('#fc-side-panel-hook');
    const docOffsetTop = document.documentElement.scrollTop || document.body.scrollTop;
    const wpAdminBar = select('#wpadminbar');
    const wpFooter = select('#wpfooter');
    
    if (docOffsetTop > sidePanel.offsetTop) {
        sidePanel.style.position = 'fixed';
        sidePanel.style.top = wpAdminBar.offsetHeight + 'px';
    } 
    if (docOffsetTop < sidePanelHook.offsetTop) {
        sidePanel.removeAttribute('style');
    }

    if (docOffsetTop + sidePanel.offsetHeight + wpAdminBar.offsetHeight > wpFooter.offsetTop) {
        sidePanel.style.top = wpFooter.offsetTop - (docOffsetTop + sidePanel.offsetHeight) + 'px';
    }
}

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

    window.on('scroll', stickySidePanel);
    stickySidePanel();
}

function emptySidePanel() {
    const sidePanel = select('#fc-side-panel');
    sidePanel.style.display = 'none';
    sidePanel.innerHTML = '';

    window.off('scroll', stickySidePanel);
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

function translate(key) {
    return formacopoeia.translations[key] || key;
}