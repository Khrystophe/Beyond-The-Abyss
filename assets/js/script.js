//////////////////////////////////ANIMATION ELEMENTS/////////////////////////

gsap.config({
  nullTargetWarn: false,
});

let toggle = document.querySelector('.toggle');
let body = document.querySelector('body');

let tl = gsap.timeline({defaults: {ease: "power4.inOut", duration: 2}})
let tl1 = gsap.timeline();


function contentAnimation() {
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
}

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

///////////////////////////////////////CARDS////////////////////////////////////

Vue.config.devtools = true;

Vue.component('card', {
  template: `
    <div class="card-wrap"
      @mousemove="handleMouseMove"
      @mouseenter="handleMouseEnter"
      @mouseleave="handleMouseLeave"
      ref="card">
      <div class="card"
        :style="cardStyle">
        <div class="card-bg" :style="[cardBgTransform, cardBgImage]"></div>
        <div class="card-info">
          <slot name="header"></slot>
          <slot name="content"></slot>
        </div>
      </div>
    </div>`,
  mounted() {
    this.width = this.$refs.card.offsetWidth;
    this.height = this.$refs.card.offsetHeight;
  },
  props: ['dataImage'],
  data: () => ({
    width: 0,
    height: 0,
    mouseX: 0,
    mouseY: 0,
    mouseLeaveDelay: null
  }),
  computed: {
    mousePX() {
      return this.mouseX / this.width;
    },
    mousePY() {
      return this.mouseY / this.height;
    },
    cardStyle() {
      const rX = this.mousePX * 30;
      const rY = this.mousePY * -30;
      return {
        transform: `rotateY(${rX}deg) rotateX(${rY}deg)`
      };
    },
    cardBgTransform() {
      const tX = this.mousePX * -40;
      const tY = this.mousePY * -40;
      return {
        transform: `translateX(${tX}px) translateY(${tY}px)`
      }
    },
    cardBgImage() {
      return {
        backgroundImage: `url(${this.dataImage})`
      }
    }
  },
  methods: {
    handleMouseMove(e) {
      this.mouseX = e.pageX - this.$refs.card.offsetLeft - this.width/2;
      this.mouseY = e.pageY - this.$refs.card.offsetTop - this.height/2;
    },
    handleMouseEnter() {
      clearTimeout(this.mouseLeaveDelay);
    },
    handleMouseLeave() {
      this.mouseLeaveDelay = setTimeout(()=>{
        this.mouseX = 0;
        this.mouseY = 0;
      }, 1000);
    }
  }
});

const app = new Vue({
  el: '#app'
});

/////////////////////////////////PAGE TRANSITION////////////////////////////////

function reload(){
  barba.init({
views: [{
  // namespace: 'index-section',
  // namespace: 'about-section',
  beforeEnter({ next }) {
  
    let pageScriptSrcs = [
      'https://unpkg.com/@barba/core',
      'https://code.jquery.com/jquery-3.4.1.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.4/gsap.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.5/flickity.pkgd.min.js',
      'assets/js/script.js',
      'assets/js/transition.js',
      'assets/js/card.js',
      'assets/js/carousel.js'
    ]
    
    for(let i = 0; i < pageScriptSrcs.length; i++){
      let script = '<script src="' + pageScriptSrcs[i] + '"><\/script>';
      console.log(script);
      console.log(next.container);
      next.container.appendChild(script);
    }
  },
}],
})
}
reload();

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

function delay(n) {
  n = n || 2000;
  return new Promise((done) => {
      setTimeout(() => {
        done();
      }, n);
    });
  }
  
  function pageTransition() {
    
    tl
    .set(".load-screen", { 
      right: "-100%" 
    })
    .to(".load-screen", {
      duration: 1.5,
      width: "100%",
      right: "0%",
      ease: "Expo.easeInOut",
    })
    .to(".load-screen", {
      duration: 1.3,
      width: "100%",
      right: "100%",
      ease: "Expo.easeInOut",
      delay:0.1,
    })  
  }
  
  
$(function () {
  barba.init({
    sync: true,
    
    transitions: [
      {
        async leave(data) {
          const done = this.async();
          pageTransition();
          await delay(1500);
          done();
        },
        
        async enter(data) {
          contentAnimation();
        },
        
        async once(data) {
          contentAnimation();
        },
      },
    ],
  }); 
});
