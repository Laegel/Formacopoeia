function formacopoeiaRenderer(template, data) {
    var parser = new DOMParser();
    doc = parser.parseFromString(template, 'text/html');
    [].slice.call(doc.all).forEach(function(element) {
        if (-1 !== ['html', 'head', 'body'].indexOf(element.localName)) {
            return;
        }
        [].slice.call(element.attributes).forEach(function(attribute) {
            if (0 !== attribute.name.indexOf('bind:')) {
                return;
            }
            var property = attribute.name.replace('bind:', '');
            if ('innertext' === property) {
                property = 'innerText';
            }
            console.log(property, attribute, data)
            element[property] = data[attribute.value] || '';
            element.removeAttribute(attribute.name);
        });
    });
    return doc.body.innerHTML;
}

function renderer(template, data) {
    var booleanAttributes = ['checked', 'selected'];
    var parser = new DOMParser();
    doc = parser.parseFromString(template, 'text/html');
    [].slice.call(doc.all).forEach(function(element) {
        if (-1 !== ['html', 'head', 'body'].indexOf(element.localName)) {
            return;
        }
        [].slice.call(element.attributes).forEach(function(attribute) {
            if (0 !== attribute.name.indexOf('bind:')) {
                return;
            }
            var property = attribute.name.replace('bind:', '');
            if (-1 !== booleanAttributes.indexOf(property)) {
                if (data[attribute.value]) {
                    element.setAttribute(property, property);
                } else {
                    element.removeAttribute(property);
                }
            } else {
                element[property] = data[attribute.value] || '';
                element.removeAttribute(attribute.name);
            }
        });
    });
    var handlebarTemplate = Handlebars.compile(doc.body.innerHTML);
    return handlebarTemplate(data);
}