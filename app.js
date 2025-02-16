let buttons=document.getElementsByClassName("blogButton");

let i=1;




window.addEventListener('load', async function () {

  for (let element of buttons) {
    let title=element.children[0]
    element.setAttribute("style",`background-image: url('./zdjecia2/img${i}.jpg');`)
    element.style.setProperty('--title-letter-spacing', calculateLetterSpacing(element));


    const backgroundUrl = getComputedStyle(element).backgroundImage.slice(4, -1).replace(/"/g, "");
    const img = new Image();
    img.onload = function() {
      console.log("------------------------------")
      // console.log("XD")
      // element.style.width=img.width+'px'
      // element.style.aspectRatio=`${img.width}/${img.height}`
      element.style.aspectRatio='3/4'

      // console.log("test: "+img.width)
      // console.log("test: "+element.offsetWidth)
      changeFontSize(element)

    };
    img.src = backgroundUrl;



    i++;

  }


  })




function changeFontSize(element){
  // element.style.setProperty('--title-font-size', calculateFontSize(element));

  element.style.fontSize=calculateFontSize(element)
  // console.log(element.offsetWidth)
}


function calculateLetterSpacing(x){

  return `${32/x.innerText.length}px`
}


function calculateFontSize(element){

  x=element.offsetWidth
  y=element.offsetHeight


  let lines
  let longest
  let size
  let text
  if(x>y){
    [text,lines]=splitWordsna2(element.innerText)
    // lines=splitWordsna2(element.children[0].innerText)[1]
    console.log("na 2");

    // lines=2
 
    size=element.innerText.length/lines*2

  }else{  

    console.log("na 3");
    [text,lines]=splitWordsna3(element.innerText)
    // lines=splitWordsna3(element.children[0].innerText)[1]
    // lines=3
    size=element.innerText.length/lines*0.9


  }

  // [text,longest]=getWords(element.children[0].innerText)
  // size=longest*0.77

  element.innerText=text
  size=x/size

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



// function makeTextSquare(text) {
//   let length = text.length; // Długość tekstu
//   let parts = []; // Tablica na części tekstu
//   let optimalParts = Math.ceil(Math.sqrt(length)); // Optymalna liczba części

//   // Dzielimy tekst na części
//   for (let i = 0; i < optimalParts; i++) {
//     let start = Math.floor((i * length) / optimalParts); // Początek części
//     let end = Math.floor(((i + 1) * length) / optimalParts); // Koniec części
//     parts.push(text.slice(start, end)); // Dodajemy część do tablicy
//   }

//   return [parts.join(" "),parts.length]; // Łączymy części spacjami
// }


console.log(getWords("Porshe 911"))

function getWords(text) {
  let words = text.split(" ");
  let maxLength = words.reduce((max, word) => Math.max(max, word.length), 0);
  
  return [text, maxLength];
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