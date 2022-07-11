tl
.to('.loading-screen',{duration: 4, delay: 1.6, top: "-110%", ease: Expo.easeInOut})

function contentAnimation() {

tl
.set('h1, .ringThree', {autoAlpha: 1})
.to('.ringThree', { opacity: 1 , duration: 3})
.to('h1', { 'clip-path': 'polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)', opacity: 1 ,y: 0, duration: 2.2},"<0.1")
.to('.title, .line.one, .line.two, .line.three', { stagger: .1, duration: 1.2, opacity: 1, y: 0}, "-=2")
.to('footer', { opacity: 1}, "-=2")
.from(".box", {
    duration: 1,
    scale: 0.1,
    y: 40,
    ease: "power1.inOut",
    stagger: {
      grid: [7,15],
      from: "edges",
      amount: 1.5
    }
  },"<-2");
}

let link= document.querySelectorAll('.link');

for (var i = 0 ; i < link.length; i++) {
  link[i].addEventListener('click', function(){
    if(body.classList.contains('open')) {
      //Fermer le menu.
      body.classList.remove('open');
      
     

      tl1
      .to('.sep', { duration: 0.75,height: 0})
      .to('.sep__icon', { duration: 0.25,opacity: 0},"<0.25")
      .to('.menu__left__inner__item', {x:-80,y: -180,opacity: 0,stagger: 0.25},"<-0.5")
      .to('.menu__right__inner__item', {x:80,y: -80,opacity: 0,stagger: 0.25},"<0.3")
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
  
  tl.set(".load-screen", { right: "-100%" });
  tl.to(".load-screen", {
      duration: 1.2,
      width: "100%",
      right: "0%",
      ease: "Expo.easeInOut",
  });

  tl.to(".load-screen", {
      duration: 1,
      width: "100%",
      right: "100%",
      ease: "Expo.easeInOut",
      delay:0.1,
  });
  
}
// function contentAnimation() {
    
//     let tl = gsap.timeline({defaults: {ease: "power4.inOut", duration: 2}})

//   tl
  
// //   .from(".animate-this", { duration: 1, y: 30, opacity: 0, stagger: 0.4, delay: 0.2 })
//   .set('h1, .ringThree', {autoAlpha: 1})
//   .to('.ringThree', { opacity: 1 , duration: 3})
//   .to('h1', { 'clip-path': 'polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)', opacity: 1 ,y: 0, duration: 2.2},"<0.1")
//   .to('.title, .line.one, .line.two, .line.three', { stagger: .1, duration: 1.2, opacity: 1, y: 0}, "-=2")
//   .to('footer', { opacity: 1}, "-=2")
// }


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