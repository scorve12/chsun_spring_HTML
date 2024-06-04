
let tl = gsap.timeline({ease:'power1.in'});
function mouseCursor(){
    
window.onmousemove = handleMouseMove
window.ontouchmove = handleTouchMove
function handleMouseMove(e) {
  e = e || window.e;
  document.querySelector('#cursor').style.top=e.clientY + "px";
  document.querySelector('#cursor').style.left=e.clientX + "px";
}
function handleTouchMove(e) {
    e = e || window.e;
    document.querySelector('#cursor').style.top=e.touches[0].clientY + "px";
    document.querySelector('#cursor').style.left=e.touches[0].clientX + "px";
  }
}
mouseCursor()


function intro(){

     tl.to('#textHomeSpan',{y:'0%',duration:1,onComplete:()=>{
       document.querySelector('#textHome').style.overflow = 'visible'
     }})


}
intro()
let colors = ['#ff0a0a','#609aff','#53e082','#ba90fa','#ffb879']
let sizes = [12,-12]
let randomSize
let randomColor
let ogColor = '#000'

let letters = document.querySelectorAll('#letter')

letters.forEach(element => {

    element.addEventListener('mouseenter',()=>{
        gsap.to('#cursor',{scale:2,onStart:()=>{
            gsap.to('#circ',{stroke:colors[randomColor]})
        }})
    randomColor = Math.floor(Math.random() * colors.length)
    randomSize = Math.floor(Math.random() * sizes.length)
    gsap.to(element,{color:colors[randomColor],rotate:sizes[randomSize],y:`${sizes[randomSize]}%`,duration:.5})
})
element.addEventListener('mouseleave',()=>{
    gsap.to('#cursor',{scale:1,onStart:()=>{
        gsap.to('#circ',{stroke:ogColor})
    }})
  gsap.to(element,{y:'0%',color:ogColor,rotate:0,duration:.5})
})
element.addEventListener('touchstart',()=>{
    gsap.to('#cursor',{scale:2,onStart:()=>{
        gsap.to('#circ',{stroke:colors[randomColor]})
    }})
randomColor = Math.floor(Math.random() * colors.length)
randomSize = Math.floor(Math.random() * sizes.length)
gsap.to(element,{color:colors[randomColor],rotate:sizes[randomSize],y:`${sizes[randomSize]}%`,duration:.5})
})
element.addEventListener('touchend',()=>{
    gsap.to('#cursor',{scale:1,onStart:()=>{
        gsap.to('#circ',{stroke:ogColor})
    }})
  gsap.to(element,{y:'0%',color:ogColor,rotate:0,duration:.5})
})
});

