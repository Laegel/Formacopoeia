toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: 'toast-bottom-right',
    preventDuplicates: false,
    onclick: null,
    showDuration: 300,
    hideDuration: 1000,
    timeOut: 5000,
    extendedTimeOut: 1000,
    showEasing: 'swing',
    hideEasing: 'linear',
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut'
};

fcUtils.domReady(function() {
    const tabs = fcUtils.selectAll('.fc-tab');
    const container = fcUtils.select('#fc-container');
    const saveButton = fcUtils.select('#fc-save');
    const spinner = fcUtils.select('.spinner');

    const renderForm = function() {
        const parser = new DOMParser();
        let form = '';
        for (let index in formacopoeia.currentForm.fields) {
            const field = getFieldByType(formacopoeia.currentForm.fields[index].type);
            if (!field) {
                toastr.error('editor.messages.missingFiekd', {fieldName: formacopoeia.currentForm.fields[index].type})
                continue;
            }
            const template = renderer(fcUtils.select('[data-template-field="' + formacopoeia.currentForm.fields[index].type + '"]').innerHTML, formacopoeia.currentForm.fields[index].props);
            
            const doc = parser.parseFromString(template, 'text/html');
            const container = fcUtils.getRootElement(doc);
            container.dataset.id = formacopoeia.currentForm.fields[index].id;
            form += container.outerHTML;
        }
        return form;
    };

    tabs.forEach(tab => {
        const object = formacopoeia.components[tab.dataset.tab];
        let data = {};
        if (object && object.onInit) {
            data = object.onInit();
        }
        data['$tab'] = object;
        const handlebarsTemplate = Handlebars.compile(fcUtils.select('[data-template-tab="' + tab.dataset.tab + '"]').innerHTML);

        const template = document.createElement('script');
        template.dataset.templateCache = tab.dataset.tab;
        template.setAttribute('type', 'text/x-handlebars/template');
        template.innerHTML = handlebarsTemplate(data);
        document.body.appendChild(template);
    });

    tabs.on('click', function(e) {
        e.preventDefault();
        emptySidePanel();

        for (let i in tinyMCE.editors){
            tinyMCE.editors[i].remove();
        }
        const activeTab = fcUtils.select('.fc-tab.active');
        if (activeTab) {
            activeTab.classList.remove('active');
            if (formacopoeia.components[activeTab.dataset.tab].onRemoveActive) {
                formacopoeia.components[activeTab.dataset.tab].onRemoveActive();
            }
        }
        this.classList.add('active');
        const tab = this.dataset.tab;
        const object = formacopoeia.components[tab];
        const template = fcUtils.select('[data-template-cache="' + tab + '"]');
        
        const handlebarsTemplate = Handlebars.compile(template.innerHTML);

        container.innerHTML = handlebarsTemplate();

        if (object && object.onActive) {
            object.onActive();
        }
    });
    tabs[0].click();

    saveButton.on('click', async () => {
        spinner.style.visibility = 'visible';
        tabs.forEach(function(tab) {
            const object = formacopoeia.components[tab.dataset.tab];
            if (object && object.onSave) {
                object.onSave();
            }
        });
        const url = new URL(window.location.href);
        const searchParams = new URLSearchParams(url.search);

        const data = await qwest.post(ajaxurl, {
            action: 'save_form', 
            tabs: formacopoeia.currentForm.tabs, 
            fields: formacopoeia.currentForm.fields,
            id: searchParams.get('id'),
            title: fcUtils.select('#fc-title').value,
            content: renderForm(),
            status: fcUtils.select('#fc-status').checked
        });
        spinner.style.visibility = 'hidden';
        toastr.success(fcUtils.translate('main.messages.successSave'));
    });
});

window.on('resize', function() {
    if (850 > window.innerWidth) {
        return;
    }
    const sidePanel = fcUtils.select('#fc-side-panel');
    sidePanel.removeAttribute('style');
});

function stickySidePanel() {
    if (850 > window.innerWidth) {
        return;
    }
    const sidePanel = fcUtils.select('#fc-side-panel');
    const sidePanelHook = fcUtils.select('#fc-side-panel-hook');
    const docOffsetTop = document.documentElement.scrollTop || document.body.scrollTop;
    const wpAdminBar = fcUtils.select('#wpadminbar');
    const wpFooter = fcUtils.select('#wpfooter');
    
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
    const sidePanel = fcUtils.select('#fc-side-panel');
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
    const sidePanel = fcUtils.select('#fc-side-panel');
    sidePanel.style.display = 'none';
    sidePanel.innerHTML = '';

    window.off('scroll', stickySidePanel);
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