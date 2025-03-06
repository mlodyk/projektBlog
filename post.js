

window.addEventListener('load', async function () {
    let title=document.getElementsByClassName("title")[0]

    console.log(title.offsetWidth)
    let x=(800-title.offsetWidth*1.5)/title.innerText.length
    title.style.setProperty('--letter-spacing', x+"px");
    
    title.style.setProperty('--margin-bottom', -x+"px");

})


function openModal(){
    console.log("open")
    document.getElementById("loginModal").style.display="flex"
}

function closeModal(obj){
    console.log(obj)
    console.log("close")
    document.getElementById("loginModal").style.display="none"
}