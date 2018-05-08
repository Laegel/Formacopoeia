var __assign = (this && this.__assign) || Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
        s = arguments[i];
        for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
            t[p] = s[p];
    }
    return t;
};
domReady(function () {
    var tabs = selectAll('.fc-tab');
    var container = select('#fc-container');
    var saveButton = select('#fc-save');
    var spinner = select('.spinner');
    tabs.forEach(function (tab) {
        var object = formacopoeia.components[tab.dataset.tab];
        var data = {};
        if (object && object.onInit) {
            data = object.onInit();
        }
        data['$tab'] = object;
        var handlebarsTemplate = Handlebars.compile(select('[data-template-tab="' + tab.dataset.tab + '"]').innerHTML);
        var template = document.createElement('script');
        template.dataset.templateCache = tab.dataset.tab;
        template.setAttribute('type', 'text/x-handlebars/template');
        template.innerHTML = handlebarsTemplate(data);
        document.body.appendChild(template);
    });
    tabs.on('click', function (e) {
        e.preventDefault();
        emptySidePanel();
        var activeTab = select('.fc-tab.active');
        if (activeTab) {
            activeTab.classList.remove('active');
            if (formacopoeia.components[activeTab.dataset.tab].onRemoveActive) {
                formacopoeia.components[activeTab.dataset.tab].onRemoveActive();
            }
        }
        this.classList.add('active');
        var tab = this.dataset.tab;
        var object = formacopoeia.components[tab];
        var template = select('[data-template-cache="' + tab + '"]');
        var handlebarsTemplate = Handlebars.compile(template.innerHTML);
        container.innerHTML = handlebarsTemplate();
        if (object && object.onActive) {
            object.onActive();
        }
    });
    tabs[0].click();
    saveButton.on('click', function () {
        spinner.style.visibility = 'visible';
        tabs.forEach(function (tab) {
            var object = formacopoeia.components[tab.dataset.tab];
            if (object && object.onSave) {
                object.onSave();
            }
        });
        var url = new URL(window.location.href);
        var searchParams = new URLSearchParams(url.search);
        jQuery.post('/wp-admin/admin-ajax.php', {
            action: 'save_form',
            tabs: formacopoeia.currentForm.tabs,
            fields: formacopoeia.currentForm.fields,
            id: searchParams.get('id'),
            title: select('#fc-title').value,
            status: select('#fc-status').checked
        }, function (data) {
            spinner.style.visibility = 'hidden';
        });
    });
});
window.on('resize', function () {
    if (850 > window.innerWidth) {
        return;
    }
    var sidePanel = select('#fc-side-panel');
    sidePanel.removeAttribute('style');
});
function stickySidePanel() {
    if (850 > window.innerWidth) {
        return;
    }
    var sidePanel = select('#fc-side-panel');
    var sidePanelHook = select('#fc-side-panel-hook');
    var docOffsetTop = document.documentElement.scrollTop || document.body.scrollTop;
    var wpAdminBar = select('#wpadminbar');
    var wpFooter = select('#wpfooter');
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
function populateSidePanel(title, content, bottom) {
    if (bottom === void 0) { bottom = ''; }
    var sidePanel = select('#fc-side-panel');
    sidePanel.innerHTML = "\n    <h2>\n        <span>" + title + "</span>\n    </h2>\n    <div class=\"inside\">" + content + "</div>\n    <div class=\"fc-panel-bottom\">" + bottom + "</div>\n    ";
    sidePanel.style.display = 'block';
    window.on('scroll', stickySidePanel);
    stickySidePanel();
}
function emptySidePanel() {
    var sidePanel = select('#fc-side-panel');
    sidePanel.style.display = 'none';
    sidePanel.innerHTML = '';
    window.off('scroll', stickySidePanel);
}
function manageBoxing(type) {
    if (type === void 0) { type = 'box'; }
    var toSend = [];
    formacopoeia.currentForm.forEach(function (field) {
        var tempField = __assign({}, field);
        var currentField = getFieldByType(field.type);
        tempField.props = __assign({}, field.props);
        for (var prop in currentField.options.props) {
            var currentProperty = getPropertyByName(currentField.options.props[prop].type);
            if (currentProperty[type]) {
                tempField.props[prop] = currentProperty[type](tempField.props[prop]);
            }
        }
        toSend.push(tempField);
    });
    return toSend;
}
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
    var S4 = function () {
        return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
    };
    return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
}
function translate(key) {
    return formacopoeia.translations[key] || key;
}
