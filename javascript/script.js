document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  form.addEventListener("submit", function (e) {
    const complaintType = document.getElementById("complaintType").value;
    const description = document.getElementById("description").value;

    if (complaintType === "Select Type" || description.trim() === "") {
      e.preventDefault();
      alert("Please fill out all fields.");
    }
  });
});

document.querySelector("form").addEventListener("submit", function (event) {
  const complaintType = document.getElementById("complaintType");
  const description = document.getElementById("description");

  if (complaintType.value === "Select Type") {
    alert("Please select a complaint type");
    event.preventDefault();
  }

  if (description.value.trim() === "") {
    alert("Please provide a description");
    event.preventDefault();
  }
});
