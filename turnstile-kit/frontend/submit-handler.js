const form = document.getElementById("contact-form");

if (form) {
  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const formData = new FormData(form);
    const token = formData.get("cf-turnstile-response");

    if (!token) {
      alert("Please complete CAPTCHA.");
      return;
    }

    const payload = {
      name: formData.get("name"),
      email: formData.get("email"),
      message: formData.get("message"),
      captcha_token: token,
    };

    const response = await fetch("/api/contact-us", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(payload),
    });

    if (!response.ok) {
      if (window.turnstile) {
        window.turnstile.reset();
      }
      alert("Request failed. Please retry.");
      return;
    }

    alert("Message sent.");
    form.reset();
    if (window.turnstile) {
      window.turnstile.reset();
    }
  });
}
