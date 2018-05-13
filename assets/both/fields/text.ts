const test = {
    onInit(wrapper, data) {
        fcUtils.select('input', wrapper).on('input', function() {
            console.log(this.value, data);
        });
    }
};