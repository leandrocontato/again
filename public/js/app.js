/* Adiciona funcionalidades na página */

// Seleciona o formulário de criação de tarefas
const form = document.querySelector('#create-task-form');

// Adiciona um evento de submissão no formulário
form.addEventListener('submit', (event) => {
  event.preventDefault(); // Previne o comportamento padrão do formulário

  const descriptionInput = document.querySelector('#description'); // Seleciona o campo de descrição
  const description = descriptionInput.value.trim(); // Obtém o valor do campo e remove espaços em branco

  // Verifica se a descrição está vazia
  if (description.length === 0) {
    alert('A descrição da tarefa não pode estar vazia!');
    return;
  }

  // Cria um objeto FormData com os dados do formulário
  const formData = new FormData(event.target);

  // Faz uma requisição assíncrona para criar a nova tarefa
  fetch('/api/tasks', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Ocorreu um erro ao criar a tarefa.');
    }

    return response.json();
  })
  .then(data => {
    console.log(data);
    descriptionInput.value = ''; // Limpa o campo de descrição
    alert('Tarefa criada com sucesso!');
  })
  .catch(error => {
    console.error(error);
    alert('Ocorreu um erro ao criar a tarefa.');
  });
});
