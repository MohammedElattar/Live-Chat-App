let signupForm = document.getElementById("signup_form");

if (signupForm) {

    signupForm.addEventListener("submit", function (e) {

        e.preventDefault();

        let avatar = document.querySelector('[type=file]').files[0];

        let formdata = new FormData(signupForm);
        formdata.append('photo', avatar)
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "app/http/auth.php", true);

        xhr.onload = function () {

            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText == '0') {
                    document.querySelector("#success").style.display = 'block';

                    function sub() {
                        signupForm.submit();
                    }
                    setTimeout(sub, 1000);
                }
                try {
                    var result = JSON.parse(xhr.responseText);
                    let user = document.getElementById("user");
                    let pass = document.getElementById("pass");
                    let img = document.getElementById("img");

                    if ("user" in result) user.style.display = "block";
                    else user.style.display = "none";

                    if ("pass" in result) pass.style.display = "block";
                    else pass.style.display = "none";

                    if ("avatar" in result) img.style.display = "block";
                    else img.style.display = "none";

                } catch (err) {
                    user.style.display = 'none';
                    pass.style.display = 'none';
                    img.style.display = 'none';
                    document.querySelector("#success").style.display = 'block';
                    setTimeout(sub, 1000);
                }

            } else console.log("failed");
        };
        xhr.send(formdata);
    });

}
// Login Form Checking 

let loginForm = document.getElementById("login_form");

if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let formdata = new FormData(loginForm);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "app/http/auth.php", true);
        xhr.onload = () => {

            if (xhr.readyState === 4 && xhr.status === 200) {

                if (xhr.responseText == '1') loginForm.submit();
                else {
                    let wrong = document.getElementById("wrong");
                    wrong.style.display = "block";
                }

            } else console.log("failed");
        }
        xhr.send(formdata);
    })
}