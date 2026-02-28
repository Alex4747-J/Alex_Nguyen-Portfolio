export function ajaxForm() {
    (() => {
        const form = document.querySelector(".contact-form");
        const feedBack = document.querySelector("#feedback");
        if (!form || !feedBack) return;

        function regForm(event) {
            event.preventDefault();

            const thisform = event.currentTarget;
            const url = "includes/adduser.php";

            const formData = new URLSearchParams({
                name: thisform.querySelector("#name").value,
                email: thisform.querySelector("#email").value,
                message: thisform.querySelector("#message").value
            });

            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: formData,
            })
            .then(response => response.json())
            .then(responseText => {
                console.log(responseText);
                feedBack.innerHTML = "";
                if (responseText.errors) {
                    responseText.errors.forEach(error => {
                        const errorElement = document.createElement("p");
                        errorElement.classList.add("feedback-error");
                        errorElement.textContent = error;
                        feedBack.appendChild(errorElement);
                    });
                } else {
                    const messageElement = document.createElement("p");
                    messageElement.classList.add("feedback-success");
                    messageElement.textContent = responseText.message;
                    feedBack.appendChild(messageElement);
                }

                feedBack.scrollIntoView({ behavior: 'smooth', block: 'end' });
            })
            .catch(error => {
                console.error("Error during fetch:", error);
                feedBack.innerHTML = "";
                const errorMessageElement = document.createElement("p");
                errorMessageElement.classList.add("feedback-error");
                errorMessageElement.textContent = "Sorry, something went wrong. Please try again later.";
                feedBack.appendChild(errorMessageElement);
            });
        }

        form.addEventListener("submit", regForm);
    })();
}