export function tagFilter() {
    const filterButtons = document.querySelectorAll(".filter-btn");
    const projectCards = document.querySelectorAll(".project-card-item");

    if (!filterButtons.length || !projectCards.length) return;

    function filterProjects(selectedTag) {
        projectCards.forEach(function(card) {
            const cardTags = card.getAttribute("data-tags");

            if (selectedTag === "all" || cardTags.includes(selectedTag)) {
                card.classList.remove("hidden-card");
            } else {
                card.classList.add("hidden-card");
            }
        });
    }

    function handleFilterClick(event) {
        // Remove active class from all buttons
        filterButtons.forEach(function(btn) {
            btn.classList.remove("active");
        });

        // Add active class to clicked button
        event.currentTarget.classList.add("active");

        // Get the filter value and filter projects
        const filterValue = event.currentTarget.getAttribute("data-filter");
        filterProjects(filterValue);
    }

    // Attach click listeners to all filter buttons
    filterButtons.forEach(function(btn) {
        btn.addEventListener("click", handleFilterClick);
    });
}