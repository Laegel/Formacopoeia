const test = {
    onInit() {
        return {
            behaviours: formacopoeia.behaviours
        };
    },
    onActive() {
        const selectBehaviour = fcUtils.select('#fc-select-behaviour');
        const addBehaviour = fcUtils.select('#fc-add-behaviour');
        addBehaviour.on('click', e => {
            formacopoeia.currentForm.tabs.behaviours = formacopoeia.currentForm.tabs.behaviours || [];
            formacopoeia.currentForm.tabs.behaviours.push({
                name: selectBehaviour.value
            });
            this.rerenderBehavioursList();
            this.toggleBehaviourContent(fcUtils.select('.fc-behaviour:last-child'));
        });
        this.rerenderBehavioursList();
        this.manageButtons();
    },
    rerenderBehavioursList() {
        for (let i in tinyMCE.editors){
            tinyMCE.editors[i].remove();
        }
        fcUtils.select('.rows').innerHTML = renderer(fcUtils.select('[data-template-part="behaviourRows"]').innerHTML, {
            formBehaviours: formacopoeia.currentForm.tabs.behaviours,
            behaviours: formacopoeia.behaviours
        });

        fcUtils.selectAll('.fc-behaviour-container').forEach(element => {
            element.innerHTML = renderer(fcUtils.select('[data-template-behaviour="' + element.dataset.behaviour + '"]').innerHTML); 
            if (formacopoeia.behavioursComponents[element.dataset.behaviour] && formacopoeia.behavioursComponents[element.dataset.behaviour].onInit) {
                const ancestor = element.closest('[data-row]');
                formacopoeia.behavioursComponents[element.dataset.behaviour].onInit(element, formacopoeia.currentForm.tabs.behaviours[ancestor.dataset.row].values);
            }
        });
    },
    removeBehaviour(element) {
        const behaviour = fcUtils.select('[data-behaviour]', element).dataset.behaviour;
        formacopoeia.currentForm.tabs.behaviours.splice(element.dataset.row, 1);
        if (formacopoeia.behavioursComponents[behaviour].onRemoveActive) {
            formacopoeia.behavioursComponents[behaviour].onRemoveActive(element);
        }
        element.remove();
    },
    updateBehaviour(element) {
        const wrapper = fcUtils.select('[data-behaviour]', element);
        if (formacopoeia.behavioursComponents[wrapper.dataset.behaviour].onSave) {
            const values = formacopoeia.behavioursComponents[wrapper.dataset.behaviour].onSave(wrapper);
            formacopoeia.currentForm.tabs.behaviours[element.dataset.row].values = values;
        }
        toastr.info(fcUtils.translate('behaviours.messages.updated'));
    },
    toggleBehaviourContent(element) {
        const toggleClasses = function(el) {
            el.classList.toggle('dashicons-arrow-down-alt2');
            el.classList.toggle('dashicons-arrow-up-alt2');
        };
        fcUtils.selectAll('.fc-behaviour').forEach(item => {
            if (item === element) {
                return;
            }
            const toggler = fcUtils.select('.fc-accordion', item);
            toggler.classList.add('dashicons-arrow-down-alt2');
            toggler.classList.remove('dashicons-arrow-up-alt2');
            fcUtils.select('.row', item).removeAttribute('style');
            const behaviour = fcUtils.select('[data-behaviour]', item).dataset.behaviour;
            if (item.classList.contains('active') && formacopoeia.behavioursComponents[behaviour].onRemoveActive) {
                formacopoeia.behavioursComponents[behaviour].onRemoveActive(element);
            }
        });
        toggleClasses(fcUtils.select('.fc-accordion', element));
        const container = fcUtils.select('.row', element);
        const behaviour = fcUtils.select('[data-behaviour]', element).dataset.behaviour;
        if (!container.style.display) {
            element.classList.add('active');
            container.style.display = 'block';
            if (formacopoeia.behavioursComponents[behaviour].onActive) {
                formacopoeia.behavioursComponents[behaviour].onActive(element);
            }
        } else {
            element.classList.remove('active');
            container.removeAttribute('style');
            if (formacopoeia.behavioursComponents[behaviour].onRemoveActive) {
                formacopoeia.behavioursComponents[behaviour].onRemoveActive(element);
            }
        }
    },
    manageButtons() {
        fcUtils.select('.fc-tab-content').on('click', (e) => {
            if (e.target.classList.contains('fc-remove')) {
                this.removeBehaviour(e.target.closest('.fc-behaviour'));
            }
            if (e.target.classList.contains('fc-accordion')) {
                this.toggleBehaviourContent(e.target.closest('.fc-behaviour'));
            }
            if (e.target.classList.contains('fc-update')) {
                this.updateBehaviour(e.target.closest('.fc-behaviour'));
            }
        });
    }
}