const test = {
    onInit() {
        formacopoeia.currentForm.tabs.after = 
            formacopoeia.currentForm.tabs.after ||
            {name: formacopoeia.afters[0].name}
        ;
        return {
            afters: formacopoeia.afters
        };
    },
    onActive() {
        const afterSelect = fcUtils.select('#fc-after');
        afterSelect.on('change', (e) => {
            console.log(e.target.value)
            formacopoeia.currentForm.tabs.after = {
                name: e.target.value
            };
            this.displayContent(e.target.value);
        });
        this.displayContent(formacopoeia.currentForm.tabs.after.name);
    },
    displayContent(name: string) {
        const data = {};
        const templateElement = fcUtils.select('[data-template-after="' + name + '"]');
        if (!templateElement) {
            return;
        }
        fcUtils.select('#fc-after-content').innerHTML = renderer(templateElement.innerHTML, data);
    }
};