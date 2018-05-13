Handlebars.registerHelper('translate', function() {
    const context = ('object' !== typeof arguments[1] ? arguments[1] + '.' : '') + arguments[0];
    return fcUtils.translate(context) || context;
});

Handlebars.registerHelper('isSelected', function(value) {
    return value ? 'selected' : '';
});

Handlebars.registerHelper('isChecked', function(value) {
    return value ? 'checked' : '';
});

// Handlebars.registerHelper('each', function(context, options) {
//     console.log(context, options)
//     var ret = "";
  
//     for(var i=0, j=context.length; i<j; i++) {
//       ret = ret + options.fn(context[i]);
//     }
  
//     return ret;
// });

Handlebars.registerHelper('in', function(context, options) {
    var ret = '';
    if (!context) {
        return ret;
    }
  
    for(var i in context) {
        var row = {$property: i, data: context[i]};
        ret = ret + options.fn(row);
    }
  
    return ret;
});

Handlebars.registerHelper('each2', function(context, options) {
    var ret = '';
    if (!context) {
        return ret;
    }
  
    for(var i=0, j=context.length; i<j; i++) {
        var row = {$row: i, data: context[i]};
        ret = ret + options.fn(row);
    }
  
    return ret;
});

Handlebars.registerHelper('eachJSON', function(value, options) {
    var array = value ? JSON.parse(value) : [];
    var ret = '';
    for(var i = 0; i < array.length; ++i) {
      ret = ret + options.fn(array[i]);
    }
  
    return ret;
});

Handlebars.registerHelper('displayLabel', function(value, options) {
    for (var i = 0; i < formacopoeia.behaviours.length; ++i) {
        if (value === formacopoeia.behaviours[i].name) {
            return formacopoeia.behaviours[i].options.label;
        }
    }
});