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
		subTaskList.className = 'subTaskList';

		const addSubTaskForm = document.createElement('form');
		const subTaskInput = document.createElement('input');
		subTaskInput.type = 'text';
		subTaskInput.placeholder = 'Dodaj podzadanie';
		const addSubTaskButton = document.createElement('button');
		addSubTaskButton.textContent = 'Dodaj';
		addSubTaskForm.appendChild(subTaskInput);
		addSubTaskForm.appendChild(addSubTaskButton);

	}
});