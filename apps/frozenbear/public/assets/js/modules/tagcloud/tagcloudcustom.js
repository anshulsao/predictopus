YCustom.later(10, window, function() {
    var settings = {
        "size": {
            "grid": 10, // word spacing; smaller is more tightly packed but takes longer
            "factor": 0, // font resizing factor; default "0" means automatically fill the container
            "normalize": true // reduces outlier weights for a more attractive output
        },
        "color": {
            "background": "#fff", // default is transparent
            "start": "#20f", // color of the smallest font
            "end": "#e00" // color of the largest font
        },
        "options": {
            "color": "random-dark", // if set to "random-light" or "random-dark", color.start and color.end are ignored
            "rotationRatio": 0, // 0 is all horizontal words, 1 is all vertical words
            "printMultiplier": 1 // 1 will look best on screen and is fastest; setting to 3.5 gives nice 300dpi printer output but takes longer
        },
        "font": "Futura, Helvetica, sans-serif", // font family, identical to CSS font-family attribute
        "shape": "circle", // one of "circle", "square", "diamond", "triangle", "triangle-forward", "x", "pentagon" or "star"; this can also be a function with the following prototype - function( theta ) {}
    };


    $("#wordcloud1").awesomeCloud(settings);
});

