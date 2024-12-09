// Function to handle update action
function handleUpdate(uploadId) {
    const url = `update_upload.php?id=${uploadId}`;
    window.location.href = url; // Redirect to update page
}

// Function to handle delete action
function handleDelete(uploadId) {
    if (confirm("Are you sure you want to delete this upload?")) {
        fetch(`delete_upload.php?id=${uploadId}`, { method: "POST" })
            .then((response) => response.text())
            .then((result) => {
                alert(result); // Show success or error message
                location.reload(); // Refresh the page to update the UI
            })
            .catch((error) => console.error("Error:", error));
    }
}
