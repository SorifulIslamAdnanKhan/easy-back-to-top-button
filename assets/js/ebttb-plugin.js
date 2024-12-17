document.addEventListener("DOMContentLoaded", () => {
  const backToTopButton = document.getElementById("backToTop");

  // Register the ScrollToPlugin
  gsap.registerPlugin(ScrollToPlugin);

  // Show Button on Scroll
  window.addEventListener("scroll", () => {
    if (window.scrollY > 200) {
      backToTopButton.classList.add("visible");
    } else {
      backToTopButton.classList.remove("visible");
    }
  });

  // Scroll Back to Top with GSAP Animation
  backToTopButton.addEventListener("click", () => {
    gsap.to(window, {
      duration: 1,
      scrollTo: { y: 0 },
      ease: "power2.out",
    });
  });
});
