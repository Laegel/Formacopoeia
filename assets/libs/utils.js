const utils = {
    translate(context, data) {
        let value = this.resolve(formacopoeia.translations, context);
        if (data) {
            for (let key in data) {
                value = value.replace(new RegExp(key, 'g'), data[key]);
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
    }
};