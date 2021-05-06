let button1 = document.getElementById("button1");
let button2 = document.getElementById("button2");

// function that lead us to registration
function inscrit() {
    document.location.href = "./inscription.php";
}

//function that lead us to login
function connect() {
    document.location.href = "./connection.php";
}

button1.addEventListener('click',inscrit);
button2.addEventListener('click',connect);
