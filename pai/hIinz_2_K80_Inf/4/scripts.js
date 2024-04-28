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
			taskItem.removeChild(taskContent);
			input.focus();

			input.addEventListener('blur', function(){
				taskContent.textContent = input.value;
				taskItem.insertBefore(taskContent, input);
				taskItem.removeChild(input);
				saveTasks();
			});
		});

		//tworzenie przycisku do usuwania zadania
		const deleteButton = document.createElement('button');
		deleteButton.textContent = 'Usuń';
		deleteButton.addEventListener('click', function(){
			taskList.removeChild(taskItem);
			saveTasks();
		});

		//tworzenie listy dla podzadań
		const subtaskList = document.createElement('ul');
		subtaskList.className = 'subtaskList';

		//tworzenie formularza do dodawania podzadań
		const addSubtaskForm = document.createElement('form');
		const subtaskInput = document.createElement('input');
		subtaskInput.type = 'text';
		subtaskInput.placeholder = 'Dodaj podzadanie';
		const addSubtaskButton = document.createElement('button');
		addSubtaskButton.textContent = 'Dodaj';
		addSubtaskForm.appendChild(subtaskInput);
		addSubtaskForm.appendChild(addSubtaskButton);

		//obsługa zdarzenia 'submit' formularza dodawania podzadań
		addSubtaskForm.addEventListener('submit', function(event){
			event.preventDefault();
			const subtaskText = subtaskInput.value.trim();
			if (subtaskText === '') {
				alert('Proszę wpisać podzadanie!');
				return;
			}

			//tworzenie i dodawanie podzadań do listy podzadań
			const subtask = document.createElement('li');
			subtask.textContent = subtaskText;
			subtask.className = 'subtask';
			subtask.addEventListener('click', function(){
				subtask.classList.toggle('done');
			});
			subtaskList.appendChild(subtask);
			subtaskInput.value = '';
			saveTasks();
		});
		//dodawanie elementów do elementu zadania
		taskItem.appendChild(taskContent);
		taskItem.appendChild(editButton);
		taskItem.appendChild(deleteButton);
		taskItem.appendChild(addSubtaskForm);
		taskItem.appendChild(subtaskList);

		return taskItem;
	}

	function saveTasks(){
		const tasks = [];
		taskList.querySelectorAll('li').forEach(taskItem => {
			const task = {
				content: taskItem.querySelector('span').textContent,
				done: taskItem.querySelector('span').classList.contains('done'),
				subtasks: []
			};
			taskItem.querySelectorAll('.subtask').forEach(subtaskItem => {
				task.subtasks.push({
					content: subtaskItem.textContent,
					done: subtaskItem.classList.contains('done')
				});
			});
			tasks.push(task);
		});
		localStorage.setItem('tasks', JSON.stringify(tasks));
	}

	function loadTasks(){
		const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
		tasks.forEach(task => {
			const taskItem = createTaskElement(task.content);
			if (task.done) {
				taskItem.querySelector('span').classList.add('done');
			}
			task.subtasks.forEach(subtask => {
				const subtaskItem = document.createElement('li');
				subtaskItem.textContent = subtask.content;
				subtaskItem.className = 'subtask';
				if (subtask.done) {
					subtaskItem.classList.add('done');
				}
				taskItem.querySelector('.subtaskList').appendChild(subtaskItem);
			});
			taskList.appendChild(taskItem);
		});
	}

	loadTasks();

});