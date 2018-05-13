var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : new P(function (resolve) { resolve(result.value); }).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = y[op[0] & 2 ? "return" : op[0] ? "throw" : "next"]) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [0, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
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
fcUtils.domReady(function () {
    var _this = this;
    var tabs = fcUtils.selectAll('.fc-tab');
    var container = fcUtils.select('#fc-container');
    var saveButton = fcUtils.select('#fc-save');
    var spinner = fcUtils.select('.spinner');
    var renderForm = function () {
        var parser = new DOMParser();
        var form = '';
        for (var index in formacopoeia.currentForm.fields) {
            var field = getFieldByType(formacopoeia.currentForm.fields[index].type);
            if (!field) {
                toastr.error('editor.messages.missingFiekd', { fieldName: formacopoeia.currentForm.fields[index].type });
                continue;
            }
            var template = renderer(fcUtils.select('[data-template-field="' + formacopoeia.currentForm.fields[index].type + '"]').innerHTML, formacopoeia.currentForm.fields[index].props);
            var doc = parser.parseFromString(template, 'text/html');
            var container_1 = fcUtils.getRootElement(doc);
            container_1.dataset.id = formacopoeia.currentForm.fields[index].id;
            form += container_1.outerHTML;
        }
        return form;
    };
    tabs.forEach(function (tab) {
        var object = formacopoeia.components[tab.dataset.tab];
        var data = {};
        if (object && object.onInit) {
            data = object.onInit();
        }
        data['$tab'] = object;
        var handlebarsTemplate = Handlebars.compile(fcUtils.select('[data-template-tab="' + tab.dataset.tab + '"]').innerHTML);
        var template = document.createElement('script');
        template.dataset.templateCache = tab.dataset.tab;
        template.setAttribute('type', 'text/x-handlebars/template');
        template.innerHTML = handlebarsTemplate(data);
        document.body.appendChild(template);
    });
    tabs.on('click', function (e) {
        e.preventDefault();
        emptySidePanel();
        for (var i in tinyMCE.editors) {
            tinyMCE.editors[i].remove();
        }
        var activeTab = fcUtils.select('.fc-tab.active');
        if (activeTab) {
            activeTab.classList.remove('active');
            if (formacopoeia.components[activeTab.dataset.tab].onRemoveActive) {
                formacopoeia.components[activeTab.dataset.tab].onRemoveActive();
            }
        }
        this.classList.add('active');
        var tab = this.dataset.tab;
        var object = formacopoeia.components[tab];
        var template = fcUtils.select('[data-template-cache="' + tab + '"]');
        var handlebarsTemplate = Handlebars.compile(template.innerHTML);
        container.innerHTML = handlebarsTemplate();
        if (object && object.onActive) {
            object.onActive();
        }
    });
    tabs[0].click();
    saveButton.on('click', function () { return __awaiter(_this, void 0, void 0, function () {
        var url, searchParams, data;
        return __generator(this, function (_a) {
            switch (_a.label) {
                case 0:
                    spinner.style.visibility = 'visible';
                    tabs.forEach(function (tab) {
                        var object = formacopoeia.components[tab.dataset.tab];
                        if (object && object.onSave) {
                            object.onSave();
                        }
                    });
                    url = new URL(window.location.href);
                    searchParams = new URLSearchParams(url.search);
                    return [4 /*yield*/, qwest.post(ajaxurl, {
                            action: 'save_form',
                            tabs: formacopoeia.currentForm.tabs,
                            fields: formacopoeia.currentForm.fields,
                            id: searchParams.get('id'),
                            title: fcUtils.select('#fc-title').value,
                            content: renderForm(),
                            status: fcUtils.select('#fc-status').checked
                        })];
                case 1:
                    data = _a.sent();
                    spinner.style.visibility = 'hidden';
                    toastr.success(fcUtils.translate('main.messages.successSave'));
                    return [2 /*return*/];
            }
        });
    }); });
});
window.on('resize', function () {
    if (850 > window.innerWidth) {
        return;
    }
    var sidePanel = fcUtils.select('#fc-side-panel');
    sidePanel.removeAttribute('style');
});
function stickySidePanel() {
    if (850 > window.innerWidth) {
        return;
    }
    var sidePanel = fcUtils.select('#fc-side-panel');
    var sidePanelHook = fcUtils.select('#fc-side-panel-hook');
    var docOffsetTop = document.documentElement.scrollTop || document.body.scrollTop;
    var wpAdminBar = fcUtils.select('#wpadminbar');
    var wpFooter = fcUtils.select('#wpfooter');
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
    var sidePanel = fcUtils.select('#fc-side-panel');
    sidePanel.innerHTML = "\n    <h2>\n        <span>" + title + "</span>\n    </h2>\n    <div class=\"inside\">" + content + "</div>\n    <div class=\"fc-panel-bottom\">" + bottom + "</div>\n    ";
    sidePanel.style.display = 'block';
    window.on('scroll', stickySidePanel);
    stickySidePanel();
}
function emptySidePanel() {
    var sidePanel = fcUtils.select('#fc-side-panel');
    sidePanel.style.display = 'none';
    sidePanel.innerHTML = '';
    window.off('scroll', stickySidePanel);
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
