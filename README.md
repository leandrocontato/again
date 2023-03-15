# again

Resumo:
Implementação das views para exibir a lista de tarefas e permitir a criação, edição e exclusão de tarefas.
Criação das rotas para as views e para a API RESTful que gerencia as tarefas.
Implementação dos métodos nos controllers para manipular as tarefas, incluindo a validação dos dados de entrada e a lógica de negócio.
Criação da model para representar os dados das tarefas e mapeá-los para o banco de dados MySQL, além de implementar métodos para recuperar, criar, atualizar e excluir tarefas.
Criação das migrations para gerar as tabelas do banco de dados.
Utilização do Bootstrap para estilizar as views e tornar a interface de usuário mais amigável.
Implementação de JavaScript (AJAX) para permitir a manipulação das tarefas de forma assíncrona sem precisar recarregar a página.
Configuração do ambiente de desenvolvimento com o banco de dados MySQL, as dependências necessárias e as variáveis de ambiente.
Em resumo, foi criada uma aplicação web de gerenciamento de tarefas que permite que os usuários criem, editem, excluam e marquem como concluídas suas tarefas, utilizando uma interface de usuário responsiva e agradável. Além disso, a aplicação possui uma API RESTful para gerenciar as tarefas e é capaz de lidar com requisições assíncronas utilizando JavaScript (AJAX).

Utilizei das tecnologias e linguagens descritas no exercicio:
Laravel(PHP framework), Bootstrap, JavaScript(AJAX), MySQL, HTML e CSS.

Explicação detalhada do funcionamento:
1.
Fiz apenas uma view utilizando o conceito de rotas com recursos do Laravel.
Na view foi utilizado @extends de um arquivo de layouts.
A adição de classes específicas para cada botão permitiu a criação de funções JavaScript para cada um deles, tornando possível a interação com a API RESTful do Laravel sem que a página precise ser recarregada a cada ação do usuário. Além disso, também foi adicionado um formulário para a criação de novas tarefas diretamente na página, sem precisar redirecionar para outra view.
2.
Criação da controller para gerenciamento de tarefas, nela tem os métodos index(), store(), e edit(), update(), complete() e destroy(), que correspondem às ações de listagem, criação, edição, atualização, marcação como concluída e exclusão de tarefas, respectivamente.

No método index(), recuperamos todas as tarefas existentes no banco de dados e retornamos a view 'tasks.index', passando as tarefas como parâmetro.

No método edit(), é responsável por retornar uma tarefa específica em formato JSON, para que ela possa ser editada na interface do usuário através do JavaScript. Ele recebe o ID da tarefa como parâmetro, busca essa tarefa no banco de dados e retorna seus dados em formato JSON através do método response()->json().

No método store(), criamos uma nova tarefa com o título enviado pelo formulário de criação de tarefas e retornamos uma resposta em formato JSON indicando que a tarefa foi criada com sucesso.

No método update(), atualizamos o título de uma tarefa existente com o novo título enviado pelo formulário de edição de tarefas e retornamos uma resposta em formato JSON indicando que a tarefa foi atualizada com sucesso.

No método complete(), marcamos uma tarefa como concluída e retornamos uma resposta em formato JSON indicando que a tarefa foi marcada como concluída com sucesso.

No método destroy(), excluímos uma tarefa existente e retornamos uma resposta em formato JSON indicando que a tarefa foi excluída com sucesso.

Esses métodos são responsáveis por lidar com as requisições AJAX enviadas pela view única apresentada anteriormente, utilizando a API RESTful do Laravel.
3.
Utilizando o trait HasFactory, que fornece uma implementação padrão do método de criação de factories para modelos. Além disso, estamos definindo o atributo $fillable, que indica quais campos da tabela 'tasks' podem ser preenchidos em massa. Nesse caso, permitimos o preenchimento dos campos 'title' e 'completed'. Essa é uma implementação simples da model Task, que contém apenas os atributos necessários para nosso exemplo de aplicação de gerenciamento de tarefas.
4.
Essa migration cria a tabela 'tasks', que possui os campos 'id', 'title', 'completed' e os campos de data e hora de criação e atualização. O campo 'id' é a chave primária da tabela e é gerado automaticamente pelo Laravel. O campo 'title' é do tipo string e armazena o título da tarefa. O campo 'completed' é do tipo booleano e é usado para indicar se a tarefa foi concluída ou não. O método up() é responsável por criar a tabela no banco de dados, enquanto o método down() é usado para excluir a tabela, caso seja necessário.
5.
Rotas web, nesse arquivo, estamos definindo as rotas para as páginas da interface do usuário da aplicação.
A rota '/tasks' com o método 'index()', que lista todas as tarefas;
A rota '/tasks/create' com o método 'create()', que retorna o formulário para criar uma nova tarefa;
A rota '/tasks' com o método 'store()', que salva uma nova tarefa no banco de dados;
A rota '/tasks/{id}' com o método 'show()', que exibe os detalhes de uma tarefa;
A rota '/tasks/{id}/edit' com o método 'edit()', que retorna o formulário para editar uma tarefa existente;
A rota '/tasks/{id}' com o método 'update()', que atualiza uma tarefa existente;
A rota '/tasks/{id}' com o método 'destroy()', que exclui uma tarefa existente.
6.
Rotas api, nesse arquivo, estamos definindo as rotas para a API da aplicação. As rotas são associadas aos métodos correspondentes do controller TaskController. 
As rotas definidas são as seguintes:
A rota '/tasks' com o método 'index()', que lista todas as tarefas;
A rota '/tasks' com o método 'store()', que cria uma nova tarefa;
A rota '/tasks/{id}' com o método 'show()', que retorna os detalhes de uma tarefa específica;
A rota '/tasks/{id}' com o método 'update()', que atualiza uma tarefa existente;
A rota '/tasks/{id}' com o método 'destroy()', que exclui uma tarefa existente.
