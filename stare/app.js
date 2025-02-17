let buttons=document.getElementsByClassName("blogButton");

let i=1;




window.addEventListener('load', async function () {

  for (let element of buttons) {
    // let title=element.children[0]
    element.setAttribute("style",`background-image: url('./zdjecia2/img${i}.jpg');`)
    // element.style.setProperty('--title-letter-spacing', calculateLetterSpacing(element));


    // const backgroundUrl = getComputedStyle(element).backgroundImage.slice(4, -1).replace(/"/g, "");
    // const img = new Image();
    // img.onload = function() {
      // console.log("------------------------------")
      // console.log("XD")
      // element.style.width=img.width+'px'
      // element.style.aspectRatio=`${img.width}/${img.height}`
      // element.style.aspectRatio='3/4'

      // console.log("test: "+img.width)
      // console.log("test: "+element.offsetWidth)

    // };
    // img.src = backgroundUrl;
    changeFontSize(element)



    i++;

  }


  })




function changeFontSize(element){
  // element.style.setProperty('--title-font-size', calculateFontSize(element));

  element.style.fontSize=calculateFontSize(element)
  // console.log(element.offsetWidth)
}


function calculateFontSize(element){

  x=element.offsetWidth
  y=element.offsetHeight


  let lines
  let longest
  let size
  let text

  [text,longest]=splitWords(element.innerText)

  element.innerText=text
  size=x/longest+23

  // console.log("length: "+text.length)
  // console.log(text)
  // console.log("width: "+x)
  // console.log("height: "+y)
  // console.log("lines: "+lines)
  // console.log("dzieli sie: "+gowno)
  // console.log("font size: "+size)
  // console.log("length: "+element.innerText.length)
  // console.log("najdluzsza w lini: "+element.innerText.length/lines)
  // console.log(size)
  // console.log("-----------------------------")
  // console.log("-----------------------------")
  // console.log("-----------------------------")
  
  return (size>=y*0.47?y*0.47:size)+"px"
  // return size+"px";
  // return "240px"
}


function splitWords(text) {
  let words = text.split(" "); // Dzielimy tekst na słowa
  let transformedWords = [];
  let maxLength = 0;

  // Funkcja do dzielenia słowa na 3 równe części
  function splitIntoThree(word) {
    let len = word.length;
    let partLength = Math.ceil(len / 3); // Długość każdej części
    let part1 = word.slice(0, partLength);
    let part2 = word.slice(partLength, 2 * partLength);
    let part3 = word.slice(2 * partLength);
    return [part1, part2, part3];
  }

  // Funkcja do dzielenia słowa na 2 części
  function splitIntoTwo(word) {
    let len = word.length;
    let middle = Math.ceil(len / 2);
    let part1 = word.slice(0, middle);
    let part2 = word.slice(middle);
    return [part1, part2];
  }

  // Przetwarzamy każde słowo
  transformedWords = words.map(word => {
    let parts;
    if (words.length === 1) {
      // Dzielimy jedno słowo na 3 części
      if (word.length < 4) {
        maxLength = Math.max(maxLength, word.length);
        return word;
      } else {
        parts = splitIntoThree(word);
      }
    } else {
      // Dzielimy każde słowo na 2 części (chyba że krótsze niż 4 litery)
      if (word.length < 4) {
        maxLength = Math.max(maxLength, word.length);
        return word;
      } else {
        parts = splitIntoTwo(word);
      }
    }
    
    parts.forEach(part => {
      maxLength = Math.max(maxLength, part.length);
    });
    
    return parts.join(" ");
  });

  return [transformedWords.join(" "), maxLength];
}
