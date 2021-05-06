// Ajax
// recovery of the text area
let recName = document.getElementById('recName');
let recMSG = document.getElementById('text');
let  push = document.getElementById('push');

function envoi (e) {
    e.preventDefault();
    const xhrEnvoi = new XMLHttpRequest();

    let obj = {
        user : recName.value,
        message : recMSG.value
    }
    xhrEnvoi.open("POST", "utils/messageC.php", true );
    xhrEnvoi.setRequestHeader('Content-Type', 'application/json');
    xhrEnvoi.send(JSON.stringify(obj));

}


push.addEventListener('click', envoi);

// display in the text area of messages ...

let divT = document.getElementById('zoneChat');
function affich (e) {
    e.preventDefault();
    const xhr = new XMLHttpRequest();
    let paraM = document.createElement('p');
    divT.appendChild(paraM);
    paraM.innerHTML = recName.value + " : " + recMSG.value;


    xhr.open("POST", "chat.php", true );
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(recMSG.value));
}

push.addEventListener('click',affich);




