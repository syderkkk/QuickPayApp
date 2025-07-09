window.sendToContact = function(email) {
    document.getElementById('contactEmailSend').value = email;
    document.getElementById('sendToContactForm').submit();
};

window.requestFromContact = function(email) {
    document.getElementById('contactEmailRequest').value = email;
    document.getElementById('requestFromContactForm').submit();
};