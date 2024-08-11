document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".content");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove("active"));
            contents.forEach(c => c.classList.remove("active"));

            // Add active class to the clicked tab and corresponding content
            tab.classList.add("active");
            const target = tab.getAttribute("data-target");
            document.getElementById(target).classList.add("active");
        });
    });
});
