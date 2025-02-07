let buttons=document.getElementsByClassName("blogTitle")

console.log(buttons)
let i=1;




window.addEventListener('load', function () {

    // buttons[0].setAttribute("style", "background-color:red;");

    for (let element of buttons) {
        element.setAttribute("style",`background-image: url('./img${i}.jpg');`)
        // element.setAttribute("style", "background-color:red;");
    
        // console.log(element.getAttribute('style:width;'))
        i++;
    }

  })

// let x=buttons[0].getAttribute("width")

// console.log(x)



