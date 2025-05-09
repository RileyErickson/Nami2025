
function hideDeleteConfirmation(e) {
    if (e.target === this) {
        $('#delete-confirmation-wrapper').addClass('hidden');
    }
}

$(function() {
    $('#delete-cancel').click(hideDeleteConfirmation);
    $('#delete-confirmation-wrapper').click(hideDeleteConfirmation);
});

function showDeleteConfirmation() {
    $('#delete-confirmation-wrapper').removeClass('hidden');
}

function showCancelConfirmation() {
    $('#cancel-confirmation-wrapper').removeClass('hidden');
}

function showResolutionConfirmation() {
    $('#approve-confirmation-wrapper').removeClass('hidden');
}

function showApprove() {
    $('#resolution-confirmation-wrapper').removeClass('hidden');
}

function showReject() {
    $('#reject-confirmation-wrapper').removeClass('hidden');
}

function hideCompleteConfirmation(e) {
    if (e.target === this) {
        $('#complete-confirmation-wrapper').addClass('hidden');
    }
}

$(function() {
    $('#complete-cancel').click(hideCompleteConfirmation);
    $('#complete-confirmation-wrapper').click(hideCompleteConfirmation);
});

function showCompleteConfirmation() {
    $('#complete-confirmation-wrapper').removeClass('hidden');
}