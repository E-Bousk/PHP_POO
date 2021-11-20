window.onload = () => {
    let buttons = document.querySelectorAll(".custom-control-input")

    for(let button of buttons) {
        button.addEventListener("click", activer)
    }
}

function activer() {
    let xmlhttp = new XMLHttpRequest;
    xmlhttp.open('GET', '/admin/activeAnnonce/'+this.dataset.id);
    // console.log(this.dataset.id);
    xmlhttp.send();
}