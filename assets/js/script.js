////////////////////// PAGE TRANSITION////////////////////////

gsap.config({
  nullTargetWarn: false,
});

let toggle = document.querySelector('.toggle');
let body = document.querySelector('body');

let tl = gsap.timeline({defaults: {ease: "power4.inOut", duration: 2}})
let tl1 = gsap.timeline();

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
  .set(".loading-screen", { 
    right: "-100%" })
  .to(".loading-screen", {
      duration: 0.9,
      width: "100%",
      right: "0%",
      ease: "Expo.easeInOut",
  })
  .to(".loading-screen", {
      duration: 0.7,
      width: "100%",
      right: "100%",
      ease: "Expo.easeInOut",
      delay: 0.3,
  });
}

function contentAnimation() {
  
  tl
  .to('body', {
    opacity: 1,
    duration: 0.1,
  })
  .to('.main_logo', {
    opacity: 1,
    duration: 3
  })
  .to('.abyss', {
    opacity: 1,
    y: 0,
    duration: 2.2
  }, "<0.1")
  .to('.separator.one', {
    width:"25%",
    duration: 2.5,
  }, "-=2")
  .to('.separator.two', {
    width:"50%",
    duration: 2.5,
  }, "-=2")
  .to('.separator.three', {
    width:"75%",
    duration: 2.5,
  }, "-=2")
  .to('.titles, .line.one, .line.two, .line.three', {
    stagger: .1,
    duration: 1.2,
    opacity: 1,
    y: 0
  }, "-=2")
  .to('footer', {
    opacity: 1
  },"-=3")
  .to('.random_content', {
    opacity: 1,
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
}

$(function () {
  barba.init({
      sync: true,
      // prefetchIgnore: true,
      // preventRunning: true,

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

//////////////////////////////////ANIMATION ELEMENTS/////////////////////////////////////


toggle.addEventListener('click', function() {
  if (body.classList.contains('open')) {
    ///////////////////////Fermer le menu////////////////////////////
    body.classList.remove('open');

    tl
      .set('.autoAlpha', {
        autoAlpha: 1
      })
      .set('wrapp', {
        autoAlpha: 1
      })
      .to('.main_logo', {
        opacity: 1,
        duration: 3
      })
      .to('.abyss', {
        opacity: 1,
        y: 0,
        duration: 2.2
      }, "<0.1")
      .to('.separator.one', {
        width:"25%",
        duration: 2.5,
      }, "-=2")
      .to('.separator.two', {
        width:"50%",
        duration: 2.5,
      }, "-=2")
      .to('.separator.three', {
        width:"75%",
        duration: 2.5,
      }, "-=2")
      .to('.titles, .line.one, .line.two, .line.three', {
        stagger: .1,
        duration: 1.2,
        opacity: 1,
        y: 0
      }, "-=2")
      .to('footer', {
        opacity: 1
      },"-=3")
      .to('.random_content', {
        opacity: 1,
      }, "-=2")
      .to(".box, .box h2", {
        duration: 2,
        scale: 1,
        opacity: 1,
        y: 0,
        ease: "power1.inOut",
        stagger: {
          grid: [7, 15],
          from: "edges",
          amount: 1.5
        }
      }, "<-2")

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
    /////////////////////////Ouvrir le menu///////////////////////////////
    body.classList.add('open');

    tl
      .to('.main_logo', {
        opacity: 0,
        duration: 2.2
      })
      .to(".box, .box h2", {
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
      }, "-=3.6")
      .to('.separator.one', {
        width:0,
        duration: 1.2,
      }, "-=2.5")
      .to('.separator.two', {
        width:0,
        duration: 1.2,
      }, "-=2.5")
      .to('.separator.three', {
        width:0,
        duration: 1.2,
      }, "-=2.5")
      .to('.titles, .line.one, .line.two, .line.three', {
        stagger: -0.1,
        duration: 0.7,
        opacity: 0,
        y: 100
      }, "-=2")
      .to('.abyss', {
        opacity: 0,
        y: 100,
        duration: 2
      }, "-=2.3")
      .to('footer', {
        opacity: 0
      }, "-=3")
      .to('.random_content', {
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


//////////////////Animation menu avant changement de page/////////////////////////////////////


let cards= document.querySelectorAll('.cards');

for (let i = 0 ; i < cards.length; i++) {
  cards[i].addEventListener('click', function(e){
    
    e.preventDefault();

    tl
    .to('.main_logo', {
      opacity: 0,
      duration: 2.2
    })
    .to('.separator.one', {
      width:0,
      duration: 1.2,
    }, "-=2.5")
    .to('.separator.two', {
      width:0,
      duration: 1.2,
    }, "-=2.5")
    .to('.separator.three', {
      width:0,
      duration: 1.2,
    }, "-=2.5")
    .to('.titles, .line.one, .line.two, .line.three', {
      stagger: -0.1,
      duration: 0.7,
      opacity: 0,
      y: 100
    }, "-=2")
    .to('.abyss', {
      opacity: 0,
      y: 100,
      duration: 2
    }, "-=2.3")
    .to('footer', {
      opacity: 0
    }, "-=3")
    .to('.random_content', {
      opacity: 0
    }, "-=2")
    .set('.autoAlpha', {
      autoAlpha: 0
    })

    setTimeout(function(){
      window.location.href = e.target.href
    },4500)
  })
}

let link= document.querySelectorAll('.link');

for (let i = 0 ; i < link.length; i++) {
  link[i].addEventListener('click', function(event){
    
    event.preventDefault();

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
    setTimeout(function(){
      window.location.href = event.target.href
    },2500)
  })
}




