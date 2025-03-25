let buttons=document.getElementsByClassName("defaultBlogButton")

let deleteButton

let removing=false



function toggleRemoving(){

    if(removing){
        for (let button of buttons) {
            // button.classList.replace("removeBlogButton","blogButton");
            button.classList.remove("removeBlogButton");
            button.classList.add("blogButton");

        }
    }else{
        for (let button of buttons) {
            // button.classList.replace("blogButton","removeBlogButton");
            button.classList.remove("blogButton");
            button.classList.add("removeBlogButton");
        }
    }
    deleteButton.innerText=removing?"usuń posty":"anuluj"

    removing=!removing

}

function removePost(idPost,htmlObj){
    fetch('./deletePostProcess.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ postId: idPost }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            htmlObj.remove()
        } else {
            console.error("Błąd:", data.message);
            alert("Błąd usuwania posta!");
        }
    })
    .catch(error => console.error('Błąd:', error));
}




window.addEventListener('load', async function () {
    deleteButton=document.getElementById("deleteButton")

    for (let element of buttons) {
        element.style.fontSize=calculateFontSize(element)
    }


})

function calculateFontSize(element){
  x=element.offsetWidth
  y=element.offsetHeight

  let longest
  let wordCount
  let size
  let text

  [text,longest,wordCount]=splitWords(element.innerText)

  element.innerText=text

  size=x/longest+23

  return size+"px"
}


function splitWords(text) {
  let words = text.split(" ");
  let transformedWords = [];
  let maxLength = 0;
  let wordCount = 0;

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
        wordCount += 1;
        return word;
      } else {
        parts = splitIntoThree(word);
      }
    } else {
      if (word.length < 4) {
        maxLength = Math.max(maxLength, word.length);
        wordCount += 1;
        return word;
      } else {
        parts = splitIntoTwo(word);
      }
    }
    
    parts.forEach(part => {
      maxLength = Math.max(maxLength, part.length);
    });

    wordCount += parts.length;
    return parts.join(" ");
  });

  return [transformedWords.join(" "), maxLength, wordCount];
}



function redirectToLogin() {
  window.location.href = "login.php";
}

function redirectToPost(id,htmlObj) {
    if(removing){
        removePost(id,htmlObj)
    }else{
        window.location.href = "post.php?id="+id;
    }
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