document.addEventListener('DOMContentLoaded', () => {
    const searchForm = document.getElementById('searchForm');
    const newsfeedContainer = document.getElementById('newsfeed-container');

    // Function to fetch and display search results
    function loadSearchResults(formData) {
        fetch('search.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text())
            .then(data => {
                newsfeedContainer.innerHTML = data; // Display search results
            })
            .catch(error => console.error('Error fetching search results:', error));
    }

    // Attach submit event to the search form
    searchForm.addEventListener('submit', (e) => {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(searchForm);
        loadSearchResults(formData);
    });
});