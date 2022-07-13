gsap.config({
  nullTargetWarn: false,
});

let toggle = document.querySelector('.toggle');
let body = document.querySelector('body');

let tl = gsap.timeline({defaults: {ease: "power4.inOut", duration: 2}})
let tl1 = gsap.timeline();
let tl2 = gsap.timeline();



tl2
.from('.ringOne',{duration: 2,opacity:0,y:400,ease:Expo.easeInOut})
.from('.ringTwo',{duration: 4, delay:0.9,opacity:0,y:400,ease:Expo.easeInOut},"-=3")
.to('.ringOne',{duration: 2, delay:0.4,opacity:0,y:-166,ease:Expo.easeInOut})
.to('.ringTwo',{duration: 2, delay:0.9,opacity:0,y:-166,ease:Expo.easeInOut},"-=3")
.to('.ringThree',{duration:0, y:-166, ease:Expo.easeInOut},"-=3")
.to('.ringThree',{duration: 3, delay:0.9,opacity: 1,ease:Expo.easeInOut},"-=3")
.set('.ringOne, .ringTwo', {autoAlpha: 0})

toggle.addEventListener('click', function() {
  if(body.classList.contains('open')) {
      //Fermer le menu.
      body.classList.remove('open');

      tl
      .set('h1, .ringThree', {autoAlpha: 1})
      .to('.ringThree', { opacity: 1 , duration: 3})
      .to('h1', { 'clip-path': 'polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)', opacity: 1 ,y: 0, duration: 2.2},"<0.1")
      .to('.title, .line.one, .line.two, .line.three', { stagger: .1, duration: 1.2, opacity: 1, y: 0}, "-=2")
      .to('footer', { opacity: 1}, "-=2")
      .to('.hero-slider', { opacity: 1, duration: 3.9}, "-=2")

      tl1
      .to('.sep', { duration: 0.75,height: 0})
      .to('.sep__icon', { duration: 0.25,opacity: 0},"<0.25")
      .to('.menu__left__inner__item', {x:-80,y: -180,opacity: 0,stagger: 0.25},"<-0.5")
      .to('.menu__right__inner__item', {x:80,y: -80,opacity: 0,stagger: 0.25},"<0.3")
      
      
  
    
  } else {
      //Ouvrir le menu.
      body.classList.add('open');
      
      tl
      .to('.ringThree', { opacity: 0, duration: 2.2})
      .to('.title, .line.one, .line.two, .line.three', { stagger: -0.1, duration: 0.7, opacity: 0, y: 100}, "-=2")
      .to('h1', { 'clip-path': 'polygon(0 100%, 100% 100%, 100% 100%, 0% 100%)', opacity: 0, y: 100, duration: 2},"-=2.3")
      .to('footer', { opacity: 0}, "-=2")
      .to('.hero-slider', { opacity: 0}, "-=2")
      .set('h1, .ringThree', {autoAlpha: 0 })

      tl1
      .set('.menu__left__inner__item, .menu__right__inner__item',{opacity: 1, y:0, x:0 })
      .to('.sep', {duration: 0.75,height: '100%',delay: 0.5},"+=0.7")
      .to('.sep__icon', {opacity: 1,duration: 0.25,delay: -0.5}) 
      .from('.menu__left__inner__item', {x:-40, y: -40,opacity: 0,stagger: 0.25}, "<-0.5")
      .from('.menu__right__inner__item', {x:40, y: -40,opacity: 0,stagger: 0.25},"<0.5")
      
  }
})




