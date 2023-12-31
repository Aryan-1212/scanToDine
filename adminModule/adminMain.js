const slides = document.querySelectorAll(".slide");
var counter = 0;

slides.forEach(
    (slide, index) => {
        slide.style.left = `${index * 100}%`;
    }
)

const changeSlide = () => {
    slides.forEach(
        (slide)=>{
            slide.style.transform = `translate(-${100*counter}%)`;
        }
    )
}

const nextSlide = () =>{
    counter++;
    if(counter>=slides.length){
        counter = 0;
    }
    changeSlide();
}

const prevSlide = () =>{
    counter--;
    if(counter<0){
        counter=slides.length-1;
    }
    changeSlide();
}

setInterval(
    ()=>{
        counter++;
        if(counter>=slides.length){
            counter = 0;
        }
        changeSlide();
    },3000
)