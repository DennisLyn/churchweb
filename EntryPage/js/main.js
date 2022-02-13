(function($) {
  "use strict";
  // Fit header text to based on the element size
  $("h1").fitText(
    1.2, {
      minFontSize: '30px',
      maxFontSize: '60px'
    }
  );
  $("h2").fitText(
    1, {
      minFontSize: '25px',
      maxFontSize: '50px'
    }
  );
})(jQuery);

// Initial global values
// A list for background animated circles
let circleArray = null;
// For mouse position
const mouse = {
  x: undefined,
  y: undefined
};
// For circle color
const colorArray = [
  '255,255,255',
  '150,137,229',
  '180,229,137',
  '255,255,0'
];
// For animation time
let frame = 0;
// Canvas events
let canvas = document.querySelector('canvas');
canvas.height = window.innerHeight;
canvas.width = window.innerWidth;
c = canvas.getContext('2d');

initCanvas();
animate();

// Start to draw circles in the canvas
for (let i = 1; i <= 10; i++) {
  (function (index) {
    setTimeout(function () {
      mouse.x = 100 + i * 10;
      mouse.y = 100;
      drawCircles();
    }, i * 800);
  })(i);
}

// Re initiate canvas when window size is changed
window.addEventListener('resize', function(){
  canvas.height = window.innerHeight;
  canvas.width = window.innerWidth;
  initCanvas();
});

function initCanvas() {
  circleArray = [];
}

// Circle object for showing animated circles on the background
function Circle(x, y, radius, vx, vy, rgb, opacity, birth, life){
  this.x = x;
  this.y = y;
  this.radius = radius;
  this.minRadius = radius;
  this.vx = vx;
  this.vy = vy;
  this.birth = birth;
  this.life = life;
  this.opacity = opacity;

  this.draw = function() {
    c.beginPath();
    c.arc(this.x, this.y, this.radius, Math.PI * 2, false);
    c.fillStyle = 'rgba(' + rgb +','+ this.opacity +')';
    c.fill();
  }

  this.update = function(){
    if (this.x + this.radius > innerWidth || this.x - this.radius < 0) {
      this.vx = -this.vx;
    }

    if (this.y + this.radius > innerHeight || this.y - this.radius < 0) {
      this.vy = -this.vy;
    }

    this.x += this.vx;
    this.y += this.vy;
    this.opacity = 1- (((frame - this.birth) * 1) / this.life);

    if (frame > this.birth + this.life){
      for (let i = 0; i < circleArray.length; i++){
        if (this.birth == circleArray[i].birth && this.life == circleArray[i].life){
          circleArray.splice(i, 1);
          break;
        }
      }
    } else{
      this.draw();
    }
  }
}

function drawCircles() {
  for (let i = 0; i < 6; i++) {
    let radius = Math.floor(Math.random() * 20) + 2;
    let vx = (Math.random() * 10) - 1;
    let vy = (Math.random() * 10) - 1;
    let spawnFrame = frame;
    let rgb = colorArray[Math.floor(Math.random() * colorArray.length)];
    let life = 250;
    circleArray.push(new Circle(mouse.x, mouse.y, radius, vx, vy, rgb, 1, spawnFrame, life));
  }
}

function animate() {
  requestAnimationFrame(animate);
  frame += 1;
  c.clearRect(0, 0, innerWidth, innerHeight);
  for (let i = 0; i < circleArray.length; i++ ){
    circleArray[i].update();
  }
}
