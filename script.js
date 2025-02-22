document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll(".hidden");
    const scrollTopBtn = document.getElementById("scrollTop");

    gsap.from("header h1", { opacity: 0, y: -50, duration: 1 });
    gsap.from("header p", { opacity: 0, y: -30, duration: 1, delay: 0.5 });
    gsap.from("nav ul li", { opacity: 0, y: -20, duration: 1, stagger: 0.3 });

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                gsap.to(entry.target, { opacity: 1, y: 0, duration: 1 });
            }
        });
    }, { threshold: 0.3 });

    sections.forEach(section => {
        observer.observe(section);
    });

    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            scrollTopBtn.style.display = "block";
        } else {
            scrollTopBtn.style.display = "none";
        }
    });

    scrollTopBtn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});
