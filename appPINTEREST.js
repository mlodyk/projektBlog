let buttons=document.getElementsByClassName("blogButton");
// let titles=document.getElementsByClassName("blogTitle");
let images=document.getElementsByClassName("image")
let i=1;




window.addEventListener('load', async function () {
  // console.log(buttons[6].offsetWidth)

  for (let element of buttons) {
    element.setAttribute("style",`background-image: url('./zdjecia2/img${i}.jpg');`)
    element.style.setProperty('--title-letter-spacing', calculateLetterSpacing(element));
    changeFontSize(element)
    i++;

  }
  while (images.length > 0) {
    images[0].parentNode.removeChild(images[0]);
}


  })




function changeFontSize(element){
  element.style.setProperty('--title-font-size', calculateFontSize(element));

  // console.log(element.offsetWidth)
}


function calculateLetterSpacing(x){
  console.log(x.innerText)

  return `${32/x.innerText.length}px`
}


function calculateFontSize(element){
  // let size=240;  


  // var dimension, image;

  // image = new Image();
  // console.log(element.style.backgroundImage)

  // image.onload = function() {
  //     dimension = {
  //         width: image.naturalWidth,
  //         height: image.naturalHeight
  //     };
  //     console.log(dimension);
  // };
  x=element.offsetWidth
  y=element.offsetHeight

  // element.children[0].style.width=x;
  element.children[0].style.setProperty('--title-width', x);
  element.style.setProperty('--button-width', x);



  let lines
  let size
  if(x>=450){
    let text=splitWordsna2(element.children[0].innerText)[0]
    lines=splitWordsna2(element.children[0].innerText)[1]
    console.log("na 2")

    // lines=2
    size=element.innerText.length/lines*(y/x)+2
    element.children[0].innerText=text


  }else{  
    console.log("na 3")

    let text=splitWordsna3(element.children[0].innerText)[0]
    lines=splitWordsna3(element.children[0].innerText)[1]
    console.log(lines)
    // lines=3
    size=element.innerText.length/lines*(x/y)+0.3
    element.children[0].innerText=text

  }



  size=x/size
  console.log("length: "+element.innerText.length)
  console.log("najdluzsza w lini: "+element.innerText.length/lines)
  console.log(size)
  return size+"px";
  // return "430%"
}

function splitWordsna3(text) {
  let totalParts = 0; // Licznik wszystkich części
  let words = text.split(" ");
  
  let transformedWords = words.map(word => {
      if (!isNaN(word) || word.length < 3 || word.length>7) {
          totalParts++; // Liczymy słowo jako jedną część
          return word;
      }

      let len = word.length;

      if (len < 5) {
          totalParts += 2; // Podział na 2 części
          return word.slice(0, Math.ceil(len / 2)) + " " + word.slice(Math.ceil(len / 2));
      } else {
          totalParts += 3; // Podział na 3 części
          let part1 = word.slice(0, Math.ceil(len / 3));
          let part2 = word.slice(Math.ceil(len / 3), Math.ceil(2 * len / 3));
          let part3 = word.slice(Math.ceil(2 * len / 3));
          return part1 + " " + part2 + " " + part3;
      }
  });

  return [transformedWords.join(" "), totalParts];
}

function splitWordsna2(text) {
  let totalParts = 0; // Licznik wszystkich części
  let words = text.split(" ");

  let transformedWords = words.map(word => {
      if (!isNaN(word) || word.length < 4) {
          totalParts++; // Liczymy słowo jako jedną część
          return word;
      }

      totalParts += 2; // Podział na 2 części
      let middle = Math.ceil(word.length / 2);
      return word.slice(0, middle) + " " + word.slice(middle);
  });

  return [transformedWords.join(" "), totalParts];
}