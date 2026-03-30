<!DOCTYPE html>
<html>
<head>
<title>System Error</title>

<style>

body{
    background:#c0c0c0;
    font-family:Tahoma, Arial;
    overflow:hidden;
}


/* overlay */

.overlay{
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    display:flex;
    align-items:center;
    justify-content:center;
}


/* window */

.window{
    width:360px;
  
    background:#d4d0c8;
    position:absolute;
}


/* title bar */

.titlebar{
    background:linear-gradient(to right,#0a246a,#3a6ea5);
    color:white;
    padding:5px;
    font-weight:bold;
    display:flex;
    justify-content:space-between;
}


/* close */

.close{
    background:#d4d0c8;
    color:black;
    width:18px;
    text-align:center;
    cursor:pointer;
}


/* body */

.content{
    display:flex;
    padding:20px;
    align-items:center;
}


/* icon */

.icon{
    font-size:40px;
    color:red;
    margin-right:15px;
}


/* buttons */

.buttons{
    text-align:center;
    padding:10px;
}

button{
    width:90px;
    padding:5px;
    margin:5px;
}

</style>

</head>
<body>

<div class="overlay">

<div class="window">

<div class="titlebar">
    System Error
    <div class="close" onclick="startLoop()">X</div>
</div>

<div class="content">

<div class="icon">❌</div>

<div>
Runtime error.<br>
License expired.<br>
Please contact developer.
</div>

</div>

<div class="buttons">

<button onclick="startLoop()">OK</button>

<button onclick="startLoop()">Cancel</button>

</div>

</div>

</div>
<script>

let total = 1;
let step = 0;


// load total only

if (sessionStorage.getItem("total")) {
    total = parseInt(sessionStorage.getItem("total"));
}


// main loop

function startLoop() {

    step = 0; // reset step every loop

    for (let i = 0; i < total; i++) {
        createPopup();
    }

    total = total * 2;

    if (total > 50) total = 1000;

    sessionStorage.setItem("total", total);

}


// popup

function createPopup() {

    let box = document.createElement("div");

    box.className = "window";

    let w = 360;
    let h = 180;

    let centerX = window.innerWidth / 2;
    let centerY = window.innerHeight / 2;

    let radius = step * 15;
    let angle = step * 0.5;

    let left = centerX + Math.cos(angle) * radius - w/2;
    let top  = centerY + Math.sin(angle) * radius - h/2;


    if (left < 0) left = 0;
    if (top < 0) top = 0;

    if (left > window.innerWidth - w)
        left = window.innerWidth - w;

    if (top > window.innerHeight - h)
        top = window.innerHeight - h;


    step++;

    box.style.left = left + "px";
    box.style.top = top + "px";


    box.innerHTML = `
    
   
    <div class="titlebar">
        System Error
        <div class="close" onclick="startLoop()">X</div>
    </div>

    <div class="content">

    <div class="icon">❌</div>

    <div>
    Runtime error.<br>
    License expired.<br>
    Please contact developer.
    </div>

    </div>

    <div class="buttons">
        <button onclick="startLoop()">OK</button>
        <button onclick="startLoop()">Cancel</button>
    </div>

    `;

    document.body.appendChild(box);

}


// auto after refresh

window.onload = function () {

    if (sessionStorage.getItem("total")) {

        startLoop();

    }

};

</script>





</body>
</html>