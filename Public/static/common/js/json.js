$.toJSON = typeof JSON === 'object' && JSON.stringify ? JSON.stringify : function (o){
    if(o === null){return 'null';}

    var pairs, k, name, val, type = $.type(o);
    if(type === 'undefined'){return undefined;}

    if(type === 'number' || type === 'boolean'){
        return String(o);}
    if(type === 'string'){
        return $.quoteString(o);}
    if(typeof o.toJSON === 'function'){
        return $.toJSON(o.toJSON());}
    if(type === 'date'){
        var month = o.getUTCMonth() + 1,
            day = o.getUTCDate(),
            year = o.getUTCFullYear(),
            hours = o.getUTCHours(),
            minutes = o.getUTCMinutes(),
            seconds = o.getUTCSeconds(),
            milli = o.getUTCMilliseconds();

        if(month < 10){month = '0' + month;}
        if(day < 10){day = '0' + day;}
        if(hours < 10){hours = '0' + hours;}
        if(minutes < 10){minutes = '0' + minutes;}
        if(seconds < 10){seconds = '0' + seconds;}
        if(milli < 100){milli = '0' + milli;}
        if(milli < 10){milli = '0' + milli;}
        return '"' + year + '-' + month + '-' + day + 'T' + hours + ':' + minutes + ':' + seconds + '.' + milli + 'Z"';
    }
    pairs = [];
    if($.isArray(o)){
        for (k = 0; k < o.length; k++){
            pairs.push($.toJSON(o[k]) || 'null');
        }
        return '[' + pairs.join(',') + ']';
    }

    // Any other object (plain object, RegExp, ..)
    // Need to do typeof instead of $.type, because we also
    // want to catch non-plain objects.
    if(typeof o === 'object'){
        for (k in o){
            // Only include own properties,
            // Filter out inherited prototypes
            if(hasOwn.call(o, k)){
                // Keys must be numerical or string. Skip others
                type = typeof k;
                if(type === 'number'){
                    name = '"' + k + '"';
                }else if(type === 'string'){
                    name = $.quoteString(k);
                }else{
                    continue;
                }
                type = typeof o[k];

                // Invalid values like these return undefined
                // from toJSON, however those object members
                // shouldn't be included in the JSON string at all.
                if(type !== 'function' && type !== 'undefined'){
                    val = $.toJSON(o[k]);
                    pairs.push(name + ':' + val);
                }
            }
        }
        return '{' + pairs.join(',') + '}';
    }
};