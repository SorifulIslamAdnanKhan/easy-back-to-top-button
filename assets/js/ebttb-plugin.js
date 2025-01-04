document.addEventListener("DOMContentLoaded", () => {
  const backToTopButton = document.getElementById("backToTop");

  // Show Button on Scroll
  window.addEventListener("scroll", () => {
    backToTopButton.classList.toggle("visible", window.scrollY > 200);
  });

  // Scroll Back to Top
  backToTopButton.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });
});
