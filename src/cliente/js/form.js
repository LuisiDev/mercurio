function showForm() {
  document.getElementById("formContainer").style.display = "block";
  document.getElementById("showForm").style.display = "none";
  document.getElementById("hideForm").style.display = "flex";
}

function hideForm() {
  document.getElementById("formContainer").style.display = "none";
  document.getElementById("showForm").style.display = "flex";
  document.getElementById("hideForm").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
  const starContainers = document.querySelectorAll(".star-container");

  starContainers.forEach((container) => {
    const stars = container.querySelectorAll(".star");
    let selectedRating = 0;

    stars.forEach((star) => {
      star.addEventListener("mouseover", function () {
        resetStars(container);
        highlightStars(container, this.getAttribute("data-value"));
      });

      star.addEventListener("mouseout", function () {
        resetStars(container);
        if (selectedRating > 0) {
          highlightStars(container, selectedRating);
        }
      });

      star.addEventListener("click", function () {
        selectedRating = this.getAttribute("data-value");
        resetStars(container);
        highlightStars(container, selectedRating);
        stars.forEach((star) => {
          if (star.getAttribute("data-value") <= selectedRating) {
            star.classList.add("selected");
          }
        });
        container.querySelector('input[type="hidden"]').value = selectedRating;
      });
    });

    function resetStars(container) {
      const stars = container.querySelectorAll(".star");
      stars.forEach((star) => {
        star.classList.remove("hover", "selected");
      });
    }

    function highlightStars(container, rating) {
      const stars = container.querySelectorAll(".star");
      stars.forEach((star) => {
        if (star.getAttribute("data-value") <= rating) {
          star.classList.add("hover");
        }
      });
    }
  });
});
