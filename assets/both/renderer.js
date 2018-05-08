// Be careful with bind:x="dataKey" -> Handlebars vars can be scoped

function renderer(template, data) {
    const booleanAttributes = ['checked', 'selected'];

    function manageBind(element, attribute, data) {
        const property = attribute.name.replace('bind:', '');
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
    }

    const parser = new DOMParser();
    doc = parser.parseFromString(template, 'text/html');
    toArray(doc.all).forEach(function(element) {
        if (-1 !== ['html', 'head', 'body'].indexOf(element.localName)) {
            return;
        }
        toArray(element.attributes).forEach(function(attribute) {
            if (0 === attribute.name.indexOf('bind:')) {
                manageBind(element, attribute, data);
                return;
            }
        });
    });
    const handlebarTemplate = Handlebars.compile(doc.body.innerHTML);
    return handlebarTemplate(data);
}