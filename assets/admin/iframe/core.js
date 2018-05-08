var functions = {
    drag: function (e) {
        e.dataTransfer.setData('text', e.target.dataset.id);
    },
    dragOver: function (e) {
        e.preventDefault();
    },
    drop: function (e) {
        var container = document.querySelector('#fc-form');
        e.preventDefault();
        var data = e.dataTransfer.getData('text');
        var target = e.target.closest('[draggable]');
        var element = document.querySelector('[data-id="' + data + '"]');
        var before = e.clientY < target.offsetTop + target.offsetHeight / 2;
        if (before) {
            container.insertBefore(element, target);
        }
        else {
            container.insertBefore(element, target.nextElementSibling);
        }
    }
};
