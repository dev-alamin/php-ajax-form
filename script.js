const form = document.getElementById("ourform");
const formBtn = document.getElementById("submit-btn");
const formInput = document.getElementsByClassName("form-input");
const success = document.querySelector(".success-container");
const nameErr = document.querySelector(".name-error");
const emailErr = document.querySelector(".email-error");
const websiteErr = document.querySelector(".website-error");
const commentErr = document.querySelector(".comment-error");
const genderErr = document.querySelector(".gender-error");

const title = document.getElementById("name");
const url = document.getElementById("url");

title.oninput = (e) => {

    const convert = title.value;
    const converted = convert.replace(/\s+/g, '-').toLowerCase();
    url.value = converted;
}

formBtn.onclick = (e) => {

    e.preventDefault();
    //Disable button when data processing
    formBtn.disabled = true;

    //Collect form data to sent with api
    const input = new FormData();

    for (let i = 0; i < formInput.length; i++) {
        input.append(formInput[i].name, formInput[i].value);
    }

    const xhr = new XMLHttpRequest();

    xhr.open("post", "form.php");
    xhr.send(input);

    xhr.onreadystatechange = () => {
        formBtn.disabled = false;

        if (xhr.readyState == 4 && xhr.status == 200) {

            const response = JSON.parse(xhr.responseText);

            if (response.success != '') {
                // Reset the form after successful submission
                form.reset();
                success.innerHTML = response.success;
                success.classList.add("alert-success");
                // remove notice of success after 5 second
                setTimeout(() => {
                    success.textContent = '';
                }, 5000);

                nameErr.textContent = '';
                emailErr.textContent = '';
                websiteErr.textContent = '';
                commentErr.textContent = '';
                genderErr.textContent = '';
            } else {
                success.innerHTML = 'Data could not be be saved!';
                success.classList.add("alert-danger");
                success.classList.add("p-10");
                success.classList.add("mb-2");
                nameErr.textContent = response.name;
                emailErr.textContent = response.email;
                websiteErr.textContent = response.website;
                commentErr.textContent = response.comment;
                genderErr.textContent = response.gender;
            }

        }
    }
}