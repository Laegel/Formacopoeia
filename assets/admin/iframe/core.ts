const functions = {
    drag(e) {
        e.dataTransfer.setData('text', e.target.dataset.id);
    },
    dragOver(e) {
        e.preventDefault();
    },
    drop(e) {
        const container = document.querySelector('#fc-form');
        e.preventDefault();
        const data = e.dataTransfer.getData('text');
        const target = e.target.closest('[draggable]');
        const element = document.querySelector('[data-id="' + data + '"]');
        const before = e.clientY < target.offsetTop + target.offsetHeight / 2;
        if (before) {
            container.insertBefore(element, target);
        } else {
            container.insertBefore(element, target.nextElementSibling);
        }
    }
};