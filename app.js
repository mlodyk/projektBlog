let buttons=document.getElementsByClassName("blogButton");



window.addEventListener('load', async function () {

  for (let element of buttons) {
    element.style.fontSize=calculateFontSize(element)
  }
})


function calculateFontSize(element){
  x=element.offsetWidth
  y=element.offsetHeight

  let longest
  let size
  let text

  [text,longest]=splitWords(element.innerText)

  element.innerText=text
  size=x/longest+23
  
  return (size>=y*0.47?y*0.47:size)+"px"
}


function splitWords(text) {
  let words = text.split(" ");
  let transformedWords = [];
  let maxLength = 0;

  function splitIntoThree(word) {
    let len = word.length;
    let partLength = Math.ceil(len / 3);
    let part1 = word.slice(0, partLength);
    let part2 = word.slice(partLength, 2 * partLength);
    let part3 = word.slice(2 * partLength);
    return [part1, part2, part3];
  }

  function splitIntoTwo(word) {
    let len = word.length;
    let middle = Math.ceil(len / 2);
    let part1 = word.slice(0, middle);
    let part2 = word.slice(middle);
    return [part1, part2];
  }

  transformedWords = words.map(word => {
    let parts;
    if (words.length === 1) {
      if (word.length < 4) {
        maxLength = Math.max(maxLength, word.length);
        return word;
      } else {
        parts = splitIntoThree(word);
      }
    } else {
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


function redirectToLogin() {
  window.location.href = "login.php";
}

function redirectToPost(id) {
  window.location.href = "post.php?id="+id;
}

function search(){
  let searchInput=document.getElementById("searchInput");

  let x=searchInput.value
  x=x.replaceAll(" ","")

  if(x.length==0){
    window.location.href = "index.php";
  }else{
    window.location.href = "index.php?search="+x;
  }
}


function filter(tag){

  console.log(tag)
  // if(x.length==0){
    // window.location.href = "index.php";
  // }else{
    // window.location.href = "index.php?search="+x;
  // }
}