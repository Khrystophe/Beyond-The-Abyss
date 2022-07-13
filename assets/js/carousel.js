let options = {
  accessibility: true,
  prevNextButtons: true,
  pageDots: true,
  setGallerySize: false,
  arrowShape: {
    x0: 10,
    x1: 60,
    y1: 50,
    x2: 60,
    y2: 45,
    x3: 15
  }
};

let carousel = document.querySelector('[data-carousel]');
let slides = document.getElementsByClassName('carousel-cell');
let flkty = new Flickity(carousel, options);

flkty.on('scroll', function () {
  flkty.slides.forEach(function (slide, i) {
    let image = slides[i];
    let x = (slide.target + flkty.x) * -1/3;
    image.style.backgroundPosition = x + 'px';
  });
});