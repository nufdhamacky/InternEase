document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('complaint-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const studentName = document.getElementById('student_name').value;
        const studentEmail = document.getElementById('student_email').value;
        const complaint = document.getElementById('complaint').value;

        if (studentName.trim() === '') {
            alert('Please enter your name.');
            return;
        }

        if (studentEmail.trim() === '' || !isValidEmail(studentEmail)) {
            alert('Please enter a valid email address.');
            return;
        }

        if (complaint.trim() === '') {
            alert('Please enter your complaint.');
            return;
        }

        form.submit();
    });

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
