let toggle = document.querySelector('.toggle');
let body = document.querySelector('body');

let tl = gsap.timeline({defaults: {ease: "power4.inOut", duration: 2}})
let tl1 = gsap.timeline();

tl.to('h1', { 'clip-path': 'polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)', opacity: 1, y: 0, duration: 2.2})
tl.to('.form', { 'clip-path': 'polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)', opacity: 1, y: 0}, "-=2")
tl.from('.card', { scaleY: 0, stagger: .2}, "-=2")
tl.to('.title, .desc', { stagger: .1, duration: 1.2, opacity: 1, y: 0}, "-=2")
tl.to('footer', { opacity: 1}, "-=2")

toggle.addEventListener('click', function() {
  if(body.classList.contains('open')) {
      //Fermer le menu.
      body.classList.remove('open');

      tl.to('h1', { 'clip-path': 'polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)', opacity: 1, y: 0, duration: 2.2})
      tl.to('.form', { 'clip-path': 'polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)', opacity: 1, y: 0}, "-=2")
      tl.to('.card', { scaleY: 1, stagger: .2}, "-=2")
      tl.to('.title, .desc', { stagger: .1, duration: 1.2, opacity: 1, y: 0}, "-=2")
      tl.to('footer', { opacity: 1}, "-=2")
      tl1.to('.sep', { duration: 0,height: 0})
      tl1.to('.sep__icon', { duration: 0,opacity: 0})
  
    
  } else {
      //Ouvrir le menu.
      body.classList.add('open');
      
      tl.to('h1', { 'clip-path': 'polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)', opacity: 0, y: 0, duration: 1})
      tl.to('.form', { 'clip-path': 'polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)', opacity: 0, y: 0}, "-=2")
      tl.to('.card', { scaleY: 0, stagger: .2}, "-=2")
      tl.to('.title, .desc', { stagger: .1, duration: 1.2, opacity: 0, y: 0}, "-=2")
      tl.to('footer', { opacity: 0}, "-=2")
      tl1.to('.sep', {duration: 0.75,height: '100%',delay: 0.5})
      tl1.to('.sep__icon', {opacity: 1,duration: 0.25,delay: -0.5}) 
      tl1.from('.menu__left__inner__item', {y: 40,opacity: 0,stagger: 0.25}, "<-0.5")
      tl1.from('.menu__right__inner__item', {y: 40,opacity: 0,stagger: 0.25}, "<0.5")
      
  }
})

