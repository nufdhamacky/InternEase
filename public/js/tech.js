document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Display the calendar in month view initially
        events: [
                // Here you can provide events data in the specified format
                // Example:
            {
                title: 'Tech Talk 1',
                start: '2024-03-10T10:00:00',
                end: '2024-03-10T12:00:00'
            },
            {
                title: 'Tech Talk 2',
                start: '2024-03-15T14:00:00',
                end: '2024-03-15T16:00:00'
            },
                // Add more events as needed
         ]
    });

    calendar.render();
});