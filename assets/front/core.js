var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : new P(function (resolve) { resolve(result.value); }).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = y[op[0] & 2 ? "return" : op[0] ? "throw" : "next"]) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [0, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
fcUtils.domReady(function () {
    return __awaiter(this, void 0, void 0, function () {
        var _this = this;
        var slots;
        return __generator(this, function (_a) {
            qwest.setDefaultOptions({
                responseType: 'json'
            });
            slots = fcUtils.selectAll('form[data-formacopoeia]');
            slots.forEach(function (slot) { return __awaiter(_this, void 0, void 0, function () {
                var data, formContent;
                return __generator(this, function (_a) {
                    switch (_a.label) {
                        case 0:
                            slot.removeAttribute('action');
                            slot.removeAttribute('method');
                            return [4 /*yield*/, qwest.get('/wp-admin/admin-ajax.php', {
                                    action: 'get_form',
                                    id: slot.dataset.formacopoeia,
                                    token: slot.dataset.token
                                })];
                        case 1:
                            data = _a.sent();
                            formContent = '';
                            data.response.form.forEach(function (field) {
                                if (formacopoeia.fields[field.type] && formacopoeia.fields[field.type].onInit) {
                                    formacopoeia.fields[field.type].onInit(fcUtils.select('[data-id="' + field.id + '"]'), field.props);
                                }
                            });
                            // slot.removeAttribute('data-token');
                            slot.on('submit', function (e) {
                                return __awaiter(this, void 0, void 0, function () {
                                    var formData, result, event;
                                    return __generator(this, function (_a) {
                                        switch (_a.label) {
                                            case 0:
                                                e.preventDefault();
                                                formData = new FormData(this);
                                                return [4 /*yield*/, qwest.post('/wp-admin/admin-ajax.php', formData, {
                                                        dataType: 'formdata'
                                                    })];
                                            case 1:
                                                result = _a.sent();
                                                event = new CustomEvent('fc:after', {
                                                    detail: {
                                                        response: result.response
                                                    },
                                                    bubbles: true,
                                                    cancelable: true
                                                });
                                                this.dispatchEvent(event);
                                                return [2 /*return*/];
                                        }
                                    });
                                });
                            });
                            slot.on('fc:after', function (data) {
                                if (data.detail.response.after && formacopoeia.afters[data.detail.response.after.name]) {
                                    formacopoeia.afters[data.detail.response.after.name](this, data.detail.response);
                                }
                            });
                            return [2 /*return*/];
                    }
                });
            }); });
            return [2 /*return*/];
        });
    });
});
function guidGenerator() {
    var S4 = function () {
        return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
    };
    return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
}
