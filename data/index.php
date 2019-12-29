<?php
require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/lib/functions.php');
require_once(__DIR__ . '/lib/Todo.php');

$todoApp = new \MyApp\Todo();
$todos = $todoApp->getAll();

// var_dump($todos);
// exit;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styles.css">
  <!-- <script src="vue.js" type="module"></script> -->
  <!-- <script src="axios" type="module"></script> -->
  <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
  <title>Todos</title>
</head>

<body>
<div id="app">
  {{message}}
<div id="container">
  <h1>Todos</h1>
  <form action="/_ajax.php" method="POST">
  <input type="text" id="new_todo" 　name="mode" placeholder="やることは？">
  <input type="number" id="new_todo" 　name="id" value="1">
  <input type="submit" value="送信">
  </form>
  <ul id="todos">
    <?php
    foreach ($todos as $todo) : ?>
    <li>
      <input type="checkbox" 
             class="update_todo" 
             v-on:input="doneTodo(<?= $todo->id ?>,$event)" 
             <?php if ($todo->state === '1') {                                                                                                   
             echo "checked";}
                                                                                                        ?>>
            <span class="<?php if ($todo->state === '1') {
                          echo 'done';}?>">
            <?php echo h($todo->title); ?></span>
            <div class="delete_todo">×</div>
    </li>
        <?php endforeach ?>
</ul>

<hr class="vue-php">
  <ul>
  aaa
    <li v-for="todo in todos">
      <input type="checkbox" class="update_todo" v-model="todo.state">
      <span :class="{done : todo.state}">{{todo.title}}</span>
      <div class="delete_todo">×</div>
        </li>
  </ul>
</div>
</div>
<script src="todos.js"></script>
</body>
</html>