<?php
require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/lib/functions.php');
require_once(__DIR__ . '/lib/Todo.php');

$todoApp = new \MyApp\Todo();
$todos = $todoApp->getAll();


?>

<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/transition.css">
  <script src="/node_modules/vue/dist/vue.js"></script>
  <script src="/node_modules/axios/dist/axios.js"></script>
  <title>Todos</title>
</head>

<body>
  <div id="app">
    <div id="container">
      <h1>Todos</h1>
      <form action="/_ajax.php" method="POST">
        <input type="text" id="new_todo" 　name="mode" placeholder="やることは？" v-model="newTodo">
        <input type="number" id="new_todo" 　name="id" value="1">
        <input type="submit" value="送信" @click.prevent="addTodo(0,$event)">
      </form>
      <ul id="todos">
        <?php
        foreach ((array) $todos as $todo) : ?>
          <li>
            <input type="checkbox" class="update_todo" v-on:input="doneTodo(<?= $todo->id ?>,$event)" <?php if ($todo->state === '1') {
                                                                                                        echo "checked";
                                                                                                      }
                                                                                                      ?>>
            <span class="<?php if ($todo->state === '1') {
                            echo 'done';
                          } ?>">
              <?php echo h($todo->title); ?></span>
            <div class="delete_todo" @click="deleteTodo(<?= $todo->id ?>,$event)">×</div>
          </li>
        <?php endforeach ?>
      </ul>

      <hr class="vue-php">
      <transition-group name="list" tag="ul">
        <li v-for="( todo,index ) in todos" :key="todo.id">
          <input type="checkbox" class="update_todo" @change="doUpdateAjax(todo.id,$event)" v-model="todo.state">
          <span :class="{done : todo.state}">{{todo.title}}</span>
          <div class="delete_todo" @click="deleteTodo(todo.id,$event)">×</div>
        </li>
      </transition-group>
    </div>
  </div>
  <script src="js/todos.js"></script>
</body>

</html>