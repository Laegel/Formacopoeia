var test = {
    iframeDoc: null,
    themeSelector: null,
    classesInput: null,
    fieldPropertiesBlock: null,
    getFieldById: function (id) {
        for (var i = 0; i < formacopoeia.currentForm.fields.length; ++i) {
            if (id === formacopoeia.currentForm.fields[i].id) {
                return formacopoeia.currentForm.fields[i];
            }
        }
    },
    renderForm: function () {
        var form = select('#fc-form', this.iframeDoc);
        form.innerHTML = '';
        for (var index in formacopoeia.currentForm.fields) {
            var field = getFieldByType(formacopoeia.currentForm.fields[index].type);
            if (!field) {
                // Notify saved field does not exist anymore
                continue;
            }
            var template = renderer(field.options.template, formacopoeia.currentForm.fields[index].props);
            form.innerHTML += this.draggifyField(template, formacopoeia.currentForm.fields[index].id);
        }
    },
    draggifyField: function (template, id) {
        var parser = new DOMParser();
        var doc = parser.parseFromString(template, 'text/html');
        var container;
        toArray(doc.all).some(function (item) {
            if (-1 === ['html', 'head', 'body'].indexOf(item.localName)) {
                container = item;
                return true;
            }
        });
        container.setAttribute('draggable', 'true');
        container.dataset.id = id;
        container.setAttribute('ondragstart', 'functions.drag(event)');
        container.setAttribute('ondragover', 'functions.dragOver(event)');
        container.setAttribute('ondrop', 'functions.drop(event)');
        return container.outerHTML;
    },
    resizeIframe: function () {
        var form = select('#fc-form', this.iframeDoc);
        this.iframe.height = form.scrollHeight + 20;
    },
    manageTheme: function () {
        var _this = this;
        var onLoad = function (element) {
            element.on('load', function (e) {
                _this.resizeIframe();
            });
        };
        var style = select('#fc-style', this.iframeDoc);
        var themeStyle = select('#fc-theme-style', this.iframeDoc);
        var setHref = function (themeName) {
            style.href = themeName ? getThemeByName(themeName).options.path + '?' + Date.now() : themeName;
        };
        onLoad(style);
        onLoad(themeStyle);
        this.themeSelector.on('change', function () {
            setHref(this.value);
        });
        setHref(this.themeSelector.value);
    },
    iframeReady: function (iframe) {
        var _this = this;
        this.iframeDoc = iframe.contentDocument;
        this.fieldPropertiesBlock = select('#fc-side-panel');
        var form = select('#fc-form', this.iframeDoc);
        form.on('drop', function () {
            var fields = selectAll('[draggable]', form);
            var newOrder = [];
            fields.forEach(function (field) {
                formacopoeia.currentForm.fields.some(function (item) {
                    if (field.dataset.id === item.id) {
                        newOrder.push(item);
                        return true;
                    }
                });
            });
            formacopoeia.currentForm.fields = newOrder;
            _this.resizeIframe();
        });
        this.manageTheme();
        this.manageButtons();
        this.renderForm();
        this.resizeIframe();
        iframe.contentWindow.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var fieldWrapper = e.target.closest('[draggable]');
            if (!fieldWrapper || fieldWrapper && fieldWrapper.dataset.id === _this.fieldPropertiesBlock.dataset.id) {
                return;
            }
            _this.togglePropertiesBlock(fieldWrapper.dataset.id);
        });
    },
    togglePropertiesBlock: function (id) {
        var _this = this;
        this.fieldPropertiesBlock.dataset.id = id;
        var propertiesString = '';
        var formField = this.getFieldById(id);
        var field = getFieldByType(formField.type);
        var propertiesEvents = [];
        for (var prop in field.options.props) {
            var value = formField.props ? formField.props[prop] : '';
            if (!value) {
                value = '';
            }
            var property = getPropertyByName(field.options.props[prop].type);
            if (!property) {
                console.log(property + ' does not exist');
            }
            var newId = guidGenerator();
            propertiesString += '<div class="fc-property-row"><label>' + utils.translate('properties.' + prop) + '</label>' + '<property-wrapper data-name="' + prop + '" data-property="' + field.options.props[prop].type + '" data-id="' + newId + '">' + renderer(select('[data-template-property="' + field.options.props[prop].type + '"]').innerHTML, { prop: prop, value: value }) + '</property-wrapper></div>';
            propertiesEvents.push(newId);
        }
        propertiesString += '</div>';
        this.fieldPropertiesBlock.innerHTML = propertiesString;
        var indexOfField = formacopoeia.currentForm.fields.indexOf(formField);
        var bottomSidePanel = '<span id="fc-remove" class="button fc-danger dashicons dashicons-trash"></span>';
        if (0 !== indexOfField) {
            bottomSidePanel += '<span id="fc-move-up" class="button dashicons dashicons-arrow-up-alt"></span>';
        }
        if (indexOfField < formacopoeia.currentForm.fields.length - 1) {
            bottomSidePanel += '<span id="fc-move-down" class="button dashicons dashicons-arrow-down-alt"></span>';
        }
        populateSidePanel(translate('fieldProperties'), propertiesString, bottomSidePanel);
        var initPropertyField = function (wrapper) {
            var object = getPropertyByName(wrapper.dataset.property);
            if (object.onInit) {
                var propertyElement = {
                    wrapper: wrapper
                };
                object.onInit.call(propertyElement, formField.props[wrapper.dataset.name]);
                var onUpdate_1 = function (e) {
                    formField.props[wrapper.dataset.name] = e.detail.value;
                    var tmp = getFieldByType(formField.type);
                    select('[draggable][data-id="' + formField.id + '"]', _this.iframeDoc).innerHTML = renderer(tmp.options.template, formField.props);
                    if (e.detail.refresh) {
                        wrapper.off('update', onUpdate_1);
                        var rerenderValue = {
                            value: e.detail.value
                        };
                        wrapper.innerHTML = renderer(select('[data-template-property="' + wrapper.dataset.property + '"]').innerHTML, rerenderValue);
                        initPropertyField(wrapper);
                    }
                    _this.resizeIframe();
                };
                wrapper.on('update', onUpdate_1);
            }
        };
        propertiesEvents.forEach(function (propId) {
            var wrapper = select('property-wrapper[data-id="' + propId + '"]');
            initPropertyField(wrapper);
        });
        select('#fc-remove', this.fieldPropertiesBlock).on('click', function () {
            for (var i = 0; i < formacopoeia.currentForm.fields.length; ++i) {
                if (id === formacopoeia.currentForm.fields[i].id) {
                    formacopoeia.currentForm.fields.splice(i, 1);
                    var tmp = select('[draggable][data-id="' + id + '"]', _this.iframeDoc);
                    tmp.parentNode.removeChild(tmp);
                    emptySidePanel();
                    _this.resizeIframe();
                    return;
                }
            }
        });
        var moveUp = select('#fc-move-up', this.fieldPropertiesBlock);
        var moveDown = select('#fc-move-down', this.fieldPropertiesBlock);
        if (moveUp) {
            moveUp.on('click', function (e) {
                var currentField = _this.getFieldById(id);
                var indexOf = formacopoeia.currentForm.fields.indexOf(currentField);
                var previousIndex = indexOf - 1;
                var previousField = formacopoeia.currentForm.fields[previousIndex];
                formacopoeia.currentForm.fields[previousIndex] = currentField;
                formacopoeia.currentForm.fields[indexOf] = previousField;
                _this.renderForm();
                if (0 === previousIndex) {
                    moveUp.style.display = 'none';
                }
                else {
                    moveUp.removeAttribute('style');
                }
            });
        }
        if (moveDown) {
            moveDown.on('click', function (e) {
                var currentField = _this.getFieldById(id);
                var indexOf = formacopoeia.currentForm.fields.indexOf(currentField);
                var nextIndex = indexOf + 1;
                var nextField = formacopoeia.currentForm.fields[nextIndex];
                formacopoeia.currentForm.fields[nextIndex] = currentField;
                formacopoeia.currentForm.fields[indexOf] = nextField;
                _this.renderForm();
                if (nextIndex === formacopoeia.currentForm.fields.length - 1) {
                    moveDown.style.display = 'none';
                }
                else {
                    moveDown.removeAttribute('style');
                }
            });
        }
        this.resizeIframe();
    },
    manageButtons: function () {
        var _this = this;
        var form = select('#fc-form', this.iframeDoc);
        var choices = select('div#choices');
        var categories = this.getFieldsCategories();
        // let categoriesList = '<ul class="fc-categories">';
        // let innerHTML = '';
        // for (let category in categories) {
        //     categoriesList += '<li class="wp-switch-editor" data-category="' + category + '">' + utils.translate('categories.' + category) + '</li>';
        //     innerHTML += '<div class="fc-category-container" data-category="' + category + '">';
        //     categories[category].forEach(fieldName => {
        //         const field = getFieldByType(fieldName);
        //         innerHTML += '<a class="fc-new-field" data-field="' + fieldName + '"><div class="fc-preview"><div class="fc-preview-overlay"></div>' + renderer(field.options.template, { label: 'Label', value: 'Value', text: 'Text' }) + '</div><span class="fc-new-field-label">' + field.options.label + '</span></a>';
        //     });
        //     innerHTML += '</div>';
        // }
        // choices.innerHTML = '<div class="fc-context">' + categoriesList + '</ul>' + innerHTML + '</div>';
        choices.innerHTML = renderer(select('[data-template-part="newFieldContent"]').innerHTML, { categories: categories });
        var newFieldLinks = selectAll('a.fc-new-field');
        selectAll('[data-category]').on('click', function () {
            selectAll('.fc-category-container').forEach(function (item) {
                item.removeAttribute('style');
            });
            select('.fc-category-container[data-category="' + this.dataset.category + '"]').style.display = 'block';
        });
        select('.fc-category-container[data-category="default"]').style.display = 'block';
        select('#fc-add').on('click', function () {
            _this.resizeIframe();
        });
        toArray(newFieldLinks).forEach(function (item) {
            item.on('click', function (e) {
                var id = guidGenerator();
                var realTarget = e.target.closest('a.fc-new-field');
                var field = getFieldByType(realTarget.dataset.field);
                form.innerHTML += _this.draggifyField(renderer(field.options.template, {}), id);
                choices.style.display = 'none';
                formacopoeia.currentForm.fields.push({
                    id: id,
                    type: realTarget.dataset.field,
                    props: {}
                });
                select('#TB_closeWindowButton').click();
                _this.togglePropertiesBlock(id);
            });
        });
    },
    getFieldsCategories: function () {
        var categories = {
            "default": {
                label: 'categories.default',
                fields: []
            }
        };
        var _loop_1 = function (i) {
            var field = getFieldByType(formacopoeia.fields[i].name);
            var fieldData = {
                name: formacopoeia.fields[i].name,
                label: 'fields.' + formacopoeia.fields[i].name,
                rendered: renderer(field.options.template, { label: 'Label', value: 'Value', text: 'Text' })
            };
            if (formacopoeia.fields[i].options.categories) {
                formacopoeia.fields[i].options.categories.forEach(function (category) {
                    if (!categories[category]) {
                        categories[category] = {
                            label: 'categories.' + category,
                            fields: []
                        };
                    }
                    categories[category].fields.push(fieldData);
                });
            }
            else {
                categories["default"].fields.push(fieldData);
            }
        };
        for (var i = 0; i < formacopoeia.fields.length; ++i) {
            _loop_1(i);
        }
        return categories;
    },
    onInit: function () {
        return {
            themes: formacopoeia.themes
        };
    },
    onActive: function () {
        var _this = this;
        var code = "<script src='/wp-content/plugins/formacopoeia/assets/admin/iframe/core.js'><\/script><script src='/wp-content/plugins/formacopoeia/assets/libs/light-query.js'><\/script>";
        code += "<form id='fc-form'></form><link rel='stylesheet' href='/wp-content/plugins/formacopoeia/assets/admin/css/core.css'><link id='fc-theme-style' rel='stylesheet' href='" + formacopoeia.frontStyle + "'><link id='fc-style' rel='stylesheet' href=''>";
        var iframe = select('#fc-preview');
        iframe.src = 'javascript: "' + code + '"';
        this.themeSelector = select('#fc-theme');
        this.classesInput = select('#fc-classes');
        iframe.on('load', function () {
            _this.iframe = iframe;
            _this.iframeReady(iframe);
        });
        this.initWindowEvents();
    },
    initWindowEvents: function () {
        var _this = this;
        window.on('resize', function () {
            _this.resizeIframe();
        });
    },
    onSave: function () {
        return {
            classes: this.classesInput.value,
            theme: this.themeSelector.value
        };
    }
};
