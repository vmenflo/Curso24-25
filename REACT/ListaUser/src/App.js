import React, { Component } from 'react';
import UserList from './componentes/UserList';
import UserForm from './componentes/UserForm';
import './App.css';

class App extends Component {
  constructor() {
    super();
    this.state = {
      users: [
        { id: 1, name: "perico", email: "perico@myfpschool.com" },
        { id: 2, name: "juanico", email: "juanico@myfpschool.com" },
        { id: 3, name: "andrés", email: "andrés@myfpschool.com" }
      ]
    };
  }

  handleOnAddUser(event) {
    event.preventDefault();
    
    if(!this.state.users.includes(event.target.email.value)){
      let user = {
        id:Math.max(...this.state.users.map(u=> u.id))+1,
        name: event.target.name.value,
        email: event.target.email.value
      };
      let tmp = this.state.users;
      tmp.push(user);
      this.setState({
        users: tmp
      });
    } 
  }

  render() {
    return (
      <div className="App">
        
          <p><strong>Añade usuarios</strong></p>
          <UserList users={this.state.users} />
          <UserForm onAddUser={(e) => this.handleOnAddUser(e)} />
        
      </div>
    );
  }
}
export default App;
