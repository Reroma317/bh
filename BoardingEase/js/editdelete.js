function handleEdit(uploadId) {
    // Redirect to an edit page or show a modal for editing
    window.location.href = 'edit_upload.php?id=' + uploadId;
}

function handleDelete(uploadId) {
    if (confirm('Are you sure you want to delete this upload?')) {
        fetch('delete_upload.php', {
            method: 'POST',
            body: JSON.stringify({ id: uploadId }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Upload deleted successfully');
                location.reload(); // Reload to refresh the content
            } else {
                alert('Error deleting upload: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        });
    }
}
