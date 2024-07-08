document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('default-search');
    const recipeTitles = document.querySelectorAll('.recipe-title');

    searchInput.addEventListener('input', function () {

        const searchTerm = searchInput.value.toLowerCase();

        recipeTitles.forEach(function (title) {
            const titleText = title.innerText.toLowerCase();

            if (titleText.includes(searchTerm)) {
                title.closest('.flex').style.display = 'flex'; // Show the recipe card
            } else {
                title.closest('.flex').style.display = 'none'; // Hide the recipe card
            }
        });
    });
}); 

