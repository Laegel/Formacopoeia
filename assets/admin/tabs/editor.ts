const test = {
    iframeDoc: null,
    themeSelector: null,
    classesInput: null,
    fieldPropertiesBlock: null,
    getFieldById(id) {
        for (let i = 0; i < formacopoeia.currentForm.fields.length; ++i) {
            if (id === formacopoeia.currentForm.fields[i].id) {
                return formacopoeia.currentForm.fields[i];
            }
        }
    },
    renderForm() {
        const form = fcUtils.select('#fc-form', this.iframeDoc);
        form.innerHTML = '';
        for (let index in formacopoeia.currentForm.fields) {
            const field = getFieldByType(formacopoeia.currentForm.fields[index].type);
            if (!field) {
                // Notify saved field does not exist anymore
                continue;
            }
            const template = this.renderTemplate('field', formacopoeia.currentForm.fields[index].type, formacopoeia.currentForm.fields[index].props);
            form.innerHTML += this.draggifyField(template, formacopoeia.currentForm.fields[index].id);

            const obj = formacopoeia.fieldsComponents[formacopoeia.currentForm.fields[index].type];
            if (obj && obj.onInit) {
                obj.onInit(fcUtils.select('[data-id="' + formacopoeia.currentForm.fields[index].id + '"]', form), formacopoeia.currentForm.fields[index]);
            }
        }
    },
    renderTemplate(type, templateId, data = {}) {
        return renderer(fcUtils.select('[data-template-' + type + '="' + templateId + '"]').innerHTML, data);
    },
    draggifyField(template, id) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(template, 'text/html');
        const container = fcUtils.getRootElement(doc);
        container.setAttribute('draggable', 'true');
        container.dataset.id = id;
        container.setAttribute('ondragstart', 'functions.drag(event)');
        container.setAttribute('ondragover', 'functions.dragOver(event)');
        container.setAttribute('ondrop', 'functions.drop(event)');
        return container.outerHTML;
    },
    resizeIframe() {
        const form = fcUtils.select('#fc-form', this.iframeDoc);
        this.iframe.height = form.scrollHeight + 30;
    },
    manageTheme() {
        const onLoad = (element) => {
            element.on('load', e => {
                this.resizeIframe();
            });
        };
        const style = fcUtils.select('#fc-style', this.iframeDoc);
        const themeStyle = fcUtils.select('#fc-theme-style', this.iframeDoc);

        const setHref = themeName => {
            style.href = themeName ? getThemeByName(themeName).options.path + '?' + Date.now() : themeName;
        };
        onLoad(style);
        onLoad(themeStyle);
        
        this.themeSelector.on('change', function() {
            setHref(this.value);
        });
        setHref(this.themeSelector.value);

        this.classesInput.on('input', (e) => {
            const form = fcUtils.select('#fc-form', this.iframeDoc);
            form.setAttribute('class', e.target.value);
            formacopoeia.currentForm.tabs.editor.classes = e.target.value;
        });
    },
    iframeReady(iframe) {
        this.iframeDoc = iframe.contentDocument;
        this.fieldPropertiesBlock = fcUtils.select('#fc-side-panel');
        const form = fcUtils.select('#fc-form', this.iframeDoc);

        form.on('drop', () => {
            const fields = fcUtils.selectAll('[draggable]', form);
            const newOrder = [];
            fields.forEach(field => {
                formacopoeia.currentForm.fields.some(item => {
                    if (field.dataset.id === item.id) {
                        newOrder.push(item);
                        return true;
                    }
                });
            });
            formacopoeia.currentForm.fields = newOrder;
            this.resizeIframe();
        });
        
        this.manageTheme();
        this.manageButtons();

        this.renderForm();
        this.resizeIframe();
        this.resizeIframe(); // Tweak, only one call doesn't resize

        iframe.contentWindow.on('click', e => {
            e.preventDefault();
            e.stopPropagation();
            const fieldWrapper = e.target.closest('[draggable]');
            if (!fieldWrapper || fieldWrapper && fieldWrapper.dataset.id === this.fieldPropertiesBlock.dataset.id) {
                return;
            }
            this.togglePropertiesBlock(fieldWrapper.dataset.id);
        });
    },
    togglePropertiesBlock(id) {
        this.fieldPropertiesBlock.dataset.id = id;
        let propertiesString = '';
        const formField = this.getFieldById(id);
        const field = getFieldByType(formField.type);
        const propertiesEvents = [];
        for (let prop in field.options.props) {
            let value = formField.props ? formField.props[prop] : '';
            if (!value) {
                value = '';
            }
            const property = getPropertyByName(field.options.props[prop].type);
            
            if (!property) {
                console.log(property + ' does not exist');
            }
            const newId = guidGenerator();
            propertiesString += '<div class="fc-property-row"><label>' + fcUtils.translate('properties.' + prop) + '</label>' + '<property-wrapper data-name="' + prop + '" data-property="' + field.options.props[prop].type + '" data-id="' + newId + '">' + this.renderTemplate('property', field.options.props[prop].type, {prop: prop, value: value}) + '</property-wrapper></div>';
            propertiesEvents.push(newId);
        }
        propertiesString += '</div>';

        this.fieldPropertiesBlock.innerHTML = propertiesString;

        const indexOfField = formacopoeia.currentForm.fields.indexOf(formField);

        let bottomSidePanel = '<span id="fc-remove" class="button danger dashicons dashicons-trash"></span>';
        if (0 !== indexOfField) {
            bottomSidePanel += '<span id="fc-move-up" class="button dashicons dashicons-arrow-up-alt"></span>';
        }
        if (indexOfField < formacopoeia.currentForm.fields.length - 1) {
            bottomSidePanel += '<span id="fc-move-down" class="button dashicons dashicons-arrow-down-alt"></span>';
        }
        populateSidePanel(translate('fieldProperties'), propertiesString, bottomSidePanel);

        const initPropertyField = wrapper => {
            const object = getPropertyByName(wrapper.dataset.property);
            if (object.onInit) {
                const propertyElement = {
                    wrapper: wrapper
                };
                object.onInit.call(propertyElement, formField.props[wrapper.dataset.name]);
                const onUpdate = e => {
                    formField.props[wrapper.dataset.name] = e.detail.value;
                    const tmp = getFieldByType(formField.type);
                    fcUtils.select('[draggable][data-id="' + formField.id + '"]', this.iframeDoc).innerHTML = this.renderTemplate('field', formField.type, formField.props);
                    if (e.detail.refresh) {
                        wrapper.off('update', onUpdate);
                        const rerenderValue = {
                            value: e.detail.value
                        }
                        wrapper.innerHTML = this.renderTemplate('property', wrapper.dataset.property, rerenderValue);
                        initPropertyField(wrapper);
                    }
                    this.resizeIframe();
                };
                wrapper.on('update', onUpdate);
            }
        }

        propertiesEvents.forEach(function(propId) {
            const wrapper = fcUtils.select('property-wrapper[data-id="' + propId + '"]');
            initPropertyField(wrapper);
        });
        
        fcUtils.select('#fc-remove', this.fieldPropertiesBlock).on('click', () => {
            for (let i = 0; i < formacopoeia.currentForm.fields.length; ++i) {
                if (id === formacopoeia.currentForm.fields[i].id) {
                    formacopoeia.currentForm.fields.splice(i, 1);
                    const tmp = fcUtils.select('[draggable][data-id="' + id + '"]', this.iframeDoc);
                    tmp.parentNode.removeChild(tmp);
                    emptySidePanel();
                    this.resizeIframe();
                    return;
                }
            }
        });
        const moveUp = fcUtils.select('#fc-move-up', this.fieldPropertiesBlock);
        const moveDown = fcUtils.select('#fc-move-down', this.fieldPropertiesBlock);

        if (moveUp) {
            moveUp.on('click', e => {
                const currentField = this.getFieldById(id);
                const indexOf = formacopoeia.currentForm.fields.indexOf(currentField);
                const previousIndex = indexOf - 1;
                const previousField = formacopoeia.currentForm.fields[previousIndex];
                formacopoeia.currentForm.fields[previousIndex] = currentField;
                formacopoeia.currentForm.fields[indexOf] = previousField;
                this.renderForm();
                if (0 === previousIndex) {
                    moveUp.style.display = 'none';
                } else {
                    moveUp.removeAttribute('style');
                }
            });
        }
        
        if (moveDown) {
            moveDown.on('click', e => {
                const currentField = this.getFieldById(id);
                const indexOf = formacopoeia.currentForm.fields.indexOf(currentField);
                const nextIndex = indexOf + 1;
                const nextField = formacopoeia.currentForm.fields[nextIndex];
                formacopoeia.currentForm.fields[nextIndex] = currentField;
                formacopoeia.currentForm.fields[indexOf] = nextField;
                this.renderForm();
                if (nextIndex === formacopoeia.currentForm.fields.length - 1) {
                    moveDown.style.display = 'none';
                } else {
                    moveDown.removeAttribute('style');
                }
            });
        }
        this.resizeIframe();
    },
    manageButtons() {
        const form = fcUtils.select('#fc-form', this.iframeDoc);
        const choices = fcUtils.select('div#choices');

        const categories = this.getFieldsCategories();
        choices.innerHTML = this.renderTemplate('part', 'newFieldContent', {categories: categories});
        const newFieldLinks = fcUtils.selectAll('a.fc-new-field');

        fcUtils.selectAll('[data-category]').on('click', function() {
            fcUtils.selectAll('.fc-category-container').forEach(item => {
                item.removeAttribute('style');
            });
            fcUtils.select('.fc-category-container[data-category="' + this.dataset.category + '"]').style.display = 'block';
        });
        fcUtils.select('.fc-category-container[data-category="default"]').style.display = 'block';

        fcUtils.select('#fc-add').on('click', () => {
            this.resizeIframe();
        });

        fcUtils.toArray(newFieldLinks).forEach(item => {
            item.on('click', e => {
                const id = guidGenerator();
                const realTarget = e.target.closest('a.fc-new-field');
                const field = getFieldByType(realTarget.dataset.field);
                form.innerHTML += this.draggifyField(this.renderTemplate('field', realTarget.dataset.field, {}), id);
                choices.style.display = 'none';
                formacopoeia.currentForm.fields.push({
                    id,
                    type: realTarget.dataset.field,
                    props: {}
                });
                fcUtils.select('#TB_closeWindowButton').click();
                this.togglePropertiesBlock(id);
                this.resizeIframe();
            });
        });

        fcUtils.select('#fc-reset').on('click', () => {
            this.renderForm();
            this.resizeIframe();
        });
    },
    getFieldsCategories() {
        const categories = {
            default: {
                label: 'categories.default',
                fields: []
            }
        };
        for (let i = 0; i < formacopoeia.fields.length; ++i) {
            const field = getFieldByType(formacopoeia.fields[i].name);
            const fieldData = {
                name: formacopoeia.fields[i].name,
                label: 'fields.' + formacopoeia.fields[i].name,
                rendered: this.renderTemplate('field', formacopoeia.fields[i].name, { label: 'Label', value: 'Value', text: 'Text' })
            };
            if (formacopoeia.fields[i].options.categories) {
                formacopoeia.fields[i].options.categories.forEach(category => {
                    if (!categories[category]) {
                        categories[category] = {
                            label: 'categories.' + category,
                            fields: []   
                        };
                    }
                    categories[category].fields.push(fieldData);
                });
            } else {
                categories.default.fields.push(fieldData);
            }
        }
        return categories;
    },
    onInit() {
        formacopoeia.currentForm.tabs.editor = formacopoeia.currentForm.tabs.editor || {};
        return {
            themes: formacopoeia.themes,
            classes: formacopoeia.currentForm.tabs.editor.classes || ''
        };
    },
    onActive() {
        let code = "<script src='/wp-content/plugins/formacopoeia/assets/admin/iframe/core.js'><\/script><script src='/wp-content/plugins/formacopoeia/assets/libs/utils.js'><\/script>";
        code += "<form id='fc-form'></form><link rel='stylesheet' href='/wp-content/plugins/formacopoeia/assets/admin/css/core.css'><link id='fc-theme-style' rel='stylesheet' href='" + formacopoeia.frontStyle + "'><link id='fc-style' rel='stylesheet' href=''>";

        const iframe = fcUtils.select('#fc-preview');
        iframe.src = 'javascript: "' + code + '"';
        this.themeSelector = fcUtils.select('#fc-theme');
        this.classesInput = fcUtils.select('#fc-classes');

        iframe.on('load', () => {
            this.iframe = iframe;
            this.iframeReady(iframe);    
        });

        this.initWindowEvents();
    },
    initWindowEvents() {
        window.on('resize', () => {
            this.resizeIframe();
        });
    }
    /*,
    onSave() {
        return {
            classes: this.classesInput.value,
            theme: this.themeSelector.value
        };
    }*/
}