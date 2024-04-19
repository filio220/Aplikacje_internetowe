document.addEventListener('DOMContentLoaded', function(){
  //console.log("test");
	const taskForm = document.getElementById('taskForm');
	const taskList = document.getElementById('taskList');
	//console.log(taskForm);

	taskForm.addEventListener('submit', function(event){
		event.preventDefault();
		const taskInput = document.getElementById('taskInput');
		if (taskInput.value.trim() === '') {
			alert('Proszę wpisać zadanie')
			return;
		}

		const newTask = createTaskElement(taskInput.value);
		taskList.appendChild(newTask);
		taskInput.value = '';
		saveTasks();

	});

	function createTaskElement(taskText){
		const taskItem = document.createElement('li');
		const taskContent = document.createElement('span');
		taskContent.textContent = taskText;

		taskContent.addEventListener('click', function(){
			taskContent.classList.toggle('done');
			saveTasks();
		});

		const editButton = document.createElement('button');
		editButton.textContent = 'Edytuj';

		editButton.addEventListener('click', function(){
			const input = document.createElement('input');
			input.type = 'text';
			input.value = taskContent.textContent;
		});

	}

});