const test = {
    iframeDoc: null,
    themeSelector: null,
    classesInput: null,
    fieldPropertiesBlock: null,
    getFieldById(id) {
        for (let i = 0; i < formacopoeia.currentForm.length; ++i) {
            if (id === formacopoeia.currentForm[i].id) {
                return formacopoeia.currentForm[i];
            }
        }
    },
    resizeIframe() {
        this.iframe.height = this.iframe.contentWindow.document.body.scrollHeight + 20;
    },
    manageTheme() {
        const onLoad = (element) => {
            element.addEventListener('load', e => {
                this.resizeIframe();
            });
        };
        const style = select('#fc-style', this.iframeDoc);
        const themeStyle = select('#fc-theme-style', this.iframeDoc);

        const setHref = themeName => {
            style.href = themeName ? getThemeByName(themeName).options.path + '?' + Date.now() : themeName;
        };
        onLoad(style);
        onLoad(themeStyle);
        
        this.themeSelector.on('change', function() {
            setHref(this.value);
        });
        setHref(this.themeSelector.value);
    },
    iframeReady(iframe) {
        this.iframeDoc = iframe.contentDocument;
        this.fieldPropertiesBlock = select('#fc-side-panel');
        const form = select('#fc-form', this.iframeDoc);
        
        this.manageTheme();
        this.manageButtons();

        /* INIT FROM EXISTING VALUES (TO MOVE & REFACTOR)*/
        for (let index in formacopoeia.currentForm) {
            const field = getFieldByType(formacopoeia.currentForm[index].type);
            form.innerHTML += '<field-wrapper data-id="' + formacopoeia.currentForm[index].id + '">' + renderer(field.options.template, formacopoeia.currentForm[index].props) + '</field-wrapper>';
        }
        this.resizeIframe();

        iframe.contentWindow.addEventListener('click', e => {
            e.preventDefault();
            e.stopPropagation();
            const fieldWrapper = e.target.closest('field-wrapper');
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
            propertiesString += '<div class="fc-property-row"><label>' + prop + '</label>' + '<property-wrapper data-name="' + prop + '" data-property="' + field.options.props[prop].type + '" data-id="' + newId + '">' + renderer(select('template[data-property="' + field.options.props[prop].type + '"]').innerHTML, {prop: prop, value: value}) + '</property-wrapper></div>';
            propertiesEvents.push(newId);
        }
        propertiesString += '</div>';

        this.fieldPropertiesBlock.innerHTML = propertiesString;

        populateSidePanel('fieldProperties', propertiesString, `<span id="fc-remove" class="button fc-danger dashicons dashicons-trash"></span>
        <span id="fc-move-up" class="button dashicons dashicons-arrow-up-alt"></span>
        <span id="fc-move-down" class="button dashicons dashicons-arrow-down-alt"></span>`);

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
                    select('field-wrapper[data-id="' + formField.id + '"]', this.iframeDoc).innerHTML = renderer(tmp.options.template, formField.props);
                    if (e.detail.refresh) {
                        wrapper.off('update', onUpdate);
                        const rerenderValue = {
                            value: e.detail.value
                        }
                        wrapper.innerHTML = renderer(select('template[data-property="' + wrapper.dataset.property + '"]').innerHTML, rerenderValue);
                        initPropertyField(wrapper);
                    }
                    this.resizeIframe();
                };
                wrapper.on('update', onUpdate);
            }
        }

        propertiesEvents.forEach(function(propId) {
            const wrapper = select('property-wrapper[data-id="' + propId + '"]');
            initPropertyField(wrapper);
        });
        

        /* PLAN A DRAG AND DROP INSTEAD OF ARROWS */
        select('#fc-remove', this.fieldPropertiesBlock).on('click', (id => {
            return () => {
                for (let i = 0; i < formacopoeia.currentForm.length; ++i) {
                    if (id === formacopoeia.currentForm[i].id) {
                        formacopoeia.currentForm.splice(i, 1);
                        const tmp = select('field-wrapper[data-id="' + id + '"]', this.iframeDoc);
                        tmp.parentNode.removeChild(tmp);
                        this.fieldPropertiesBlock.removeChild(this.fieldPropertiesBlock.firstChild);
                        this.resizeIframe();
                        return;
                    }
                }
            }
        })(id));
        this.resizeIframe();
    },
    manageButtons() {
        const form = select('#fc-form', this.iframeDoc);
        const choices = select('div#choices');

        for (var i = 0; i < formacopoeia.fields.length; ++i) {
            choices.innerHTML += '<button class="new-field" data-field="' + formacopoeia.fields[i].name + '">' + formacopoeia.fields[i].options.label + '</button>';
        }

        const buttonsNewField = selectAll('button.new-field');

        select('#fc-add').addEventListener('click', () => {
            this.resizeIframe();
        });

        toArray(buttonsNewField).forEach(item => {
            item.addEventListener('click', e => {
                const id = guidGenerator();
                const field = getFieldByType(e.target.dataset.field);
                const properties = {};
                for (let prop in field.options.props) {
                    const property = getPropertyByName(field.options.props[prop].type);
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
                this.togglePropertiesBlock(id);
            });
        });
    },
    onInit() {
        
    },
    onActive() {
        const srcdoc = `
            <form id="fc-form"></form>
            <link rel="stylesheet" href="/wp-content/plugins/formacopoeia/assets/admin/css/core.css">
            <link id="fc-theme-style" rel="stylesheet" href="` + formacopoeia.frontStyle + `">
            <link id="fc-style" rel="stylesheet" href="">
        `;

        const iframe = select('#fc-preview');
        iframe.srcdoc = srcdoc;
        this.themeSelector = select('#fc-theme');
        this.classesInput = select('#fc-classes');

        domReady(() => {
            this.iframe = iframe;
            this.iframeReady(iframe);    
        }, iframe.contentWindow);
    },
    onRemoveActive() {
        
    },
    onSave() {
        var form = select('#fc-form', this.iframeDoc);
        return {
            classes: this.classesInput.value,
            theme: this.themeSelector.value
        };
    }
}