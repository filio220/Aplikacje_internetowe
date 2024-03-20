document.addEventListener('DOMContentLoaded', function(){
  const taskForm = document.getElementById('taskForm');
  const taskList = document.getElementById('taskList');
	
	taskForm.addEventListener('submit', function(event){
		event.preventDefault();

		const taskInput = document.getElementById('taskInput');
		if (taskInput.value.trim() === ''){
			alert('Proszę wpisać zadanie');
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
			taskItem.insertBefore(input, taskContent);
			taskItem.removeChild('taskContent');
			input.focus();

			input.addEventListener('blur', function(){
				taskContent.textContent = input.value;
				taskItem.insertBefore(taskContent, input);
				taskItem.removeChild(input);
				saveTasks();
			});
		});

		
		

		
	}

});