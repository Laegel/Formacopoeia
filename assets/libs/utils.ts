const fcUtils = {
    translate(context, data) {
        let value = this.resolve(formacopoeia.translations, context);
        if (data) {
            for (let key in data) {
                value = value.replace(new RegExp('{{' + key + '}}', 'g'), data[key]);
            }
        }
        if (!value) {
            console.log(context + ' is not translated!');
            return context;
        }
        return value;
    },
    resolve(o, s) {
        s = s.replace(/\[(\w+)\]/g, '.$1');
        s = s.replace(/^\./, '');
        const a = s.split('.');
        for (let i = 0, n = a.length; i < n; ++i) {
            const k = a[i];
            if (k in o) {
                o = o[k];
            } else {
                return;
            }
        }
        return o;
    },
    toArray(object) {
        return [].slice.call(object);
    },
    getRootElement(doc) {
        let container;
        this.toArray(doc.all).some(item => {
            if (-1 === ['html', 'head', 'body'].indexOf(item.localName)) {
                container = item;
                return true;
            }
        });
        return container;
    },
    guidGenerator() {
        const S4 = function() {
           return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
        };
        return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
    },
    select(selector, ancestor) {
        if (!ancestor) {
            ancestor = document;
        }
        return ancestor.querySelector(selector);
    },
    selectAll(selector, ancestor) {
        if (!ancestor) {
            ancestor = document;
        }
        return ancestor.querySelectorAll(selector);
    },
    domReady(callback, target) {
        if (!target) {
            target = window;
        }
        target.addEventListener('DOMContentLoaded', callback);
    }
};

HTMLElement.prototype.on = Node.prototype.on = window.on = function(name, fn) {
    this.addEventListener(name, fn);
};

Node.prototype.off = window.off = function(name, fn) {
    this.removeEventListener(name, fn);
};

Node.prototype.remove = function() {
    this.parentNode.removeChild(this);
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

if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector || 
                                Element.prototype.webkitMatchesSelector;
}

if (!Element.prototype.closest) {
    Element.prototype.closest = function(s) {
        var el = this;
        if (!document.documentElement.contains(el)) return null;
        do {
            if (el.matches(s)) return el;
            el = el.parentElement || el.parentNode;
        } while (el !== null); 
        return null;
    };
}

(function() {
    if ('function' === typeof window.CustomEvent) {
        return false;
    }
  
    function CustomEvent(event, params) {
        params = params || {bubbles: false, cancelable: false, detail: undefined};
        var evt = document.createEvent( 'CustomEvent' );
        evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
        return evt;
    }
  
    CustomEvent.prototype = window.Event.prototype;
  
    window.CustomEvent = CustomEvent;
})();