function send_login() {
    var form = document.getElementById("login_");
    var formData = new FormData(form);
    
    formData.append("login", "login");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "hello.php", true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("vu").innerHTML = xhr.responseText;
        }
    };

    xhr.send(formData);
}