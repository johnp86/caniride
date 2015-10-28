
// First lets create our drawing surface out of existing SVG element
// If you want to create new surface just provide dimensions
// like s = Snap(800, 600);
var s = Snap("#svg");
var stage = document.getElementById('svg');
var weatherColor;
var weather;
//var animating = true;
var body = document.getElementsByTagName("body");

raining = s.rect(10,10,4,10).attr({fill:'#70ADDF'}).pattern(0,0,25,25).attr({patternTransform: 'rotate(45)'});
var rainCont = null;
var sun = s.circle(420, 100, 0);

function changeWeather(weath) {


    if(weath == "ride-good") {
        weatherColor = "#bbdfe5";
        weather = 'good';
        // sun
        sun = s.circle(420, 100, 80);
        sun.attr({
            fill: '#F7EB60'
        });
        raining.remove();
    }
    if(weath == "ride-maybe") {
        sun.remove();
        raining.remove();
        rainCont = null;
        clouds.selectAll('ellipse').attr({fill: '#fff'});
        clouds.selectAll('rect').attr({fill: '#fff'});
        weatherColor = "#a4b9bc";
        weather = 'maybe';
        animationClouds();
    }
    if(weath == "ride-bad") {
        sun.remove();
        weatherColor = "#a9a9a9";
        weather = 'bad';
        clouds.selectAll('ellipse').attr({fill: '#777'});
        clouds.selectAll('rect').attr({fill: '#777'});
        // rain
        raining = s.rect(10,10,4,10).attr({fill:'#70ADDF'}).pattern(0,0,25,25).attr({patternTransform: 'rotate(45)'});
        rainCont = s.rect(0,0,'100%','100%').attr({fill: raining});
        animationRain = function () {
            raining.transform('t0,0');
            animateAlongPath(rainPath, raining, 0, 3000, animationRain);
        };
        animationRain();
        animationClouds();
    }
    stage.style.backgroundColor = weatherColor;
}

stage.style.backgroundColor = weatherColor;

for (var i = 0; i < body.length; i++) {
    changeWeather( body[i].id );
}


var buildings = s.select('#buildings');
var hills =  s.select('#hills');
var scooter =  s.select('#scooter');
var wheel1 =  s.select('.wheel1');
var wheel2 =  s.select('.wheel2');
var clouds =  s.select('#clouds');

//colours
// var hot = "#bbdfe5";
// var cloudy = "#a4b9bc";
// var cold = "#a9a9a9";

// // set main background color

// trees
// Snap.load("tree.svg", onSVGLoaded ) ;

// function onSVGLoaded( data ){ 
//     s.append( data );
// }

// scooter
// Snap.load("scooter.svg", onSVGLoaded ) ;

// function onSVGLoaded( data ){ 
//     var scooter = s.append( data );
// }

// sun
// var sun = s.circle(420, 100, 80);
// sun.attr({
//     fill: 'yellow'
// });

// grass
var grass = s.rect(0, 400, 600, 200);
grass.attr({
    fill: '#74a46d'
});



// road
var road = s.rect(0, 450, 600, 120);
road.attr({
    fill: '#666'
});

var grass2 = s.rect(0, 570, 600, 500);
grass2.attr({
    fill: '#74a46d'
});

// hills

//s.selectAll(".ellipse").attr({fill: 'red'});

var roadMarking = s.rect(10,10,60,16).attr({fill:'#fff'}).pattern(0,0,120,16).transform('skewX(-20)');

var roadMarkings = s.rect(0, 500, 600, 14);
roadMarkings.attr({
    fill: roadMarking
});


var sn = Snap('.snap'),
path = sn.select('.roadPath'),
hillPath = sn.select('.hillPath'),
rainPath = sn.select('.rainPath'),
buildingPath = sn.select('.buildingPath'),
roadMove = roadMarking,
treeMove = s.select('#XMLID_1_'),
animationRoad,
animationTrees,
animationHills,
animateAlongPath;

s.append(treeMove);
s.append(scooter);

animationRoad = function () {
    roadMove.transform('t0,0');
    animateAlongPath(path, roadMove, 0, 600, animationRoad);
};
animationTrees = function () {
    treeMove.transform('t0,-280');
    animateAlongPath(path, treeMove, 0, 900, animationTrees);
};
animationHills = function () {
    hills.transform('t0,-480');
    animateAlongPath(hillPath, hills, 0, 2000, animationHills);
};
animationBuildings = function () {
    buildings.transform('t0,-420');
    animateAlongPath(buildingPath, buildings, 0, 6500, animationBuildings);
};
animationClouds = function () {
    clouds.transform('t0,100');
    animateAlongPath(path, clouds, 0, 40000, animationClouds);
};

animateAlongPath = function (path, el, start, duration, easing, callback) {
  var len = Snap.path.getTotalLength(path), 
      elBB =  el.getBBox(),
      elCenter = {
        x: elBB.x + (elBB.width / 2),
        y: elBB.y + (elBB.height / 2),
      };

    Snap.animate(start, len, function (value) {
      var movePoint = Snap.path.getPointAtLength(path, value);
      el.transform('t'+ (movePoint.x - elCenter.x) + ',' + (movePoint.y - elCenter.y));
    }, duration, easing, function () {
      if (callback) callback(path);
    });
};

animationRoad();
animationTrees();
animationHills();
animationBuildings();




// scooter animation
scooter.transform('t-800,0');

scooterStartMatrix = new Snap.Matrix(),
scooterMidMatrix = new Snap.Matrix(),
scooterEndMatrix = new Snap.Matrix();

// Sets up the matrix transforms
scooterStartMatrix.translate(-1000, 0);
scooterMidMatrix.translate(-420,0);

scooter.animate({
  transform: scooterStartMatrix
}, 1250, function () {
    scooter.animate({
    transform: scooterMidMatrix
  }, 1250, mina.easein)
});


// wheels
function rotateWheel1(){
    wheel1.animate(
        { transform: 'r20'}, // Basic rotation around a point. No frills.
        40, // Nice slow turning rays
        function(){ 
            wheel1.attr({ transform: 'rotate(0)'}); // Reset the position of the rays.
            rotateWheel1(); // Repeat this animation so it appears infinite.
        }
    );

};
function rotateWheel2(){
    wheel2.animate(
        { transform: 'r20'}, // Basic rotation around a point. No frills.
        40, // Nice slow turning rays
        function(){ 
            wheel2.attr({ transform: 'rotate(0)'}); // Reset the position of the rays.
            rotateWheel2(); // Repeat this animation so it appears infinite.
        }
    );

};
rotateWheel1();
rotateWheel2();


//clouds
// Snap.load("scooter.svg", onSVGLoaded ) ;

// function onSVGLoaded( data ){ 
//     var scooter = s.append( data );
// }
// var cloud = s.select('.cloud');
// var containerHeight = s.node.offsetHeight / 4,
// numberOfClouds = 10;

// // Gets the width of the container
// cloudWidth = s.select('#a').getBBox().w;

// // Creates a group element
// clouds = s.g();

// // Loop to create clouds
// for ( var i = numberOfClouds; i >= 0; i-- ) {
//     var x = Math.floor(Math.random() * cloudWidth),
//         y = -Math.floor(Math.random() * containerHeight),
//         newCloud = cloud.use(),
//         randomScale = Math.random() * (0.9 - 0.2) + 0.2;
//     // Applies our new attributes to the use element
//     newCloud.attr({
//       x: x,
//       y: y,
//       transform: 's' + randomScale
//     });

//     // Adds the use element to our group
//     clouds.add(newCloud);
// };



