const select = function(selector, ancestor) {
    if (!ancestor) {
        ancestor = document;
    }
    return ancestor.querySelector(selector);
};

const selectAll = function(selector, ancestor) {
    if (!ancestor) {
        ancestor = document;
    }
    return ancestor.querySelectorAll(selector);
};

HTMLElement.prototype.on = Node.prototype.on = window.on = function(name, fn) {
    this.addEventListener(name, fn);
};

Node.prototype.off = window.off = function(name, fn) {
    this.removeEventListener(name, fn);
};

NodeList.prototype.__proto__ = Array.prototype;

NodeList.prototype.on = NodeList.prototype.addEventListener = function(name, fn) {
    this.forEach(function(item) {
        item.on(name, fn);
    });
};

NodeList.prototype.off = NodeList.prototype.removeEventListener = function(name, fn) {
    this.forEach(function(item) {
        item.off(name, fn);
    });
};

function toArray(object) {
    return [].slice.call(object);
}

const domReady = function(callback, target) {
    if (!target) {
        target = window;
    }
    target.addEventListener('DOMContentLoaded', callback);
};