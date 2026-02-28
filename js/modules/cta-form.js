export function ctaForm() {
    (() => {
        const form = document.querySelector(".cta-form");
        if (!form) return;

        const feedBack = document.querySelector("#cta-feedback");

        function submitCta(event) {
            event.preventDefault();

            const thisform = event.currentTarget;
            const url = "includes/add-subscriber.php";

            const formData = new URLSearchParams({
                email: thisform.querySelector("#cta-email").value
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
                        errorElement.textContent = error;
                        errorElement.style.color = "#ff6b6b";
                        feedBack.appendChild(errorElement);
                    });
                } else {
                    const messageElement = document.createElement("p");
                    messageElement.textContent = responseText.message;
                    feedBack.appendChild(messageElement);
                    thisform.reset();
                }
            })
            .catch(error => {
                console.error("Error during fetch:", error);
                feedBack.innerHTML = "";
                const errorElement = document.createElement("p");
                errorElement.textContent = "Sorry, something went wrong. Please try again later.";
                errorElement.style.color = "#ff6b6b";
                feedBack.appendChild(errorElement);
            });
        }

        form.addEventListener("submit", submitCta);
    })();
}