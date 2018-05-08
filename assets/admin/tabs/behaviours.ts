const test = {
    onInit() {
        return {
            behaviours: formacopoeia.behaviours
        };
    },
    onActive() {
        const selectBehaviour = select('#fc-select-behaviour');
        const addBehaviour = select('#fc-add-behaviour');
        const behaviours
        addBehaviour.on('click', e => {
            formacopoeia.currentForm.tabs.behaviours = formacopoeia.currentForm.tabs.behaviours || [];
            formacopoeia.currentForm.tabs.behaviours.push({
                name: selectBehaviour.value
            });
            this.rerenderBehavioursList();
            this.toggleBehaviourContent(select('.fc-behaviour:last-child'));
        });
        this.rerenderBehavioursList();
        this.manageButtons();
    },
    rerenderBehavioursList() {
        select('.rows').innerHTML = renderer(select('[data-template-part="behaviourRows"]').innerHTML, {
            formBehaviours: formacopoeia.currentForm.tabs.behaviours,
            behaviours: formacopoeia.behaviours
        });

        selectAll('.fc-behaviour-container').forEach(element => {
            element.innerHTML = renderer(select('[data-template-behaviour="' + element.dataset.behaviour + '"]').innerHTML); //TODO
        });
    },
    removeBehaviour(element) {
        formacopoeia.currentForm.tabs.behaviours.splice(element.dataset.row, 1);
        element.remove();
    },
    toggleBehaviourContent(element) {
        const toggleClasses = function(el) {
            el.classList.toggle('dashicons-arrow-down-alt2');
            el.classList.toggle('dashicons-arrow-up-alt2');
        };
        selectAll('.fc-behaviour').forEach(item => {
            if (item === element) {
                return;
            }
            const toggler = select('.fc-accordion', item);
            toggler.classList.add('dashicons-arrow-down-alt2');
            toggler.classList.remove('dashicons-arrow-up-alt2');
            select('.container', item).removeAttribute('style');
        });
        toggleClasses(select('.fc-accordion', element));
        const container = select('.container', element);
        if (!container.style.display) {
            container.style.display = 'block';
        } else {
            container.removeAttribute('style');
        }
    },
    manageButtons() {
        select('.fc-tab-content').on('click', (e) => {
            if (e.target.classList.contains('fc-remove')) {
                this.removeBehaviour(e.target.closest('.fc-behaviour'));
            }
            if (e.target.classList.contains('fc-accordion')) {
                this.toggleBehaviourContent(e.target.closest('.fc-behaviour'));
            }
        });
    }
}