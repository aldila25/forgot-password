<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="container-form">
      <h2 class="heading-form">Forgot Password</h2>
      <p class="desk-form">
        Enter your email and we'll help you reset your password.
      </p>
      <!-- Kode form -->
      <form id="ForgotForm" action="forgot_password.php" method="POST">
        <div class="input-wrapper">
          <label class="label-form" for="email">Email :</label>
          <input type="email" id="email" name="email" required />
        </div>

        <!-- Button pengguna untuk mengirimkan form -->
        <button class="button-form" type="submit">Submit</button>
      </form>
      <div class="back-to-login">
        <!-- Tautan untuk kembali ke halaman login -->
        Go back to <a href="login.html">Login Page</a>
      </div>
    </div>

    <script>
      const resetForm = document.getElementById("ForgotForm");
      const emailInput = document.getElementById("email");

      resetForm.addEventListener("submit", function (event) {
        const emailValue = emailInput.value;

        // Regular expression untuk memeriksa format email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Hapus pesan kesalahan jika sudah ada sebelumnya
        const existingError = emailInput.nextElementSibling;
        if (existingError && existingError.className === "error-message") {
          existingError.remove();
        }

        // Memeriksa apakah email sesuai dengan pola
        if (!emailPattern.test(emailValue)) {
          event.preventDefault(); // Mencegah form dikirim

          // Buat elemen div untuk pesan kesalahan
          const errorMessage = document.createElement("div");
          errorMessage.className = "error-message";
          errorMessage.style.color = "red";
          errorMessage.textContent = "Please enter a valid email address.";
          errorMessage.style.marginBottom = "10px";
          errorMessage.style.fontSize = "small";

          // Tambahkan pesan kesalahan setelah input email
          emailInput.parentNode.insertBefore(
            errorMessage,
            emailInput.nextSibling
          );
        }
      });
    </script>
  </body>
</html>
