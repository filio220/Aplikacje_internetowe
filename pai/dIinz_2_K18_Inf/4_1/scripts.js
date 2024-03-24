document.addEventListener('DOMContentLoaded', function(){
	//console.log('test');
	const taskForm = document.getElementById('taskForm');
	const taskList = document.getElementById('taskList');

	taskForm.addEventListener('submit', function(event){
		event.preventDefault();

		const taskInput = document.getElementById('taskInput');

		if (taskInput.value.trim() === '') {
			alert("Proszę wpiasać dane")
			return;
		}
		//console.log(taskInput.value);
		const newTask = createTaskElement(taskInput.value);

		taskList.appendChild(newTask);
		taskInput.value = '';  
		saveTasks();
	});

	function createTaskElement(taskText){
		//console.log("aaaaa");
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

		const deleteButton = document.createElement('button'); 
		deleteButton.textContent = 'Usuń';
		deleteButton.addEventListener('click', function(){
			taskList.removeChild(taskItem);
			saveTasks();
		});

		const subTaskList = document.createElement('ul');
		subTaskList.className = 'subtaskList';

		const addSubTaskForm = document.createElement('form');
		const subTaskInput = document.createElement('input');
		subTaskInput.type = 'text';
		subTaskInput.placeholder = 'Dodaj podzadanie';
		const addSubTaskButton = document.createElement('button');
		addSubTaskButton.textContent = 'Dodaj';
		addSubTaskForm.appendChild(subTaskInput);
		addSubTaskForm.appendChild(addSubTaskButton);

		// obsłga zdarzenia 'submit' formularza dodawania podzadań
		addSubTaskForm.addEventListener('submit', function(event){
			event.preventDefault();
			const subtaskText = subTaskInput.value.trim();
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
			subTaskList.appendChild(subtask);
			subTaskInput.value = '';
			saveTasks();
		});

		//dodawanie elementów do elementu zadania
		taskItem.appendChild(taskContent);
		taskItem.appendChild(editButton);
		taskItem.appendChild(deleteButton);
		taskItem.appendChild(addSubTaskForm);
		taskItem.appendChild(subTaskList);

		return taskItem;
	}

	//funkcja zapisująca stan listy zadań w pamięci lokalnej
	function saveTasks(){
		const tasks = [];
		taskList.querySelectorAll('li').forEach(taskItem => {
			const task = {
				content: taskItem.querySelector('span').textContent,
				done: taskItem.querySelector('span').classList.contains('done'),
				subtasks: []
			};

			//iteracja po wszystkich podzadanich i zapisywanie ich
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

	//funkcja odczytująca stan listy zadań z pamięci lokalnej
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
				taskItem.querySelector('subtaskList').appendChild(subtaskItem);
			});
			taskList.appendChild(taskItem);
		});
	}

	loadTasks();

});