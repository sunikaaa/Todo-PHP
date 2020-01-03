// import Vue from 'vue';

var app = new Vue({
  el: '#app',
  data: {
    message: 'Hello',
    todos: []
  },
  methods: {
    doneTodo: function(id, e) {
      const params = new URLSearchParams();
      console.log(id, e);
      params.append('id', id);
      params.append('mode', 'update');
      axios
        .post('_ajax.php', params)
        .then(res => {
          console.log(res);
          if (res.state == 1) {
            e.target.addClass('done');
          } else {
            e.target.removeClass('done');
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    stateChange() {
      this.todos.forEach(value => {
        if (value.state == 1) {
          value.state = true;
        }
        if (value.state == 0) {
          value.state = false;
        }
      });
    }
  },
  async mounted() {
    const params = new URLSearchParams();
    params.append('id', 0);
    params.append('mode', 'mounted');
    axios.post('/_ajax.php', params).then(res => {
      console.log(res);
      console.log(res.data.state);
      this.todos = res.data.state;
    });
    this.stateChange();
    console.log(this.todos);
    console.log('mounted');
  }
});
