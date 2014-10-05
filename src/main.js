define(function(require, exports, module) {
    // import dependencies
    var Engine = require('famous/core/Engine');
    var Modifier = require('famous/core/Modifier');
    var Transform = require('famous/core/Transform');
    var ImageSurface = require('famous/surfaces/ImageSurface');
    var Surface = require('famous/core/Surface');
    var ListView  = require('app/ListView');
    var StateModifier = require('famous/modifiers/StateModifier');


    // create the main context
    var mainContext = Engine.createContext();

    var header = new Surface({
        size: [undefined,200],
        content: _.unescape(php_vars['header']),
        properties: {
            color: 'white',
            textAlign: 'center',
            backgroundColor: 'black'
        }
        });
    var sidebar = new Surface({
        size: [undefined,200],
        content: php_vars['sidebar'],
        properties: {
            color: 'black',
            textAlign: 'center',
            backgroundColor: 'white'
        }
        });
    var cleanfooter = _.unescape(php_vars['footer']);
    var footer = new Surface({
        size: [undefined,250],
        content: cleanfooter,
        properties: {
            color: 'white',
            textAlign: 'left',
            backgroundColor: 'black'
        }
        });
    var listView = new ListView({listData: recentPosts});

    var footerPosition = new Modifier({
        align: [0,0.8]
    });
    mainContext.add(footerPosition).add(footer);
    //mainContext.add(header);
    mainContext.add(listView);
    //mainContext.add(sidebar);
    
});
