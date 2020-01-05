// import Vue from 'vue';

var app = new Vue({
  el: '#app',
  data: {
    todos: [],
    newTodo: ''
  },
  methods: {
    doneTodo: async function(id, e) {
      const res = await this.commonAjax(id, e, 'update');
      console.log(res);
    },
    deleteTodo(id, e) {
      const res = this.commonAjax(id, e, 'delete');
      this.todos.splice(id, 1);
      console.log(res);
    },
    addTodo(id, e) {
      const res = this.commonAjax(id, e, 'create', this.newTodo);
      const todo = new Object();
      console.log(res);
    },
    commonAjax(id, e, sendMode, createTitle = false) {
      const params = new URLSearchParams();
      console.log(id, e);
      params.append('id', id);
      params.append('mode', sendMode);
      if (!createTitle) {
        params.append('title', createTitle);
      }
      return axios.post('_ajax.php', params).catch(err => console.log(err));
    },
    stateChangeToBool() {
      this.todos.forEach(value => {
        if (value.state == 1) {
          value.state = true;
        }
        if (value.state == 0) {
          value.state = false;
        }
      });
    },
    stateChangeToNumber() {
      return this.todos.map(value => {
        if (value.state === true) {
          return 1;
        }
        if (value.state === false) {
          return 0;
        }
      });
    },
    doUpdateAjax(id, e) {
      console.log(id, e);
      this.doneTodo(id, e);
    }
  },
  async beforeCreate() {
    const params = new URLSearchParams();
    params.append('id', 0);
    params.append('mode', 'mounted');
    axios.post('/_ajax.php', params).then(res => {
      console.log(res);
      console.log(res.data.state);
      this.todos = res.data.state;
      this.stateChangeToBool();
    });
    console.log(this.todos);
    console.log('mounted');
  }
});
