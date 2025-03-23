let selectedTag = null;
let selectedTagId = null;

function chooseTag(tag) {
    if (selectedTagId == tag.id) {
        selectedTagId = null;
        selectedTag = null;
        tag.classList.remove("selectedTag");
    } else {
        selectedTag?.classList.remove("selectedTag");
        selectedTagId = tag.id;
        selectedTag = tag;
        tag.classList.add("selectedTag");
    }
}

function addPost() {
    const title = document.getElementById('titleInput').value;
    const imageInput = document.getElementById('imageInput');
    const file = imageInput.files[0];


    if (!title || !file || !selectedTagId) {
        alert('Proszę wypełnić wszystkie pola!');
        return;
    }

    const formData = new FormData();
    formData.append('title', title);
    formData.append('image', file);
    formData.append('tagId', selectedTagId);

    fetch('./addPostProcess.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {


            document.getElementById("zobaczButton").href = `post.php?id=${data.postId}`;

            openModal()
        } else {
            console.error("Błąd:", data.message);
            alert("Błąd dodawania posta!");
        }
    })
    .catch(error => console.error('Błąd:', error));
}



function openModal(){
    console.log("open")
    document.getElementById("addedModal").style.display="flex"
}

function closeModal(obj){
    console.log(obj)
    console.log("close")
    document.getElementById("addedModal").style.display="none"
}