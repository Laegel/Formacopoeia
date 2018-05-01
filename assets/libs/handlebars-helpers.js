Handlebars.registerHelper('translate', function(context) {
    return context;
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

Handlebars.registerHelper('each2', function(context, options) {
    var ret = "";
  
    for(var i=0, j=context.length; i<j; i++) {
        var row = {$row: i, data: context[i]};
        ret = ret + options.fn(row);
    }
  
    return ret;
});

Handlebars.registerHelper('eachJSON', function(value, options) {
    var array = value ? JSON.parse(value) : [];
    var ret = '';
    console.log(value, array)
    for(var i = 0; i < array.length; ++i) {
      ret = ret + options.fn(array[i]);
    }
  
    return ret;
  });