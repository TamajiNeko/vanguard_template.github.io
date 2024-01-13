function eye() {
    var pas = document.getElementById("pw");
    var eye_ = document.getElementById("eye");
    if (pas.type === "password") {
        pas.type = "text";
        eye_.className = "fa fa-eye"
    } else {
        pas.type = "password";
        eye_.className = "fa fa-eye-slash"
    }
}

function eye_s() {
    var pas = document.getElementById("n_pw");
    var eye_ = document.getElementById("eye_");
    if (pas.type === "password") {
        pas.type = "text";
        eye_.className = "fa fa-eye"
    } else {
        pas.type = "password";
        eye_.className = "fa fa-eye-slash"
    }
}

function log_sing() {
    var BD = document.getElementById("BD");
    var BD1 = document.getElementById("BD1");

    if (BD.className === "BD") {
        BD.className = "BD1";
        BD1.className = "BD"
    }
    else{
        BD.className = "BD";
        BD1.className = "BD1"
    }
    
}

function focus_n() {
    var vu = document.getElementById("vu");
    var un = document.getElementById("uname");
    un.className = "ip";
    vu.textContent = "";
}

function focus_nw() {
    var vu = document.getElementById("vu_n");
    var un = document.getElementById("n_uname");
    un.className = "ip";
    vu.textContent = "";
}

function focus_p() {
    var vu = document.getElementById("vp");
    var pw = document.getElementById("pw");
    pw.className = "ip";
    vu.textContent = "";
}