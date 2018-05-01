var test = {
    iframeDoc: null,
    themeSelector: null,
    classesInput: null,
    fieldPropertiesBlock: null,
    getFieldById: function (id) {
        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
            if (id === formacopoeia.currentForm[i].id) {
                return formacopoeia.currentForm[i];
            }
        }
    },
    resizeIframe: function () {
        this.iframe.height = this.iframe.contentWindow.document.body.scrollHeight + 20;
    },
    manageTheme: function () {
        var _this = this;
        var onLoad = function (element) {
            element.addEventListener('load', function (e) {
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
        this.manageTheme();
        this.manageButtons();
        /* INIT FROM EXISTING VALUES (TO MOVE & REFACTOR)*/
        for (var index in formacopoeia.currentForm) {
            var field = getFieldByType(formacopoeia.currentForm[index].type);
            form.innerHTML += '<field-wrapper data-id="' + formacopoeia.currentForm[index].id + '">' + renderer(field.options.template, formacopoeia.currentForm[index].props) + '</field-wrapper>';
        }
        this.resizeIframe();
        iframe.contentWindow.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var fieldWrapper = e.target.closest('field-wrapper');
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
            propertiesString += '<div class="fc-property-row"><label>' + prop + '</label>' + '<property-wrapper data-name="' + prop + '" data-property="' + field.options.props[prop].type + '" data-id="' + newId + '">' + renderer(select('template[data-property="' + field.options.props[prop].type + '"]').innerHTML, { prop: prop, value: value }) + '</property-wrapper></div>';
            propertiesEvents.push(newId);
        }
        propertiesString += '</div>';
        this.fieldPropertiesBlock.innerHTML = propertiesString;
        populateSidePanel('fieldProperties', propertiesString, "<span id=\"fc-remove\" class=\"button fc-danger dashicons dashicons-trash\"></span>\n        <span id=\"fc-move-up\" class=\"button dashicons dashicons-arrow-up-alt\"></span>\n        <span id=\"fc-move-down\" class=\"button dashicons dashicons-arrow-down-alt\"></span>");
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
                    select('field-wrapper[data-id="' + formField.id + '"]', _this.iframeDoc).innerHTML = renderer(tmp.options.template, formField.props);
                    if (e.detail.refresh) {
                        wrapper.off('update', onUpdate_1);
                        var rerenderValue = {
                            value: e.detail.value
                        };
                        wrapper.innerHTML = renderer(select('template[data-property="' + wrapper.dataset.property + '"]').innerHTML, rerenderValue);
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
        /* PLAN A DRAG AND DROP INSTEAD OF ARROWS */
        select('#fc-remove', this.fieldPropertiesBlock).on('click', (function (id) {
            return function () {
                for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
                    if (id === formacopoeia.currentForm[i].id) {
                        formacopoeia.currentForm.splice(i, 1);
                        var tmp = select('field-wrapper[data-id="' + id + '"]', _this.iframeDoc);
                        tmp.parentNode.removeChild(tmp);
                        _this.fieldPropertiesBlock.removeChild(_this.fieldPropertiesBlock.firstChild);
                        _this.resizeIframe();
                        return;
                    }
                }
            };
        })(id));
        this.resizeIframe();
    },
    manageButtons: function () {
        var _this = this;
        var form = select('#fc-form', this.iframeDoc);
        var choices = select('div#choices');
        for (var i = 0; i < formacopoeia.fields.length; ++i) {
            choices.innerHTML += '<button class="new-field" data-field="' + formacopoeia.fields[i].name + '">' + formacopoeia.fields[i].options.label + '</button>';
        }
        var buttonsNewField = selectAll('button.new-field');
        select('#fc-add').addEventListener('click', function () {
            _this.resizeIframe();
        });
        toArray(buttonsNewField).forEach(function (item) {
            item.addEventListener('click', function (e) {
                var id = guidGenerator();
                var field = getFieldByType(e.target.dataset.field);
                var properties = {};
                for (var prop in field.options.props) {
                    var property = getPropertyByName(field.options.props[prop].type);
                    properties[prop] = property.unbox ? property.unbox('') : '';
                }
                form.innerHTML += '<field-wrapper data-id="' + id + '">' + renderer(field.options.template, properties) + '</<field-wrapper>';
                choices.style.display = 'none';
                formacopoeia.currentForm.push({
                    id: id,
                    type: e.target.dataset.field,
                    props: properties
                });
                select('#TB_closeWindowButton').click();
                _this.togglePropertiesBlock(id);
            });
        });
    },
    onInit: function () {
    },
    onActive: function () {
        var _this = this;
        var srcdoc = "\n            <form id=\"fc-form\"></form>\n            <link rel=\"stylesheet\" href=\"/wp-content/plugins/formacopoeia/assets/admin/css/core.css\">\n            <link id=\"fc-theme-style\" rel=\"stylesheet\" href=\"" + formacopoeia.frontStyle + "\">\n            <link id=\"fc-style\" rel=\"stylesheet\" href=\"\">\n        ";
        var iframe = select('#fc-preview');
        iframe.srcdoc = srcdoc;
        this.themeSelector = select('#fc-theme');
        this.classesInput = select('#fc-classes');
        domReady(function () {
            _this.iframe = iframe;
            _this.iframeReady(iframe);
        }, iframe.contentWindow);
    },
    onRemoveActive: function () {
    },
    onSave: function () {
        var form = select('#fc-form', this.iframeDoc);
        return {
            classes: this.classesInput.value,
            theme: this.themeSelector.value
        };
    }
};