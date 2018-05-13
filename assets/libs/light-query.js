// console.log(fcUtils);


// fcUtils.select = function(selector, ancestor) {
//     if (!ancestor) {
//         ancestor = document;
//     }
//     return ancestor.querySelector(selector);
// };

// fcUtils.selectAll = function(selector, ancestor) {
//     if (!ancestor) {
//         ancestor = document;
//     }
//     return ancestor.querySelectorAll(selector);
// };

// if (fcUtils) {
//     console.log(fcUtils.select('#wpwrap'));
    
// }

// HTMLElement.prototype.on = Node.prototype.on = window.on = function(name, fn) {
//     this.addEventListener(name, fn);
// };

// Node.prototype.off = window.off = function(name, fn) {
//     this.removeEventListener(name, fn);
// };

// Node.prototype.remove = function() {
//     this.parentNode.removeChild(this);
// };

// NodeList.prototype.__proto__ = Array.prototype;

// NodeList.prototype.on = NodeList.prototype.addEventListener = function(name, fn) {
//     this.forEach(function(item) {
//         item.on(name, fn);
//     });
// };

// NodeList.prototype.off = NodeList.prototype.removeEventListener = function(name, fn) {
//     this.forEach(function(item) {
//         item.off(name, fn);
//     });
// };

// fcUtils.domReady = function(callback, target) {
//     if (!target) {
//         target = window;
//     }
//     target.addEventListener('DOMContentLoaded', callback);
// };

// if (!Element.prototype.matches) {
//     Element.prototype.matches = Element.prototype.msMatchesSelector || 
//                                 Element.prototype.webkitMatchesSelector;
// }

// if (!Element.prototype.closest) {
//     Element.prototype.closest = function(s) {
//         var el = this;
//         if (!document.documentElement.contains(el)) return null;
//         do {
//             if (el.matches(s)) return el;
//             el = el.parentElement || el.parentNode;
//         } while (el !== null); 
//         return null;
//     };
// }

// (function() {
//     if ('function' === typeof window.CustomEvent) {
//         return false;
//     }
  
//     function CustomEvent(event, params) {
//         params = params || {bubbles: false, cancelable: false, detail: undefined};
//         var evt = document.createEvent( 'CustomEvent' );
//         evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
//         return evt;
//     }
  
//     CustomEvent.prototype = window.Event.prototype;
  
//     window.CustomEvent = CustomEvent;
// })();