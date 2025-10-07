// Simple confirmation before submitting vote or deleting candidate
function confirmVote() {
    return confirm("Are you sure you want to cast this vote? You cannot change it later.");
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this candidate?");
}
