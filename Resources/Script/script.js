document.addEventListener('DOMContentLoaded', () => {
    const employeeForm = document.getElementById('employeeForm');
    if (employeeForm) {
        employeeForm.addEventListener('submit', addEmployee);
    }

    function addEmployee(e) {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const position = document.getElementById('position').value;
        const salary = document.getElementById('salary').value;

        if (name === '' || position === '' || salary === '') {
            alert('Please fill in all fields');
            return;
        }

        const employeeList = document.getElementById('employeeList');
        if (employeeList) {
            const li = document.createElement('li');
            li.appendChild(document.createTextNode(`${name} - ${position} - $${salary}`));
            employeeList.appendChild(li);
        }

        employeeForm.reset();
    }
});
