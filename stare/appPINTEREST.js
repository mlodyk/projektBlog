let buttons=document.getElementsByClassName("blogButton");
// let titles=document.getElementsByClassName("blogTitle");
let images=document.getElementsByClassName("image")
let i=1;




window.addEventListener('load', async function () {
  // console.log(buttons[6].offsetWidth)

  for (let element of buttons) {
    // element.setAttribute("style",`background-image: url('./zdjecia2/img${i}.jpg');`)
    element.style.setProperty('--title-letter-spacing', calculateLetterSpacing(element));
    changeFontSize(element)
    i++;

  }
  // while (images.length > 0) {
  //   images[0].parentNode.removeChild(images[0]);
  // }


  })




function changeFontSize(element){
  element.style.setProperty('--title-font-size', calculateFontSize(element));

  // console.log(element.offsetWidth)
}


function calculateLetterSpacing(x){

  return `${(32+x.offsetWidth)/x.offsetWidth}`
}


function calculateFontSize(element){

  x=element.offsetWidth
  y=element.offsetHeight


  // element.children[0].style.width=x;
  // element.children[0].style.setProperty('--title-width', x);
  // element.style.setProperty('--button-width', x);



  let lines
  let size
  let text
  let gowno
  if(x>=y){
    [text,lines]=splitWordsna2(element.children[0].innerText)
    // lines=splitWordsna2(element.children[0].innerText)[1]
    // console.log("na 2")
    gowno=" na 2";

    // lines=2
    size=element.innerText.length/lines*0.9

  }else{  

    // console.log("na 3")
    gowno=" na 3";

    [text,lines]=splitWordsna3(element.children[0].innerText)
    // lines=splitWordsna3(element.children[0].innerText)[1]
    // lines=3
    size=element.innerText.length/lines*(x/y)+0.7


  }

  element.children[0].innerText=text
  size=x/size

  // console.log("length: "+text.length)
  console.log(text)
  console.log("width: "+x)
  console.log("height: "+y)
  // console.log("lines: "+lines)
  // console.log("dzieli sie: "+gowno)
  // console.log("font size: "+size)
  console.log("-----------------------------")
  // console.log("length: "+element.innerText.length)
  // console.log("najdluzsza w lini: "+element.innerText.length/lines)
  // console.log(size)
  
  return (size>=y*0.47?y*0.47:size)+"px"
  // return size+"px";
  // return "240px"
}

function splitWordsna3(text) {
  let words = text.split(" "); // Dzielimy tekst na słowa
  let transformedWords = [];
  let totalParts = 0;

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
    if (words.length === 1) {
      // Dzielimy jedno słowo na 3 części
      if (word.length < 4) {
        totalParts += 1; // Nie dzielimy krótkich słów
        return word;
      } else {
        let parts = splitIntoThree(word);
        totalParts += parts.length;
        return parts.join(" ");
      }
    } else {
      // Dzielimy każde słowo na 2 części (chyba że krótsze niż 4 litery)
      if (word.length < 4) {
        totalParts += 1; // Nie dzielimy krótkich słów
        return word;
      } else {
        // Dla "streetwear" dzielimy na 3 części
        if (word === "streetwear") {
          let parts = splitIntoThree(word);
          totalParts += parts.length;
          return parts.join(" ");
        } else {
          // Dla pozostałych słów dzielimy na 2 części
          let parts = splitIntoTwo(word);
          totalParts += parts.length;
          return parts.join(" ");
        }
      }
    }
  });

  return [transformedWords.join(" "), totalParts];
}

function splitWordsna2(text) {
  let totalParts = 0; // Licznik wszystkich części
  let words = text.split(" ");

  let transformedWords = words.map(word => {
      if (!isNaN(word) || /\d/.test(word) || word.length<=6) { // Nie dzielimy liczb ani słów zawierających cyfry
          totalParts++; // Liczymy słowo jako jedną część
          return word;
      }

      if (word.length < 4) {
          totalParts++; // Krótkie słowa pozostają bez zmian
          return word;
      }

      totalParts += 2; // Podział na 2 części
      let middle = Math.ceil(word.length / 2);
      return word.slice(0, middle) + " " + word.slice(middle);
  });

  return [transformedWords.join(" "), totalParts];
}