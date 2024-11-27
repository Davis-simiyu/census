document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const message = document.getElementById("message").value.trim();

        if (!name || !email || !phone || !message) {
            alert("Please fill in all fields.");
            return;
        }
        
        alert(`Thank you, ${name}. Your message has been sent successfully.`);
        form.reset();
    });
});
