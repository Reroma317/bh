document.addEventListener('DOMContentLoaded', () => {
    const uploadFormContainer = document.getElementById('upload-form');
    const searchFormContainer = document.getElementById('search-form');
    const uploadButton = document.getElementById('show-upload');
    const searchButton = document.getElementById('show-search');

    // Add click event to toggle between upload and search forms
    uploadButton.addEventListener('click', () => {
        uploadFormContainer.classList.remove('hidden'); // Show upload form
        searchFormContainer.classList.add('hidden'); // Hide search form
        uploadButton.classList.add('active'); // Highlight the active button
        searchButton.classList.remove('active'); // Remove highlight from search button
    });

    searchButton.addEventListener('click', () => {
        searchFormContainer.classList.remove('hidden'); // Show search form
        uploadFormContainer.classList.add('hidden'); // Hide upload form
        searchButton.classList.add('active'); // Highlight the active button
        uploadButton.classList.remove('active'); // Remove highlight from upload button
    });
});

