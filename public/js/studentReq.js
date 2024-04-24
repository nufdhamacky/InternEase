document.addEventListener("DOMContentLoaded", function() {
    // Get all select elements
    const selects = document.querySelectorAll('.allstudents select');

    // Get all tables
    const tables = document.querySelectorAll('.details');

    // Hide all tables initially
    tables.forEach(table => {
        table.style.display = 'none';
    });

    // Add change event listener to each select element
    selects.forEach(select => {
        select.addEventListener('change', function() {
            const selectedValue = this.value;

            // Hide all tables initially
            tables.forEach(table => {
                table.style.display = 'none';
            });

            // Show the table based on the selected value
            const selectedTable = document.getElementById(selectedValue + 'Table');
            if (selectedTable) {
                selectedTable.style.display = 'block';
            }
        });
    });

    // Set default selection to Software Engineer
    const defaultCategory = 'all';
    const defaultTable = document.getElementById(defaultCategory + 'Table');
    const defaultSelect = document.querySelector('.allstudents select');
    
    if (defaultTable) {
        defaultTable.style.display = 'block';
    }

    if (defaultSelect) {
        defaultSelect.value = defaultCategory;
    }
});