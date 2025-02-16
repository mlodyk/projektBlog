let buttons=document.getElementsByClassName("blogTitle");

let i=1;





window.addEventListener('load', function () {
  // console.log(buttons[6].offsetWidth)

  for (let element of buttons) {
    element.setAttribute("style",`background-image: url('./zdjecia/img${i}.jpg');`)
    element.style.setProperty('--title-letter-spacing', calculateLetterSpacing(element));
    i++;
  }

  })





function calculateLetterSpacing(x){
  return `${32/x.innerText.length}px`
}