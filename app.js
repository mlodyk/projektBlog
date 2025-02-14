let buttons=document.getElementsByClassName("blogTitle");
let turcja=document.getElementsByClassName("turcja")

let i=1;





window.addEventListener('load', function () {
  // console.log(buttons[6].offsetWidth)

  for (let element of buttons) {
    element.setAttribute("style",`background-image: url('./zdjecia/img${i}.jpg');`)
    element.style.setProperty('--title-letter-spacing', calculateLetterSpacing(element));
    i++;

    element.addEventListener("click", async function (e) {
      console.log(this.offsetHeight);

    });

  }

  })





function calculateLetterSpacing(x){
  
  return `${32/x.innerText.length}px`
}



function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}