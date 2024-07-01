function validateForm() {
  let isValid = true;

  // Clear previous error messages
  document.getElementById("nameError").innerText = "";
  document.getElementById("emailError").innerText = "";
  document.getElementById("phoneError").innerText = "";
  document.getElementById("addressError").innerText = "";
  document.getElementById("passwordError").innerText = "";
  document.getElementById("confirmPasswordError").innerText = "";

  // Get form values
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const phone = document.getElementById("phone").value;
  const address = document.getElementById("address").value;
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirmPassword").value;

  // Validate name
  if (name.trim() === "") {
    document.getElementById("nameError").innerText = "Name is required.";
    isValid = false;
  }

  // Validate email
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    document.getElementById("emailError").innerText = "Invalid email address.";
    isValid = false;
  }

  // Validate phone
  const phonePattern = /^[0-9]{10}$/;
  if (!phonePattern.test(phone)) {
    document.getElementById("phoneError").innerText = "Invalid phone number.";
    isValid = false;
  }

  // Validate address
  if (address.trim() === "") {
    document.getElementById("addressError").innerText = "Address is required.";
    isValid = false;
  }

  // Validate password
  if (password.length < 8) {
    document.getElementById("passwordError").innerText =
      "Minimum 8 chars required";
    isValid = false;
  }

  // Validate confirm password
  if (password !== confirmPassword) {
    document.getElementById("confirmPasswordError").innerText =
      "Passwords do not match.";
    isValid = false;
  }

  return isValid;
}

// Password visibility toggle

document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("passwordTog")
    .addEventListener("change", function () {
      const passwordField = document.getElementById("password"),
        passwordField2 = document.getElementById("confirmPassword");
      if (this.checked) {
        passwordField.type = "text";
        passwordField2.type = "text";
      } else {
        passwordField.type = "password";
        passwordField2.type = "password";
      }
    });
});
