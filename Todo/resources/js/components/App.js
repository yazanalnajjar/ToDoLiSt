import React , {Component} from 'react';
import {BrowserRouter  as Router, Route} from 'react-router-dom'
import axios from 'axios';

import Todos from './Todos';

import Header from './layout/Header';
import AddTodo from './AddTodo';
// import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class App extends Component {
  state = {
    todos : [ ]
  }

  componentDidMount(){
    axios.get('/api/tasks', {
        headers: { 'Content-Type': 'application/json' }
    })
    .then(res => this.setState({todos: res.data}))
  }


  //Toggle Complete
  markComplete = (id) =>{
    this.setState({todos : this.state.todos.map((todo) => {
         if(todo.id === id){
           todo.comppleted = !todo.comppleted
         }
         return todo
    })
  })
  }


//Delete Todo
delTodo = (id) =>{
 this.setState({todos : [...this.state.todos.filter(todo => todo.id !== id)]})
}


// Add Todo
addTodo = (title) => {
  axios.post( '/api/tasks',
  {
      name: name
  },
  {
    title, completed: false
  })
  .then(res => this.setState({todos : [...this.state.todos, res.data]}))
}



updateItem = (title, id) => {
    return axios
        .put(
            `/api/tasks/${id}`,
            {
                title: title
            },
            {
                headers: { 'Content-Type': 'application/json' }
            }
        )
        .then(function(response) {
            console.log(response)
        })
}

  render(){


  return (
    <Router>
     <div className="App">
    <div className="container">
    <Header/>
    <React.Fragment>


    <AddTodo addTodo = { this.addTodo } />



    <Todos todos = {this.state.todos}
           markComplete = {this.markComplete}
           delTodo = {this.delTodo}
           updateItem = {this.updateItem}/>




      </React.Fragment>



    </div>
    </div>
    </Router>

  );
  }
}

ReactDOM.render(<App/> , document.getElementById('root'));
