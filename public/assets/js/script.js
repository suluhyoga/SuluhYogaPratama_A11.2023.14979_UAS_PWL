document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const nama = document.getElementById("xnama");
  const alamat = document.getElementById("xalamat");
  const email = document.getElementById("xemail");
  const pesan = document.getElementById("xpesan");

  form.addEventListener("submit", (event) => {
    let valid = true;

    if (!nama.value.trim()) {
      alert("Nama harus diisi !!!");
      nama.focus();
      valid = false;
    } else if (!alamat.value.trim()) {
      alert("Alamat harus diisi !!!");
      alamat.focus();
      valid = false;
    } else if (!email.value.trim()) {
      alert("Email harus diisi !!!");
      email.focus();
      valid = false;
    } else if (!pesan.value.trim()) {
      alert("Pesan harus diisi !!!");
      pesan.focus();
      valid = false;
    }

    if (!valid) {
      event.preventDefault();
    }
  });
});
