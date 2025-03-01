

window.addEventListener('load', async function () {
    let title=document.getElementsByClassName("title")[0]

    console.log(title.offsetWidth)
    let x=(800-title.offsetWidth)/title.innerText.length
    title.style.setProperty('--letter-spacing', x+"px");
    
    title.style.setProperty('--margin-bottom', -x+"px");

})
