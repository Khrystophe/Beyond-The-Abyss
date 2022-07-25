//////////////////////////////////ANIMATION ELEMENTS/////////////////////////

gsap.config({
  nullTargetWarn: false,
});

let toggle = document.querySelector('.toggle');
let body = document.querySelector('body');

let tl = gsap.timeline({defaults: {ease: "power4.inOut", duration: 2}})
let tl1 = gsap.timeline();


  tl
    .to('body', {
      opacity: 1,
      duration: 0.1,
    })
    .to('.ringThree', {
      opacity: 1,
      duration: 3
    }, "<1")
    .to('.miror h1', {
      opacity: 1,
      y: 0,
      duration: 2.2
    }, "<0.1")
    .to('.titles, .line.one, .line.two, .line.three', {
      stagger: .1,
      duration: 1.2,
      opacity: 1,
      y: 0
    }, "-=2")
    .to('.hero-slider', {
      opacity: 1
    }, "-=2")
    .from(".box, .box h2", {
      duration: 2,
      scale: 0.1,
      opacity: 0,
      y: 40,
      ease: "power1.inOut",
      stagger: {
        grid: [7, 15],
        from: "edges",
        amount: 1.5
      }
    }, "<-2")
    .to('footer', {
      opacity: 1
    })


toggle.addEventListener('click', function() {
  if (body.classList.contains('open')) {
    //Fermer le menu.
    body.classList.remove('open');

    tl
      .set('.autoAlpha', {
        autoAlpha: 1
      })
      .to('.ringThree', {
        opacity: 1,
        duration: 3
      })
      .to('.miror h1', {
        opacity: 1,
        y: 0,
        duration: 2.2
      }, "<0.1")
      .to('.titles, .line.one, .line.two, .line.three', {
        stagger: .1,
        duration: 1.2,
        opacity: 1,
        y: 0
      }, "-=2")
      .to('footer', {
        opacity: 1
      }, "-=2")
      .to('.hero-slider', {
        opacity: 1,
        duration: 3.9
      }, "-=2")

    tl1
      .to('.sep', {
        duration: 0.75,
        height: 0
      })
      .to('.sep__icon', {
        duration: 0.25,
        opacity: 0
      }, "<0.25")
      .to('.menu__left__inner__item', {
        x: -80,
        y: -180,
        opacity: 0,
        stagger: 0.25
      }, "<-0.5")
      .to('.menu__right__inner__item', {
        x: 80,
        y: -80,
        opacity: 0,
        stagger: 0.25
      }, "<0.3")

  } else {
    //Ouvrir le menu.
    body.classList.add('open');

    tl
      .to('.ringThree', {
        opacity: 0,
        duration: 2.2
      })
      .to('.titles, .line.one, .line.two, .line.three', {
        stagger: -0.1,
        duration: 0.7,
        opacity: 0,
        y: 100
      }, "-=2")
      .to('.miror h1', {
        opacity: 0,
        y: 100,
        duration: 2
      }, "-=2.3")
      .to('footer', {
        opacity: 0
      }, "-=2")
      .to('.hero-slider', {
        opacity: 0
      }, "-=2")
      .set('.autoAlpha', {
        autoAlpha: 0
      })

    tl1
      .set('.menu__left__inner__item, .menu__right__inner__item', {
        opacity: 1,
        y: 0,
        x: 0
      })
      .to('.sep', {
        duration: 0.75,
        height: '100%',
        delay: 0.5
      }, "+=0.7")
      .to('.sep__icon', {
        opacity: 1,
        duration: 0.25,
        delay: -0.5
      })
      .from('.menu__left__inner__item', {
        x: -40,
        y: -40,
        opacity: 0,
        stagger: 0.25
      }, "<-0.5")
      .from('.menu__right__inner__item', {
        x: 40,
        y: -40,
        opacity: 0,
        stagger: 0.25
      }, "<0.5")

  }
})

let link= document.querySelectorAll('.link');

for (let i = 0 ; i < link.length; i++) {
  link[i].addEventListener('click', function(){
    if(body.classList.contains('open')) {
      
      body.classList.remove('open');

      tl1
          .to('.sep', {
            duration: 0.75,
            height: 0
          })
          .to('.sep__icon', {
            duration: 0.25,
            opacity: 0
          }, "<0.25")
          .to('.menu__left__inner__item', {
            x: -80,
            y: -180,
            opacity: 0,
            stagger: 0.25
          }, "<-0.5")
          .to('.menu__right__inner__item', {
            x: 80,
            y: -80,
            opacity: 0,
            stagger: 0.25
          }, "<0.3")
    }
  })
}
//////////////////////////////////CAROUSEL///////////////////////////////////

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





