var test = {
    onInit: function () {
        return {
            behaviours: formacopoeia.behaviours
        };
    },
    onActive: function () {
        var _this = this;
        var selectBehaviour = select('#fc-select-behaviour');
        var addBehaviour = select('#fc-add-behaviour');
        var behaviours;
        addBehaviour.on('click', function (e) {
            formacopoeia.currentForm.tabs.behaviours = formacopoeia.currentForm.tabs.behaviours || [];
            formacopoeia.currentForm.tabs.behaviours.push({
                name: selectBehaviour.value
            });
            _this.rerenderBehavioursList();
            _this.toggleBehaviourContent(select('.fc-behaviour:last-child'));
        });
        this.rerenderBehavioursList();
        this.manageButtons();
    },
    rerenderBehavioursList: function () {
        select('.rows').innerHTML = renderer(select('[data-template-part="behaviourRows"]').innerHTML, {
            formBehaviours: formacopoeia.currentForm.tabs.behaviours,
            behaviours: formacopoeia.behaviours
        });
        selectAll('.fc-behaviour-container').forEach(function (element) {
            element.innerHTML = renderer(select('[data-template-behaviour="' + element.dataset.behaviour + '"]').innerHTML); //TODO
        });
    },
    removeBehaviour: function (element) {
        formacopoeia.currentForm.tabs.behaviours.splice(element.dataset.row, 1);
        element.remove();
    },
    toggleBehaviourContent: function (element) {
        var toggleClasses = function (el) {
            el.classList.toggle('dashicons-arrow-down-alt2');
            el.classList.toggle('dashicons-arrow-up-alt2');
        };
        selectAll('.fc-behaviour').forEach(function (item) {
            if (item === element) {
                return;
            }
            var toggler = select('.fc-accordion', item);
            toggler.classList.add('dashicons-arrow-down-alt2');
            toggler.classList.remove('dashicons-arrow-up-alt2');
            select('.container', item).removeAttribute('style');
        });
        toggleClasses(select('.fc-accordion', element));
        var container = select('.container', element);
        if (!container.style) {
            container.style.display = 'block';
        }
        else {
            container.removeAttribute('style');
        }
    },
    manageButtons: function () {
        var _this = this;
        select('.fc-tab-content').on('click', function (e) {
            if (e.target.classList.contains('fc-remove')) {
                _this.removeBehaviour(e.target.closest('.fc-behaviour'));
            }
            if (e.target.classList.contains('fc-accordion')) {
                _this.toggleBehaviourContent(e.target.closest('.fc-behaviour'));
            }
        });
    }
};
